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

    <Rating v-if="product && user" :product="product" :user="user" />



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
      user: null,
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
    // Fetch product
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

    // Fetch user (adjust URL to match your real user endpoint)
    axios.get('http://localhost:8000/api/users')
      .then((response) => {
        this.user = response.data.data; // Make sure your backend wraps it in { data: { ... } }
      })
      .catch((error) => {
        console.error('Failed to load user', error);
        this.user = {
          id: 1,
          name: "Fallback User",
          avatar: "https://randomuser.me/api/portraits/lego/1.jpg"
        }; // fallback
      });
  },
  methods: {
    handleCartUpdate(newQuantity) {
      this.quantity = newQuantity;
      console.log(`Updated cart quantity: ${newQuantity}`);
      // You can now store it in localStorage or a global cart system (like Vuex)
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
  /* Adjust as needed for spacing */
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
