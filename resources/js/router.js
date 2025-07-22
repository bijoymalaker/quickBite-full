import { createRouter, createWebHistory } from 'vue-router'
import Home from './pages/Home.vue'
import Menus from './pages/Menus.vue'
import Offers from './pages/Offers.vue'
import Restaurants from './pages/Restaurants.vue'
import Tracking from './pages/Tracking.vue'
import Login from './pages/Login.vue'

const routes = [
  { path: '/', component: Home },
  { path: '/menus', component: Menus },
  { path: '/offers', component: Offers },
  { path: '/restaurants', component: Restaurants },
  { path: '/tracking', component: Tracking },
  { path: '/login', component: Login },



  { path: '/:notFound(.*)', redirect: '/' },
  
]

const router = createRouter({
  history: createWebHistory(),
  routes,
  linkActiveClass: 'active',
})

export default router