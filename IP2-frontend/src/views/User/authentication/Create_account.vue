<template>
  <div class="create-account-container">
    <div class="left-section">
      <img src="@/assets/images/food.png" alt="Background" class="background-image" />
      <div class="logo-overlay">
        <img src="@/assets/images/Food_Station_logo.png" alt="Logo" class="logo" />
      </div>
    </div>

    <div class="right-section">
      <div class="form-card">
        <h1>Create Account</h1>

        <form @submit.prevent="createAccount">
          <div class="input-group full-width">
            <label for="username">Username</label>
            <input type="text" id="name" v-model="name" required />
          </div>

          <div class="input-group full-width">
            <label for="email">Email</label>
            <input type="email" id="email" v-model="email" required />
          </div>

          <div class="input-group full-width">
            <label for="password">Password</label>
            <input type="password" id="password" v-model="password" required />
          </div>

          <div class="input-group full-width">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" id="password_confirmation" v-model="password_confirmation" required />
          </div>

          <button type="submit" class="create-account-button">Create Account</button>
        </form>

        <p class="login-link">
          Already have an account?
          <router-link to="/login">Login</router-link>
        </p>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'CreateAccount',
  data() {
    return {
      name: '',
      email: '',
      password: '',
      password_confirmation: ''
    }
  },
  methods: {
    async createAccount() {
      if (this.password !== this.password_confirmation) {
        alert('Passwords do not match.')
        return
      }

      const payload = {
        name: this.name,
        email: this.email,
        password: this.password,
        password_confirmation: this.password_confirmation
      }

      try {
        const response = await axios.post('http://localhost:8000/api/register', payload)
        alert('Account created successfully!')
        this.$router.push('/login')
      } catch (error) {
        if (error.response?.status === 422) {
          alert('Validation failed: ' + JSON.stringify(error.response.data.errors))
        } else {
          alert('Registration failed. Please try again.')
        }
        console.error('Error:', error)
      }
    }
  }
}
</script>

<style scoped>
/* Simplified styles for core functionality */
.create-account-container {
  display: flex;
  min-height: 100vh;
}

.left-section {
  flex: 1;
  position: relative;
}

.background-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  position: absolute;
  top: 0;
  left: 0;
  filter: brightness(0.8);
}

.logo-overlay {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

.right-section {
  flex: 1;
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: #f8f4ed;
}

.form-card {
  width: 100%;
  max-width: 400px;
  padding: 2rem;
  background: white;
  border-radius: 12px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

h1 {
  font-size: 1.8rem;
  margin-bottom: 1.5rem;
  text-align: center;
}

.input-group {
  margin-bottom: 1rem;
}

.input-group label {
  display: block;
  margin-bottom: 0.5rem;
  font-weight: bold;
}

.input-group input {
  width: 100%;
  padding: 0.75rem;
  border-radius: 6px;
  border: 1px solid #ccc;
}

.create-account-button {
  width: 100%;
  padding: 0.75rem;
  background-color: #574e4a;
  color: white;
  font-weight: bold;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  margin-top: 1rem;
}

.create-account-button:hover {
  background-color: #3f3834;
}

.login-link {
  text-align: center;
  margin-top: 1rem;
}
</style>
