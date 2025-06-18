<template>
  <div class="login-container">
    <div class="login-box">
      <h1>Welcome Back</h1>
      <form @submit.prevent="handleLogin">
        <div class="input-group">
          <label for="email">Email</label>
          <input
            type="email"
            id="email"
            v-model="email"
            placeholder="Enter your email"
            required
          />
        </div>
        <div class="input-group">
          <label for="password">Password</label>
          <input
            type="password"
            id="password"
            v-model="password"
            placeholder="Enter your password"
            required
          />
        </div>

        <div v-if="errorMessage" class="error-message">
          {{ errorMessage }}
        </div>

        <button type="submit" :disabled="loading" class="login-button">
          {{ loading ? 'Logging in...' : 'Login' }}
        </button>
      </form>

      <div class="links">
        <a href="#" @click.prevent="forgotPassword">Forgot Password?</a>
        <a href="#" @click.prevent="createAccount">Create Account</a>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "LoginSection",
  data() {
    return {
      email: "",
      password: "",
      errorMessage: "",
      loading: false,
    };
  },
  methods: {
    async handleLogin() {
      if (!this.email || !this.password) {
        this.errorMessage = "Both fields are required.";
        return;
      }

      this.errorMessage = "";
      this.loading = true;

      try {
        const response = await axios.post("api/login", {
          email: this.email,
          password: this.password,
        });

        const token = response.data.token;
        localStorage.setItem("authToken", token);
        this.$router.push("/");
      } catch (error) {
        this.errorMessage =
          error.response?.data?.message || "Login failed. Try again.";
      } finally {
        this.loading = false;
      }
    },
    forgotPassword() {
      this.$router.push("/forgot-password");
    },
    createAccount() {
      this.$router.push("/register");
    },
  },
};
</script>


<style scoped>
.login-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),
    url("@/assets/images/bg_login.jpg") center/cover no-repeat;
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
  font-size: 2.5em;
  color: #2e2e2e;
  margin-bottom: 30px;
  font-weight: 700;
}

.input-group {
  margin-bottom: 20px;
  text-align: left;
}

.input-group label {
  display: block;
  margin-bottom: 8px;
  font-weight: 600;
  color: #444;
}

.input-group input {
  width: 100%;
  padding: 14px 16px;
  border: 1px solid #ccc;
  border-radius: 12px;
  font-size: 1em;
  background: #fdfdfd;
  transition: border 0.2s ease-in-out;
}

.input-group input:focus {
  outline: none;
  border-color: #574e4a;
  box-shadow: 0 0 5px rgba(87, 78, 74, 0.3);
}

.error-message {
  color: #d93025;
  background-color: #ffe8e8;
  border-radius: 8px;
  padding: 10px 15px;
  margin-bottom: 15px;
  font-size: 0.95em;
}

.login-button {
  background-color: #574e4a;
  color: white;
  padding: 14px;
  width: 100%;
  border: none;
  border-radius: 12px;
  font-size: 1.1em;
  font-weight: bold;
  cursor: pointer;
  transition: background 0.3s ease;
}

.login-button:hover {
  background-color: #3e3733;
}

.links {
  margin-top: 25px;
  display: flex;
  justify-content: space-between;
  font-size: 0.95em;
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
