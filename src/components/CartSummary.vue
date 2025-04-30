<template>
    <div class="cart-summary">
      <h3>Your Order</h3>
      <input v-model="voucher" placeholder="Discount Voucher" />
      <button class="apply-btn">Apply</button>
      <div class="summary-details">
        <p>Sub Total: ${{ subtotal.toFixed(2) }}</p>
        <p>Discount: $0.00</p>
        <p>Delivery Fee: ${{ deliveryFee.toFixed(2) }}</p>
      </div>
      <div class="total">
        Total: ${{ (subtotal + deliveryFee).toFixed(2) }}
      </div>
      <button class="checkout-btn">Checkout</button>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue'
  const subtotal = ref(20.00)
  const deliveryFee = ref(0.20)
  const voucher = ref('')
  </script>
  
  <style scoped>
  .cart-summary {
    border: 1px solid #ccc;
    padding: 16px;
    border-radius: 10px;
    width: 300px;
    display: block;
    background-color: white;
  }
  .cart-summary input {
    width: 200px;
    padding: 6px;
    margin: 10px 0;
    border-radius: 20px;
    border: 1px solid #ccc;
  }
  .apply-btn {
    padding: 6px 12px;
    cursor: pointer;
    margin: 10px;
    width: 60px;
    border-radius: 20px;
    border: 1px solid #ccc;
  }
  .summary-details {
    font-size: 14px;
    color: #444;
    display: block;
  }
  .total {
    margin-top: 10px;
    font-weight: bold;
    font-size: 16px;
  }
  .checkout-btn {
    margin-top: 80px;
    width: 100%;
    background: #000;
    color: #fff;
    padding: 10px;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    font-size: 15px;;

  }
  </style>
  