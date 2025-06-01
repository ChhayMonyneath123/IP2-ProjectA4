<template>
  <div class="create-account-container">
    <div class="left-section">
      <img
        src="@/assets/images/food.png"
        alt="La Libre Food Station Background"
        class="background-image"
      />
      <div class="logo-overlay">
        <img
          src="@/assets/images/Food_Station_logo.png"
          alt="La Libre Food Station Logo"
          class="logo"
        />
      </div>
    </div>

    <div class="right-section">
      <div class="form-card">
        <h1>Create New account</h1>
        <form @submit.prevent="createAccount">
          <div class="form-row">
            <div class="input-group">
              <label for="firstName" >First Name</label>
              <input type="text" id="firstName" v-model="firstName" required />
            </div>
            <div class="input-group">
              <label for="lastName">Last Name</label>
              <input type="text" id="lastName" v-model="lastName" required />
            </div>
          </div>

          <div class="input-group full-width">
            <label for="email">Email</label>
            <input type="email" id="email" v-model="email" required />
          </div>

          <div class="input-group full-width">
            <label for="password">Password</label>
            <input type="password" id="password" v-model="password" required />
          </div>

          <button type="submit" class="create-account-button">
            Create a new account
          </button>
        </form>

        <p class="login-link">
          Already have an account?
          <router-link to="sign-in">Login</router-link>
        </p>

        <div class="divider">
          <span>or</span>
        </div>

        <div class="social-login">
          <a
            href="#"
            @click.prevent="socialLogin('google')"
            class="social-icon"
          >
            <i class="fab fa-google"></i>
          </a>
          <a
            href="#"
            @click.prevent="socialLogin('telegram')"
            class="social-icon"
          >
            <i class="fab fa-telegram-plane"></i>
          </a>
          <a
            href="#"
            @click.prevent="socialLogin('facebook')"
            class="social-icon"
          >
            <i class="fab fa-facebook-f"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import "@fortawesome/fontawesome-free/css/all.css";
import Sign_In from "./Sign_In.vue";

export default {
  name: "CreateAccount",
  data() {
    return {
      firstName: "",
      lastName: "",
      email: "",
      password: "",
    };
  },
  methods: {
    createAccount() {
      console.log("Creating account with:", {
        firstName: this.firstName,
        lastName: this.lastName,
        email: this.email,
        password: this.password,
      });
      // Replace this with your actual API logic if needed
      // Example:
      // axios.post('/api/register', {
      //   firstName: this.firstName,
      //   lastName: this.lastName,
      //   email: this.email,
      //   password: this.password
      // }).then(...)
    },
    goToLogin() {
      console.log("Redirect to Login page");
      // Example: this.$router.push('/login');
    },
    socialLogin(provider) {
      console.log(`Initiate login with ${provider}`);
      // Example redirect: window.location.href = `/auth/${provider}`;
    },
  },
};
</script>

<style scoped>
.create-account-container {
  display: flex;
  min-height: 100vh;
  font-family: Arial, sans-serif;
}

.left-section {
  flex: 1;
  position: relative;
  overflow: hidden;
}

.left-section .background-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  position: absolute;
  top: 0;
  left: 0;
  filter: brightness(0.8);
}

.left-section .logo-overlay {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: rgba(255, 255, 255, 0.9);
  border-radius: 50%;
  width: 200px;
  height: 200px;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

.left-section .logo {
  max-width: 80%;
  height: auto;
}

.right-section {
  flex: 1;
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: #f8f4ed;
  padding: 40px;
  box-sizing: border-box;
}

.form-card {
  width: 100%;
  max-width: 500px;
  text-align: center;
}

h1 {
  font-size: 2.2em;
  margin-bottom: 30px;
  color: #574e4a;
}

.form-row {
  display: flex;
  gap: 20px;
  margin-bottom: 20px;
}

.input-group {
  flex: 1;
  text-align: left;
  margin-bottom: 15px;
}

.input-group.full-width {
  flex: none;
  width: 100%;
}

.input-group label {
  display: block;
  margin-bottom: 8px;
  font-weight: bold;
  color: #574e4a;
}

.input-group input {
  width: 100%;
  padding: 12px 15px;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-size: 1em;
  box-sizing: border-box;
  background-color: #fff;
}

.create-account-button {
  background-color: #a08c79;
  color: white;
  padding: 15px 30px;
  border: none;
  border-radius: 8px;
  font-size: 1.1em;
  cursor: pointer;
  transition: background-color 0.3s ease;
  width: 100%;
  max-width: 500px;
  margin-top: 20px;
  margin-bottom: 25px;
}

.create-account-button:hover {
  background-color: #8d7a65;
}

.login-link {
  font-size: 1em;
  color: #666;
  margin-bottom: 25px;
}

.login-link a {
  color: #574e4a;
  text-decoration: none;
  font-weight: bold;
}

.login-link a:hover {
  text-decoration: underline;
}

.divider {
  display: flex;
  align-items: center;
  text-align: center;
  color: #999;
  font-size: 0.9em;
  margin: 30px 0;
}

.divider::before,
.divider::after {
  content: "";
  flex: 1;
  border-bottom: 1px solid #ddd;
}

.divider:not(:empty)::before {
  margin-right: 0.25em;
}

.divider:not(:empty)::after {
  margin-left: 0.25em;
}

.social-login {
  display: flex;
  justify-content: center;
  gap: 20px;
  margin-top: 20px;
}

.social-icon {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 50px;
  height: 50px;
  border-radius: 50%;
  background-color: white;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  transition: transform 0.2s ease;
}

.social-icon:hover {
  transform: translateY(-3px);
}

.social-icon img {
  width: 60%;
  height: auto;
  color: #a08c79;
}
</style>
