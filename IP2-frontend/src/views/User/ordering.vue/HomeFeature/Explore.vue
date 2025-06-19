<template>
    <section class="py-16 bg-gray-50">
      <div class="container mx-auto px-4 text-center max-w-6xl">
        <h2 class="font-bold text-gray-800 mb-8">Explore Our New Menu Every Day</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div
            v-for="(item, index) in allFoodItems"
            :key="index"
            v-show="showAllItems || index < 4"
            class="flex items-center bg-white rounded-lg shadow-md p-4 transition-transform duration-300 ease-in-out hover:scale-105"
          >
            <img
              :src="item.image"   
              class="w-40 h-40 object-cover rounded-md mr-4 flex-shrink-0"
            />
            <div class="text-left flex-grow">
              <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ item.title }}</h3>
              <p class="text-gray-600 text-sm font-medium mb-1">{{ item.type }}</p>
              <p class="text-gray-600 text-sm">{{ item.description }}</p>
            </div>
          </div>
        </div>
  
        <div class="flex justify-center mt-8" v-if="!showAllItems">
          <button
            @click="toggleViewMore"
            class="bg-black hover:bg-blue-600 text-white font-semibold py-3 px-6 rounded-md transition-colors duration-300"
          >
            View More
          </button>
        </div>
      </div>
      <FoodWebsiteSection />
    </section>
  </template>
  
  <script>
  import mangoCake from '@/assets/images/mango_cake.png';
  import amok from '@/assets/images/amok.png';
  import fishCheese from '@/assets/images/fish_cheese.png';
  import redCake from '@/assets/images/red_cake.png';
  import Sushi from '@/assets/images/sushi.png';
import FoodWebsiteSection from './FoodWebsiteSection.vue';
  
export default {
  name: "Explore",
  components: {
    FoodWebsiteSection // Registering the component for use in the template
  },
    data() {
      return {
        showAllItems: false,
        allFoodItems: [
          { image: mangoCake, type: "Tea", title: "Iced Latte", description: "A refreshing cold drink made with espresso and milk" },
          { image: amok, type: "Seafood", title: "Sushi", description: "Fresh and delicious sushi rolls" },
          { image: redCake, type: "Dessert", title: "Cake", description: "Yummy cake with creamy frosting" },
          { image: fishCheese, type: "Drink", title: "Mango Shake", description: "A refreshing tropical drink made with ripe mangoes" },
          { image: Sushi, type: "Fast Food", title: "Burger", description: "Juicy beef patty with fresh toppings" },
        ],
      };
    },
    methods: {
      toggleViewMore() {
        this.showAllItems = !this.showAllItems;
      },
    },
  };
  </script>
  
<style scoped>
section {
  background-color: #f9fafb;
  padding-top: 4rem;
  padding-bottom: 4rem;
}

.container {
  max-width: 1200px;
  margin-left: auto;
  margin-right: auto;
  padding-left: 1rem;
  padding-right: 1rem;
  text-align: center;
}

.container h2 {
  font-size: 36px;
  color: #1f2937;
}

.grid {
  display: grid;
  grid-template-columns: 1fr;
  gap: 1.5rem;
}

@media (min-width: 768px) {
  .grid {
    grid-template-columns: repeat(2, 1fr);
  }
}

.flex {
  display: flex;
  align-items: center;
  background-color: #fff;
  border-radius: 0.5rem;
  box-shadow: 0 4px 6px rgb(0 0 0 / 0.1);
  padding: 1rem;
  transition: transform 0.3s ease-in-out;
}

.flex:hover {
  transform: scale(1.05);
}

img {
  width: 10rem;
  height: 10rem;
  object-fit: cover;
  border-radius: 0.375rem;
  margin-right: 1rem;
  flex-shrink: 0;
}

.text-left {
  text-align: left;
  flex-grow: 1;
}

h3 {
  font-size: 1.25rem;
  font-weight: 600;
  color: #1f2937;
  margin-bottom: 0.5rem;
}

p {
  color: #4b5563;
  font-size: 0.875rem;
  margin: 0;
}

button {
  background-color: #000;
  color: #fff;
  font-weight: 600;
  padding: 0.75rem 1.5rem;
  border-radius: 0.375rem;
  cursor: pointer;
  transition: background-color 0.3s ease-in-out;
  border: none;
}

button:hover {
  background-color: #2563eb;
}

.flex.justify-center {
  justify-content: center;
  margin-top: 2rem;
}
</style>