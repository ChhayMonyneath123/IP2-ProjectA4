import { defineStore } from 'pinia'
import { ref } from 'vue'
import axios from 'axios'
import router from '@/router'

export const useAuthStore = defineStore('auth', () => {
    const user = ref(null)
    const isAuthenticated = ref(false)
    const errors = ref({})
    const loading = ref(false)

    const init = () => {
        const storedUser = localStorage.getItem('user')
        if (storedUser) {
            user.value = JSON.parse(storedUser)
            isAuthenticated.value = true
        }
    }

    const register = async (formData) => {
        loading.value = true
        errors.value = {}
        
        try {
            const response = await axios.post('/register', formData)
            user.value = response.data.user
            isAuthenticated.value = true
            localStorage.setItem('access_token', response.data.access_token)
            localStorage.setItem('user', JSON.stringify(response.data.user))
            
            // Redirect to home page after registration
            router.push('/')
        } catch (error) {
            if (error.response.status === 422) {
                errors.value = error.response.data.errors
            }
        } finally {
            loading.value = false
        }
    }

    const login = async (credentials) => {
        loading.value = true
        errors.value = {}
        
        try {
            const response = await axios.post('/login', credentials)
            user.value = response.data.user
            isAuthenticated.value = true
            localStorage.setItem('access_token', response.data.access_token)
            localStorage.setItem('user', JSON.stringify(response.data.user))
            
            // Redirect based on role
            router.push(response.data.redirect_to)
        } catch (error) {
            if (error.response.status === 422) {
                errors.value = error.response.data.errors
            } else if (error.response.status === 401) {
                errors.value = { email: ['Invalid credentials'] }
            }
        } finally {
            loading.value = false
        }
    }

    const logout = async () => {
        try {
            await axios.post('/logout')
            user.value = null
            isAuthenticated.value = false
            localStorage.removeItem('access_token')
            localStorage.removeItem('user')
            router.push('/login')
        } catch (error) {
            console.error('Logout failed:', error)
        }
    }

    const sendResetLink = async (email) => {
        loading.value = true
        errors.value = {}
        
        try {
            await axios.post('/forgot-password', { email })
            return true
        } catch (error) {
            if (error.response.status === 422) {
                errors.value = error.response.data.errors
            }
            return false
        } finally {
            loading.value = false
        }
    }

    const resetPassword = async (formData) => {
        loading.value = true
        errors.value = {}
        
        try {
            await axios.post('/reset-password', formData)
            return true
        } catch (error) {
            if (error.response.status === 422) {
                errors.value = error.response.data.errors
            }
            return false
        } finally {
            loading.value = false
        }
    }

    return { 
        user, 
        isAuthenticated, 
        errors, 
        loading, 
        init,
        register, 
        login, 
        logout, 
        sendResetLink, 
        resetPassword 
    }
})