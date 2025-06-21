<template>
  <div>
    <!-- Pay Now Button -->
    <button @click="showPopup = true" class="pay-now-btn">Pay Now</button>

    <!-- Order Placed Popup -->
    <div v-if="showPopup" class="popup-overlay">
      <div class="popup">
        <button class="close-btn" @click="showPopup = false">×</button>
        <img src="https://cdn-icons-png.flaticon.com/512/3159/3159066.png" alt="celebration" class="popup-img" />
        <h2>Payment Successfully!</h2>
        <button class="thanks-btn" @click="showPopup = false">Thanks!</button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const showPopup = ref(false);
</script>

<style scoped>
.pay-now-btn {
  padding: 10px 20px;
  background-color: rgb(100, 66, 66);
  color: white;
  border: none;
  border-radius: 6px;
  cursor: pointer;
}

.pay-now-btn:hover {
  background-color: #333;
}

.popup-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.4);
  display: flex;
  justify-content: center;
  align-items: center;
}

.popup {
  background: white;
  border-radius: 12px;
  padding: 30px;
  text-align: center;
  position: relative;
  max-width: 400px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.2);
  font-size: 15px;
}

.popup-img {
  width: 60px;
  margin-bottom: 20px;
}

.close-btn {
  position: absolute;
  top: 10px;
  right: 14px;
  background: transparent;
  border: none;
  font-size: 20px;
  cursor: pointer;
}

.thanks-btn {
  padding: 10px 20px;
  background-color: black;
  color: white;
  border: none;
  border-radius: 6px;
  cursor: pointer;
}
.thanks-btn:hover {
  background-color: #219bff;
}
</style>
