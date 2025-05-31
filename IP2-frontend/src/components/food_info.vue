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
  background-color: #f8f7f3;
  padding: 32px 16px;
  display: flex;
  justify-content: center;
}

/* Inner container */
.info-box {
  display: flex;
  flex-direction: column;
  background-color: #eae7db;
  border-radius: 12px;
  padding: 40px 32px;
  width: 100%;
  max-width: 1200px;
  gap: 40px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
}

/* Row layout on wider screens */
@media (min-width: 768px) {
  .info-box {
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
  }
}

/* Info section */
.info-section {
  display: flex;
  flex-direction: column;
  gap: 24px;
  color: #2c2c2c;
}

@media (min-width: 768px) {
  .info-section {
    flex-direction: row;
    gap: 60px;
  }
}

.info-item {
  display: flex;
  align-items: center;
  gap: 12px;
}

.info-item i {
  font-size: 36px;
  color: #2c2c2c;
}

.label {
  font-size: 16px;
  color: #555;
}

.value {
  font-size: 18px;
  font-weight: 600;
}

/* Button section */
.button-section {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
  justify-content: flex-start;
}

@media (min-width: 768px) {
  .button-section {
    justify-content: flex-end;
  }
}

.action-button {
  display: flex;
  align-items: center;
  gap: 10px;
  font-size: 16px;
  font-weight: 600;
  padding: 12px 20px;
  border: 2px solid #2c2c2c;
  color: #2c2c2c;
  border-radius: 8px;
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
  border: 2px solid #2c2c2c;
  padding: 12px 16px;
  border-radius: 8px;
  background-color: transparent;
  color: #2c2c2c;
  cursor: pointer;
  transition: background-color 0.2s ease;
}

.icon-button:hover {
  background-color: #eceae5;
}


</style>
