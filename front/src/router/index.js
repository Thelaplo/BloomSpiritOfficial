import { createRouter, createWebHistory } from 'vue-router'

import HomeView from '../views/HomeView.vue'
import CarteView from '../views/CarteView.vue'
import DetailView from '../views/DetailView.vue' // ✅ Import ajouté

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/carte', 
      name: 'carte', 
      component: CarteView
    },
    {
      path: '/detail/:id', // ✅ Route dynamique vers les détails
      name: 'detail', 
      component: DetailView
    }
   
  ]
})

export default router