<?php

namespace App\Controller\Admin;

use App\Entity\Utilisateur;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UtilisateurCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Utilisateur::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index' , 'Liste des utilisateurs')
            ->setPageTitle('new' , 'Créer un nouveau utilisateur')
            ->setPageTitle('edit' , 'Modifier cette utilisateur');


    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            Field::new('nom')->setLabel('Nom'),
            Field::new('prenom')->setLabel('Prenom'),
            Field::new('email')->setLabel('Adresse E-Mail'),
            ArrayField::new('roles')->setLabel('Rôle')
        ];
    }

}
