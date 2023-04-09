<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use App\Repository\MarqueRepository;
use App\Repository\VoitureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Security\LoginAuthenticator;

class MainController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('index/index.html.twig', []);
    }

    #[Route('/voitures', name: 'voitures')]
    public function voitures(CategorieRepository $categorieRepository , VoitureRepository $voitureRepository , MarqueRepository $marqueRepository ): Response
    {
        $categories = $categorieRepository->findAll();
        $voitures = $voitureRepository->findAll();
        $marques = $marqueRepository->findAll();

       // $filtre =[];
        $erreur = "none";
        if (!empty($_GET)) {

            // Filtre catégorie
            if ($_GET['categorie'] != 'All' && $_GET['marque'] == 'All' && $_GET['transmission'] == 'All' && $_GET['carburant'] == 'All') {
                $cat = $_GET['categorie'];
                $voitures = $voitureRepository->FindByCategorie($cat);
                // Gestion erreur si la catégorie sélectionée est vide
                if(empty($voitures)){
                    $erreur = "Catégorie";
                }
                // Filtre marque
            } else if ($_GET['marque'] != 'All' && $_GET['categorie'] == 'All' && $_GET['transmission'] == 'All' && $_GET['carburant'] == 'All') {
                $marq = $_GET['marque'];
                $voitures = $voitureRepository->FindByMarque($marq);
                // gestion erreur si la marque sélectionnée est vide
                if(empty($voitures)){
                    $erreur = "Marque";
                }
            }
            // filtre transmission
            else if($_GET['transmission'] != 'All' && $_GET['marque'] == 'All' && $_GET['categorie'] == 'All' && $_GET['carburant'] == 'All'){
                    $transmission = $_GET['transmission'];
                    $voitures = $voitureRepository->findBy(['Vitesse' => $transmission]);
            }
            //Filtre carburant
            else if($_GET['carburant'] != 'All' && $_GET['marque'] == 'All' && $_GET['categorie'] == 'All' && $_GET['transmission'] == 'All'){
                $carburant = $_GET['carburant'];
                $voitures = $voitureRepository->findBy(['Carburant' => $carburant]);
            }
            // Tous les filtres activés
            else if ($_GET['categorie'] != 'All' && $_GET['marque'] != 'All' && $_GET['transmission'] != 'All' && $_GET['carburant'] != 'All') {
                $cat = $_GET['categorie'];
                $marq = $_GET['marque'];
                $transmission = $_GET['transmission'];
                $carburant = $_GET['carburant'];
                $voitures = $voitureRepository->FindByArguments($cat, $marq , $transmission,$carburant);
            }

        }
            return $this->render('index/voiture.html.twig', [
                'categories' => $categories,
                'voitures' => $voitures,
                'marques' => $marques,
                'erreur' => $erreur
            ]);

    }

    #[Route('/detailvoiture/{id}', name: 'detail')]
    public function voiture($id = 0, VoitureRepository $voitureRepository): Response
    {
        // Récupération de la voiture cliqué par l'utilisateur pour avoir l'image en + grand et plus d'informations sur la voiture
        $voiture = $voitureRepository->find($id);
        return $this->render('index/detailvoiture.html.twig', [
            'voiture' => $voiture
        ]);
    }
}