<?php

namespace App\Controller\Admin;

use App\Entity\Categorie;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class CategorieCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Categorie::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index' , 'Liste des catégories')
            ->setPageTitle('new' , 'Créer une nouvelle catégorie')
            ->setPageTitle('edit' , 'Modifier cette catégorie');


    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm()->setLabel('ID Catégorie'),
            Field::new('name')->setLabel('Nom'),
        ];
    }
}
