<template>
  <router-view />
</template>

<script setup>
import { useAuthStore } from '@/stores/auth'
import { onMounted } from 'vue'
import { createApp } from 'vue';
import Wishlist from './views/User/authentication/Wishlist.vue';

createApp({
    components: { Wishlist }
}).mount('#app');

const authStore = useAuthStore()
const cartStore = useCartStore()

onMounted(() => {
  authStore.init()
  
  if (authStore.user && authStore.user.user_id) {
    cartStore.fetchCartItems(authStore.user.user_id)
  }
})

watch(() => authStore.user, (newUser) => {
  if (newUser && newUser.user_id) {
    cartStore.fetchCartItems(newUser.user_id)
  } else {
    cartStore.clearCart()
  }
})
</script>