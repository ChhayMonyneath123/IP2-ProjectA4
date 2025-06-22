<template>
  <router-view />
</template>

<script setup>
import { useAuthStore } from '@/stores/auth'
import { useCartStore } from '@/stores/cart'
import { onMounted, watch } from 'vue'

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