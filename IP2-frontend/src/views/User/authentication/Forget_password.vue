<template>
  <div class="reset-password-container">
    <div class="reset-password-box">
      <h1>Reset Your Password</h1>
      
      <!-- Status messages -->
      <div v-if="status" class="status-message success">
        {{ status }}
      </div>
      <div v-if="errors.general" class="status-message error">
        {{ errors.general }}
      </div>
      
      <form @submit.prevent="handleSubmit">
        <input type="hidden" v-model="form.token">
        
        <div class="input-group">
          <label for="email">Email Address</label>
          <input
            id="email"
            v-model="form.email"
            type="email"
            placeholder="your@email.com"
            required
            :class="{ 'input-error': errors.email }"
          >
          <p v-if="errors.email" class="input-error-message">
            {{ errors.email }}
          </p>
        </div>
        
        <div class="input-group">
          <label for="verificationCode">Verification Code</label>
          <input
            id="verificationCode"
            v-model="form.token"
            type="text"
            placeholder="Enter verification code"
            required
            :class="{ 'input-error': errors.token }"
          >
          <p v-if="errors.token" class="input-error-message">
            {{ errors.token }}
          </p>
        </div>
        
        <div class="input-group">
          <label for="newPassword">New Password</label>
          <input
            id="newPassword"
            v-model="form.password"
            type="password"
            placeholder="Enter new password"
            required
            :class="{ 'input-error': errors.password }"
          >
          <p v-if="errors.password" class="input-error-message">
            {{ errors.password }}
          </p>
        </div>
        
        <div class="input-group">
          <label for="confirmPassword">Confirm New Password</label>
          <input
            id="confirmPassword"
            v-model="form.password_confirmation"
            type="password"
            placeholder="Confirm new password"
            required
            :class="{ 'input-error': errors.password_confirmation }"
          >
          <p v-if="errors.password_confirmation" class="input-error-message">
            {{ errors.password_confirmation }}
          </p>
        </div>
        
        <button
          type="submit"
          class="submit-button"
          :disabled="loading"
        >
          <svg v-if="loading" class="spinner" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
          </svg>
          <span>{{ loading ? 'Resetting...' : 'Reset Password' }}</span>
        </button>
      </form>
      
      <div class="links">
        <a href="#" @click.prevent="resendCode">Resend Code?</a>
        <router-link to="/login">Back to Login</router-link>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useAuthStore } from '@/stores/auth'
import { useRoute, useRouter } from 'vue-router'

const authStore = useAuthStore()
const route = useRoute()
const router = useRouter()

const form = ref({
  token: '',
  email: route.query.email || '',
  password: '',
  password_confirmation: ''
})

const errors = ref({})
const status = ref('')
const loading = ref(false)

onMounted(() => {
  form.value.token = route.params.token || route.query.token || ''
})

const validate = () => {
  errors.value = {}
  let isValid = true

  // Email validation
  if (!form.value.email) {
    errors.value.email = 'Email is required'
    isValid = false
  } else if (!/^\S+@\S+\.\S+$/.test(form.value.email)) {
    errors.value.email = 'Please enter a valid email address'
    isValid = false
  }

  // Token validation
  if (!form.value.token) {
    errors.value.token = 'Verification code is required'
    isValid = false
  }

  // Password validation
  if (!form.value.password) {
    errors.value.password = 'Password is required'
    isValid = false
  } else if (form.value.password.length < 8) {
    errors.value.password = 'Password must be at least 8 characters'
    isValid = false
  }

  // Password confirmation
  if (form.value.password !== form.value.password_confirmation) {
    errors.value.password_confirmation = 'Passwords do not match'
    isValid = false
  }

  return isValid
}

const handleSubmit = async () => {
  if (!validate()) return
  
  loading.value = true
  errors.value = {}
  status.value = ''

  try {
    const success = await authStore.resetPassword(form.value)
    if (success) {
      status.value = 'Your password has been reset successfully!'
      setTimeout(() => {
        router.push({ name: 'login', query: { passwordReset: true } })
      }, 2000)
    }
  } catch (error) {
    if (error.response?.status === 422) {
      // Handle Laravel validation errors
      const errorData = error.response.data.errors
      for (const field in errorData) {
        errors.value[field] = errorData[field][0]
      }
    } else {
      errors.value.general = error.response?.data?.message || 'Failed to reset password. Please try again.'
    }
  } finally {
    loading.value = false
  }
}

const resendCode = async () => {
  if (!form.value.email) {
    errors.value.email = 'Please enter your email address first'
    return
  }
  
  try {
    loading.value = true
    await authStore.sendResetLink({ email: form.value.email })
    status.value = 'Verification code has been resent to your email'
  } catch (error) {
    status.value = 'Failed to resend code. Please try again.'
  } finally {
    loading.value = false
  }
}
</script>

<style scoped>
.reset-password-container {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  background: linear-gradient(
      rgba(0, 0, 0, 0.4),
      rgba(0, 0, 0, 0.4)
    ),
    url("@/assets/images/bg_login.jpg") center/cover no-repeat;
  padding: 20px;
}

.reset-password-box {
  background: rgba(255, 255, 255, 0.9);
  padding: 40px;
  border-radius: 15px;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
  text-align: center;
  width: 100%;
  max-width: 500px;
  backdrop-filter: blur(5px);
  animation: slideFadeIn 0.6s ease-out;
}

@keyframes slideFadeIn {
  from {
    transform: translateY(30px);
    opacity: 0;
  }
  to {
    transform: translateY(0);
    opacity: 1;
  }
}

h1 {
  font-size: 2.2rem;
  color: #2e2e2e;
  margin-bottom: 1.5rem;
  font-weight: 700;
}

.status-message {
  padding: 0.75rem 1rem;
  border-radius: 0.5rem;
  margin-bottom: 1.5rem;
  font-size: 0.95rem;
}

.status-message.success {
  background-color: #dcfce7;
  color: #15803d;
}

.status-message.error {
  background-color: #fee2e2;
  color: #b91c1c;
}

.input-group {
  margin-bottom: 1.5rem;
  text-align: left;
}

.input-group label {
  display: block;
  margin-bottom: 0.5rem;
  font-weight: 600;
  color: #444;
}

.input-group input {
  width: 100%;
  padding: 0.875rem 1rem;
  border: 1px solid #ddd;
  border-radius: 0.75rem;
  font-size: 1rem;
  background: #fdfdfd;
  transition: border 0.2s ease-in-out;
}

.input-group input:focus {
  outline: none;
  border-color: #574e4a;
  box-shadow: 0 0 5px rgba(87, 78, 74, 0.3);
}

.input-error {
  border-color: #ef4444 !important;
}

.input-error-message {
  color: #ef4444;
  font-size: 0.875rem;
  margin-top: 0.25rem;
}

.submit-button {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 0.75rem;
  background-color: #574e4a;
  color: white;
  padding: 0.875rem;
  width: 100%;
  border: none;
  border-radius: 0.75rem;
  font-size: 1rem;
  font-weight: 600;
  cursor: pointer;
  transition: background 0.3s ease;
  margin-top: 1rem;
}

.submit-button:hover {
  background-color: #3e3733;
}

.submit-button:disabled {
  cursor: not-allowed;
  opacity: 0.7;
}

.spinner {
  animation: spin 1s linear infinite;
  width: 1.25rem;
  height: 1.25rem;
}

@keyframes spin {
  from {
    transform: rotate(0deg);
  }
  to {
    transform: rotate(360deg);
  }
}

.links {
  margin-top: 1.5rem;
  display: flex;
  justify-content: space-between;
  font-size: 0.95rem;
}

.links a {
  color: #574e4a;
  text-decoration: none;
  font-weight: 500;
  transition: color 0.3s;
}

.links a:hover {
  text-decoration: underline;
  color: #2e2e2e;
}
</style>