<template>
    <div class="login-container">
      <div class="login-box">
        <h1>Login</h1>
        <form @submit.prevent="handleLogin">
          <div class="input-group">
            <label for="email">Email</label>
            <input
              type="email"
              id="email"
              v-model="email"
              placeholder="Your Email"
              required
            />
          </div>
          <div class="input-group">
            <label for="password">Password</label>
            <input
              type="password"
              id="password"
              v-model="password"
              placeholder="Your Password"
              required
            />
          </div>
  
          <!-- Error Message -->
          <div v-if="errorMessage" class="error-message">
            {{ errorMessage }}
          </div>
  
          <button type="submit" class="login-button">Login</button>
        </form>
  
        <div class="links">
          <a href="#" @click.prevent="forgotPassword">Forget Password?</a>
          <a href="#" @click.prevent="createAccount">Create new account</a>
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
      errorMessage: ""
    };
  },
  methods: {
    async handleLogin() {
      if (!this.email || !this.password) {
        this.errorMessage = "Both fields are required.";
        return;
      }

      this.errorMessage = "";

      try {
        const response = await axios.post("http://localhost:3000/api/login", {
          email: this.email,
          password: this.password
        }, {
          withCredentials: true // if you're using Sanctum for cookie auth
        });

        console.log("Login successful:", response.data);

        localStorage.setItem("token", response.data.token); // optional

        this.$router.push("/");
      } catch (error) {
        console.error("Login failed:", error);
        this.errorMessage = "Invalid email or password.";
      }
    },
    forgotPassword() {
      this.$router.push("/forgot-password");
    },
    createAccount() {
      this.$router.push("/register");
    }
  }
};

  </script>
  
  <style scoped>
  .login-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background: url('@/assets/images/bg_login.jpg') center/cover no-repeat, #f5f5f5;
  }
  
  .login-box {
    background: 
  linear-gradient(
    rgba(255, 255, 255, 0.3), /* white semi-transparent reflection */
    rgba(255, 255, 255, 0)
  ),
  rgba(255, 255, 255, 1); /* semi-transparent red base */
    padding: 40px 50px;
    border-radius: 15px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    width: 100%;
    max-width: 600px;
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    max-height: 180vh;
    overflow-y: auto;
  }
  
  h1 {
    font-size: 3.5em;
    margin-bottom: 30px;
    color: #333;
  }
  
  .input-group {
    margin-bottom: 25px;
    text-align: left;
  }
  
  .input-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
    color: #555;
  }
  
  .input-group input {
    width: calc(100% - 20px);
    padding: 15px 10px;
    border: 1px solid #ffffff;
    border-radius: 15px;
    font-size: 1.1em;
    box-sizing: border-box;
  }
  
  .error-message {
    color: red;
    margin-bottom: 15px;
    font-size: 0.95em;
  }
  
  .login-button {
    background-color: #574e4a;
    color: white;
    padding: 15px 10px;
    border: none;
    border-radius: 8px;
    font-size: 1.2em;
    cursor: pointer;
    transition: background-color 0.3s ease;
    width: 100%;
    margin-top: 20px;
  }
  
  .login-button:hover {
    background-color: #433b37;
  }
  
  .links {
    margin-top: 25px;
    display: flex;
    justify-content: space-between;
    font-size: 1em;
    
  }
  
  .links a {
    color: #574e4a;
    text-decoration: none;
    transition: color 0.3s ease;
  }
  
  .links a:hover {
    text-decoration: underline;
    color: #333;
  }
  </style>
  