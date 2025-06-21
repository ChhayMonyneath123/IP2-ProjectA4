<template>
  <div class="page-bg">
    <div class="info-box">
      <!-- Info Section -->
      <div class="info-section">
        <div class="info-item">
          <i class="fa-solid fa-utensils"></i>
          <span class="label">Quantity</span>
          <span class="value">{{ quantity }} Set{{ quantity > 1 ? 's' : '' }}</span>
        </div>
        <div class="info-item">
          <i class="fa-regular fa-clock"></i>
          <span class="label">Cooking</span>
          <span class="value">{{ cooking }}</span>
        </div>
        <div class="info-item">
          <i class="fa-solid fa-motorcycle"></i>
          <span class="label">Delivery</span>
          <span class="value">{{ delivery }}</span>
        </div>
      </div>

      <!-- Buttons -->
      <div class="button-section">
        <!-- If not in cart -->
        <button v-if="quantityInCart === 0" class="action-button" @click="addToCart">
          <i class="fa-solid fa-cart-shopping"></i>
          Add to Cart
        </button>

        <!-- Quantity controls -->
        <div v-else class="quantity-controls">
          <button @click="decrease" class="qty-btn">−</button>
          <span class="qty-value">{{ quantityInCart }}</span>
          <button @click="increase" class="qty-btn">+</button>
        </div>

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
  props: {
    quantity: { type: Number, required: true },
    cooking: { type: String, required: true },
    delivery: { type: String, required: true },
  },
  data() {
    return {
      quantityInCart: 0,
    };
  },
  methods: {
    addToCart() {
      this.quantityInCart = 1;
      this.$emit("update-cart", this.quantityInCart);
    },
    increase() {
      this.quantityInCart++;
      this.$emit("update-cart", this.quantityInCart);
    },
    decrease() {
      if (this.quantityInCart > 1) {
        this.quantityInCart--;
        this.$emit("update-cart", this.quantityInCart);
      } else {
        this.quantityInCart = 0;
        this.$emit("update-cart", this.quantityInCart);
      }
    },
  },
};
</script>

<style scoped>
.page-bg {
  background-color: #f8f7f3;
  padding: 28px 16px;
  display: flex;
  justify-content: center;
}

.info-box {
  display: flex;
  flex-direction: column;
  background-color: #eae7db;
  border-radius: 10px;
  padding: 36px 28px;
  width: 100%;
  max-width: 1000px;
  gap: 32px;
  box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
}

@media (min-width: 768px) {
  .info-box {
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
  }
}

.info-section {
  display: flex;
  flex-direction: column;
  gap: 20px;
  color: #2c2c2c;
}

@media (min-width: 768px) {
  .info-section {
    flex-direction: row;
    gap: 50px;
  }
}

.info-item {
  display: flex;
  align-items: center;
  gap: 10px;
}

.info-item i {
  font-size: 28px;
  color: #2c2c2c;
}

.label {
  font-size: 15px;
  color: #555;
}

.value {
  font-size: 17px;
  font-weight: 600;
}

/* Button Section */
.button-section {
  display: flex;
  flex-wrap: wrap;
  gap: 16px;
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
  gap: 8px;
  font-size: 15px;
  font-weight: 600;
  padding: 10px 18px;
  border: 2px solid #2c2c2c;
  color: #2c2c2c;
  border-radius: 7px;
  background-color: transparent;
  cursor: pointer;
  transition: background-color 0.2s ease;
}

.action-button:hover {
  background-color: #ffffff;
}

.icon-button {
  display: flex;
  align-items: center;
  justify-content: center;
  border: 2px solid #2c2c2c;
  padding: 10px 14px;
  border-radius: 7px;
  background-color: transparent;
  color: #2c2c2c;
  cursor: pointer;
  transition: background-color 0.2s ease;
}

.icon-button:hover {
  background-color: #ffffff;
}

/* Quantity Controls */
.quantity-controls {
  display: flex;
  align-items: center;
  border: 2px solid #2c2c2c;
  border-radius: 7px;
}

.qty-btn {
  font-size: 17px;
  font-weight: bold;
  padding: 8px 14px;
  border: none;
  background-color: transparent;
  cursor: pointer;
}

.qty-value {
  font-size: 15px;
  font-weight: 600;
  padding: 0 12px;
}

</style>
