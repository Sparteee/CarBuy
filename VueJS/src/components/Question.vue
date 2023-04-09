<template>
<main>
  <div class="questions">
    <h2>Question n°{{numQuestion}} / 5</h2>
    
    <h3>{{data[idQuestion]['contenu']}}</h3>
    <ul>
      <li v-for="(reponse,index) in data[idQuestion]['reponses']" :key="index" @click="gestionreponse(reponse.valeurReponse)">
        {{reponse.contenuReponse}}
      </li>
    </ul>
  </div>

  <div class="button">
    <button v-if="visible" @click="gererRoute()"><img src="https://img.icons8.com/FFFFFF/ios11/2x/long-arrow-right.png">Voir les recommandations de CarBuy</button>
    <button v-if="visible" @click="recommencer()"><img src="https://img.icons8.com/FFFFFF/m_sharp/2x/restart.png">Recommencer</button>
  </div>

  </main>
</template>

<script setup>


import { useDefaultStore } from '../stores/index'
import { useRouter , useRoute } from 'vue-router'
import {ref , computed} from '@vue/reactivity'
import  Axios from 'axios';

// Définition des variables avec ref
const store = useDefaultStore();
const router = useRouter()
const route = useRoute() 
const idQuestion = ref(0); // Variable à incrémenter pour pouvoir changer les questions plus facilement
const numQuestion = ref(1) // variable pour l'affichage du numéro des questions 
const valeurReponse = ref([]) // Tableau de récupération des valeurs des réponses données par l'utilsateur
const visible = ref(false) // Variable pour la condition if dans le template pour montrer les recommendations uniquement quand l'utilisateur a fini de répondre au question
const urlReponse = ref(null); 
urlReponse.value = 'http://localhost:8000/api/questions'; // Passage de l'url dans une variable pour alléger l'écriture dans la requête Axios
const data = ref(null);

// Appel de Axios pour récuperer les données via l'url définie au dessus 
Axios.get(urlReponse.value).then(response => response.data).then(response =>{
  // Passage des données dans une autre variable nommée data pour simplifier l'écriture dans le template
  data.value = response["hydra:member"]
})

function gestionreponse(valeur){

// Condition pour la fin des questions pour afficher les boutons et bloquer l'incrémentation
  if(idQuestion.value == 4){
    valeurReponse.value.push(valeur)
    visible.value = true;
  }else{
    // Envoie de chaque valeur a chaque clique dans un tableau déclaré au dessus
    valeurReponse.value.push(valeur)
    // Changement de question via l'incrémentation
    idQuestion.value++;
    // Affichage dynamique des numéros de questions
    numQuestion.value++;
  }
}

function gererRoute(){
  // Changement de route grâce au routeur , avec passage en paramètre du tableau qui comporte les valeurs de réponses de l'utilisateur
  router.push({name : 'recommandations' , params : valeurReponse})
}

// Cette fonction sert à pouvoir recommencer le questionnaire si l'utilisateur a fait une erreur
function recommencer(){
  // Avec cette remise par défaut des valeurs , l'utilsiateur retourne à la question 1 et enlève les boutons
  idQuestion.value = 0
  numQuestion.value = 1
  visible.value = false
  
}

</script>

<style>
  .questions{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 55vh;
  }

  .questions h2{
    font-family: Roboto , 'sans-serif';
  }

  .questions h3{
    font-family: Roboto, 'sans-serif';
  }

  .questions li{
    list-style-type: none;
    cursor: pointer;
    margin-bottom: 1rem;
    background-color: #ff5950;
    color: white;
    font-family: Roboto , sans-serif;
    padding: 1rem;
    text-align: center;
    margin-right: 2rem;
    border-radius: 8px;
  }

  .questions li:hover{
    background-color: #ff291d;
  }

  .button{
    display: flex;
    justify-content: center;
  }

  .button button{
    margin-right: 2rem;
    font-size: 14px
  }


</style>