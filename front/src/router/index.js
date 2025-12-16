import { createRouter, createWebHistory } from 'vue-router'

// ✅ 1. Tous les imports de Vues/Composants sont regroupés ici :
import HomeView from '../views/HomeView.vue'
import CarteView from '../views/CarteView.vue' 
import LoginView from '../views/LoginView.vue'
import InscriptionView from '@/views/InscriptionView.vue'



const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  
  routes: [
    {
     
      path: '/', 
      name: 'login', 
      component: LoginView
    },
    {
      path: '/home',
      name: 'home',
      component: HomeView
    },
    {
      
      path: '/carte', 
      name: 'carte', 
      component: CarteView
    },
    {

      path: '/inscription', 
      name: 'inscription', 
      component: InscriptionView
    },
    
  ]
})

export default router 
// ✅ 3. Le routeur est exporté une seule fois