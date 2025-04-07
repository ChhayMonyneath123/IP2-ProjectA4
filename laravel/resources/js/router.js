
import { createRouter, createWebHistory } from 'vue-router'


// Define your routes
const routes = [
  {
    path: "/",
    name: "home",
    component: () => import("@/vueCode/views/user/Home.vue"),
  },
  {
    path: "/contact",
    name: "contact",
    component: () => import("@/vueCode/views/user/Contact.vue"),
  },
  {
    path: "/about",
    name: "about",
    component: () => import("@/vueCode/views/user/About_Us.vue"),
  },
  // {
  //   path: "/signIn",
  //   name: "signIn",
  //   component: () => import("../views/SignIn/SignInView.vue"),
  // },
  // {
  //   path: "/signUp",
  //   name: "signUp",
  //   component: () => import("../views/SignUp/SignUpView.vue"),
  // },
  // {
  //   path: "/profile",
  //   name: "profile",
  //   component: () => import("../views/ProfileAccountView.vue"),
  // },
  {
    path: '/food-detail',
    component: () => import("@/vueCode/views/user/categories/Food_dessertDetail.vue"),
  },
  
  // {
  //   path: '/drink-detail',
  //   component: () => import("../views/user/categories/Drink_Detail.vue"),
  // },


]

// Create router
const router = createRouter({
  history: createWebHistory(),
  routes
})
export default router;