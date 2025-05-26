<template>
  <Header />
  <div class="order-page">
    <div class="product-list">
      <ProductCard
        v-for="(item, index) in items"
        :key="index"
        v-bind="item"
        @remove="removeItem(index)"
      />
    </div>

    <div class="cart-summary-container">
      <CartSummary />
    </div>
  </div>
  <Footer />
</template>

<script setup>
import { ref } from 'vue'
import Header from '@/components/Header.vue'
import Footer from '@/components/Footer.vue'
import ProductCard from '@/components/ProductCard.vue'
import CartSummary from '@/components/CartSummary.vue'

const items = ref([
  {
    title: 'Amok Fish',
    description: 'Cambodian dish',
    price: 3.2,
    image: 'https://i.pinimg.com/736x/87/38/4a/87384ae90057fc7f1ad80e51a4d58c33.jpg',
  },
  {
    title: 'Strawberry Smoothie',
    description: 'Cambodian dish',
    price: 3.1,
    image: 'https://i.pinimg.com/736x/fd/5b/3a/fd5b3a26a73653481f01ed4c55fc199d.jpg',
  },
  {
    title: 'Chocolate Frappe',
    description: 'Cambodian dish',
    price: 3.1,
    image: 'https://i.pinimg.com/736x/15/80/4e/15804e381f8e4aca5742f0c17de6a66d.jpg',
  },
])

const removeItem = (index) => {
  items.value.splice(index, 1)
}

</script>

<style scoped>
.order-page {
  font-family: Arial, sans-serif;
  display: flex;
  justify-content: space-between;
  margin: 5rem auto;
  width: 85%;
  gap: 3rem;
}

.product-list {
  flex: 1;
  border-radius: 10px;
}

.cart-summary-container {
  width: 30%;
  border-radius: 10px;
}
</style>
