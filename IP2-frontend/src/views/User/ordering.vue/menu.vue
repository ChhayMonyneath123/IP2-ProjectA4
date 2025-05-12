<template>
    <div class="menu">
      <Nav_bar />
      <all_product_menu />
      <router-view />
      
      <!-- Display product cards only when route is /menu -->
      <div v-if="$route.path === '/menu'" class="contain-card">
        <all_product_card
          v-for="product in products"
          :key="product.id"
          :title="product.title"
          :price="product.price"
          :deliveryTime="product.deliveryTime"
          :image="product.image"
          :rating="product.rating"
        />
      </div>
  
      <div class="viewMore">
        <button type="button">View More</button>
      </div>
      <FooterBar />
    </div>
  </template>
  
  <script>
  import Nav_bar from '@/components/nav_bar.vue';
  import FooterBar from '@/components/FooterBar.vue';
  import all_product_card from '@/components/all _product_card.vue';
//   import All_product_card from '@/components/all_product_card.vue';

  import all_product_menu from '@/components/all_product_menu.vue';
  
  export default {
    name: "menu",
    components: {
      FooterBar,
      Nav_bar,
      all_product_menu,
      all_product_card
    },
    data() {
      return {
        products: [
          {
            id: 1,
            title: 'Blueberry Cake',
            price: 1.5,
            deliveryTime: 15,
            image: new URL('@/assets/images/p.jpg', import.meta.url).href,
            rating: 4
          },
          {
            id: 2,
            title: 'Strawberry Cake',
            price: 2.5,
            deliveryTime: 20,
            image: new URL('@/assets/images/p1.png', import.meta.url).href,
            rating: 3
          },
          {
            id: 3,
            title: 'Chocolate Cake',
            price: 3.0,
            deliveryTime: 25,
            image: new URL('@/assets/images/p2.png', import.meta.url).href,
            rating: 4
          },
          {
            id: 4,
            title: 'Vanilla Cake',
            price: 1.8,
            deliveryTime: 10,
            image: new URL('@/assets/images/p3.png', import.meta.url).href,
            rating: 5
          },
          {
            id: 5,
            title: 'Lemon Tart',
            price: 2.0,
            deliveryTime: 12,
            image: new URL('@/assets/images/p4.png', import.meta.url).href,
            rating: 4
          },
          {
            id: 6,
            title: 'Red Velvet',
            price: 2.5,
            deliveryTime: 30,
            image: new URL('@/assets/images/p5.png', import.meta.url).href,
            rating: 4
          },
          {
            id: 7,
            title: 'Pineapple Cake',
            price: 2.2,
            deliveryTime: 15,
            image: new URL('@/assets/images/p6.png', import.meta.url).href,
            rating: 3
          },
          {
            id: 8,
            title: 'Fruit Cake',
            price: 2.3,
            deliveryTime: 18,
            image: new URL('@/assets/images/p6.png', import.meta.url).href,
            rating: 4
          }
        ]
      };
    }
  }
  </script>
  
  <style scoped>
  .menu {
    width: 100%;
    height: auto;
  }
  .contain-card {
    width: 90%;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    padding: 4rem 2rem;
    margin: 0 auto;
  }
  .viewMore {
    display: flex;
    justify-content: center;
    align-content: center;
    margin-bottom: 5rem;
  }
  .viewMore button {
    font-size: 32px;
    font-weight: bold;
    border-radius: 30px;
    padding: 10px 20px;
    background-color: #31261b;
    color: white;
  }
  </style>
  