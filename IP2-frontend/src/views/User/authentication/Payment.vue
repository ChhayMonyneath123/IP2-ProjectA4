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
          <!-- <input type="text" placeholder="Please select" id="delivery" class="style-input" /> -->
        </div>

        <!-- Location Selection -->
        <div class="section">
          <label for="location">Choose Location:</label>
          <input type="text" placeholder="Please select" id="location" class="style-input" readonly @click="showPopup = true" :value="selectedLocationDisplay"/>
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
          <Popup :selectedMethod="selectedMethod"/>
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
import { ref,computed, onMounted, watch } from 'vue'
import L from 'leaflet'
import Popup from '@/components/popup.vue'
import Footer_bar from '@/components/footer_bar.vue'
import Nav_bar from '@/components/nav_bar.vue'

const showPopup = ref(false)
const form = ref({
  name: '',
  phone: '',
  location: '',
})
const selectedLocationDisplay = computed(() => {
  if (!form.value.name && !form.value.phone && !form.value.location) return ''
  return `${form.value.name}, ${form.value.phone}, ${form.value.location}`
})

let map = null
let marker = null

const initMap = () => {
  map = L.map('map').setView([11.5564, 104.9282], 13) // Default to Phnom Penh
  setTimeout(() => map.invalidateSize(), 300)
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
  }).addTo(map)

  map.on('click', e => {
    const { lat, lng } = e.latlng
    form.value.location = `${lat.toFixed(5)}, ${lng.toFixed(5)}`

    if (marker) {
      marker.setLatLng(e.latlng)
    } else {
      marker = L.marker(e.latlng).addTo(map)
    }
  })
}

watch(showPopup, (newVal) => {
  if (newVal) {
    // Wait for DOM render, then initialize
    setTimeout(() => {
      if (!map) {
        initMap()
      } else {
        map.invalidateSize() // <-- Important to fix white/cut area
      }
    }, 100)
  }
})

const confirmLocation = () => {
  showPopup.value = false
}
// Selected payment method
const selectedMethod = ref(null)

// Payment methods Options
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
.fade-enter-active, .fade-leave-active {
  transition: opacity 0.3s ease;
}
.fade-enter-from, .fade-leave-to {
  opacity: 0;
}
.fade-enter-to, .fade-leave-from {
  opacity: 1;
}
.popup-overlay {
  position: fixed;
  inset: 0;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
}
.map-container {
  width: 100%;
  height: 250px;
  margin-top: 10px;
  border-radius: 8px;
  overflow: hidden;
}
.popup-content {
  background: white;
  padding: 20px;
  border-radius: 12px;
  width: auto;
  max-width: 500px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
}

.popup-content h3 {
  margin-bottom: 12px;
  text-align: center;
}

.popup-input {
  width: 90%;
  padding: 10px;
  margin: 8px 0;
  border: 1px solid #ccc;
  border-radius: 6px;
}

.popup-actions {
  display: flex;
  justify-content: space-between;
  margin-top: 12px;
}

.popup-actions button {
  padding: 8px 16px;
  border: none;
  border-radius: 6px;
  cursor: pointer;
}

.popup-actions button:first-child {
  background-color: #4CAF50;
  color: white;
}

.popup-actions button:last-child {
  background-color: #f44336;
  color: white;
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
  transition:
  border-color 0.3s,
  background-color 0.3s;
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
.order-summary {
  background-color: #ffffff;
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
