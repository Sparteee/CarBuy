# CarBuy

## Objectifs 

Application Web réalisée avec Symfony et VueJS pour un projet scolaire - La Rochelle Université
Le but du projet est de mettre en place une application web dynamique en utilisant un framework PHP pour la partie principale du site et un framework JS pour une autre partie.

## Description

Pour ce projet, nous avions un cahier des charges avec plusieurs conditions comme avoir 4 entités, une entité pouvant gérer un upload de fichiers, une entité pouvant gérer des dates en français et un backoffice pour la partie Symfony. Pour la partie VueJS, c'était l'utilisation de plusieurs composants ou encore utiliser l'API généré dans la partie Symfony pour avoir des données de manières dynamiques.

Le thème du site et le style étaient libres.

Pour ce site, j'ai choisi le thème d'un concessionnaire de voiture avec son site qui présente les modèles qu'ils possèdent à sa concession. Ce thème me permettait de remplir toutes les conditions demandés du cahier des charges. 

  - Pour la partie Symfony, il y a l'affichage des voitures présents dans la base de donnée, le formulaire de connexion/inscription, le compte utilisateur et le backoffice admin. On peut également réserver des voitures qui donne un bon de commande.
  - Pour la partie VueJS, c'est un questionnaire de recommendation avec des questions prédéfinies qui en fonction des réponses de l'utilisateur, donne des voitures présents à la concession qui se rapproche des réponses.
  
## Ajouts possibles
  
  - Pour la partie Symfony, la réservation de voiture ne donne qu'un bon de commande. Je suis parti du principe que acheter une voiture à X milliers d'euros sur Internet et en une seule fois est compliqué mais c'est un ajout possible.
  - Pour la partie VueJS, faire en sorte que le questionnaire soit changeable/modulable par l'administrateur du site
  - Faire le site en responsive pour mobile
  
# Installation & Exécution 
  
  - Remplir le .env de son token secret Symfony
  - Au niveau de src de la partie symfony exécutez : ``` symfony server:start ```
  - Au niveau de l'index js de la partie VueJS exécutez : ``` npm run dev ```
  
  - Comptes de test : 
    ```
      Compte user : 
		     - email : user@gmail.com
		     - mdp : useruser

      Compte admin : 
		    - email : admin@gmail.com
		    - mdp : testadmin
    ```

# Auteurs

Ce projet a été réalisé par moi-même



