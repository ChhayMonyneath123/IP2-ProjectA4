<template>
    <div class="cart-summary">
        <h3>Your Order</h3>
        <div class="voucher-section">
          <input v-model="voucher" placeholder="Discount Voucher" />
          <button class="apply-btn">Apply</button>
        </div>

        <div class="summary-details">
          <p>Sub Total: ${{ subtotal.toFixed(2) }}</p>
          <p>Discount: $0.00</p>
          <p>Delivery Fee: ${{ deliveryFee.toFixed(2) }}</p>
        </div>

        <div class="total">Total: ${{ (subtotal + deliveryFee).toFixed(2) }}</div>

        <button class="checkout-btn" @click="goToPayment">Checkout</button>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const subtotal = ref(20.0)
const deliveryFee = ref(0.2)
const voucher = ref('')
const router = useRouter()

const goToPayment = () => {
  router.push('/payment')
}
</script>

<style scoped>
.cart-summary {
  border: 1px solid #ccc;
  padding: 16px;
  border-radius: 10px;
  width: 100%;
  background-color: #fff;
}

h3 {
  margin-bottom: 10px;
  font-size: 20px;
}

p {
  font-size: 15px;
  margin-bottom: 20px;
}

.voucher-section {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 15px;
}

.cart-summary input {
  flex: 1;
  padding: 8px 12px;
  border-radius: 20px;
  border: 1px solid #ccc;
}

.apply-btn {
  padding: 8px 16px;
  border-radius: 20px;
  border: 1px solid #ccc;
  cursor: pointer;
  background-color: #dddddd;
}

.apply-btn:hover {
  background-color: #0071f3;
  color: #fff;
}

.summary-details {
  font-size: 14px;
  color: #444;
  margin-bottom: 10px;
}

.total {
  font-weight: bold;
  font-size: 16px;
  margin-bottom: 20px;
}

.checkout-btn {
  width: 100%;
  background: #000;
  color: #fff;
  padding: 12px;
  border: none;
  border-radius: 10px;
  cursor: pointer;
  font-size: 16px;
}
.checkout-btn:hover{
  background-color: #0071f3;
}
</style>
