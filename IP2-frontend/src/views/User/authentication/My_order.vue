<template>
<div class="myorder">
  <Nav_bar />
  <div class="order-page">
    <div class="product-list">
      <ProductCard
        v-for="(item, index) in items"
        :key="item.id"
        :title="item.title"
        :description="item.description"
        :price="item.price"
        :image="item.image"
        :quantity="item.quantity"
        @remove="() => removeItem(item.id)"
        @updateQuantity="newQty => updateQuantity(item.id, newQty)"
      />
    </div>

    <div class="cart-summary-container">
      <CartSummary />
    </div>
  </div>
  <Footer_bar />
</div>
</template>

<script setup>
import { ref } from 'vue'
import Nav_bar from '@/components/nav_bar.vue'
import Footer_bar from '@/components/footer_bar.vue'
import ProductCard from '@/components/ordering_card.vue'
import CartSummary from '@/components/CartSummary.vue'

const items = ref([
  {
    id: 1,
    title: 'Amok Fish',
    description: 'Cambodian dish',
    price: 3.2,
    image: 'https://i.pinimg.com/736x/87/38/4a/87384ae90057fc7f1ad80e51a4d58c33.jpg',
  },

  {
    id: 2,
    title: 'Strawberry Smoothie',
    description: 'Cambodian dish',
    price: 3.1,
    image: 'https://i.pinimg.com/736x/fd/5b/3a/fd5b3a26a73653481f01ed4c55fc199d.jpg',
  },
  {
    id: 3,
    title: 'Chocolate Frappe',
    description: 'Cambodian dish',
    price: 3.1,
    image: 'https://i.pinimg.com/736x/15/80/4e/15804e381f8e4aca5742f0c17de6a66d.jpg',
  },
])

const removeItem = (id) => {
  items.value = items.value.filter(item => item.id !== id)
}
const updateQuantity = (id, newQty) => {
  const item = items.value.find(item => item.id === id)
  if (item && newQty >= 1) {
    item.quantity = newQty
  }
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
