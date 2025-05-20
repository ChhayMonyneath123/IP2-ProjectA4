<template>
  <div class="all-products">
    <div class="breadcrumb">
      <span><router-link to="/" class="disable">Home &gt;</router-link></span>
      <a href="#">Menu</a>
    </div>
    <div class="header-title">All Products</div>
    <div class="filters">
      <select class="filter-box" v-model="filters.category">
        <option value="" disabled selected hidden>Category</option>
        <option v-for="item in filterValue.categories" :key="item.value" :value="item.value">
          {{ item.name }}
        </option>
      </select>

      <select class="filter-box" v-model="filters.price">
        <option disabled selected hidden value="">Price</option>
        <option v-for="item in filterValue.prices" :key="item.value" :value="item.value">
          {{ item.price }}
        </option>
      </select>

      <select class="filter-box" v-model="filters.serving">
        <option disabled selected hidden value="">Serving</option>
        <option v-for="item in filterValue.services" :key="item.value" :value="item.value">
          {{ item.service }}
        </option>
      </select>

      <select class="filter-box" v-model="filters.cooking">
        <option disabled selected hidden value="">Cooking</option>
        <option v-for="item in filterValue.cook" :key="item.value" :value="item.value">
          {{ item.time }}
        </option>
      </select>

      <button class="search-btn" @click="handleSearch">🔍</button>
    </div>
  </div>
</template>

<script>
import { reactive } from 'vue';
import { useRouter } from 'vue-router';

export default {
  name: 'all_product_menu',
  setup() {
    const router = useRouter();

    const filters = reactive({
      category: '',
      price: '',
      serving: '',
      cooking: ''
    });

    const filterValue = {
      categories: [
        { name: 'Foods', value: 'food', route: '/menu/food' },
        { name: 'Drinks', value: 'drink', route: '/menu/drink' },
        { name: 'Desserts', value: 'dessert', route: '/menu/dessert' }
      ],
      prices: [
        { price: 'From 1$-5$', value: 'low' },
        { price: 'From 5$-10$', value: 'mid' },
        { price: 'From 10$-15$', value: 'high' }
      ],
      services: [
        { service: 'serving 6', value: '6' },
        { service: 'serving 7', value: '7' },
        { service: 'serving 8', value: '8' },
        { service: 'serving 9', value: '9' },
        { service: 'serving 10', value: '10' }
      ],
      cook: [
        { time: '1 hour', value: '60' },
        { time: '50 minutes', value: '50' },
        { time: '40 minutes', value: '40' },
        { time: '30 minutes', value: '30' },
        { time: '20 minutes', value: '20' }
      ]
    };

    const handleSearch = () => {
      const match = filterValue.categories.find(item => item.value === filters.category);
      if (match) {
        router.push(match.route);
        console.log('Navigating to:', match.route);
      } else {
        console.warn('Please select a category to navigate.');
      }
    };

    return {
      filters,
      filterValue,
      handleSearch
    };
  }
};
</script>


<style scoped>
.all-products {
font-family: Arial, sans-serif;
background-color: #f9f6f0;
}

.breadcrumb {
background-color: #6f665d;
color: white;
font-size: 14px;
padding: 1rem;
}

.breadcrumb span .disable {
color: white;
text-decoration: none;
margin-left: 10px;
}

.breadcrumb a {
color: white;
text-decoration: underline;
margin-left: 5px;
}

.header-title {
background-color: #6f665d;
text-align: center;
padding: 2rem 1rem 1rem;
color: white;
font-size: 2rem;
font-weight: bold;
}

.filters {
background-color: #6f665d;
display: flex;
justify-content: space-around;
gap: 1rem;
flex-wrap: wrap;
padding: 1rem;
box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

.filter-box {
width: 10%;
padding: 0.5rem;
font-size: 1rem;
border: none;
border-radius: 6px;
}

.filter-box option[disabled] {
color: gray;
}

.search-btn {
background-color: transparent;
border: 2px solid white;
color: white;
padding: 0.5rem 0.8rem;
border-radius: 6px;
font-size: 1.5rem;
cursor: pointer;
}

.search-btn:hover {
background-color: white;
color: #6f665d;
}
</style>
