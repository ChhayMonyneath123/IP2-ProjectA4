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

onMounted(() => {
  authStore.init()
})
</script>