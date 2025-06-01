import { createRouter, createWebHistory } from 'vue-router'
import AboutUs from '@/views/User/ordering.vue/AboutUs.vue'
import Contact from '@/views/User/ordering.vue/Contact.vue'
import Home from '@/views/User/ordering.vue/Home.vue'
import Menu from '@/views/User/ordering.vue/Menu.vue'
import Food from '@/views/User/categories/Food.vue'
import Dessert from '@/views/User/categories/Dessert.vue'
import Drink from '@/views/User/categories/Drink.vue'
import Sign_In from '@/views/User/authentication/Sign_In.vue'
import Manage_Acc from '@/views/User/authentication/Manage_Acc.vue'
import My_Review from '@/views/User/authentication/My_Review.vue'
import My_Order from '@/views/User/authentication/My_Order.vue'
import FoodDessert_detail from '@/views/User/categories/Food&Dessert_detail.vue'
import Drink_detail from '@/views/User/categories/Drink_detail.vue'
import Wishlist from '@/views/User/authentication/Wishlist.vue'
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
      component: Sign_In,
    },
    {
      path: '/manage_Account',
      name: 'manage_Account',
      component: Manage_Acc,
    },
    {
      path: '/my_review',
      name: 'my_review',
      component: My_Review,
    },
    {
      path: '/my-order',
      name: 'my-order',
      component: My_Order,
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
    {
      path: '/wishlist',
      name: 'Wishlist',
      component: Wishlist
    }

  ],
})

export default router
