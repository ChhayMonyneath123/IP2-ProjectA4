<template>
  <div class="drink-customizer">
    <h2>Customize Your Drink</h2>

    <div class="options">
      <!-- Sugar Group -->
      <div class="group">
        <h3>Sugar</h3>
        <div class="option-list">
          <label v-for="option in sugarOptions" :key="option" class="option">
            <input type="radio" v-model="selectedSugar" :value="option" />
            <span>{{ option }}</span>
          </label>
        </div>
      </div>

      <!-- Cup Size Group -->
      <div class="group">
        <h3>Cup Size</h3>
        <div class="option-list">
          <label v-for="option in sizeOptions" :key="option" class="option">
            <input type="radio" v-model="selectedSize" :value="option" />
            <span>{{ option }}</span>
          </label>
        </div>
      </div>

      <!-- Topping Group -->
      <div class="group">
        <h3>Topping</h3>
        <div class="option-list">
          <label v-for="option in toppingOptions" :key="option" class="option">
            <input type="checkbox" v-model="selectedToppings" :value="option" />
            <span>{{ option }}</span>
          </label>
        </div>
      </div>
    </div>

    <!-- Display Summary -->
    <div class="summary-row" v-if="hasSelection">
      <div class="summary-item"><strong>Sugar:</strong> {{ selectedSugar || '-' }}</div>
      <div class="summary-item"><strong>Size:</strong> {{ selectedSize || '-' }}</div>
      <div class="summary-item"><strong>Toppings:</strong> {{ selectedToppings.join(', ') || '-' }}</div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Drink_info',
  data() {
    return {
      sugarOptions: ['100%', '70%', '50%', '25%', '0%'],
      sizeOptions: ['Large', 'Venti', 'Regular', 'Small'],
      toppingOptions: ['Bubble', 'Golden Bubble', 'Aloe Vera', 'Grass Jelly', 'Caramel'],
      selectedSugar: '',
      selectedSize: '',
      selectedToppings: []
    };
  },
  computed: {
    hasSelection() {
      return this.selectedSugar || this.selectedSize || this.selectedToppings.length > 0;
    }
  }
};
</script>

<style scoped>
.drink-customizer {
  font-family: 'Segoe UI', sans-serif;
  background-color: #f9f8f6;
  padding: 40px 20px;
  border-radius: 20px;
  max-width: 1200px;
  margin: auto;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.08);
}

h2 {
  text-align: start;
  font-size: 32px;
  margin-bottom: 40px;
  color: #333;
}

.options {
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 40px;
  margin-bottom: 40px;
}

.group {
  flex: 1 1 300px;
  min-width: 280px;
}

h3 {
  margin-bottom: 16px;
  font-size: 22px;
  color: #444;
}

.option-list {
  display: flex;
  flex-direction: column;
  gap: 14px;
}

.option {
  display: flex;
  align-items: center;
  gap: 12px;
  background: #fff;
  border: 2px solid #ddd;
  padding: 14px 18px;
  border-radius: 12px;
  font-size: 18px;
  transition: 0.2s ease;
  cursor: pointer;
}

.option:hover {
  background: #f0f0f0;
  border-color: #bbb;
}

.option input {
  transform: scale(1.5);
}

.summary-row {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
  justify-content: space-around;
  background-color: #ffffff;
  padding: 20px 25px;
  border-radius: 16px;
  box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);
  font-size: 20px;
  font-weight: 500;
  color: #333;
}

.summary-item {
  flex: 1 1 250px;
  text-align: center;
}

/* Mobile Responsive */
@media (max-width: 768px) {
  .option {
    font-size: 16px;
    padding: 12px 16px;
  }

  .summary-row {
    font-size: 18px;
    flex-direction: column;
    align-items: center;
  }

  h2 {
    font-size: 26px;
  }

  h3 {
    font-size: 20px;
  }
}
</style>
