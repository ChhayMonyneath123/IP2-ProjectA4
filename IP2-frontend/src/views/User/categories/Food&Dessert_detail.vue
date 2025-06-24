<template>
  <div class="container">
    <Nav_bar />
    <Breadcrumb />

    <div class="wrapper" v-if="!loading && product">
      <div class="title">{{ product.title }}</div>
      <img :src="product.image" :alt="product.title" />
    </div>

    <div v-else-if="loading" class="loading">Loading product...</div>
    <div v-else class="error">{{ error }}</div>

    <FoodInfo v-if="product" :quantity="product.quantity"
      :cooking="`${Math.max(product.estimated_delivery_minutes - 10, 0)} mins`"
      :delivery="`${product.estimated_delivery_minutes} mins`" @update-cart="handleCartUpdate" />

    <!-- Display the Rating component even without user -->
    <Rating v-if="product" :product="product" />

    <Footer_bar />
  </div>
</template>

<script>
import Nav_bar from '@/components/nav_bar.vue';
import Footer_bar from '@/components/footer_bar.vue';
import FoodInfo from '@/components/food_info.vue';
import Rating from '@/components/rating.vue';
import Breadcrumb from '@/components/breadcrumb.vue';
import axios from 'axios';
import { useRoute } from 'vue-router';

export default {
  name: "ProductDetail",
  components: {
    Nav_bar,
    Rating,
    Footer_bar,
    FoodInfo,
    Breadcrumb,
  },
  data() {
    return {
      product: null,
      quantity: 1,
      loading: true,
      error: null,
    };
  },
  setup() {
    const route = useRoute();
    return { route };
  },
  mounted() {
    const id = this.route.params.id;

    // Fetch product data
    axios.get(`http://localhost:8000/api/products/${id}`)
      .then((response) => {
        this.product = response.data.data;
        this.loading = false;
      })
      .catch((error) => {
        console.error(error);
        this.error = "Failed to load product data.";
        this.loading = false;
      });
  },
  methods: {
    handleCartUpdate(newQuantity) {
      this.quantity = newQuantity;
      console.log(`Updated cart quantity: ${newQuantity}`);
      // Optionally, you can store it in localStorage or a global cart system (e.g., Vuex)
    },
  },
};
</script>

<style scoped>
.container {
  background-color: #F8F7F3;
  width: 100%;
  max-width: 100%;
  height: auto;
}

.breadcrumb {
  margin-top: 1%;
}

.wrapper {
  display: flex;
  align-items: center;
  flex-direction: column;
}

.title {
  font-size: 46px;
  margin-bottom: 2%;
  font-family: 'Instrument Sans Variable', sans-serif;
  font-weight: 700;
}

img {
  width: 40%;
  height: auto;
}

.loading {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 300px;
  font-size: 20px;
  font-weight: 500;
  color: #888;
}

.error {
  text-align: center;
  color: rgb(156, 0, 0);
  font-size: 18px;
  margin-top: 20px;
}
</style>
