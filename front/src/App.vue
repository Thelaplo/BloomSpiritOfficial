<template>
  <div id="app">
    <router-view /> <TheFooter /> </div>
</template>

<script setup>
import { RouterView } from 'vue-router'
import TheFooter from './components/TheFooter.vue';
</script>

<style>
/* Ce style s'applique globalement.
   Vous pouvez ajouter des styles de réinitialisation (reset) ici si vous le souhaitez,
   mais il n'y a rien de critique pour l'instant.
*/
</style>
