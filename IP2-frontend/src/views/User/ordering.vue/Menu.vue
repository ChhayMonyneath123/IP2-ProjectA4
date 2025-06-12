<template>
    <div class="menu">
      <Nav_bar />
      <div class="menu-categories">
        <div class="menu-header">
          <h1>Product</h1>
        </div>
  
        <div class="category-tabs">
          <template v-for="category in categories" :key="category">
            <button
              v-if="category === 'All'"
              @click="selectCategory(category)"
              :class="{ active: activeCategory === category }"
              class="category-button"
            >
              {{ category }}
            </button>
            
            <div v-else class="category-dropdown-container">
              <button
                @click="toggleDropdown(category)"
                :class="{ active: activeCategory === category }"
                class="category-button button-with-dropdown"
              >
                {{ category }} 
                <span class="dropdown-arrow" :class="{ 'rotate': activeCategory === category && showDropdownForCategory === category }"></span>
              </button>
              
              <div v-if="activeCategory === category && showDropdownForCategory === category" class="region-dropdown">
                <div 
                  v-for="region in regions" 
                  :key="region" 
                  @click="selectRegion(category, region)"
                  :class="{ 'active-region-option': activeRegion === region }"
                  class="dropdown-option"
                >
                  {{ region }}
                </div>
              </div>
            </div>
          </template>
        </div>
  
        <div class="category-content">
          <transition name="fade" mode="out-in">
            <div v-if="filteredMenus.length > 0" :key="activeCategory + activeRegion" class="menu-card">
              <div class="contain-menu">
                <all_product_card
                  v-for="menu in filteredMenus"
                  :key="menu.id"
                  :price="menu.price"
                  :title="menu.title"
                  :rating="menu.rating"
                  :deliveryTime="menu.deliveryTime + ' mins'"
                  :image="menu.image"
                />
              </div>
            </div>
            <div v-else class="no-items-message">
              No items found for the selected category or region.
            </div>
          </transition>
        </div>
      </div>
      <Footer_bar />
    </div>
</template>

<script>
import Nav_bar from '@/components/nav_bar.vue';
import Footer_bar from '@/components/footer_bar.vue';
import all_product_card from '@/components/all _product_card.vue';

export default {
    name: "MenuPage",
    components: {
      Footer_bar,
      Nav_bar,
      all_product_card
    },
    data() {
      return {
        regions: ['Asia', 'Europe',], 
        activeCategory: 'All', // The currently selected category button
        activeRegion: '',      // The currently selected region filter
        showDropdownForCategory: null, // Stores which category's dropdown is currently open (null or 'Food', 'Drink', 'Dessert')
        
        allProducts: [
          {
            id: 1,
            title: 'Amok Fish',
            price: 3.5,
            deliveryTime: 20,
            image: new URL('@/assets/images/Amok.webp', import.meta.url).href,
            rating: 4,
            category: 'Food',
            region: 'Asia'
          },
          {
            id: 2,
            title: 'Spaghetti',
            price: 5,
            deliveryTime: 25,
            image: new URL('@/assets/images/Carbonara.webp', import.meta.url).href,
            rating: 5,
            category: 'Food',
            region: 'Europe'
          },
          {
            id: 3,
            title: 'Pho Soup',
            price: 3.8,
            deliveryTime: 22,
            image: new URL('@/assets/images/pho.webp', import.meta.url).href,
            rating: 4,
            category: 'Food',
            region: 'Asia'
          },
          {
            id: 4,
            title: 'Burger',
            price: 4.5,
            deliveryTime: 18,
            image: new URL('@/assets/images/burger.webp', import.meta.url).href,
            rating: 4.5,
            category: 'Food',
            region: 'Europe'
          },
          {
            id: 5,
            title: 'Milk Tea',
            price: 2.0,
            deliveryTime: 10,
            image: new URL('@/assets/images/thaitea.webp', import.meta.url).href,
            rating: 4,
            category: 'Drink',
            region: 'Asia'
          },
          {
            id: 6,
            title: 'Tiramisu',
            price: 3.0,
            deliveryTime: 12,
            image: new URL('@/assets/images/tiramisu.webp', import.meta.url).href,
            rating: 5,
            category: 'Dessert',
            region: 'Europe'
          }
        ]
      };
    },
    computed: {
      categories() {
        const uniqueCategories = [...new Set(this.allProducts.map(item => item.category))];
        return ['All', ...uniqueCategories];
      },
      filteredMenus() {
        let currentMenus = this.allProducts;

        // 1. Filter by Category (if not 'All')
        if (this.activeCategory !== 'All') {
          currentMenus = currentMenus.filter(menu => menu.category === this.activeCategory);
        }
        if (this.activeRegion && ['Food', 'Drink', 'Dessert'].includes(this.activeCategory)) {
          currentMenus = currentMenus.filter(menu => menu.region === this.activeRegion);
        }
        
        return currentMenus;
      }
    },
    methods: {
      selectCategory(category) {
        this.activeCategory = category;
        this.activeRegion = ''; // Reset region filter
        this.showDropdownForCategory = null; // Close any open dropdowns
      },
      
      toggleDropdown(category) {
        if (this.activeCategory === category && this.showDropdownForCategory === category) {
          // If clicking the active category button and its dropdown is open, close it
          this.showDropdownForCategory = null;
          this.activeRegion = ''; // Also clear region filter if closing dropdown
          this.activeCategory = category; // Keep category active until another is clicked
        } else {
          // Open the dropdown for the clicked category
          this.showDropdownForCategory = category;
          this.activeCategory = category; // Set the active category
          
          // Set default region when opening dropdown
          this.activeRegion = 'Asia'; 
        }
      },

      selectRegion(category, region) {
        this.activeCategory = category;      // Ensure the category is active
        this.activeRegion = region;          // Set the selected region
        this.showDropdownForCategory = null; // Close the dropdown after selection
      }
    },
    created() {
        this.selectCategory('All'); 
    }
}
</script>

<style scoped>
.menu {
    width: 100%;
}

.menu-header {
    text-align: center;
    margin-bottom: 2rem;
}

.category-tabs {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 1rem; 
    margin-bottom: 2rem;
    flex-wrap: wrap;
}

/* Base style for all category buttons */
.category-button {
    padding: 0.8rem 1.8rem;
    border: none;
    background: #f5f5f5;
    color: #555;
    font-size: 1rem;
    font-weight: 500;
    border-radius: 30px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex; 
    align-items: center;
    justify-content: center;
}

.category-button.active {
    background: #3a2e26;
    color: white;
}

/* Container for category buttons with integrated dropdowns */
.category-dropdown-container {
  position: relative; 
  display: inline-block; 
}

/* Styling for buttons that have a dropdown */
.button-with-dropdown {
  padding-right: 2.5rem; /* Make space for the arrow */
}

.dropdown-arrow {
  margin-left: 0.5rem;
  width: 0;
  height: 0;
  border-left: 5px solid transparent;
  border-right: 5px solid transparent;
  border-top: 5px solid #555; 
  transition: transform 0.3s ease;
}

.category-button.active .dropdown-arrow {
  border-top-color: white; /* Arrow color when button is active */
}

.dropdown-arrow.rotate {
  transform: rotate(180deg);
}

/* Styling for the dropdown menu itself (regions) */
.region-dropdown {
  position: absolute;
  top: 100%; /* Position right below the button */
  left: 0;
  background-color: white;
  border: 1px solid #ddd;
  border-radius: 8px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  min-width: 120px; 
  z-index: 10; 
  overflow: hidden; 
  margin-top: 5px; /* Small gap below button */
}

.dropdown-option {
  padding: 0.8rem 1.5rem;
  cursor: pointer;
  color: #555;
  transition: background-color 0.2s ease;
}

.dropdown-option:hover {
  background-color: #f0f0f0;
}

.dropdown-option.active-region-option {
  background-color: #e0e0e0; 
  font-weight: 600;
  color: #3a2e26;
}

/* No more .region-select for separate dropdowns, as they are now integrated */

.category-content {
    padding: 1rem;
}

.contain-menu {
    display: flex;
    flex-wrap: wrap;
    gap: 1.5rem;
    justify-content: center;
}

.no-items-message {
  text-align: center;
  padding: 2rem;
  color: #777;
  font-size: 1.1rem;
}

.fade-enter-active, .fade-leave-active {
    transition: opacity 0.3s;
}
.fade-enter, .fade-leave-to {
    opacity: 0;
}
</style>