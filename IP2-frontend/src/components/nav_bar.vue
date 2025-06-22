<template>
  <nav class="navbar">
    <div class="logo-section">
      <img src="@/assets/logofood_station.png" alt="La Libre Logo" class="logo" />
      <span class="brand-name">La Libre</span>
    </div>

    <ul class="nav-links">
      <li><router-link to="/">Home</router-link></li>
      <li><router-link to="/menu">Menu</router-link></li>
      <li><router-link to="/contact">Contact</router-link></li>
      <li><router-link to="/aboutUs">About Us</router-link></li>
    </ul>

    <div class="search-section">
      <input type="text" placeholder="Search..." aria-label="Search" />
      <i class="fas fa-search search-icon"></i>
    </div>

    <div class="icon-buttons">
      <div class="cart-icon-container">
        <i class="fas fa-shopping-cart icon" aria-label="Cart" @click="goToCart"></i>
        <span class="cart-count" v-if="cartCount > 0">{{ cartCount }}</span>
      </div>
      <i class="fas fa-heart icon" aria-label="Wishlist" @click="goToWishlist"></i>

      <!-- Conditionally render based on login state -->
      <template v-if="!isLoggedIn">
        <router-link to="/login" class="login-btn">Login</router-link>
        <router-link to="/register" class="register-btn">Register</router-link>
      </template>

      <template v-else>
        <router-link to="/profile" class="avatar-circle">
          {{ firstLetter }}
        </router-link>
        <button class="logout-btn" @click="handleLogout">Logout</button>
      </template>
    </div>
  </nav>
</template>

<script setup>
import {useCartStore} from '@/stores/cart'
import { computed } from 'vue'
import { useAuthStore } from '@/stores/auth'
import { useRouter } from 'vue-router'


// add to cart 
const cartStore = useCartStore()
const cartCount = computed(() => cartStore.count)  // make sure cartItems is reactive in your store


const authStore = useAuthStore()
const router = useRouter()

const isLoggedIn = computed(() => authStore.isLoggedIn)  // make sure isLoggedIn is reactive in your store

const firstLetter = computed(() => {
  return authStore.user?.name ? authStore.user.name.charAt(0).toUpperCase() : '?'
})
function goToCart() {
  router.push('/my-order')
}

function goToWishlist() {
  router.push('/wishlist')
}

function handleLogout() {
  authStore.logout()
  router.push('/login')
}
</script>

<style scoped>
/* Your styles remain the same */
.navbar {
  width: 100%;
  background-color: #f8f7f3;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0.5rem 2%;
  font-family: "IBM Plex Sans Condensed", sans-serif;
  flex-wrap: wrap;
  box-sizing: border-box;
}

.logo-section {
  display: flex;
  align-items: center;
  gap: 10px;
}

.logo {
  height: 60px;
}

.brand-name {
  font-size: 1.75rem;
  font-weight: bold;
  white-space: nowrap;
}

.nav-links {
  display: flex;
  gap: 2rem;
  list-style: none;
  padding: 0;
  margin: 10px 0;
}

.nav-links li {
  font-size: 1.125rem;
}

.nav-links a {
  text-decoration: none;
  color: inherit;
}

.router-link-exact-active {
  font-weight: bold;
  border-bottom: 2px solid black;
}

.search-section {
  display: flex;
  align-items: center;
  background: #f0efeb;
  border-radius: 20px;
  padding: 0.3rem 1rem;
  margin: 10px 0;
}

.search-section input {
  border: none;
  background: transparent;
  outline: none;
  font-family: inherit;
  width: 16rem;
}

.search-icon {
  margin-left: 10px;
}

.icon-buttons {
  display: flex;
  gap: 15px;
  align-items: center;
}

.icon {
  font-size: 1.2rem;
  cursor: pointer;
}

.login-btn,
.register-btn {
  text-decoration: none;
  padding: 6px 12px;
  border: 1px solid #333;
  border-radius: 5px;
  color: #333;
}

.login-btn:hover,
.register-btn:hover {
  background-color: #f0f0f0;
}

.avatar-circle {
  display: inline-flex;
  justify-content: center;
  align-items: center;
  width: 40px;
  height: 40px;
  background-color: #574e4a;
  color: white;
  font-weight: bold;
  font-size: 1.5rem;
  border-radius: 50%;
  text-transform: uppercase;
  cursor: pointer;
  user-select: none;
  text-align: center;
  line-height: 40px;
}

.logout-btn {
  background-color: #a08c79;
  border: none;
  color: white;
  padding: 8px 14px;
  border-radius: 5px;
  cursor: pointer;
  font-weight: bold;
  transition: background-color 0.3s ease;
}

.logout-btn:hover {
  background-color: #8d7a65;
}


.cart-icon-container {
  position: relative;
  display: inline-block;
}

.cart-count {
  position: absolute;
  top: -8px;
  right: -8px;
  background-color: #ff4757;
  color: white;
  border-radius: 50%;
  width: 20px;
  height: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 12px;
  font-weight: bold;
}
</style>
