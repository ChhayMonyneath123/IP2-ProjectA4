<template>
    <div class="container">
    <NavbarComponent/>
      <div class="wrapper">
        <div class="title">Enjoy Your day with Fresh Strawberry Soda</div>
        <img src="@/assets/images/spagetti.png" alt="">
      </div>
        
    </div>
  </template>
  
  <script>
  import NavbarComponent from '@/vueCode/components/nav_bar.vue';

  export default {
  components: {
    NavbarComponent,
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
    background-color: rgb(46, 67, 229);
    max-width: 120rem;
    height: 1440px;
  }
  .wrapper{
    padding: 2%;
    display: flex;
    align-items: center;
    flex-direction: column;
  }
  .title{
    font-size: 36px;
    margin-bottom: 2%;
    margin-top: 5%;
  }
  img{
    width: 800px;
    height: auto;

  }

  </style>
  