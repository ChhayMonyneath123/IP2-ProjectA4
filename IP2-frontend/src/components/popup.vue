<template>
  <div>
    <!-- Pay Now Button -->
    <button @click="openPopup" class="pay-now-btn" :disabled="!selectedMethod">Pay Now</button>

    <!-- Order Placed Popup -->
    <div v-if="showPopup" class="popup-overlay">
      <div class="popup">
        <button class="close-btn" @click="showPopup = false">×</button>

        <h2>Scan Payment Here!</h2> 
        <div v-if="qrCodeDataUrl">
          <img :src="qrCodeDataUrl" alt="Bakong QR" style="width: 160px; margin: 16px 0;" />
        </div>
        <div v-if="loading && !transactionSuccess">Checking transaction status...</div>
        <div v-if="transactionSuccess">Transaction completed!</div>
        <div v-if="error" style="color:red">{{ error }}</div>
        <button class="cancel-btn" @click="CancelPayment">Cancel</button>
      </div>
    </div>

    <div v-if="showSuccessModal" class="success-modal-overlay">
      <div class="success-modal">
        <button class="close-btn" @click="confirmSuccess">×</button>
        <div class="icon-container">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" fill="none" stroke="green" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10" stroke="green" fill="white"/>
            <path d="M9 12l2 2l4 -4" />
          </svg>
        </div>
        <h2>Transaction Successful</h2>
        <p>Thank you for your payment!</p>
        <button @click="confirmSuccess" class="ok-btn">OK</button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { getBakongQR } from '@/api/payway/BakongPay';
// .ts extension is optional in Vite
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import QRCode from 'qrcode'
import axios from 'axios';
import { defineProps } from 'vue';

const props = defineProps({
  selectedMethod: {
    type: [Number, String, null],
    default: null,
  },
});

const router = useRouter();
const showPopup = ref(false);
const qrCodeDataUrl = ref(null);
const transactionSuccess = ref(false);
const loading = ref(false);
const error = ref(null);
const showSuccessModal = ref(false);

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
      showPopup.value = false;
      showSuccessModal.value = true;
      // alert("Transaction successful!");
      // router.push("/");
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

const confirmSuccess = () => {
  showSuccessModal.value = false;
  router.push("/");
};
const CancelPayment = () => {
  showPopup.value = false;
  qrCodeDataUrl.value = null;
  transactionSuccess.value = false;
  loading.value = false;
  error.value = null;
  router.push('/payment');
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
  z-index: 10;
}

.popup {
  background: white;
  padding: 2rem;
  border-radius: 1rem;
  width: 90%;
  max-width: 400px;
  position: relative;
  text-align: center;
  box-shadow: 0 0 20px rgba(0,0,0,0.2);
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
.success-modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.4);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 999;
}

.success-modal {
  background: white;
  padding: 2rem;
  border-radius: 1rem;
  text-align: center;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
  max-width: 400px;
  width: 90%;
  position: relative;
}

.success-modal .icon-container {
  font-size: 3rem;
  color: green;
  margin-bottom: 1rem;
}

.success-modal h2 {
  margin-bottom: 0.5rem;
}

.success-modal p {
  margin-bottom: 1.5rem;
}

.success-modal .ok-btn {
  padding: 0.5rem 1.5rem;
  background-color: #3085d6;
  color: white;
  border: none;
  border-radius: 8px;
  cursor: pointer;
}
.icon-container .icon {
  width: 120px;
  height: 120px;
}
.cancel-btn {
  padding: 10px 20px;
  background-color: black;
  color: white;
  border: none;
  border-radius: 6px;
  cursor: pointer;
}
.cancel-btn:hover {
  background-color: #219bff;
}
</style>
