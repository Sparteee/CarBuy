<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\Utilisateur;
use App\Entity\Voiture;
use App\Repository\CommandeRepository;
use App\Repository\UtilisateurRepository;
use App\Repository\VoitureRepository;
use Doctrine\Persistence\ObjectManager;
use http\Client\Curl\User;
use mysql_xdevapi\DatabaseObject;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    #[Route('/panier', name: 'panier')]
    public function index(UtilisateurRepository $utilisateurRepository ,SessionInterface $session , VoitureRepository $voitureRepository): Response
    {
        // On récupère l'id de l'utilisateur
        $user = $this->getUser()->getId();
        // On recherche l'utilisateur
        $utilisateur = $utilisateurRepository->find($user);

        // On ouvre la session avec le panier dedans
        $panier = $session->get("panier" , []);

        // On déclare les variables qui vont nous être utile
        $dataPanier = [];
        $total = 0;
        // On boucle sur le panier pour récupérer toutes les valeurs présente dans celui-ci
        foreach($panier as $value){
            // On recherche chaque voiture qui sont présents dans le panier de l'utilisateur
            $voiture = $voitureRepository->find($value);
            // On push les objets voitures dans un tableau pour simplifier l'affichage
            array_push($dataPanier , $voiture);
            // Calcul du total qui additionne chaque prix de voiture au total
            $total += $voiture->getPrix();
        }
        return $this->render('panier/index.html.twig', [
            'panier' => $dataPanier,
            'total' => $total,
            'utilisateur' => $utilisateur
        ]);
    }

    #[Route('/panier/ajouter/{id}', name: 'ajout_panier')]
    public function ajouter(Voiture $voiture ,SessionInterface $session): Response
    {

        // On ouvre la session qui contient le panier
        $panier = $session->get("panier" ,[]);
        // On récupère l'id de la voiture à ajouter
        $id = $voiture->getId();

        // Vérification que cette voiture n'est pas présente dans le panier car on ne peut pas acheter en même temps 2 fois la même voiture
        if(!in_array($id , $panier)){
            // On ajoute la voiture qui correspond à cette id
            array_push($panier , $id);
            // On fixe les changements qui ont été effectués dans le panier
            $session->set("panier", $panier);

            // On redirige avec la route /panier
            return $this->redirectToRoute('panier');
        }
        else{
            // Gestion des erreurs possibles qui se remplissent seulement il y a une erreur
            $existant = "Erreur";
            $suppresion = "suppr";
            // Redirection vers une page d'erreur
            return $this->render('panier/ErreurPanier.html.twig' , [
                'existant' => $existant,
                'suppression' => $suppresion
            ]);
        }

    }
    #[Route('/panier/supprimer/{id}', name: 'supprimer_panier')]
    public function supprimer(Voiture $voiture ,SessionInterface $session): Response
    {
        // On ouvre la session qui contient le panier
        $panier = $session->get("panier" , []);
        // On recupère l'id de la voiture à supprimer
        $id = $voiture->getId();

        // On vérifie cette voiture est bien présente dans le panier
        if(in_array($id, $panier)){
            // On boucle pour effectuer une recherche
           foreach ($panier as $cle => $element){
               // Vérification de correspondance
               if($element == $id){
                   // Si une id du panier est égale à l'id recherché alors on enlève la voiture associé à la clé ou la condition a été validé
                   unset($panier[$cle]);
               }
            }
           // On fixe les changements qui ont été effectués dans le panier
            $session->set("panier" , $panier);
           // On redirige vers le panier pour bien voir les changements
            return $this->redirectToRoute("panier");
        }
        else{
            // Gestion des erreurs possibles
            $suppresion = "Erreur";
            $existant = "Existe";
            return $this->render("panier/ErreurPanier.html.twig" , [
                'suppression' => $suppresion,
                'existant' => $existant
            ]);
        }



    }


    #[Route('/panier/vider', name: 'vider_panier')]
    public function viderPanier(SessionInterface $session): Response
    {
        // Détruit complètement la session qui contient le panier
        $session->remove("panier");

        return $this->redirectToRoute("panier");

    }
    #[Route('/panier/valider', name: 'valider_panier')]
    public function validation(VoitureRepository $voitureRepository ,Request $request ,CommandeRepository $commandeRepository , SessionInterface $session): Response
    {
        // On ouvre la session qui contient le panier
        $panier  = $session->get("panier" , []);

        // On récupère l'utilisateur qui valide le panier
        $user = $this->getUser();
        // Tableau vide pour passer des données plus facilement
          $voiture = [];

        // Vérification pour pas valider un panier vide
        if(!empty($panier)){

            // On recherche toutes les voitures présentes dans le panier
            foreach ($panier as $id) {
                $findvoiture = $voitureRepository->find($id);
                array_push($voiture, $findvoiture);
            }
            // Gestion si il y a qu'une voiture dans le panier
                if(count($voiture) == 1){
                    // Création de la commande avec la date de la commande et l'utilisateur associé à cette commande
                    $commande = new Commande(new \DateTime() , $user);
                    // On ajoute la seule voiture présente dans le panier
                    $commande->addVoiture($voiture[0]);
                    // Systeme envoi vers la base de données
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($commande);
                    $em->flush();
                }
                else {
                    // Gestion plusieurs voitures
                    // Parcours de toutes les voitures présente dans le panier
                    foreach ($voiture as $element) {
                        // Création de la commande avec date et utilisateur associé
                        $commande = new Commande(new \DateTime(), $user);
                        // On associe chaque voiture à une commande .
                        $commande->addVoiture($element);
                        // Systeme envoi vers la base de données
                        $em = $this->getDoctrine()->getManager();
                        $em->persist($commande);
                        $em->flush();
                    }
                }
        }
        // Et on détruit la session du panier pour remettre le panier à 0
        $session->remove("panier");
        return $this->redirectToRoute("profil");
    }
}
