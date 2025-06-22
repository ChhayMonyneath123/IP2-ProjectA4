<template>
  <div class="product-card">
    <img :src="image" alt="product" class="product-image" />

    <div class="product-info">
      <h4>{{ title }}</h4>
      <p>{{ description }}</p>
    </div>

    <div class="quantity-controls">
      <button @click="decrease">-</button>
      <span>{{ quantity }}</span>
      <button @click="increase">+</button>
    </div>

    <div class="price">${{ price.toFixed(2) }}</div>
    <button class="remove-btn" @click="$emit('remove')">
      <i class="fas fa-trash-alt"></i>
    </button>
  </div>
</template>

<script setup>
import { ref } from 'vue'
defineProps(['title', 'description', 'price', 'image', 'quantity'])
defineEmits(['remove', 'updateQuantity'])

const decrease = () => {
  if (props.quantity > 1) {
    emit('update:quantity', props.quantity - 1)
  }
}
</script>



<style scoped>
.product-card {
  display: flex;
  align-items: center;
  border: 1px solid #ddd;
  padding: 12px;
  border-radius: 8px;
  margin-bottom: 12px;
  background-color: white;
  gap: 12px;
}
.product-image {
  width: 60px;
  height: 60px;
  object-fit: cover;
  border-radius: 6px;
}
.product-info {
  flex: 1;
  margin-left: 12px;
}
.quantity-controls {
  display: flex;
  align-items: center;
  gap: 10px;
}
.quantity-controls button {
  width: 28px;
  height: 28px;
  border: 1px solid #ccc;
  background: white;
  cursor: pointer;
  font-size: 16px;
}
.price {
  margin-left: 16px;
  font-weight: bold;
}
.remove-btn {
  background: none;
  border: none;
  color: red;
  font-size: 18px;
  cursor: pointer;
  margin-left: 20px;
}
</style>