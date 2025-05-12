import { createRouter, createWebHistory } from 'vue-router'
import AboutUs from '@/views/User/ordering.vue/AboutUs.vue'
import Contact from '@/views/User/ordering.vue/contact.vue'
import Home from '@/views/User/ordering.vue/Home.vue'
import Menu from '@/views/User/ordering.vue/menu.vue'
import Food from '@/views/User/categories/Food.vue'
import Dessert from '@/views/User/categories/Dessert.vue'
import Drink from '@/views/User/categories/Drink.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'Home',
      component: Home,
    },
    {
      path: '/menu',
      name: 'menu',
      component: Menu,
    },
    {
      path: '/contact',
      name: 'contact',
      component: Contact
    },
    {
      path: '/aboutUs',
      name: 'aboutUs',
      component: AboutUs,
    },
    {
      path: '/food',
      name: 'food',
      component: Food,
    },
    {
      path: '/drink',
      name: 'drink',
      component: Drink,
    },
    {
      path: '/dessert',
      name: 'Dessert',
      component: Dessert,
    },
  ],
})

export default router
