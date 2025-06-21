<template>
  <Nav_bar/>
  <div class="page-wrapper">
    <div class="content-container">
      <div class="payment-container">
        <!-- Delivery Service Section -->
        <div class="section">
          <label>Type of Service:</label>
          <input type="text" placeholder="Please select" id="delivery" class="style-input" />
        </div>

        <!-- Location Selection -->
        <div class="section">
          <label for="location">Choose Location:</label>
          <input type="text" placeholder="Please select" id="location" class="style-input" />
        </div>

        <!-- Payment Method -->
        <div class="payment-methods">
          <h3>Choose your payment method</h3>
          <div class="method-list">
            <label
              v-for="method in paymentMethods"
              :key="method.id"
              :class="['method-option', { selected: selectedMethod === method.id }]"
            >
              <input type="radio" name="payment" :value="method.id" v-model="selectedMethod" />
              <img :src="method.logo" :alt="method.name" class="logo" />
              <span>{{ method.name }}</span>
            </label>
          </div>
        </div>

        <!-- Cost and Pay Button -->
        <div class="pay-section">
          <p>Total Cost <strong>$ 20.20</strong></p>
          <Popup />
        </div>
      </div>

      <!-- Order Summary -->
      <div class="order-summary">
        <h3>Order Summary</h3>
        <div class="order-items">
          <div class="order-item">
            <span>Amok Fish</span>
            <div class="item-details">
              <span class="quantity">x2</span>
              <span class="price">$10.00</span>
            </div>
          </div>

          <div class="order-item">
            <span>Strawberry Shake</span>
            <div class="item-details">
              <span class="quantity">x3</span>
              <span class="price">$9.00</span>
            </div>
          </div>

          <div class="order-item">
            <span>Strawberry Shake</span>
            <div class="item-details">
              <span class="quantity">x3</span>
              <span class="price">$9.00</span>
            </div>
          </div>
          <div class="order-item">
            <span>Blueberry Cake</span>
            <div class="item-details">
              <span class="quantity">x3</span>
              <span class="price">$18.00</span>
            </div>
          </div>
          <div class="order-item">
            <span>Beef Stack</span>
            <div class="item-details">
              <span class="quantity">x3</span>
              <span class="price">$11.00</span>
            </div>
          </div>
        </div>

        <hr />

        <div class="summary-row">
          <span>Sub Total:</span>
          <span>$47.00</span>
        </div>
        <div class="summary-row">
          <span>Discount:</span>
          <span>$0.00</span>
        </div>
        <div class="summary-row">
          <span>Delivery Fee:</span>
          <span>$0.20</span>
        </div>

        <hr />

        <div class="summary-row total">
          <strong>Total:</strong>
          <strong>$47.20</strong>
        </div>
      </div>
    </div>
  </div>
  <Footer_bar/>
</template>

<script setup>
import Popup from '@/components/popup.vue'
import { ref } from 'vue'
import Footer_bar from '@/components/footer_bar.vue'
import Nav_bar from '@/components/nav_bar.vue'

// Selected payment method
const selectedMethod = ref(null)

// Payment methods Options
const paymentMethods = [
  {
    id: 1,
    name: 'Cash on Delivery',
    logo: 'https://cdn.iconscout.com/icon/premium/png-512-thumb/cash-on-delivery-11983829-9923960.png?f=webp&w=256',
  },
  {
    id: 2,
    name: 'MasterCard',
    logo: 'https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg',
  },
  {
    id: 3,
    name: 'ABA',
    logo: 'https://cdn.brandfetch.io/iduTsrn35q/w/284/h/354/theme/dark/logo.png?c=1dxbfHSJFAPEGdCLU4o5B',
  },
  {
    id: 4,
    name: 'Aceleda',
    logo: 'https://acledabank.com.kh/kh/assets/download_image/download-logo-blue.jpg',
  },
]
</script>

<style scoped>
.page-wrapper {
  display: flex;
  height: auto;
  justify-content: center;
}

.quantity,
.price {
  color: #6b7280; /* Tailwind's text-gray-500 */
  margin-left: 8px;
  width: 60px;
  text-align: end;
}

.content-container {
  flex: 1;
  width: 100%;
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  padding: 1rem;
  flex-wrap: wrap;
  flex-direction: row;
  gap: 1rem;
  margin: 0 auto;
}

.payment-container {
  background-color: #cacaca;
  padding: 2rem;
  border-radius: 10px;
  flex: 1 1 60%;
  
}

.section {
  margin-bottom: 1.5rem;
  font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
}

.section label {
  display: block;
  font-weight: bold;
  margin-bottom: 1rem;
}

.section input {
  width: 100%;
  padding: 0.5rem;
}

.payment-methods {
  margin-bottom: 1.5rem;
  font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
}

.method-list {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.method-option {
  display: flex;
  align-items: center;
  border: 1px solid #ccc;
  border-radius: 8px;
  padding: 0.8rem;
  cursor: pointer;
  transition:
  border-color 0.3s,
  background-color 0.3s;
}

.method-option:hover {
  border-color: #888;
}

.method-option.selected {
  border-color: #3b2e1c;
  background-color: #f1ece5;
}

.method-option input {
  margin-right: 1rem;
}

.logo {
  width: 36px;
  height: auto;
  margin-right: 1rem;
}

.pay-section {
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 20px;
  font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
}

.pay-section button {
  padding: 0.6rem 1.2rem;
  background-color: #3b2e1c;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.pay-section button:hover {
  background-color: #5a4b3c;
}
.order-summary {
  background-color: #d3d3d3;
  border: 1px solid #ccc;
  border-radius: 12px;
  padding: 1.5rem;
  flex: 1 1 15%;
  box-sizing: border-box;
}

.order-summary h3 {
  margin-bottom: 1rem;
  font-size: 1.5rem;
  font-weight: 600;
}
.order-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 12px;
}

.item-details {
  display: flex;
  align-items: center;
  gap: 8px;
}
.order-items .item-row {
  display: flex;
  justify-content: space-between;
  margin-bottom: 0.5rem;
  font-size: 1rem;
}

.summary-row {
  display: flex;
  justify-content: space-between;
  font-size: 1rem;
  margin-top: 1rem;
}

.summary-row.total {
  font-size: 1.5rem;
  font-weight: bold;
  margin-top: 1rem;
}

hr {
  border: none;
  border-top: 2px solid #ddd;
  margin: 1.5rem 0;
}
</style>
