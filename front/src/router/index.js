import { createRouter, createWebHistory } from 'vue-router'

import HomeView from '../views/HomeView.vue'
<<<<<<< HEAD
import CarteView from '../views/CarteView.vue'
import DetailView from '../views/DetailView.vue' // ✅ Import ajouté
=======
import CarteView from '../views/CarteView.vue' 
import LoginView from '../views/LoginView.vue'
import InscriptionView from '@/views/InscriptionView.vue'


>>>>>>> LoginView

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
<<<<<<< HEAD
=======
      
>>>>>>> LoginView
      path: '/carte', 
      name: 'carte', 
      component: CarteView
    },
    {
<<<<<<< HEAD
      path: '/detail/:id', // ✅ Route dynamique vers les détails
      name: 'detail', 
      component: DetailView
    }
   
=======

      path: '/inscription', 
      name: 'inscription', 
      component: InscriptionView
    },
    
>>>>>>> LoginView
  ]
})

export default router