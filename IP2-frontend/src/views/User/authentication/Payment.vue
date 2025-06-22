<template>
  <Nav_bar/>
  <div class="page-wrapper">
    <div class="content-container">
      <div class="payment-container">
        <!-- Delivery Service Section -->
        <div class="section">
          <label for="serviceType">Type of Service:</label>
          <select id="serviceType" v-model="serviceType" class="style-input">
            <option disabled value="">Please select</option>
            <option value="Dine in">Dine In</option>
            <option value="Delivery">Delivery</option> 
          </select>
        </div>

        <!-- Location Selection -->
        <div class="section">
          <label for="location">Choose Location:</label>
          <input type="text" placeholder="Please select" id="location" class="style-input" />
        </div>

        <!-- Location Popup -->
        <Transition name="fade">
          <div v-if="showPopup" class="popup-overlay">
            <div class="popup-content">
              <h3>Input Your Location</h3>
              <input v-model="form.name" type="text" placeholder="Full Name" class="popup-input" />
              <input v-model="form.phone" type="text" placeholder="Phone Number" class="popup-input" />      

              <div id="map" class="map-container"></div>

              <div class="popup-actions">              
                <button @click="confirmLocation">Confirm</button>             
                <button @click="showPopup = false">Cancel</button>            
              </div>          
            </div>       
          </div>
        </Transition>

        <!-- Location Popup -->
         <Transition name="fade">
          <div v-if="showPopup" class="popup-overlay">
            <div class="popup-content">
            <h3>Input Your Location</h3>
              <input v-model="form.name" type="text" placeholder="Full Name" class="popup-input" />
              <input v-model="form.phone" type="text" placeholder="Phone Number" class="popup-input" />      

              <div id="map" class="map-container"></div>

              <div class="popup-actions">              
                <button @click="confirmLocation">Confirm</button>             
                <button @click="showPopup = false">Cancel</button>            
              </div>          
            </div>       
          </div>
         </Transition>

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
      <div class="cart-summary">
        <h3>Order Summary</h3>

        <div
          v-for="item in cartStore.cartItems"
          :key="item.cart_id"
          class="summary-item"
        >
          <div class="item-info">
            <span class="item-name">{{ item.product_name }}</span>
            <span class="item-quantity">x {{ item.quantity }}</span>
          </div>
          <div class="item-price">
            ${{ (item.unit_price * item.quantity).toFixed(2) }}
          </div>
        </div>

        <div class="summary-row total">
          <span>Total:</span>
          <span>${{ cartStore.cartTotal.toFixed(2) }}</span>
        </div>

        
      </div>
    </div>
  </div>
  <Footer_bar/>
</template>

<script setup>
import Popup from '@/components/popup.vue'
import Footer_bar from '@/components/footer_bar.vue'
import Nav_bar from '@/components/nav_bar.vue'

// Selected payment method
const selectedMethod = ref(null)

const paymentMethods = [
  {
    id: 1,
    name: 'Pay on cash',
    logo: 'https://cdn.iconscout.com/icon/premium/png-512-thumb/cash-on-delivery-11983829-9923960.png?f=webp&w=256',
  },
  {
    id: 2,
    name: 'KHQR',
    logo: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSwG-Zx92YNnU6BuabALnRRwBqX_5USd3AJJw&s',
  },
  // {
  //   id: 3,
  //   name: 'ABA',
  //   logo: 'https://cdn.brandfetch.io/iduTsrn35q/w/284/h/354/theme/dark/logo.png?c=1dxbfHSJFAPEGdCLU4o5B',
  // },
  // {
  //   id: 4,
  //   name: 'Aceleda',
  //   logo: 'https://acledabank.com.kh/kh/assets/download_image/download-logo-blue.jpg',
  // },
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
  color: #6b7280;
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
  background-color: #ffffff;
  padding: 2rem;
  border-radius: 10px;
  flex: 1 1 60%;
}

.section {
  margin-bottom: 1.5rem;
  font-size: 20px;
}

.style-input {
  width: 100%;
  padding: 10px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 6px;
  box-sizing: border-box;
  appearance: none;
  background-color: white;
}

.style-input:focus {
  outline: none;
  border-color: #007BFF;
  box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
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
  transition: border-color 0.3s, background-color 0.3s;
}

.method-option:hover {
  border-color: #888;
}

.method-option.selected {
  border-color: #3b2e1c;
  background-color: #e7e7e7;
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

/* Improved Order Summary Design */
.cart-summary {
  background-color: #fff;
  border-radius: 12px;
  box-shadow: 0 8px 16px rgba(0,0,0,0.1);
  padding: 2rem;
  width: 320px;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.cart-summary h3 {
  font-weight: 700;
  font-size: 1.6rem;
  margin-bottom: 1rem;
  border-bottom: 2px solid #ddd;
  padding-bottom: 0.5rem;
}

.summary-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  border-bottom: 1px solid #eee;
  padding: 0.6rem 0;
  font-size: 1rem;
  color: #444;
}

.summary-item:last-child {
  border-bottom: none;
}

.item-info {
  display: flex;
  gap: 0.5rem;
}

.item-name {
  font-weight: 600;
}

.item-quantity {
  color: #777;
}

.item-price {
  font-weight: 600;
  color: #2c3e50;
}

.summary-row.total {
  font-weight: 800;
  font-size: 1.25rem;
  padding-top: 1rem;
  border-top: 2px solid #ddd;
  display: flex;
  justify-content: space-between;
  color: #111;
}

.checkout-btn {
  margin-top: 1.5rem;
  width: 100%;
  background: #3b2e1c;
  color: white;
  border: none;
  padding: 15px;
  border-radius: 8px;
  font-size: 1.1rem;
  font-weight: 700;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.checkout-btn:hover {
  background-color: #5a4b3c;
}
</style>
