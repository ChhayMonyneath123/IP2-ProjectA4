<template>
  <div class="order-page">
    <div class="content">
      <div class="product-list">
        <ProductCard
          v-for="(item, index) in items"
          :key="index"
          v-bind="item"
          @remove="removeItem(index)"
        />
      </div>
      <CartSummary />
    </div>
  </div>
</template>

<script setup>
import ProductCard from '@/components/ProductCard.vue'
import CartSummary from '@/components/CartSummary.vue'
import { ref } from 'vue'

const items = ref([
  { title: 'Amok Fish', description: 'Cambodian dish', price: 3.2, image: 'https://i.pinimg.com/736x/87/38/4a/87384ae90057fc7f1ad80e51a4d58c33.jpg' },
  { title: 'Strawberry Smoothie', description: 'Cambodian dish', price: 3.1, image: 'https://i.pinimg.com/736x/fd/5b/3a/fd5b3a26a73653481f01ed4c55fc199d.jpg' },
  { title: 'Chocolate Frappe', description: 'Cambodian dish', price: 3.1, image: 'https://i.pinimg.com/736x/15/80/4e/15804e381f8e4aca5742f0c17de6a66d.jpg' }
])

const removeItem = (index) => {
  items.value.splice(index, 1)
}
</script>

<style scoped>
.order-page {
  font-family: Arial, sans-serif;
  background: #f9f8f5;
  min-height: 100vh;
}
.content {
  display: flex;
  max-width: 1000px;
  margin: 20px auto;
  gap: 20px;
  padding: 20px;
  
}
.product-list {
  flex: 2;
}
</style>
