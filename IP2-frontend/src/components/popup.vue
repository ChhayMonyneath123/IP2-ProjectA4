<template>
  <div>
    <!-- Pay Now Button -->
    <button @click="openPopup" class="pay-now-btn">Pay Now</button>

    <!-- Order Placed Popup -->
    <div v-if="showPopup" class="popup-overlay">
      <div class="popup">
        <button class="close-btn" @click="showPopup = false">×</button>
        <img src="https://cdn-icons-png.flaticon.com/512/3159/3159066.png" alt="celebration" class="popup-img" />
        <h2>Payment Successfully!</h2>
        <div v-if="qrCodeDataUrl">
          <img :src="qrCodeDataUrl" alt="Bakong QR" style="width: 160px; margin: 16px 0;" />
        </div>
        <div v-if="loading && !transactionSuccess">Checking transaction status...</div>
        <div v-if="transactionSuccess">Transaction completed!</div>
        <div v-if="error" style="color:red">{{ error }}</div>
        <button class="thanks-btn" @click="goHome">Thanks!</button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { getBakongQR } from '@/api/payway/BakongPay';
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import QRCode from 'qrcode';
import axios from 'axios';

// Add your imports for getUser, checkout, ChangeBoughtStatus, getCurrentDateTime, sendTelegramMessage, updateCouponQTY, sharedState, etc.

const router = useRouter();
const showPopup = ref(false);
const qrCodeDataUrl = ref(null);
const transactionSuccess = ref(false);
const loading = ref(false);
const error = ref(null);

// Example refs for required data (replace with your actual logic)
const md5 = ref(''); // Set this from your logic
const itemsID = ref([]); // Set this from your logic
const amountInKHR = ref(0); // Set this from your logic
const CouponID = ref(''); // Set this from your logic
const CouponQTY = ref(0); // Set this from your logic

const openPopup = async () => {
  showPopup.value = true;
  const result = await getBakongQR();
  if (result.qr) {
    qrCodeDataUrl.value = await QRCode.toDataURL(result.qr);
    console.log(`QR Code Data URL: ${result.md5}`);
    console.log(`QR Code Data URL: ${result.qr}`);
    checkTransactionStatus(result.md5); // Pass as value
  } else {
    qrCodeDataUrl.value = null;
  }
};

const checkTransactionStatus = async (md5) => {
  loading.value = true;
  const url = import.meta.env.VITE_BAKONG_ACCESS_URL;
  const accessToken = import.meta.env.VITE_BAKONG_API_KEY;
  console.log(`Checking transaction status for MD5: ${md5}`);
  try {
    const res = await axios.post(
      url,
      { md5: md5 },
      {
        headers: {
          Authorization: `Bearer ${accessToken}`,
          "Content-Type": "application/json",
        },
      }
    );

    if (res.data.responseMessage === "Success") {
      transactionSuccess.value = true;
      alert("Transaction successful!");
      
      // Call your business logic here
      // Example:
      // const user = getUser();
      // checkout(res.data.responseMessage, itemsID.value, "...", "Store accepted", amountInKHR.value, user);
      // itemsID.value.map((item) => ChangeBoughtStatus(item));
      // ...etc

      // setTimeout(() => router.push("/"), 3000);
    } else {
      setTimeout(() => checkTransactionStatus(md5), 5000); // Pass md5 again
    }
  } catch (err) {
    error.value = err.response ? err.response.data : err.message;
    setTimeout(() => checkTransactionStatus(md5), 5000); // Pass md5 again
  }
};

const goHome = () => {
  showPopup.value = false;
  qrCodeDataUrl.value = null;
  transactionSuccess.value = false;
  loading.value = false;
  error.value = null;
  router.push('/');
};
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
