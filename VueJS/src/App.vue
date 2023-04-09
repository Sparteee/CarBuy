<script setup>

import {onMounted} from 'vue'

// si vous voulez utilisez pinia , il faut placer ces deux lignes dans le composant de votre choix.
import { useDefaultStore } from './stores/index'
const store = useDefaultStore()
</script>

<template>
  <main>
      <header>
        <h1>CarBuy - Questionnaire</h1>
    </header>
    <router-view />
  </main>
</template>

<style>

</style>
