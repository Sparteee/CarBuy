import { createRouter, createWebHashHistory } from 'vue-router'
import Accueil from '../components/Accueil.vue'
import Question from '../components/Question.vue'
import Recommandations from '../components/Recommandations.vue'

const routes = [
    {
      path: '/',
      name : 'homepage',
      component : Accueil
    },
    {
      path :'/questions',
      name:'questions',
      component : Question,
    },
    {
      path:'/recommandations',
      name : 'recommandations',
      component : Recommandations,
    }
]

const router = createRouter({
    history: createWebHashHistory(),
    routes,
  })

export default router