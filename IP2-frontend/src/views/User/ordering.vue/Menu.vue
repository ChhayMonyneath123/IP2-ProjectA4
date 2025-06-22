<template>
  <div class="menu">
    <Nav_bar />
    <Breadcrumb />
    <div class="menu-categories">
      <div class="menu-header">
        <h1>Our Menu</h1>
      </div>

      <div class="category-tabs">
        <button @click="selectCategory('All')" :class="{ active: activeCategory === 'All' }" class="category-button">
          All
        </button>

        <div v-for="category in categories" :key="category.id" class="category-dropdown-container">
          <button @click="toggleDropdown(category.name)" :class="{ active: activeCategory === category.name }"
            class="category-button button-with-dropdown">
            {{ category.name }}
            <span class="dropdown-arrow"
              :class="{ 'rotate': activeCategory === category.name && showDropdownForCategory === category.name }"></span>
          </button>

          <div v-if="activeCategory === category.name && showDropdownForCategory === category.name"
            class="region-dropdown">
            <div v-for="subcategory in category.subcategories" :key="subcategory.id"
              @click="selectSubcategory(category.name, subcategory.name)"
              :class="{ 'active-region-option': activeSubcategory === subcategory.name }" class="dropdown-option">
              {{ subcategory.name }}
            </div>
          </div>
        </div>
      </div>

      <div class="category-content">
        <div v-if="isLoading" class="loading-spinner">
          <div class="spinner"></div>
          <p>Loading menu...</p>
        </div>

        <div v-else-if="error" class="error-message">
          <p>{{ error }}</p>
          <button @click="fetchData" class="retry-button">Try Again</button>
        </div>

        <transition v-else name="fade" mode="out-in">
          <div v-if="filteredProducts.length > 0" class="menu-card">
            <div class="contain-menu">
              <all_product_card v-for="product in filteredProducts" 
                :key="product.id"
                :id="product.id"
                :price="product.price"
                :title="product.title" 
                :rating="product.rating" 
                :deliveryTime="product.delivery_time + ' mins'"
                :image="getImageUrl(product.image)" 
                @image-click="goToProductDetail(product.id)" />
            </div>
          </div>
          <div v-else class="no-items-message">
            No products found in this category.
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
import Breadcrumb from '@/components/breadcrumb.vue';
import { useRouter } from 'vue-router';
import axios from 'axios';

export default {
  name: "MenuPage",
  components: {
    Footer_bar,
    Nav_bar,
    all_product_card,
    Breadcrumb
  },
  data() {
    return {
      categories: [],      // Will store all categories with subcategories
      products: [],        // Will store all products
      activeCategory: 'All',
      activeSubcategory: '',
      showDropdownForCategory: null,
      isLoading: true,
      error: null
    };
  },
  setup() {
    const router = useRouter();
    const goToProductDetail = (id) => {
      router.push({ name: "detail", params: { id } });
    };
    return { goToProductDetail };
  },
  computed: {
    filteredProducts() {
      if (this.activeCategory === 'All') {
        return this.products;
      }

      let filtered = this.products.filter(
        product => product.category === this.activeCategory
      );

      if (this.activeSubcategory) {
        filtered = filtered.filter(
          product => product.subcategory === this.activeSubcategory
        );
      }

      return filtered;
    }
  },
  methods: {
    async fetchData() {
      this.isLoading = true;
      this.error = null;

      try {
        // Fetch categories, subcategories, and products
        const [categoriesRes, subcategoriesRes, productsRes] = await Promise.all([
          axios.get('http://127.0.0.1:8000/api/categories'),
          axios.get('http://127.0.0.1:8000/api/subcategories'),
          axios.get('http://127.0.0.1:8000/api/products')
        ]);

        const categories = categoriesRes.data;
        const subcategories = subcategoriesRes.data;

        // Add subcategories to each category
        const categoryMap = categories.map(cat => {
          return {
            ...cat,
            subcategories: subcategories.filter(sub => sub.category_id === cat.category_id)
          };
        });

        this.categories = categoryMap;

        // Normalize product data
        this.products = productsRes.data.data.map(product => ({
          id: product.product_id,
          title: product.title,
          price: product.price,
          image: product.image,
          delivery_time: product.estimated_delivery_minutes || 30,
          rating: product.average_rating || 0,
          category: product.category_name,
          subcategory: product.subcategory_name
        }));

        console.log('Products loaded:', this.products); // Debug log
      } catch (err) {
        console.error("Error fetching data:", err);
        this.error = "Failed to load menu. Please try again later.";
      } finally {
        this.isLoading = false;
      }
    },

    getImageUrl(imagePath) {
      if (!imagePath) return require('@/assets/default-product.png');
      if (imagePath.startsWith('http')) return imagePath;
      return `http://127.0.0.1:8000/storage/${imagePath}`;
    },

    selectCategory(category) {
      this.activeCategory = category;
      this.activeSubcategory = '';
      this.showDropdownForCategory = null;
    },

    toggleDropdown(category) {
      if (this.showDropdownForCategory === category) {
        this.showDropdownForCategory = null;
      } else {
        this.showDropdownForCategory = category;
        this.activeCategory = category;
        // Select first subcategory by default
        const categoryObj = this.categories.find(c => c.name === category);
        if (categoryObj?.subcategories?.length) {
          this.activeSubcategory = categoryObj.subcategories[0].name;
        }
      }
    },

    selectSubcategory(category, subcategory) {
      this.activeCategory = category;
      this.activeSubcategory = subcategory;
      this.showDropdownForCategory = null;
    }
  },
  mounted() {
    this.fetchData();
  }
};
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
  padding-right: 2.5rem;
  /* Make space for the arrow */
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
  border-top-color: white;
  /* Arrow color when button is active */
}

.dropdown-arrow.rotate {
  transform: rotate(180deg);
}

/* Styling for the dropdown menu itself (regions) */
.region-dropdown {
  position: absolute;
  top: 100%;
  /* Position right below the button */
  left: 0;
  background-color: white;
  border: 1px solid #ddd;
  border-radius: 8px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  min-width: 120px;
  z-index: 10;
  overflow: hidden;
  margin-top: 5px;
  /* Small gap below button */
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

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s;
}

.fade-enter,
.fade-leave-to {
  opacity: 0;
}

.loading-spinner {
  text-align: center;
  padding: 2rem;
}

.spinner {
  border: 4px solid #f3f3f3;
  border-top: 4px solid #3a2e26;
  border-radius: 50%;
  width: 40px;
  height: 40px;
  animation: spin 1s linear infinite;
  margin: 0 auto 1rem;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

.error-message {
  text-align: center;
  padding: 2rem;
  color: #d32f2f;
}

.retry-button {
  background: #3a2e26;
  color: white;
  border: none;
  padding: 0.5rem 1rem;
  border-radius: 5px;
  cursor: pointer;
  margin-top: 1rem;
}

.retry-button:hover {
  background: #2d1f17;
}
</style>