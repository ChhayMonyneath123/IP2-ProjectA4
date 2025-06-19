<template>
    <div class="menu">
      <Nav_bar />
      <Breadcrumb/>
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
                  v-for="subcategory in getSubcategories(category)"
                  :key="subcategory"
                  @click="selectSubcategory(category, subcategory)"
                  :class="{ 'active-region-option': activeSubcategory === subcategory }"
                  class="dropdown-option"
                >
                  {{ subcategory }}
                </div>
              </div>
            </div>
          </template>
        </div>
  
        <div class="category-content">
          <transition name="fade" mode="out-in">
            <div v-if="filteredProducts.length > 0" :key="activeCategory + activeSubcategory" class="menu-card">
              <div class="contain-menu">
                <all_product_card
                  v-for="product in filteredProducts"
                  :key="product.id"
                  :price="product.price"
                  :title="product.title"
                  :rating="product.rating"
                  :deliveryTime="product.deliveryTime + ' mins'"
                  :image="product.image"
                />
              </div>
            </div>
            <div v-else class="no-items-message">
              No items found for the selected category or subcategory.
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
import All_product_card from '@/components/all _product_card.vue';
import Breadcrumb from '@/components/breadcrumb.vue';
import { useRouter } from 'vue-router';
import axios from 'axios';

export default {
    name: "MenuPage",
    components: {
        Footer_bar,
        Nav_bar,
        All_product_card,
        Breadcrumb
    },
    data() {
        return {
            subcategories: {
                'Food': ['Asia', 'Europe'],
                'Drink': ['Hot Drink', 'Iced & Smoothie', 'Juice & Fresh'],
                'Dessert': ['Asian', 'European', 'Middle Eastern']
            },
            activeCategory: 'All',
            activeSubcategory: '',
            showDropdownForCategory: null,
            products: []
        };
    },
    setup() {
        const router = useRouter();
        const goToProductDetail = (id) => {
            console.log("Navigating to product detail with ID:", id);
            router.push({ name: "detail", params: { id } });
        };
        return {
            goToProductDetail 
        };
    },
    computed: {
        categories() {
            const uniqueCategories = [...new Set(this.products.map(item => item.category))];
            return ['All', ...uniqueCategories];
        },
        filteredProducts() {
            let currentProducts = this.products;

            // 1. Filter by Category (if not 'All')
            if (this.activeCategory !== 'All') {
                currentProducts = currentProducts.filter(product => product.category === this.activeCategory);
            }
            
            // 2. Filter by Subcategory (if one is selected)
            if (this.activeSubcategory) {
                currentProducts = currentProducts.filter(product => product.subcategory === this.activeSubcategory);
            }
            
            return currentProducts;
        }
    },
    methods: {
        getSubcategories(category) {
            return this.subcategories[category] || [];
        },
        
        selectCategory(category) {
            this.activeCategory = category;
            this.activeSubcategory = '';
            this.showDropdownForCategory = null;
        },
        
        toggleDropdown(category) {
            if (this.activeCategory === category && this.showDropdownForCategory === category) {
                this.showDropdownForCategory = null;
                this.activeSubcategory = '';
                this.activeCategory = category;
            } else {
                this.showDropdownForCategory = category;
                this.activeCategory = category;
                
                const subcats = this.getSubcategories(category);
                if (subcats.length > 0) {
                    this.activeSubcategory = subcats[0];
                }
            }
        },

        selectSubcategory(category, subcategory) {
            this.activeCategory = category;
            this.activeSubcategory = subcategory;
            this.showDropdownForCategory = null;
        },

        async fetchProducts() {
            try {
                const response = await axios.get('http://127.0.0.1:8000/api/products');
                this.products = response.data.map(product => ({
                    id: product.id,
                    title: product.title,
                    price: product.price,
                    deliveryTime: product.delivery_time
                        ? parseInt(product.delivery_time.split(':')[1])
                        : 0,
                    image: product.image ? `http://127.0.0.1:8000/storage/${product.image}` : '',
                    rating: product.rating || 0,
                    category: product.category || 'Food', // Default to 'Food' if not specified
                    subcategory: product.subcategory || 'Asia' // Default to 'Asia' if not specified
                }));
            } catch (error) {
                console.error("Error fetching products:", error);
                this.products = [];
            }
        }
    },
    mounted() {
        this.fetchProducts();
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
