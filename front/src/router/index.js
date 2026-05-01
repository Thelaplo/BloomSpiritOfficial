import { createRouter, createWebHistory } from 'vue-router'

import HomeView from '../views/HomeView.vue'
import CarteView from '../views/CarteView.vue'
import DetailView from '../views/DetailView.vue'
import LoginView from '../views/LoginView.vue'
import InscriptionView from '@/views/InscriptionView.vue'
import CRUDView from '../views/CRUDView.vue'


const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  
  routes: [
    {
     
      path: '/login', 
      name: 'login', 
      component: LoginView
    },
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
      path: '/detail/:id',
      name: 'detail', 
      component: DetailView
    },
    {
      path: '/CRUD',
      name: 'CRUD',
      component: CRUDView
    },
    {
      path: '/inscription', 
      name: 'inscription', 
      component: InscriptionView
    },
    {
      path: '/profil',
      name: 'Profil',
      component: () => import('@/views/ProfilView.vue')
    }


  ]
})

export default router