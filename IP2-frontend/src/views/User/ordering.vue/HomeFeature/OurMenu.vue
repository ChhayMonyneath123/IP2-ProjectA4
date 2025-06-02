<template>
    <section>
      <!-- OUR MENU Section -->
      <div class="menu-title">OUR MENU</div>
      <div class="menu-grid">
  <div class="menu-item">
    <img :src="food" @click="onClick" alt="Food" />
  </div>
  <div class="menu-item">
    <img :src="coffee" @click="onClick" alt="Drinks" />
  </div>
  <div class="menu-item">
    <img :src="sweet" @click="onClick" alt="Dessert" />
  </div>
</div>

<div class="menu-labels">
  <router-link to="/menu/food"><h2>Food</h2></router-link>
  <router-link to="/menu/drinks"><h2>Drinks</h2></router-link>
  <router-link to="/menu/dessert"><h2>Dessertddd</h2></router-link>
</div>

  
      <!-- Popular Menu Section -->
      <div class="popular-menu-section">
        <div class="popular-container">
          <h1>Popular Menu</h1>
          <div class="relative">
            <div ref="popularMenuItemsContainer" class="scroll-container">
              <div v-for="(item, index) in popularMenuItems" :key="index" class="menu-card">
                <img :src="item.imagePath" :alt="item.title" class="menu-image" />
                <h3 class="menu-title">{{ item.title }}</h3>
                <p class="menu-description">{{ item.description }}</p>
              </div>
            </div>
  
            <button @click="scrollPopularMenuLeft" class="scroll-button left" aria-label="Scroll Left">
              &#8592;
            </button>
  
            <button @click="scrollPopularMenuRight" class="scroll-button right" aria-label="Scroll Right">
              &#8594;
            </button>
          </div>
        </div>
      </div>
      <Explore/>
    </section>
  </template>
  
  <script setup>
  import sweet from '@/assets/images/sweet.png';
  import food from '@/assets/images/food.png';
  import coffee from '@/assets/images/coffee.png';
  import sushi from '@/assets/images/sushi.png';
import mangoCake from '@/assets/images/mango_cake.png';
import amok from '@/assets/images/amok.png';
import fishCheese from '@/assets/images/fish_cheese.png';
import greenTea from '@/assets/images/sushi.png'; // Update if you have the correct image
import noodleSoup from '@/assets/images/sushi.png'; // Update if you have the correct image

  
  import { ref, onMounted } from 'vue';
import Explore from './Explore.vue';
  
  const popularMenuItems = ref([
  { imagePath: sushi, title: 'Sushi', description: 'Fresh and delicious sushi rolls.' },
  { imagePath: mangoCake, title: 'Mango Shake', description: 'Refreshing mango shake.' },
  { imagePath: amok, title: 'Amok', description: 'Traditional Cambodian fish amok.' },
  { imagePath: fishCheese, title: 'Red Velvet Cake', description: 'Rich and moist red velvet cake.' },
  { imagePath: greenTea, title: 'Green Tea', description: 'Refreshing green tea.' },
  { imagePath: noodleSoup, title: 'Noodle Soup', description: 'Hearty noodle soup.' },
  { imagePath: fishCheese, title: 'Red Velvet Cake', description: 'Rich and moist red velvet cake.' },
  { imagePath: greenTea, title: 'Green Tea', description: 'Refreshing green tea.' },
  { imagePath: noodleSoup, title: 'Noodle Soup', description: 'Hearty noodle soup.' },
]);

  
  
  function onClick(event) {
    alert(`Image clicked: ${event.target.alt}`);
  }
  
  const popularMenuItemsContainer = ref(null);
  
  function scrollPopularMenuLeft() {
    const container = popularMenuItemsContainer.value;
    const itemWidth = container.children[0]?.offsetWidth + 32 || 0;
    container.scrollLeft -= itemWidth;
  }
  
  function scrollPopularMenuRight() {
    const container = popularMenuItemsContainer.value;
    const itemWidth = container.children[0]?.offsetWidth + 32 || 0;
    container.scrollLeft += itemWidth;
  }
  </script>
  
  <style scoped>
  /* OUR MENU Section */
  .menu-title {
    text-align: center;
    font-size: 48px;
    font-weight: bold;
    padding: 20px 0;
    text-decoration: none;
  }
  
  .menu-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
    padding: 0 1rem;
  }
  
  .menu-labels {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    text-align: center;
    padding: 1rem 0;
  }
  
  /* POPULAR MENU Section */
  .popular-menu-section {
    padding: 4rem 0;
    background-color: white;
    width: 100%;
  }
  
  .popular-container {
    max-width: 1500px;
    margin: 0 auto;
    padding: 0 1rem;
    text-align: center;
  }
  .popular-container h1{
    font-size: 36px;
    font-weight: bold;
    margin-bottom: 2rem;
    color: #2d3748;
  }
  .relative {
    position: relative;
  }
  
  .scroll-container {
    display: flex;
    gap: 2rem;
    overflow-x: auto;
    scrollbar-width: none;
    -ms-overflow-style: none;
    scroll-behavior: smooth;
    justify-content: center;
    align-items: center;
  }
  
  .scroll-container::-webkit-scrollbar {
    display: none;
  }
  
  .menu-card {
    flex: 0 0 auto;
    width: 10rem;
    background-color: white;
    border-radius: 0.5rem;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    padding: 1rem;
    text-align: center;
  }
  
  .menu-image {
    width: 100%;
    height: 10rem;
    object-fit: cover;
    border-radius: 0.375rem;
    margin-bottom: 1rem;
  }
  
  .menu-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #2d3748;
    margin-bottom: 0.5rem;
  }
  
  .menu-description {
    color: #000000;
    font-size: 0.875rem;
    margin: 0;
  }
  
  .scroll-button {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background-color:#2F2008;
    border-radius: 9999px;
    padding: 0.5rem;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
    cursor: pointer;
    border: none;
    width: 3rem;
    height: 3rem;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 2rem;
    color: #ffffff;
    transition: background-color 0.3s ease;
  }
  
  .scroll-button:hover {
    background-color: #edf2f7;
    color: #2d3748;
  }
  
  .scroll-button.left {
    left: -2.5rem;
  }
  
  .scroll-button.right {
    right: -2.5rem;
  }

  .menu-grid {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}

.menu-item {
  width:570px; /* or any desired width */
  height: 500px; /* or any desired height */
  overflow: hidden;
  cursor: pointer;
  transition: transform 0.3s ease;
}

.menu-item img {
  width: 100%;
  height: 100%;
  object-fit: cover; /* ensures image fills the box nicely */
  
}

.menu-item:hover {
  transform: scale(1.05);
}
.menu-labels h2 {
  cursor: pointer;
  color: #574E4A;
  transition: color 0.3s ease;
}

.menu-labels h2:hover {
  color: #A08C79;
  text-decoration: underline;
}


  </style>
  