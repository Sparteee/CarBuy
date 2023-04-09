<?php

namespace App\Controller\Admin;

use App\Entity\Categorie;
use App\Entity\Commande;
use App\Entity\Marque;
use App\Entity\Utilisateur;
use App\Entity\Voiture;
use App\Repository\CategorieRepository;
use App\Repository\CommandeRepository;
use App\Repository\UtilisateurRepository;
use App\Repository\VoitureRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    protected CommandeRepository $commandeRepository;
    protected UtilisateurRepository $utilisateurRepository;
    protected VoitureRepository $voitureRepository;

    public function __construct(CommandeRepository $commandeRepository, UtilisateurRepository $utilisateurRepository , VoitureRepository $voitureRepository)
    {
        $this->commandeRepository = $commandeRepository;
        $this->utilisateurRepository = $utilisateurRepository;
        $this->voitureRepository = $voitureRepository;
    }


    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
         //$adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
         // return $this->redirect($adminUrlGenerator->setController(CommandeCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //

        $cptvoiture= $this->voitureRepository->countAllVoiture();
        $cptcommande = $this->commandeRepository->countAllCommande();
        $cptuser = $this->utilisateurRepository->countAllVoiture();
         return $this->render('admin/dashboard.html.twig', [
             'voiture' => $cptvoiture,
             'commande' => $cptcommande,
             'utilisateur' => $cptuser
         ]);

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('CarBuy');
    }

    public function configureMenuItems(): iterable
    {
            return[
                MenuItem::linkToDashboard('Tableau de bord' , 'fa fa-home'),
                MenuItem::section('Gestion Commerce '),
                MenuItem::linkToCrud('Commandes', 'fa fa-home' , Commande::class)
                ->setAction('index'),
                    MenuItem::linkToCrud('Voitures' , 'fa fa-car' , Voiture::class)
                ->setAction('index'),
                    MenuItem::linkToCrud('Categories' , 'fa fa-tag' , Categorie::class)
                ->setAction('index'),
                    MenuItem::linkToCrud('Marques' , 'fa fa-copyright' , Marque::class)
                ->setAction('index'),
                    MenuItem::subMenu(''),
                MenuItem::section('Gestion Utilisateur'),
                    MenuItem::linkToCrud('Utilisateurs' , 'fa fa-users' , Utilisateur::class)
                ->setAction('index'),


        ];
    }
}
