
import { createRouter, createWebHistory } from 'vue-router'
import firstPage from './components/pages/myFirstVue.vue'

// Define your routes
const routes = [
  {
    path: '/my-new-vue-route',
    component: firstPage
  },

]

// Create router
const router = createRouter({
  history: createWebHistory(),
  routes
})
export default router;