import { createRouter, createWebHistory } from 'vue-router'

// ✅ 1. Tous les imports de Vues/Composants sont regroupés ici :
import HomeView from '../views/HomeView.vue'
import CarteView from '../views/CarteView.vue' 
import Japon from '../components/CarteJapon.vue' 



const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  
  // ✅ 2. Toutes les routes sont dans un seul tableau 'routes' :
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      // Bonne pratique : utiliser des chemins en minuscules
      path: '/carte', 
      name: 'carte', 
      component: CarteView
    },
    {
      // Bonne pratique : utiliser des chemins en minuscules
      path: '/japon', 
      name: 'japon', 
      component: Japon
    },
   
  ]
})

export default router 
// ✅ 3. Le routeur est exporté une seule fois