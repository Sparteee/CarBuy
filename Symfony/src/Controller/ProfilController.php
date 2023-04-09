<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\UtilisateurType;
use App\Repository\CommandeRepository;
use App\Repository\UtilisateurRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use MongoDB\Driver\Manager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/profil')]
class ProfilController extends AbstractController
{
    #[Route('/', name: 'profil', methods: ['GET'])]
    public function index(CommandeRepository $commandeRepository, UtilisateurRepository $utilisateurRepository): Response
    {
        // On récupère l'id de l'utilisateur
        $user = $this->getUser()->getId();
        // On recherche toutes les commandes associés à l'utilisateur récupéré précedemment
        $commandes = $commandeRepository->FindCommandeByIdUtilisateur($user);
        return $this->render('profil/index.html.twig', [
            'utilisateur' => $utilisateurRepository->find($user),
            'commandes' => $commandes
        ]);
    }

    #[Route('/{id}/edit', name: 'modifier_profil', methods: ['GET', 'POST'])]
    public function edit(Request $request, Utilisateur $utilisateur, UtilisateurRepository $utilisateurRepository): Response
    {
        // Création formulaire de l'édition du profil
        $form = $this->createForm(UtilisateurType::class, $utilisateur);
        $form->handleRequest($request);

        // Condition dès qu'il est envoyé avec le changement des informations de l'utilisateur
        if ($form->isSubmitted() && $form->isValid()) {
            $utilisateurRepository->add($utilisateur);

            // Retourne sur la page profil pour voir les modifications
            return $this->redirectToRoute('profil', []);
        }

        return $this->renderForm('profil/edit.html.twig', [
            'utilisateurs' => $utilisateur,
            'form' => $form,
        ]);
    }

    #[Route('/delete/{id}', name: 'supprimer_commande', methods: ['GET'])]
    public function delete($id = 0 ,CommandeRepository $commandeRepository, UtilisateurRepository $utilisateurRepository): Response
    {

        $em = $this->getDoctrine()->getManager();
        // Recherche la commande qui correspond à l'id que l'utilisateur veut supprimer
        $commandes = $commandeRepository->find($id);

        // Systeme de suppression dans la base de données
        $em->remove($commandes);
        $em->flush();
        return $this->redirectToRoute('profil');
    }
}
