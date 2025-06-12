<template>
    <div class="container">
    <Nav_bar/>
    <Breadcrumb/>
      <div class="wrapper">
        <div class="title">Enjoy Your day with Fresh Strawberry Soda</div>
        <img :src="product.image" alt="Spaghetti">

      </div>
      <FoodInfo/>
      <Rating />
      
      <Footer_bar/>
    </div>
  </template>
  
<script>
import Nav_bar from '@/components/nav_bar.vue';
import FoodInfo from '@/components/food_info.vue';
import Rating from '@/components/rating.vue';
import Breadcrumb from '@/components/breadcrumb.vue';
import Footer_bar from '@/components/footer_bar.vue';
  export default {
    components: {
      Nav_bar,
      Rating,
      FoodInfo,
      Breadcrumb,
      Footer_bar
    },
    data() {
      return {
        product: {
          name: 'Classic Cargo Pants',
          description: 'Comfortable, durable, and made for adventure.',
          price: 45.99,
          stock: 'In Stock',
          image: new URL('@/assets/images/spagetti.png', import.meta.url).href,
        },
        quantity: 1,
      };
    },
    methods: {
      increment() {
        this.quantity++;
      },
      decrement() {
        if (this.quantity > 1) this.quantity--;
      },
      addToCart() {
        alert(`Added ${this.quantity} item(s) to cart!`);
      },
    },


  };
  </script>
  
  <style scoped>
  .container {
    background-color: #F8F7F3;
    width: 100%;
    height: auto;
  }
  .breadcrumb{
    margin-top: 1%;
  }
  .wrapper{
    padding: 2%;
    display: flex;
    align-items: center;
    flex-direction: column;
  }
  .title{
    font-size: 48px;
    margin-bottom: 2%;
    font-family: 'Instrument Sans Variable', sans-serif;
    font-weight: 700;
  }
  img{
    width: 1000px;
    height: auto;

  }

  </style>
  