<template>
  <div class="menu-page">
    <Breadcrumb />
    <!-- Signature Drinks -->
    <div class="drink-menu">
      <div class="menu-header">
        <h1>Our Signature Drinks</h1>
      </div>
      <!-- Gallery -->
      <div class="gallery-section">
        <div class="gallery-card">
          <img :src="galleryImage" alt="Coffee Gallery" class="gallery-image" />
          <div class="gallery-content">
            <h2>Our Specialties</h2>
            <p>Discover our premium selection including Americano, Latte, Cappuccino, Mocha, and Espresso - each crafted with care and the finest beans.</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Category Tabs -->
    <div class="menu-categories">
      <div class="menu-header">
        <h2>Menu</h2>
      </div>
      <div class="category-tabs">
        <button 
          v-for="category in categories" 
          :key="category" 
          :class="{ active: activeCategory === category }"
          @click="activeCategory = category; selectedDrink = category"
        >
          {{ category }}
        </button>
      </div>

      <!-- Category Content -->
      <div class="category-content">
        <div v-if="activeCategory === 'Hot Drink'">
          <transition name="fade" mode="out-in">
            <div v-if="selectedDrink && drinks[selectedDrink]" :key="selectedDrink" class="drink-card">
              <div class="contain-drink">
                <all_product_card
                  v-for="drink in drinks[selectedDrink]"
                  :key="drink.id"
                  :price="drink.price"
                  :title="drink.title"
                  :rating="drink.rating"
                  :delivery-time="drink.deliveryTime + ' mins'"
                  :image="drink.image"
                />
              </div>
            </div>
          </transition>
        </div>

        <div v-if="activeCategory === 'Iced & Smoothie'">
          <transition name="fade" mode="out-in">
            <div v-if="selectedDrink && drinks[selectedDrink]" :key="selectedDrink" class="drink-card">
              <div class="contain-drink">
                <all_product_card
                  v-for="drink in drinks[selectedDrink]"
                  :key="drink.id"
                  :price="drink.price"
                  :title="drink.title"
                  :rating="drink.rating"
                  :delivery-time="drink.deliveryTime + ' mins'"
                  :image="drink.image"
                />
              </div>
            </div>
          </transition>
        </div>

        <div v-if="activeCategory === 'Juices & Fresh'">
          <transition name="fade" mode="out-in">
            <div v-if="selectedDrink && drinks[selectedDrink]" :key="selectedDrink" class="drink-card">
              <div class="contain-drink">
                <all_product_card
                  v-for="drink in drinks[selectedDrink]"
                  :key="drink.id"
                  :price="drink.price"
                  :title="drink.title"
                  :rating="drink.rating"
                  :delivery-time="drink.deliveryTime + ' mins'"
                  :image="drink.image"
                />
              </div>
            </div>
          </transition>
        </div>
      </div>
    </div>

    <Footer_bar />
  </div>
</template>

<script>
import Breadcrumb from '@/components/breadcrumb.vue';
import Footer_bar from '@/components/footer_bar.vue';
import all_product_card from '@/components/all _product_card.vue';

export default {
  name: "Menu",
  components: {
    Breadcrumb,
    Footer_bar,
    all_product_card
  },
  data() {
    return {
      categories: ['Hot Drink', 'Iced & Smoothie', 'Juices & Fresh'],
      activeCategory: 'Hot Drink',
      selectedDrink: 'Hot Drink',
      galleryImage: new URL('@/assets/images/drinkbg.jpg', import.meta.url).href,
      drinks: {
        'Hot Drink': [
        {
    "id": 1,
    "title": "Hot Americano",
    "price": 2.5,
    "deliveryTime": 15,
    "image": "https://i.pinimg.com/736x/4a/d7/b7/4ad7b70efacd8390944568f16d1a3096.jpg",
    "rating": 4.5
  },

{
    "id": 2,
    "title": "Hot Cappuccino",
    "price": 2.8,
    "deliveryTime": 20,
    "image": "https://i.pinimg.com/736x/f0/65/5f/f0655f2737da76be9b4ac435c65e3d9b.jpg",
    "rating": 4.0
  },

{
    "id": 3,
    "title": "Hot Macchiato",
    "price": 3.0,
    "deliveryTime": 25,
    "image": "https://i.pinimg.com/736x/6c/0f/46/6c0f465a04617940d6e5fc1e784849c0.jpg",
    "rating": 3.5
  },

{
    "id": 4,
    "title": "Hot Matcha",
    "price": 3.5,
    "deliveryTime": 17,
    "image": "https://i.pinimg.com/736x/c2/67/d3/c267d3070e22a73eb254cc43e1eca72f.jpg",
    "rating": 4.2
  },
{
    "id": 5,
    "title": "Hot Mocha",
    "price": 2.2,
    "deliveryTime": 24,
    "image": "https://i.pinimg.com/736x/22/8b/72/228b72a03cb98c19063193cf0188a6a3.jpg",
    "rating": 2.8
  },
{
    "id": 6,
    "title": "Hot espresso",
    "price": 2.4,
    "deliveryTime": 12,
    "image": "https://i.pinimg.com/736x/a8/02/a3/a802a3347368a5155c3ba3388bc77ce1.jpg",
    "rating": 3.3
  },

{
    "id": 7,
    "title": "Hot Salt Caramel Macchiato",
    "price": 2.9,
    "deliveryTime": 10,
    "image": "https://i.pinimg.com/736x/d2/0c/e6/d20ce6b882f53f35c58738dab963434b.jpg",
    "rating": 3.4
  },

{
    "id": 8,
    "title": "Hot Honey Lemon Tea",
    "price": 2.7,
    "deliveryTime": 21,
    "image": "https://i.pinimg.com/736x/99/27/a6/9927a6ed9832abf7da9361772a5a6f9f.jpg",
    "rating": 2.9
  },

{
    "id": 9,
    "title": "Hot Green Tea",
    "price": 2.0,
    "deliveryTime": 30,
    "image": "https://i.pinimg.com/736x/e7/f8/d5/e7f8d59826f9ef94db40bc47765f194d.jpg",
    "rating": 2.1
  },

{
    "id": 10,
    "title": "Hot Cocoa",
    "price": 2.9,
    "deliveryTime": 28,
    "image": "https://i.pinimg.com/736x/9b/21/7d/9b217dff29b25f72b9070a174492e732.jpg",
    "rating": 4.3
  },

        ],
        'Iced & Smoothie': [
        {
    "id": 11,
    "title": "Iced Latte",
    "price": 2.5,
    "deliveryTime": 25,
    "image": "https://i.pinimg.com/736x/d4/70/0c/d4700c9e6ad5ef2630f4d530a613d86b.jpg",
    "rating": 4.0
  },

{
    "id": 12,
    "title": "Iced Matcha Latte",
    "price": 3.3,
    "deliveryTime": 32,
    "image": "https://i.pinimg.com/736x/73/22/d0/7322d0a282371f8bb205b7b66cd50d7c.jpg",
    "rating": 4.3
  },

{
    "id": 13,
    "title": "Iced Americano",
    "price": 3.8,
    "deliveryTime": 22,
    "image": "https://i.pinimg.com/736x/21/03/32/21033241cec90baa0f32f80373d70a61.jpg",
    "rating": 2.3
  },

{
    "id": 14,
    "title": "Iced Honey Tea",
    "price": 2.3,
    "deliveryTime": 16,
    "image": "https://i.pinimg.com/736x/af/10/5e/af105ebd496501a9ccacbfada1bf055c.jpg",
    "rating": 2.1
  },
{
    "id": 15,
    "title": "Iced Vanilla Latte",
    "price": 3.0,
    "deliveryTime": 21,
    "image": "https://i.pinimg.com/736x/0d/f2/8a/0df28a920e3fbc7cef703579a09d48ae.jpg",
    "rating": 3.5
  },
{
    "id": 16,
    "title": "Peanut butter and banana Smoothie",
    "price": 4.0,
    "deliveryTime": 31,
    "image": "https://i.pinimg.com/736x/0d/f2/8a/0df28a920e3fbc7cef703579a09d48ae.jpg",
    "rating": 3.5
  },

{
    "id": 17,
    "title": "Strawberry Smoothie",
    "price": 4.2,
    "deliveryTime": 28,
    "image": "https://i.pinimg.com/736x/69/cf/a6/69cfa6d82bda2dc58013888353b4a74b.jpg",
    "rating": 3.7
  },

{
    "id": 18,
    "title": "Blueberry Banana Smoothie",
    "price": 4.5,
    "deliveryTime": 18,
    "image": "https://i.pinimg.com/736x/f8/1c/df/f81cdf2b077ebf0db858351cdc0c9ef3.jpg",
    "rating": 3.9
  },

{
    "id": 19,
    "title": "Avocado Smoothie",
    "price": 3.6,
    "deliveryTime": 21,
    "image": "https://i.pinimg.com/736x/46/d8/15/46d815be729c637ceaf9be14d1f80a04.jpg",
    "rating": 4.5
  },

{
    "id": 20,
    "title": "RainbowSmoothie",
    "price": 4.0,
    "deliveryTime": 16,
    "image": "https://i.pinimg.com/736x/2d/e4/1d/2de41d64c747a503149fad421693455f.jpg",
    "rating": 3.6
  },

        ],
        'Juices & Fresh': [
        {
    "id": 21,
    "title": "Strawberry Soda",
    "price": 2.4,
    "deliveryTime": 11,
    "image": "https://i.pinimg.com/736x/4f/7a/60/4f7a608bd5384c201a6d707b16263616.jpg",
    "rating": 3.0
  },

{
    "id": 22,
    "title": "Fresh Passion Juice",
    "price": 2.7,
    "deliveryTime": 19,
    "image": "https://i.pinimg.com/736x/02/f7/9e/02f79ea76240b214c527bc94d689920a.jpg",
    "rating": 3.8
  },

{
    "id": 23,
    "title": "Fresh Passion Juice",
    "price": 2.7,
    "deliveryTime": 19,
    "image": "https://i.pinimg.com/736x/02/f7/9e/02f79ea76240b214c527bc94d689920a.jpg",
    "rating": 3.8
  },

{
    "id": 24,
    "title": "Honey Lime Tea",
    "price": 2.5,
    "deliveryTime": 35,
    "image": "https://i.pinimg.com/736x/91/3c/fd/913cfd83bc134c57c66919286ce292b3.jpg",
    "rating": 3.0
  },
{
    "id": 25,
    "title": "Wildberry Raspberry Tea",
    "price": 2.8,
    "deliveryTime": 15,
    "image": "https://i.pinimg.com/736x/e9/34/b6/e934b670aeeda8cdb49a1a67eeb16331.jpg",
    "rating": 3.1
  },
{
    "id": 26,
    "title": "Blueberry Soda",
    "price": 1.5,
    "deliveryTime": 10,
    "image": "https://i.pinimg.com/736x/4a/3f/e0/4a3fe020097f9ec2a5dba454860b7396.jpg",
    "rating": 2.8
  },

{
    "id": 27,
    "title": "Blue Hawaii Soda",
    "price": 1.75,
    "deliveryTime": 10,
    "image": "https://i.pinimg.com/736x/85/13/64/851364b03d5d3298583826f883d2d263.jpg",
    "rating": 2.9
  },

{
    "id": 28,
    "title": "Watermelon Mint",
    "price": 2.75,
    "deliveryTime": 20,
    "image": "https://i.pinimg.com/736x/63/fe/9e/63fe9e6066520678479ab953fb1c2767.jpg",
    "rating": 3.9
  },

{
    "id": 29,
    "title": "Mango Mocktail",
    "price": 3.25,
    "deliveryTime": 30,
    "image": "https://i.pinimg.com/736x/22/c2/1c/22c21c1b21d3553568531a1d6c8596a0.jpg",
    "rating": 2.4
  },

{
    "id": 30,
    "title": "Cucumber Apple Mocktail",
    "price": 4.25,
    "deliveryTime": 35,
    "image": "https://i.pinimg.com/736x/10/d9/71/10d971a0b40ebae91ca3a3a869f21577.jpg",
    "rating": 3.1
  },

        ]
      }
    };
  }
};
</script>
<style scoped>
.menu-page {
  width: 100%;
  min-height: 100vh;
  background-color: white;
  font-family: 'Poppins', sans-serif;
}

.menu-categories {
  margin-bottom: 3rem;
}

.menu-header {
  text-align: center;
  margin-bottom: 2rem;
}

.menu-header h2 {
  font-size: 2.2rem;
  color: #3a2e26;
  font-weight: 600;
  letter-spacing: 1px;
}

.category-tabs {
  display: flex;
  justify-content: center;
  gap: 1rem;
  margin-bottom: 2rem;
  flex-wrap: wrap;
}

.category-tabs button {
  padding: 0.8rem 1.8rem;
  border: none;
  background: #f5f5f5;
  color: #555;
  font-size: 1rem;
  font-weight: 500;
  border-radius: 30px;
  cursor: pointer;
  transition: all 0.3s ease;
  text-transform: capitalize;
}

.category-tabs button:hover {
  background: #e0e0e0;
}

.category-tabs button.active {
  background: #3a2e26;
  color: white;
}

.category-content {
  padding: 1rem;
}

/* FLEX container for drink cards */
.contain-drink {
  display: flex;
  flex-wrap: wrap;
  gap: 1.5rem;
  justify-content: center;
  padding: 1rem 0;
  /* Remove background-color or add if you want */
  /* background-color: aqua; */
}

.drink-menu {
  max-width: 1400px;
  margin: 0 auto;
}

.subtitle {
  color: #7a6a5f;
  font-size: 1.1rem;
  font-weight: 300;
}

.drink-card {
  background: white;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  width: 100%;
  /* max-width: 300px; */
  opacity: 0;
  animation: fadeInUp 0.5s forwards;
}

.drink-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 12px 25px rgba(0, 0, 0, 0.12);
}

.drink-image-container {
  position: relative;
  width: 100%;
  height: 200px;
  overflow: hidden;
}

.drink-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.5s ease;
}

.drink-card:hover .drink-image {
  transform: scale(1.05);
}

.image-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(to bottom, rgba(0,0,0,0.1), rgba(0,0,0,0.3));
}

.drink-details {
  padding: 1.5rem;
  text-align: center;
}

.drink-details h3 {
  color: #3a2e26;
  font-size: 1.3rem;
  margin-bottom: 1rem;
  font-weight: 500;
}

.gallery-section {
  margin-top: 2rem;
}

.gallery-card {
  background: white;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
}

.gallery-image {
  width: 100%;
  height: 250px;
  object-fit: cover;
}

.gallery-content {
  padding: 2rem;
  text-align: center;
}

.gallery-content h2 {
  color: #3a2e26;
  font-size: 1.8rem;
  margin-bottom: 1rem;
}

.gallery-content p {
  color: #7a6a5f;
  line-height: 1.6;
  margin-bottom: 1.5rem;
}

@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* Responsive Styles */
@media (max-width: 1200px) {
  .menu-page {
    padding: 2rem 1.5rem;
  }
}

@media (max-width: 768px) {
  .menu-header h2 {
    font-size: 1.8rem;
  }

  .category-tabs {
    gap: 0.5rem;
  }

  .category-tabs button {
    padding: 0.6rem 1.2rem;
    font-size: 0.9rem;
  }

  .drink-menu {
    padding: 2rem 1rem;
  }

  .drink-grid {
    gap: 1.5rem;
  }
}

@media (max-width: 576px) {
  .menu-header h2 {
    font-size: 1.5rem;
  }

  .drink-grid {
    grid-template-columns: 1fr;
  }
}
</style>