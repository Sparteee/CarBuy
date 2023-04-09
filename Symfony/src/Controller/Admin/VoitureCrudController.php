<?php

namespace App\Controller\Admin;

use App\Entity\Voiture;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

class VoitureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Voiture::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new('id')->hideOnForm()->setLabel('ID Voiture')->setTextAlign('center'),
            Field::new('nom')->setTextAlign('center'),
            Field::new('prix')->setLabel("Prix €")->setTextAlign('center'),
            // Pour le champ prix , je n'utilise pas MoneyField car j'ai rencontré des problèmes dont je n'ai toujours pas trouvé le moyen de régler
            IntegerField::new('cv')->setLabel('Nombre de chevaux')->setTextAlign('center'),
            Field::new('carburant')->setTextAlign('center'),
            Field::new('vitesse')->setLabel('Transmission')->setTextAlign('center'),
            AssociationField::new('categorie')->setLabel('Catégorie de voiture')->setTextAlign('center'),
            AssociationField::new('marque')->setLabel('Marque de voiture')->setTextAlign('center'),
            ImageField::new('image')->setBasePath('images')->setUploadDir('public/images')
                ->setUploadedFileNamePattern('[name].jpg')
                ->setRequired(false)->setLabel('Image')
        ];
    }

}
