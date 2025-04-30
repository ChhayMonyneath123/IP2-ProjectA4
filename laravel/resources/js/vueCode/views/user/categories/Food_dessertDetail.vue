<template>
  <div>
    <div class="container">
    <NavbarComponent/>
    <div class="breadcrumb">
      <Breadcrumb/>
    </div>
    
      <div class="wrapper">
        <div class="title">Enjoy Your day with Fresh Strawberry Soda</div>
        <img :src="'/assets/images/spagetti.png'" alt="">
      </div>
      <FoodInfo/>
      <Rating />
      <Footer/>
    </div>
  </div>
  </template>
  
  <script>
  import NavbarComponent from '@/vueCode/components/nav_bar.vue';
  import Rating from '../../../components/rating.vue';
  import Footer from '../../../components/footer.vue';
  import FoodInfo from '../../../components/food-info.vue';
import Breadcrumb from '../../../components/breadcrumb.vue';

  export default {
  components: {
    NavbarComponent,
    Rating,
    Footer,
    FoodInfo,
    Breadcrumb,
    }
  }
  // export default {
  //   data() {
  //     return {
  //       product: {
  //         name: 'Classic Cargo Pants',
  //         description: 'Comfortable, durable, and made for adventure.',
  //         price: 45.99,
  //         stock: 'In Stock',
  //         image: 'Cargo_pant1.png',
  //       },
  //       quantity: 1,
  //     };
  //   },
  //   methods: {
  //     increment() {
  //       this.quantity++;
  //     },
  //     decrement() {
  //       if (this.quantity > 1) this.quantity--;
  //     },
  //     addToCart() {
  //       alert(`Added ${this.quantity} item(s) to cart!`);
  //     },
  //   },


  // };
  </script>
  
  <style scoped>
  .container {
    background-color: #F8F7F3;
    max-width: 120rem;
    height: 100%;
  }
  .breadcrumb{
    margin: 2%;
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
  