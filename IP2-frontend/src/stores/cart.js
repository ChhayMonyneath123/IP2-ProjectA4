// src/stores/cart.js
import { defineStore } from 'pinia'
import { ref, computed } from 'vue'

export const useCartStore = defineStore('cart', () => {
  // Load from localStorage if available
  const initialCart = JSON.parse(localStorage.getItem('cart')) || {
    items: [],
    count: 0
  }

  const items = ref(initialCart.items)
  const count = ref(initialCart.count)
  const getCartCount = computed(() => count.value)

  // Save to localStorage whenever cart changes
  function saveToLocalStorage() {
    localStorage.setItem('cart', JSON.stringify({
      items: items.value,
      count: count.value
    }))
  }

  function addToCart(productId, productData) {
    const existingItem = items.value.find(item => item.id === productId)
    
    if (existingItem) {
      existingItem.quantity++
    } else {
      items.value.push({
        id: productId,
        quantity: 1,
        ...productData // Include title, price, image etc.
      })
    }
    
    count.value++
    saveToLocalStorage()
  }

  function removeFromCart(productId) {
    const index = items.value.findIndex(item => item.id === productId)
    if (index !== -1) {
      count.value -= items.value[index].quantity
      items.value.splice(index, 1)
      saveToLocalStorage()
    }
  }

  const totalItems = computed(() => count.value)
  const cartItems = computed(() => items.value)
  const totalPrice = computed(() => {
    return items.value.reduce((sum, item) => sum + (item.price * item.quantity), 0)
  })

  return {
    items,
    count,
    addToCart,
    removeFromCart,
    totalItems,
    cartItems,
    totalPrice
  }
})