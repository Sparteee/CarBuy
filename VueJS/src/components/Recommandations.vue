<template>
  <main>
    <h3>Voici nos recommendations par rapport à vos réponses</h3>
    <div class="container-case">
        <!--Dans la boucle v-for , j'utilise slice sur le tableau de données pour bloquer le nombre de recommendations à 5-->
        <a class="case" :href="`http://localhost:8000/detailvoiture/${d['id']}`" v-for="(d,index) in donnees.slice(0,5)" :key="index">
        <img :src="`src/assets/images/${d['image']}`" alt="">
        <div class="info">
            <p>Modèle : {{ d['nom']}}</p>
            <p>Marque : {{ d["marque"]["nom"]}}</p>
            <p>Categorie : {{ d["categorie"]["name"]}}</p>
            <p>Prix : {{ d["prix"] }} €</p>
            <p>Carburant : {{d["Carburant"]}}</p>
            <p>Transmission : {{ d["Vitesse"]}}</p>
                </div>
            </a>
            <h3 v-if="vide">CarBuy ne contient aucune voiture qui correspond à votre demande . Toute l'équipe de Carbuy est désolé !</h3>
    </div>
  </main>
</template>

<script setup>

import { useRouter , useRoute } from 'vue-router'
import {computed, ref} from '@vue/reactivity'
import Axios from 'axios';

// Définition des variables avec ref
const router = useRouter()
const route = useRoute()
const tabReponse = ref(null);
tabReponse.value = route.params._value // Réception du tableau, via le router, qui comporte toutes les valeurs des réponses
const url = ref(null) // Passage de l'url pour simplifier l'écriture dans la requête Axios
const donnees = ref(null)
const vide = ref(false)

console.log("test commit");

// URL avec tous les paramètres
url.value = `http://localhost:8000/api/voitures?categorie[]=${tabReponse.value[0]}&categorie[]=${tabReponse.value[1]}&categorie[]=${tabReponse.value[2]}&Carburant=${tabReponse.value[3]}&Vitesse=${tabReponse.value[4]}&order[prix]`


// Appel de Axios pour récuperer les données via l'url définie au dessus 
Axios.get(url.value).then(response => response.data).then(response => {
    // Passage des données dans une autre variable nommée data pour simplifier l'écriture dans le template
  donnees.value = response['hydra:member']
  if(donnees.value.length == 0) {
      vide.value = true;
  }
})

</script> 

<style>

h3{
    font-family: Roboto , sans-serif;
    text-align: center;
    font-size: 24px;
}

.container-case{
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    margin-top: 3rem;
}

.case{
    display: flex;
    flex-direction: column;
    width: 15%;
    margin-right: 2rem;
    background-color: #FFFFFF;
    cursor: pointer;
    border-radius: 9px;
    text-decoration : none;
    color: black;
    margin-top: 1rem;
    justify-content: center;
}

.case:hover{
    transform: scale(1.06);
    -webkit-box-shadow: 1px 1px 8px 4px #CBCBCB;
    box-shadow: 1px 1px 8px 4px #CBCBCB;
}

.case img{
    border-radius: 7px;
}

.case .info{
    text-align: center;
    background-color: #FFFFFF;
    font-family: Roboto , sans-serif;
}
</style>