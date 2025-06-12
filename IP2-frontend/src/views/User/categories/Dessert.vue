<template>
    <div class="dessert">
      <Nav_bar />
      <Breadcrumb />
  
      <!-- Content and Image side by side -->
      <div class="dessert-wrapper">
        <div class="dessert-content">
          <h1>Desserts</h1>
  
          <!-- Dessert Listings -->
          <div v-if="activeRegion === 'All' || activeRegion === 'Asia'">
            <h2>Cambodian Desserts</h2>
            <h4>{{ desserts.Asia.join(', ') }}</h4>
          </div>
  
          <div v-if="activeRegion === 'All' || activeRegion === 'European'">
            <h2>European Desserts</h2>
            <h4>{{ desserts.European.join(', ') }}</h4>
          </div>
  
          <div v-if="activeRegion === 'All' || activeRegion === 'Middle Eastern'">
            <h2>Middle Eastern Desserts</h2>
            <h4>{{ desserts["Middle Eastern"].join(', ') }}</h4>
          </div>
        </div>
  
        <div class="dessert-image">
          <img id="dessertImage" width="300" alt="Dessert" />
        </div>
      </div>
  
      <!-- Filter Buttons -->
      <div class="allbutton">
        <div class="dessert-nav-button">
          <button @click="setRegion('All')">All</button>
          <button @click="setRegion('Asia')">Asia</button>
          <button @click="setRegion('European')">European</button>
          <button @click="setRegion('Middle Eastern')">Middle Eastern</button>
        </div>
      </div>
  
      <!-- Product Cards -->
      <transition name="fade" mode="out-in">
        <div v-if="activeRegion === 'All'" class="dessert-card">
          <div class="contain-dessert">
            <all_product_card
              v-for="dessert in allDesserts"
              :key="dessert.id"
              :price="dessert.price"
              :title="dessert.title"
              :rating="dessert.rating"
              :delivery-time="dessert.deliveryTime + ' mins'"
              :image="dessert.image"
            />
          </div>
        </div>
      </transition>
      <transition name="fade" mode="out-in">
        <div v-if="activeRegion === 'Asia'" class="dessert-card">
          <div class="contain-dessert">
            <all_product_card
              v-for="dessert in asiaDesserts"
              :key="dessert.id"
              :price="dessert.price"
              :title="dessert.title"
              :rating="dessert.rating"
              :delivery-time="dessert.deliveryTime + ' mins'"
              :image="dessert.image"
            />
          </div>
        </div>
      </transition>
      <transition name="fade" mode="out-in">
        <div v-if="activeRegion === 'European'" class="dessert-card">
          <div class="contain-dessert">
            <all_product_card
              v-for="dessert in EuropeanDesserts"
              :key="dessert.id"
              :price="dessert.price"
              :title="dessert.title"
              :rating="dessert.rating"
              :delivery-time="dessert.deliveryTime + ' mins'"
              :image="dessert.image"
            />
          </div>
        </div>
      </transition>
      <transition name="fade" mode="out-in">
        <div v-if="activeRegion === 'Middle Eastern'" class="dessert-card">
          <div class="contain-dessert">
            <all_product_card
              v-for="dessert in MiddleDesserts"
              :key="dessert.id"
              :price="dessert.price"
              :title="dessert.title"
              :rating="dessert.rating"
              :delivery-time="dessert.deliveryTime + ' mins'"
              :image="dessert.image"
            />
          </div>
        </div>
      </transition>
  
      <Footer_bar />
    </div>
  </template>
  
  <script>
  import Nav_bar from '@/components/nav_bar.vue';
  import Footer_bar from '@/components/footer_bar.vue';
  import Breadcrumb from '@/components/breadcrumb.vue';
  import all_product_card from '@/components/all _product_card.vue';
  
  export default {
    name: "dessert",
    components: {
      Nav_bar,
      Footer_bar,
      Breadcrumb,
      all_product_card
    },
    data() {
      return {
        activeRegion: 'All',
        desserts: {
          Asia: ["Num Ansom Chek", "Tartin", "Chek Kdam", "Kralan"],
          European: ["Tiramisu", "Baklava", "Panna Cotta", "Crepes"],
          "Middle Eastern": ["Kunafa", "Baklava", "Basbousa", "Knafeh"]
        },
        allDesserts: [
          {
            id: 1,
            title: 'Num Ansom Chek',
            price: 3.5,
            deliveryTime: 25,
            image: 'https://upload.wikimedia.org/wikipedia/commons/a/a2/Num_ansom_chrouk.jpg',
            rating: 4,
          },
          {
            id: 2,
            title: 'Tartin',
            price: 4.0,
            deliveryTime: 20,
            image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQNtJurqSG-Prm7oDjhzWVHrMRj0kYPzseoEg&s',
            rating: 4,
          },
          {
            id: 7,
            title: 'Tiramisu',
            price: 6.0,
            deliveryTime: 30,
            image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRpiRjt4A-TRZSmORiY_YiHwruO-I1TBpw42A&s',
            rating: 5,
          },
          {
            id: 8,
            title: 'Baklava',
            price: 5.5,
            deliveryTime: 25,
            image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTqcXBktNsIimO0afpqZTFfKzsZaqzk-5FHsQ&s',
            rating: 4,
          },
          {
            id: 15,
            title: 'Mousse au Chocolat',
            price: 6.0,
            deliveryTime: 25,
            image: 'https://www.1001recettes.net/wp-content/uploads/2025/01/1735901112-mousse-au-chocolat-onctueuse-recette-facile-et-rapide.jpg',
            rating: 5,
          },
          {
            id: 28,
            title: 'Churros (with Chocolate Sauce)',
            price: 4.5,
            deliveryTime: 15,
            image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRjdqSqc0g8SkzYA7FTGavh93mcnWuPQfb91Q&s',
            rating: 4,
          },
          {
            id: 17,
            title: 'Basbousa',
            price: 4.5,
            deliveryTime: 15,
            image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRB8pw_oVfW9fFg0LpuiOwD-XMIsqNyX3EecQ&s',
            rating: 4,
          },
          {
            id: 18,
            title: 'Luqaimat',
            price: 4.0,
            deliveryTime: 15,
            image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQi16uMu_AR1rbW0WwNqa49g7U0iMObErNJyg&s',
            rating: 3,
          },
          {
            id: 22,
            title: 'Maamoul',
            price: 4.2,
            deliveryTime: 15,
            image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ-adpbn6ODLpeyPwcsmcqitwxi4cFYVDxZ9Q&s',
            rating: 4,
          },
          {
            id: 23,
            title: 'Gulab Jamun',
            price: 4.0,
            deliveryTime: 20,
            image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT7jjET_D5ujcfyL33VEVKvWLIbifiysZdMmA&s',
            rating: 4,
          },

        ],
        asiaDesserts: [
          {
            id: 1,
            title: 'Num Ansom Chek',
            price: 3.5,
            deliveryTime: 25,
            image: 'https://upload.wikimedia.org/wikipedia/commons/a/a2/Num_ansom_chrouk.jpg',
            rating: 4,
          },
          {
            id: 2,
            title: 'Tartin',
            price: 4.0,
            deliveryTime: 20,
            image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQNtJurqSG-Prm7oDjhzWVHrMRj0kYPzseoEg&s',
            rating: 4,
          },
          {
            id: 3,
            title: 'Plae ay',
            price: 3.0,
            deliveryTime: 20,
            image: 'https://i.ytimg.com/vi/qZrYLwX5yto/hq720.jpg?sqp=-oaymwEhCK4FEIIDSFryq4qpAxMIARUAAAAAGAElAADIQj0AgKJD&rs=AOn4CLAi6pWIgTQlHahjaEwQIT-N5VT9CQ',
            rating: 4,
          },
          {
            id: 4,
            title: 'Kralan',
            price: 2.5,
            deliveryTime: 15,
            image: 'https://askacambodian.net/wp-content/uploads/2015/06/images-12.jpeg',
            rating: 4,
          },
          {
            id: 5,
            title: 'Banh Duk',
            price: 3.0,
            deliveryTime: 25,
            image: 'https://i.ytimg.com/vi/5MYOR4apKBo/hq720.jpg?sqp=-oaymwEhCK4FEIIDSFryq4qpAxMIARUAAAAAGAElAADIQj0AgKJD&rs=AOn4CLCLjq3DE90W0lci9tgU8nCook1SVw',
            rating: 3,
          },
          {
            id: 6,
            title: 'Nom dongkov',
            price: 2.8,
            deliveryTime: 20,
            image: 'https://i.ytimg.com/vi/rcpX3UeQU24/hq720.jpg?sqp=-oaymwEhCK4FEIIDSFryq4qpAxMIARUAAAAAGAElAADIQj0AgKJD&rs=AOn4CLA89WvIsFdGbOgO3_bF2PAvSnM_GQ',
            rating: 4,
          },
        ],
        EuropeanDesserts:[
         {
            id: 7,
            title: 'Tiramisu',
            price: 6.0,
            deliveryTime: 30,
            image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRpiRjt4A-TRZSmORiY_YiHwruO-I1TBpw42A&s',
            rating: 5,
          },
          {
            id: 8,
            title: 'Baklava',
            price: 5.5,
            deliveryTime: 25,
            image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTqcXBktNsIimO0afpqZTFfKzsZaqzk-5FHsQ&s',
            rating: 4,
          },
          {
            id: 9,
            title: 'Panna Cotta',
            price: 5.0,
            deliveryTime: 20,
            image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSCOoBmKHmCQPFK2uwpFpMJOJNqkmwld9iIWg&s',
            rating: 4,
          },
          {
            id: 10,
            title: 'Crepes (with Nutella)',
            price: 4.5,
            deliveryTime: 15,
            image: 'https://www.chelseasmessyapron.com/wp-content/uploads/2019/05/Nutella-Crepes-ChelseasMessyApron-1200-3-500x500.jpg',
            rating: 4,
          },
          {
            id: 11,
            title: 'Cheesecake',
            price: 6.5,
            deliveryTime: 30,
            image: 'https://www.thespruceeats.com/thmb/HM3X8w38eMVo0Lejx4GLvGHZ4dM=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/gluten-free-new-york-cheesecake-1450985-hero-01-dc54f9daf38044238b495c7cefc191fa.jpg',
            rating: 5,
          },
          {
            id: 12,
            title: 'Chocolate Lava Cake',
            price: 7.0,
            deliveryTime: 25,
            image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQkD7OSbyvoEzYoqjoEAjzRxlV0QUXQ7E2M9g&s',
            rating: 5,
          },
          {
            id: 13,
            title: 'Apple Strudel',
            price: 5.8,
            deliveryTime: 20,
            image: 'https://platedcravings.com/wp-content/uploads/2017/12/Apple-Strudel-Recipe-Plated-Cravings-10-500x375.jpg',
            rating: 4,
          },
          {
            id: 14,
            title: 'Profiteroles',
            price: 5.2,
            deliveryTime: 20,
            image: 'https://www.seriouseats.com/thmb/oN0XXRAYpQqfRrefFnhOvUBmuWg=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/20210609-profiteroles-debbie-wee-seriouseats-17-b1ac56cd654549bc896307e919b26edc.jpg',
            rating: 4,
          },
          {
            id: 15,
            title: 'Mousse au Chocolat',
            price: 6.0,
            deliveryTime: 25,
            image: 'https://www.1001recettes.net/wp-content/uploads/2025/01/1735901112-mousse-au-chocolat-onctueuse-recette-facile-et-rapide.jpg',
            rating: 5,
          },
          {
            id: 28,
            title: 'Churros (with Chocolate Sauce)',
            price: 4.5,
            deliveryTime: 15,
            image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRjdqSqc0g8SkzYA7FTGavh93mcnWuPQfb91Q&s',
            rating: 4,
          },
          {
            id: 29,
            title: 'Doughnuts (Glazed)',
            price: 3.0,
            deliveryTime: 10,
            image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRsRg2a-i048EX4JQ34nTTGDt6gGyfBcj3VWQ&s',
            rating: 3,
          },
          {
            id: 30,
            title: 'Strawberry Shortcake',
            price: 5.5,
            deliveryTime: 20,
            image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRl8I5Yzxz7OG_VAekb4Y7jOHTl70G5mxqo_ASNI13gwBpC7SAeuBhXzgfRzH49TiAgiYQ&usqp=CAU',
            rating: 4,
          },
          {
            id: 26,
            title: 'Turkish Delight (Lokum)',
            price: 3.0,
            deliveryTime: 10,
            image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQtI-DJMzItKCBodDYgnhLhApgBDJ__MJK7Rw&s',
            rating: 3,
          },
          {
            id: 27,
            title: 'Sutlac (Turkish Rice Pudding)',
            price: 3.8,
            deliveryTime: 20,
            image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTuiRedPYM6lSqFR9NHhLEwy8H3IklSWbfYOw&s',
            rating: 4,
          },
        ],
        MiddleDesserts:[
        {
            id: 16,
            title: 'Qatayef',
            price: 4.5,
            deliveryTime: 20,
            image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQkUilLsSMCoMgaQD77ApABajzDUlnk0EY90w&s',
            rating: 4,
          },
          {
            id: 17,
            title: 'Basbousa',
            price: 4.5,
            deliveryTime: 15,
            image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRB8pw_oVfW9fFg0LpuiOwD-XMIsqNyX3EecQ&s',
            rating: 4,
          },
          {
            id: 18,
            title: 'Luqaimat',
            price: 4.0,
            deliveryTime: 15,
            image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQi16uMu_AR1rbW0WwNqa49g7U0iMObErNJyg&s',
            rating: 3,
          },
          {
            id: 19,
            title: 'Umm Ali',
            price: 4.8,
            deliveryTime: 20,
            image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR23iK_ry_nsaXs-Hc_91nKxMb0CBRmVAfkeg&s',
            rating: 4,
          },
          {
            id: 20,
            title: 'Halawet el Jibn',
            price: 5.5,
            deliveryTime: 25,
            image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQsDpaYBcpg_eXghkirVlcu89gAOcx5_gdiUQ&s',
            rating: 4,
          },
          {
            id: 21,
            title: 'Rice Pudding',
            price: 3.5,
            deliveryTime: 20,
            image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSqo9w11fqJdgVdr50pIIe-6i2mriKptg8X1A&s',
            rating: 3,
          },
          {
            id: 22,
            title: 'Maamoul',
            price: 4.2,
            deliveryTime: 15,
            image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ-adpbn6ODLpeyPwcsmcqitwxi4cFYVDxZ9Q&s',
            rating: 4,
          },
          {
            id: 23,
            title: 'Gulab Jamun',
            price: 4.0,
            deliveryTime: 20,
            image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT7jjET_D5ujcfyL33VEVKvWLIbifiysZdMmA&s',
            rating: 4,
          },
          {
            id: 24,
            title: 'Kataifi',
            price: 5.0,
            deliveryTime: 25,
            image: 'https://www.vickisgreekrecipes.com/wp-content/uploads/2023/10/kataifi-roll-2-1170x804.jpeg',
            rating: 4,
          },
          {
            id: 25,
            title: 'Qatayef',
            price: 4.5,
            deliveryTime: 20,
            image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQkUilLsSMCoMgaQD77ApABajzDUlnk0EY90w&s',
            rating: 4,
          },
        ]
      };
    },
    methods: {
      setRegion(region) {
        this.activeRegion = region;
      }
    }
  };
  </script>
  
  <style scoped>
  .dessert {
    display: flex;
    flex-direction: column;
    width: 100%;
    min-height: 100vh;
    background-color: #f9f9f9;
  }
  
  /* Wrapper for content + image */
  .dessert-wrapper {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    padding: 2rem;
    gap: 2rem;
    margin-left: 20px;
  }
  
  .dessert-content {
    width: 40%;
  }
  
  .dessert-image {
    width: 60%;
    text-align: center;
    margin-top: 2rem;
  }
  
  .dessert-image img {
    width: 100%;
    border-radius: 12px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
  }
  
  /* Buttons */
  .allbutton {
    display: flex;
    justify-content: center;
    align-content: center;
  }
  
  .dessert-nav-button {
    margin-top: 2rem;
    display: flex;
    gap: 3rem;
  }
  
  .dessert-nav-button button {
    padding: 10px 20px;
    font-size: 15px;
    background-color: #2c1c14;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    box-shadow: 1px 2px 2px rgba(59, 59, 59, 0.616);
  }
  
  .dessert-nav-button button:hover {
    background-color: #3a281c;
  }
  
  /* Dessert Cards Section */
  .dessert-card {
    margin-top: 2rem;
  }
  
  .contain-dessert {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 1.5rem;
    padding: 1rem;
  }
  </style>
  