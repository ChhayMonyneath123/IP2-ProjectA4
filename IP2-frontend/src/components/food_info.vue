<template>
  <div class="page-bg">
    <div class="info-box">
      <!-- Info Section -->
      <div class="info-section">
        <div class="info-item">
          <i class="fa-solid fa-utensils"></i>
          <span class="label">Serving</span>
          <span class="value">6 Serving</span>
        </div>
        <div class="info-item">
          <i class="fa-regular fa-clock"></i>
          <span class="label">Cooking</span>
          <span class="value">15 mins</span>
        </div>
        <div class="info-item">
          <i class="fa-solid fa-motorcycle"></i>
          <span class="label">Delivery</span>
          <span class="value">20mins</span>
        </div>
      </div>

      <!-- Buttons -->
      <div class="button-section">
        <button class="action-button">
          <i class="fa-solid fa-cart-shopping"></i>
          Add to Cart
        </button>
        <button class="icon-button">
          <i class="fa-regular fa-heart"></i>
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "FoodInfo",
};
</script>

<style scoped>
/* Outer background */
.page-bg {
  background-color: #F8F7F3;
  padding: 24px 16px;
  display: flex;
  justify-content: center;
}

/* Inner beige box */
.info-box {
  display: flex;
  flex-direction: column;
  background-color: #e0ddcd9c;
  border-radius: 8px;
  padding: 22px 24px;
  width: 70%;
  gap: 100px;
  justify-content: center;

}

@media (min-width: 768px) {
  .info-box {
    flex-direction: row;
    align-items: center;
  }
}

/* Info section */
.info-section {
  display: flex;
  flex-direction: row;
  gap: 100px;
  color: #2c2c2c;
  font-size: 16px;


}


.info-item {
  display: flex;
  align-items: center;
  gap: 15px;
}
.info-item i {
  font-size: 54px;
}

.label {
  font-size: 14px;
}

.value {
  font-size: 16px;
  font-weight: 600;
}

/* Button section */
.button-section {
  display: flex;
  gap: 20px;
  margin-top: 20px;
}

@media (min-width: 768px) {
  .button-section {
    margin-top: 0;
  }
}

.action-button {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 14px;
  font-weight: 500;
  padding: 10px 16px;
  border: 1px solid #2c2c2c;
  color: #2c2c2c;
  border-radius: 6px;
  background-color: transparent;
  cursor: pointer;
  transition: background-color 0.2s ease;
}

.action-button:hover {
  background-color: #eceae5;
}

.icon-button {
  display: flex;
  align-items: center;
  justify-content: center;
  border: 1px solid #2c2c2c;
  padding: 10px 12px;
  border-radius: 6px;
  background-color: transparent;
  color: #2c2c2c;
  cursor: pointer;
  transition: background-color 0.2s ease;
}

.icon-button:hover {
  background-color: #eceae5;
}
</style>
