<template>
  <div class="login-container">
    <div class="login-box">
      <h1>Welcome Back</h1>
      
      <!-- Success messages -->
      <div v-if="$route.query.passwordReset" class="success-message">
        Your password has been reset successfully!
      </div>
      <div v-if="$route.query.resetEmailSent" class="success-message">
        Password reset link sent to your email.
      </div>
      
      <form @submit.prevent="handleLogin">
        <!-- General error message -->
        <div v-if="authStore.errors.general" class="error-message">
          {{ authStore.errors.general[0] }}
        </div>
        
        <!-- Email Field -->
        <div class="input-group">
          <label for="email">Email</label>
          <input
            type="email"
            id="email"
            v-model="form.email"
            placeholder="your@email.com"
            required
            :class="{ 'input-error': authStore.errors.email }"
          />
          <p v-if="authStore.errors.email" class="input-error-message">
            {{ authStore.errors.email[0] }}
          </p>
        </div>
        
        <!-- Password Field -->
        <div class="input-group">
          <label for="password">Password</label>
          <input
            type="password"
            id="password"
            v-model="form.password"
            placeholder="••••••••"
            required
            :class="{ 'input-error': authStore.errors.password }"
          />
          <p v-if="authStore.errors.password" class="input-error-message">
            {{ authStore.errors.password[0] }}
          </p>
        </div>
        
        <!-- Remember Me & Forgot Password -->
        <div class="remember-forgot">
          <div class="remember-me">
            <input
              type="checkbox"
              id="remember"
              v-model="form.remember"
            />
            <label for="remember">Remember me</label>
          </div>
          <router-link to="/forgot-password" class="forgot-password">
            Forgot password?
          </router-link>
        </div>
        
        <!-- Submit Button -->
        <button type="submit" :disabled="authStore.loading" class="login-button">
          <svg v-if="authStore.loading" class="spinner" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
          </svg>
          <span>{{ authStore.loading ? 'Logging in...' : 'Login' }}</span>
        </button>
        
        <!-- Registration Link -->
        <div class="register-link">
          Don't have an account? 
          <router-link to="/register">Register here</router-link>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useAuthStore } from '@/stores/auth'
import { useRoute } from 'vue-router'

const authStore = useAuthStore()
const route = useRoute()

const form = ref({
  email: '',
  password: '',
  remember: false
})

const handleLogin = async () => {
  await authStore.login(form.value)
}
</script>

<style scoped>
.login-container {
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

.login-box {
  background: rgba(255, 255, 255, 0.85);
  padding: 40px 50px;
  border-radius: 20px;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
  backdrop-filter: blur(10px);
  text-align: center;
  width: 100%;
  max-width: 450px;
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
  font-size: 2.5rem;
  color: #2e2e2e;
  margin-bottom: 2rem;
  font-weight: 700;
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
  border: 1px solid #ccc;
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

.error-message {
  color: #d93025;
  background-color: #ffe8e8;
  border-radius: 0.5rem;
  padding: 0.75rem 1rem;
  margin-bottom: 1.5rem;
  font-size: 0.95rem;
}

.success-message {
  color: #15803d;
  background-color: #dcfce7;
  border-radius: 0.5rem;
  padding: 0.75rem 1rem;
  margin-bottom: 1.5rem;
  font-size: 0.95rem;
}

.remember-forgot {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1.5rem;
}

.remember-me {
  display: flex;
  align-items: center;
}

.remember-me input {
  margin-right: 0.5rem;
}

.forgot-password {
  color: #574e4a;
  text-decoration: none;
  font-weight: 500;
  font-size: 0.875rem;
  transition: color 0.3s;
}

.forgot-password:hover {
  text-decoration: underline;
  color: #2e2e2e;
}

.login-button {
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
  margin-bottom: 1.5rem;
}

.login-button:hover {
  background-color: #3e3733;
}

.login-button:disabled {
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

.register-link {
  font-size: 0.95rem;
  color: #444;
}

.register-link a {
  color: #574e4a;
  font-weight: 500;
  text-decoration: none;
  transition: color 0.3s;
}

.register-link a:hover {
  text-decoration: underline;
  color: #2e2e2e;
}
</style>