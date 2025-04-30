<template>
  <div class="AllProduct">
      <FooterComponent />
      <AllProductMenu />
      <div class="contain-card">
          <AllProductCard
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
  </div>
</template>

<script>
import FooterComponent from '../../components/Footer-component.vue';
import AllProductMenu from '../../components/AllProductMenu.vue';
import AllProductCard from '../../components/AllProduct-card.vue';
import p1 from '../../../assets/images/p1.png';
import p from '../../../assets/images/p.jpg';
import p2 from '../../../assets/images/p2.png'
import p3 from '../../../assets/images/p3.png'
import p4 from '../../../assets/images/p4.png'
import p5 from '../../../assets/images/p5.png'
import p6 from '../../../assets/images/p6.png'

export default {
  name: 'AllProduct',
  components: {
      FooterComponent,
      AllProductMenu,
      AllProductCard, // Register the card component
  },
  data() {
      return {
          products: [
              {
                  id: 1,
                  title: 'Blueberry Cake',
                  price: 1.5,
                  deliveryTime: 15,
                  image: p,
                  rating: 4
              },
              {
                  id: 2,
                  title: 'Chocolate Cake',
                  price: 2.0,
                  deliveryTime: 20,
                  image:p1,
                  rating: 5
              },
              {
                  id: 3,
                  title: 'Lemon Cake',
                  price: 2.5,
                  deliveryTime: 10,
                  image: p2,
                  rating: 4
              },
              {
                  id: 4,
                  title: 'Red Velvet Cake',
                  price: 3.0,
                  deliveryTime: 25,
                  image: p3,
                  rating: 5
              },
              {
                  id: 3,
                  title: 'Lemon Cake',
                  price: 2.5,
                  deliveryTime: 10,
                  image: p4,
                  rating: 4
              },
              {
                  id: 4,
                  title: 'Red Velvet Cake',
                  price: 3.0,
                  deliveryTime: 25,
                  image: p5,
                  rating: 5
              },
              {
                  id: 3,
                  title: 'Lemon Cake',
                  price: 2.5,
                  deliveryTime: 10,
                  image: p6,
                  rating: 4
              },
              {
                  id: 4,
                  title: 'Red Velvet Cake',
                  price: 3.0,
                  deliveryTime: 25,
                  image: p,
                  rating: 5
              },
              {
                  id: 4,
                  title: 'Red Velvet Cake',
                  price: 3.0,
                  deliveryTime: 25,
                  image: p3,
                  rating: 5
              },
              {
                  id: 3,
                  title: 'Lemon Cake',
                  price: 2.5,
                  deliveryTime: 10,
                  image: p4,
                  rating: 4
              },
              {
                  id: 4,
                  title: 'Red Velvet Cake',
                  price: 3.0,
                  deliveryTime: 25,
                  image: p5,
                  rating: 5
              },
              {
                  id: 3,
                  title: 'Lemon Cake',
                  price: 2.5,
                  deliveryTime: 10,
                  image: p6,
                  rating: 4
              },
          ]
      };
  }
};
</script>

<style scoped>
.contain-card {
  width: 95%;
  display: flex;
  flex-wrap: wrap;
  justify-content: space-around;
  padding: 5rem;
  margin: 0 auto;
}
.viewMore{
    display: flex;
    justify-content: center;
    align-content: center;
    margin-bottom: 5rem;
}
.viewMore button{
    font-size: 32px;
    font-weight: bold;
    border-radius: 30px;
    padding: 10px 20px;
    background-color: #31261b;
    color: white;
}
</style>