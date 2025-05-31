import { createRouter, createWebHistory } from 'vue-router'
import AboutUs from '@/views/User/ordering.vue/AboutUs.vue'
import Contact from '@/views/User/ordering.vue/Contact.vue'
import Home from '@/views/User/ordering.vue/Home.vue'
import Menu from '@/views/User/ordering.vue/Menu.vue'
import Food from '@/views/User/categories/Food.vue'
import Dessert from '@/views/User/categories/Dessert.vue'
import Drink from '@/views/User/categories/Drink.vue'
import Sign_in from '@/views/User/authentication/Sign_in.vue'
import Manage_acc from '@/views/User/authentication/manage_acc.vue'
import My_review from '@/views/User/authentication/My_review.vue'
import My_order from '@/views/User/authentication/My_order.vue'
import FoodDessert_detail from '@/views/User/categories/Food&Dessert_detail.vue'
import Drink_detail from '@/views/User/categories/Drink_detail.vue'
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
      name: 'MenuPage',
      component: Menu,
    },
    {
      path: '/menu/food',
      name: 'food',
      component: Food
    },
    {
      path: '/menu/drink',
      name: 'drink',
      component: Drink
    },
    {
      path: '/menu/dessert',
      name: 'dessert',
      component: Dessert
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
      path: '/sign-in',
      name: 'sign-in',
      component: Sign_in,
    },
    {
      path: '/manage_account',
      name: 'manage_account',
      component: Manage_acc,
    },
    {
      path: '/my_review',
      name: 'my_review',
      component: My_review,
    },
    {
      path: '/my-order',
      name: 'my-order',
      component: My_order,
    },
    {
      path: '/menu/food/detail/:id',
      name: 'detail',
      component: FoodDessert_detail,
    },
    {
      path: '/menu/drink/detail/:id',
      name: 'drink-detail',
      component: Drink_detail,
    },

  ],
})

export default router
