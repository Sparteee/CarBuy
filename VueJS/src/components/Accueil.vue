<template>
  <main>  
    <div class="con">
        <p>Nos recommandations sont parmi les voitures disponible à la vente chez CarBuy</p>
        <button class="accueil" @click="gererRoute()" ><img src="https://img.icons8.com/FFFFFF/m_outlined/2x/help.png">Commencez le questionnaire !</button>
    </div>
  </main>
</template>

<script setup>
import { useRouter } from 'vue-router'
const router = useRouter()

function gererRoute(){
  // Appel au router pour changer de route
  router.push({name : 'questions'})
}
</script>

<style>

 button {
    background-color: #ff5950;
    color: #FFFFFF;
    text-transform: uppercase;
    padding: 0.8rem 2rem 0.8rem 1rem;
    text-align: center;
    cursor: pointer;
    border: none;
    font-size: 16px;
    font-family: Roboto , sans-serif;
    border-radius: 3px;
    margin-bottom: 10rem;
    display: flex;
    align-items: center;
}

button:hover{
    background-color: #ff291d;
}

button>img{
    width: 28px;
    height: 28px;
    margin-right: 0.5rem;
}

.con{
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  height: 92vh;
}
.con p {
  font-family: Roboto , sans-serif;
  font-weight: bold;
}

</style>