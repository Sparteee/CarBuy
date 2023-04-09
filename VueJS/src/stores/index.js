import { defineStore } from 'pinia'
import { Axios } from 'axios'

export const useDefaultStore = defineStore({
  id: 'default',
  state: () => ({
    // Données des questions en dur
    /*dataQuestion : [
      {
        "questions":[
          {
            "question":"Combien de kilomètres faites vous par semaine avec votre voiture ?",
            "reponses": [
              {
                reponse : "0 à 50 kilomètres par semaine",
                valeur : "1" // Citadine
              },
              {
                reponse : "51 à 150 kilomètres par semaine",
                valeur : "3" // Berline
              },
              {
                reponse:  "151 ou plus par semaine",
                valeur : "2" // Routière
              }
            ]
          },
          {
            "question" : "Avez-vous besoin de transporter des objets longs (ex:meubles,outils de travail,vélo ...)",
            "reponses" : [
              {
                reponse : "Oui",
                valeur : "6"
              },
              {
                reponse : "Non",
                valeur : "0"
              }
            ]
          },
          {
            "question" : "Est-ce que vous avez des enfants?",
            "reponses" : [
              {
                reponse : "Oui",
                valeur : "5"
              },
              {
                reponse : "Non",
                valeur : "0"
              }
            ]
          },
          {
            "question" : "Diesel ou Essence ?",
            "reponses" : [
              {
                reponse : "Diesel",
                valeur : "Diesel"
              },
              {
                reponse : "Essence",
                valeur : "Essence"
              }
            ]
          },
          {
            "question" : "Manuelle ou Automatique ?",
            "reponses" : [
              {
                reponse : "Manuelle",
                valeur : "Manuelle"
              },
              {
                reponse : "Automatique",
                valeur : "Automatique"
              }
            ]
          }
        ]
      }
    ]*/
    
  }),
  getters: {
    
  },
  actions: {
    
    
  }
})
