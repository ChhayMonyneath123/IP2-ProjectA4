import { defineStore } from 'pinia'
import axios from 'axios'

export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: null,
    adminEmails: ['admin@example.com'] // your admin email(s)
  }),
  getters: {
    isLoggedIn: (state) => !!state.user,
    isAdmin: (state) => {
      return state.user && state.adminEmails.includes(state.user.email)
    }
  },
  actions: {
    async login(credentials, router) {
      const response = await axios.post('/api/login', credentials)
      this.user = response.data.user
      localStorage.setItem('user', JSON.stringify(this.user))

      // Navigate based on role
      if (this.isAdmin) {
        router.push('/admin/dashboard')  // Admin dashboard route
      } else {
        router.push('/')  // Regular user home
      }
    },
    logout(router) {
      this.user = null
      localStorage.removeItem('user')
      if (router) router.push('/login')
    },
    init() {
      const storedUser = localStorage.getItem('user')
      if (storedUser) {
        this.user = JSON.parse(storedUser)
      }
    }
  }
})
