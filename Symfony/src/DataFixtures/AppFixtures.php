<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Entity\Marque;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $nomMarques = array("BMW", "Renault" , "Peugeot" , "Citrôen" , "Volkswagen" , "Mercedes" , "Audi" ,
            "Fiat" , "Hyundai" , "Mazda" , "Ford" , "Toyota" , "Opel");
        $nomCategories = array("Citadine" , "Routière" , "Berline" , "Break" , "Monospace" , "Utilitaire" ,  "SUV");

        for($i = 0; $i < count($nomMarques); $i++){
            $marque = new Marque(
                $nomMarques[$i].""
            );
            $manager->persist($marque);
        }
        for($i = 0; $i < count($nomCategories); $i++){
            $categorie = new Categorie(
                $nomCategories[$i].""
            );
            $manager->persist($categorie);
        }

        /* On pourrait utiliser les fixutes pour créer les voitures également . Par soucis de cohérence  et de "réalisme" sur les marques ,
        sur les catégories , sur les prix et sur les images associés aux modèles des voitures , j'ai donc créer les voitures à la main
            ---- Potentiel code ----

                $nomModèle = array("Modele1", ... , "ModèleN")
                $carburant = array("Diesel" , "Essence" , "Electrique)
                $transmission = array("Manuelle", "Automatique")

                for($i = 0; $i < count($nomModèle); $i++){
                $prix = rand(4500,15000);
                    $votiure = new Voiture(
                $nomModèle[$i], $carburant[$i], $transmission[$i] , $prix
            );
                $manager->persist($voiture);
        }
         */
        $manager->flush();
    }
}
