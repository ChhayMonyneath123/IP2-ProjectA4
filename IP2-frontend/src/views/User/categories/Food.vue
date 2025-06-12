<template>
  <div class="page-wrapper">
    <Breadcrumb />
    <div class="food">
      <div class="app-container">
        <!-- Sidebar -->
        <div class="menu-sidebar">
          <h2>Menu</h2>
          <div v-for="group in menu" :key="group.category" class="menu-group">
            <h3>{{ group.category }}</h3>
            <ul>
              <li v-for="country in group.countries" :key="country">
                <button
                  @click="selectCountry(country)"
                  :class="{ active: selectedCountry === country }"
                >
                  {{ country }}
                </button>
              </li>
            </ul>
          </div>
        </div>

        <!-- Display Area with Transition -->
        <div class="food-display">
          <transition name="fade" mode="out-in">
            <div v-if="selectedCountry" :key="selectedCountry + '-' + countryKey" class="country-card">
              <h1 >{{ selectedCountry }}</h1>
              <div class="contain-food">
                <all_product_card
                  v-for="food in foods[selectedCountry]"
                  :key="food.id"
                  :price="food.price"
                  :title="food.title"
                  :rating="food.rating"
                  :delivery-time="food.deliveryTime + ' mins'"
                  :image="food.image"
                />
              </div>
            </div>
          </transition>
        </div>
      </div>
    </div>
    <Footer_bar />
  </div>
</template>

<script setup>
import { ref } from 'vue';
import Footer_bar from '@/components/footer_bar.vue';
import Breadcrumb from '@/components/breadcrumb.vue';
import all_product_card from '@/components/all _product_card.vue';

const menu = [
  {
    category: 'Asian Food',
    countries: ['Cambodia', 'Thailand', 'Malaysia', 'Vietnam', 'Korea', 'China', 'Japan'],
  },
  {
    category: 'European Food',
    countries: ['Italy', 'Spain', 'France', 'Hungary'],
  },
];

const selectedCountry = ref('Cambodia');

const foods = {
  Cambodia: [
    {
      id: 1,
      title: 'Amok Fish ',
      price: 3.5,
      deliveryTime: 20,
      image: new URL('@/assets/images/Amok.webp', import.meta.url).href,
      rating: 4,
    },
    {
      id: 2,
      title: 'Nom Banh Chok',
      price: 2.0,
      deliveryTime: 20,
      image: new URL('@/assets/images/Noodles.webp', import.meta.url).href,
      rating: 3,
    },
    {
      id: 3,
      title: 'Samlar machu',
      price: 1.5,
      deliveryTime: 15,
      image: new URL('@/assets/images/Samlar-Machu.webp', import.meta.url).href,
      rating: 4,
    },
    {
      id: 4,
      title: 'Kampot Pepper Crab',
      price: 2.0,
      deliveryTime: 20,
      image: new URL('@/assets/images/Crab.webp', import.meta.url).href,
      rating: 3,
    },
    {
      id: 5,
      title: 'Samlar kari',
      price: 1.5,
      deliveryTime: 15,
      image: new URL('@/assets/images/Curry.webp', import.meta.url).href,
      rating: 4,
    },
    {
      id: 6,
      title: 'Yaohon',
      price: 2.0,
      deliveryTime: 20,
      image: new URL('@/assets/images/Yaohon.webp', import.meta.url).href,
      rating: 3,
    },
    {
      id: 7,
      title: 'Samlor Korkor',
      price: 2.0,
      deliveryTime: 20,
      image: new URL('@/assets/images/Samlor-Korkor.webp', import.meta.url).href,
      rating: 3,
    },
    {
      id: 8,
      title: 'Beef Lok Lak',
      price: 1.5,
      deliveryTime: 15,
      image: new URL('@/assets/images/Beef-Lok-Lak.webp', import.meta.url).href,
      rating: 4,
    },
    {
      id: 9,
      title: 'Lap Khmer',
      price: 2.0,
      deliveryTime: 20,
      image: new URL('@/assets/images/Khmer-beef-salad1.webp', import.meta.url).href,
      rating: 3,
    },
    {
      id: 10,
      title: ' Samlor Machu Trey',
      price: 2.5,
      deliveryTime: 25,
      image: new URL('@/assets/images/Samlor-Machu-Trey-cambodia.webp', import.meta.url).href,
      rating: 4,
    },
    {
      id: 11,
      title: 'Fried Insects',
      price: 3.0,
      deliveryTime: 30,
      image: new URL('@/assets/images/cambodia-food1.webp', import.meta.url).href,
      rating: 5,
    },
    {
      id: 12,
      title: 'Samlar machu',
      price: 1.5,
      deliveryTime: 15,
      image: new URL('@/assets/images/Samlar-Machu.webp', import.meta.url).href,
      rating: 4,
    },
  ],
  Thailand: [
        {
          id: 1,
          title: 'SPICY MANGO SALAD',
          price: 1.5,
          deliveryTime: 15,
          image: new URL('@/assets/images/SPICY-MANGO-SALAD.jpg', import.meta.url).href,
          rating: 4,
        },
        {
          id: 2,
          title: 'PAD THAI',
          price: 2.0,
          deliveryTime: 20,
          image: new URL('@/assets/images/PAD-THAI.jpg', import.meta.url).href,
          rating: 3,
        },
        {
          id: 3,
          title: 'TOM YUM KUNG',
          price: 1.5,
          deliveryTime: 15,
          image: new URL('@/assets/images/TOM-YUM-KUNG_GOONG.jpg', import.meta.url).href,
          rating: 4,
        },
        {
          id: 4,
          title: 'ROASTED DUCK AND RICE ',
          price: 2.0,
          deliveryTime: 20,
          image: new URL('@/assets/images/ROASTED-DUCK-AND-RICE.jpg', import.meta.url).href,
          rating: 3,
        },
        {
          id: 5,
          title: 'THAI STYLE OMELETTE',
          price: 1.5,
          deliveryTime: 15,
          image: new URL('@/assets/images/THAI-STYLE-OMELETTE.jpg', import.meta.url).href,
          rating: 4,
        },
        {
          id: 6,
          title: 'GRILLED PORK SKEWERS',
          price: 2.0,
          deliveryTime: 20,
          image: new URL('@/assets/images/GRILLED-PORK-SKEWERS.jpg', import.meta.url).href,
          rating: 3,
        },
        {
          id: 7,
          title: 'PORK SALAD',
          price: 2.0,
          deliveryTime: 20,
          image: new URL('@/assets/images/PORK-SALAD.jpg', import.meta.url).href,
          rating: 3,
        },
        {
          id: 8,
          title: 'SPICY MANGO SALAD',
          price: 1.5,
          deliveryTime: 15,
          image: new URL('@/assets/images/SPICY-MANGO-SALAD.jpg', import.meta.url).href,
          rating: 4,
        },
        {
          id: 9,
          title: 'THAI-STYLE STIR FRY',
          price: 2.0,
          deliveryTime: 20,
          image: new URL('@/assets/images/THAI-STYLE-STIR-FRY-also-spelled-PAD-KRAPOW.jpg', import.meta.url).href,
          rating: 3,
        },
        {
          id: 10,
          title: ' PAD SEE EW',
          price: 2.5,
          deliveryTime: 25,
          image: new URL('@/assets/images/PAD-SEE-EW.jpg', import.meta.url).href,
          rating: 4,
        },
        {
          id: 11,
          title: 'Fried Insects',
          price: 3.0,
          deliveryTime: 30,
          image: new URL('@/assets/images/cambodia-food1.webp', import.meta.url).href,
          rating: 5,
        },
        {
          id: 12,
          title: 'Samlar machu',
          price: 1.5,
          deliveryTime: 15,
          image: new URL('@/assets/images/Samlar-Machu.webp', import.meta.url).href,
          rating: 4,
        },
  ],
  Malaysia: [
        {
          id: 1,
          title: 'Nasi Lemak',
          price: 1.5,
          deliveryTime: 15,
          image: new URL('@/assets/images/nasilemak.jpg', import.meta.url).href,
          rating: 4,
        },
        {
          id: 2,
          title: 'Ayam Goreng',
          price: 2.0,
          deliveryTime: 20,
          image: new URL('@/assets/images/ayam.jpg', import.meta.url).href,
          rating: 3,
        },
        {
          id: 3,
          title: 'Roti Jala ',
          price: 1.5,
          deliveryTime: 15,
          image: new URL('@/assets/images/rotijala.jpg', import.meta.url).href,
          rating: 4,
        },
        {
          id: 4,
          title: 'Satay',
          price: 1.5,
          deliveryTime: 15,
          image: new URL('@/assets/images/Satay.jpg', import.meta.url).href,
          rating: 4,
        },
        {
          id: 5,
          title: 'Lontong',
          price: 1.5,
          deliveryTime: 15,
          image: new URL('@/assets/images/Lontong.jpg', import.meta.url).href,
          rating: 4,
        },
        {
          id: 6,
          title: 'Pecal',
          price: 2.0,
          deliveryTime: 20,
          image: new URL('@/assets/images/Pecel.JPG', import.meta.url).href,
          rating: 3,
        },
        {
          id: 7,
          title: 'Bak Kut Teh',
          price: 2.0,
          deliveryTime: 20,
          image: new URL('@/assets/images/Bak.jpg', import.meta.url).href,
          rating: 3,
        },
        {
          id: 8,
          title: 'Char Kway Teow ',
          price: 1.5,
          deliveryTime: 15,
          image: new URL('@/assets/images/char.jpg', import.meta.url).href,
          rating: 4,
        },
        {
          id: 9,
          title: 'Roti Canai',
          price: 2.0,
          deliveryTime: 20,
          image: new URL('@/assets/images/canai.jpg', import.meta.url).href,
          rating: 3,
        },
        {
          id: 10,
          title: ' Mee Rebus',
          price: 2.5,
          deliveryTime: 25,
          image: new URL('@/assets/images/Mee.jpg', import.meta.url).href,
          rating: 4,
        },
        {
          id: 11,
          title: 'Lor Bak',
          price: 3.0,
          deliveryTime: 30,
          image: new URL('@/assets/images/lor.jpg', import.meta.url).href,
          rating: 5,
        },
        {
          id: 12,
          title: 'Satay',
          price: 1.5,
          deliveryTime: 15,
          image: new URL('@/assets/images/Satay.jpg', import.meta.url).href,
          rating: 4,
        },
  ],
  Vietnam: [
        {
          id: 1,
          title: 'Pho',
          price: 1.5,
          deliveryTime: 15,
          image: new URL('@/assets/images/pho.jpg', import.meta.url).href,
          rating: 4,
        },
        {
          id: 2,
          title: 'Banh Mi',
          price: 2.0,
          deliveryTime: 20,
          image: new URL('@/assets/images/banhmi.jpg', import.meta.url).href,
          rating: 3,
        },
        {
          id: 3,
          title: 'Bun Bo Hue ',
          price: 1.5,
          deliveryTime: 15,
          image: new URL('@/assets/images/bunbohue.jpg', import.meta.url).href,
          rating: 4,
        },
        {
          id: 4,
          title: 'Cao Lau',
          price: 1.5,
          deliveryTime: 15,
          image: new URL('@/assets/images/caolau.jpg', import.meta.url).href,
          rating: 4,
        },
        {
          id: 5,
          title: 'Mi Quang',
          price: 1.5,
          deliveryTime: 15,
          image: new URL('@/assets/images/miquang.jpg', import.meta.url).href,
          rating: 4,
        },
        {
          id: 6,
          title: 'Banh Xeo',
          price: 2.0,
          deliveryTime: 20,
          image: new URL('@/assets/images/banhxeo.jpg', import.meta.url).href,
          rating: 3,
        },
        {
          id: 7,
          title: 'Bak Kut Teh',
          price: 2.0,
          deliveryTime: 20,
          image: new URL('@/assets/images/Bak.jpg', import.meta.url).href,
          rating: 3,
        },
        {
          id: 8,
          title: 'Banh Can',
          price: 1.5,
          deliveryTime: 15,
          image: new URL('@/assets/images/bancan.jpg', import.meta.url).href,
          rating: 4,
        },
        {
          id: 9,
          title: 'Pho',
          price: 1.5,
          deliveryTime: 15,
          image: new URL('@/assets/images/pho.jpg', import.meta.url).href,
          rating: 4,
        },
        {
          id: 10,
          title: 'Mi Quang',
          price: 1.5,
          deliveryTime: 15,
          image: new URL('@/assets/images/miquang.jpg', import.meta.url).href,
          rating: 4,
        },
        {
          id: 11,
          title: 'Banh Mi',
          price: 2.0,
          deliveryTime: 20,
          image: new URL('@/assets/images/banhmi.jpg', import.meta.url).href,
          rating: 3,
        },
        {
          id: 12,
          title: 'Cao Lau',
          price: 1.5,
          deliveryTime: 15,
          image: new URL('@/assets/images/caolau.jpg', import.meta.url).href,
          rating: 4,
        },
  ],
  Korea: [
        {
          id: 1,
          title: 'Korean Bibimbap',
          price: 1.5,
          deliveryTime: 15,
          image: new URL('@/assets/images/bibimbap.jpg', import.meta.url).href,
          rating: 4,
        },
        {
          id: 2,
          title: 'Dongchimi',
          price: 2.0,
          deliveryTime: 20,
          image: new URL('@/assets/images/dongchimi.JPG', import.meta.url).href,
          rating: 3,
        },
        {
          id: 3,
          title: 'Bulgogi',
          price: 1.5,
          deliveryTime: 15,
          image: new URL('@/assets/images/bulgogi.jpg', import.meta.url).href,
          rating: 4,
        },
        {
          id: 4,
          title: 'Mandoo',
          price: 1.5,
          deliveryTime: 15,
          image: new URL('@/assets/images/Mandoo.jpg', import.meta.url).href,
          rating: 4,
        },
        {
          id: 5,
          title: 'Chap Chae',
          price: 1.5,
          deliveryTime: 15,
          image: new URL('@/assets/images/chapchae.jpg', import.meta.url).href,
          rating: 4,
        },
        {
          id: 6,
          title: 'Bossam',
          price: 2.0,
          deliveryTime: 20,
          image: new URL('@/assets/images/bossam.jpg', import.meta.url).href,
          rating: 3,
        },
        {
          id: 7,
          title: 'Kimchi',
          price: 2.0,
          deliveryTime: 20,
          image: new URL('@/assets/images/kimchi.jpg', import.meta.url).href,
          rating: 3,
        },
        {
          id: 8,
          title: 'Galbi Tang',
          price: 1.5,
          deliveryTime: 15,
          image: new URL('@/assets/images/galbitang.jpg', import.meta.url).href,
          rating: 4,
        },
        {
          id: 9,
          title: 'Corn Cheese',
          price: 1.5,
          deliveryTime: 15,
          image: new URL('@/assets/images/corncheese.jpg', import.meta.url).href,
          rating: 4,
        },
        {
          id: 10,
          title: 'Mi Quang',
          price: 1.5,
          deliveryTime: 15,
          image: new URL('@/assets/images/miquang.jpg', import.meta.url).href,
          rating: 4,
        },
        {
          id: 11,
          title: 'Banh Mi',
          price: 2.0,
          deliveryTime: 20,
          image: new URL('@/assets/images/banhmi.jpg', import.meta.url).href,
          rating: 3,
        },
        {
          id: 12,
          title: 'Cao Lau',
          price: 1.5,
          deliveryTime: 15,
          image: new URL('@/assets/images/caolau.jpg', import.meta.url).href,
          rating: 4,
        },
  ],
  China: [
        {
          id: 1,
          title: 'Peking Roasted Duck',
          price: 1.5,
          deliveryTime: 15,
          image: new URL('@/assets/images/Duck.webp', import.meta.url).href,
          rating: 4,
        },
        {
          id: 2,
          title: 'Kung Pao Chicken',
          price: 2.0,
          deliveryTime: 20,
          image: new URL('@/assets/images/Chicken.webp', import.meta.url).href,
          rating: 3,
        },
        {
          id: 3,
          title: 'Sweet and Sour Pork',
          price: 1.5,
          deliveryTime: 15,
          image: new URL('@/assets/images/SourPork.webp', import.meta.url).href,
          rating: 4,
        },
        {
          id: 4,
          title: 'Hot Pot',
          price: 1.5,
          deliveryTime: 15,
          image: new URL('@/assets/images/HotPot.webp', import.meta.url).href,
          rating: 4,
        },
        {
          id: 5,
          title: 'Dim Sum',
          price: 1.5,
          deliveryTime: 15,
          image: new URL('@/assets/images/DimSum.webp', import.meta.url).href,
          rating: 4,
        },
        {
          id: 6,
          title: 'Dumplings',
          price: 2.0,
          deliveryTime: 20,
          image: new URL('@/assets/images/Dumplings.webp', import.meta.url).href,
          rating: 3,
        },
        {
          id: 7,
          title: 'Ma Po Tofu',
          price: 2.0,
          deliveryTime: 20,
          image: new URL('@/assets/images/kimchi.jpg', import.meta.url).href,
          rating: 3,
        },
        {
          id: 8,
          title: 'Char Siu',
          price: 1.5,
          deliveryTime: 15,
          image: new URL('@/assets/images/charsiu.webp', import.meta.url).href,
          rating: 4,
        },
        {
          id: 9,
          title: 'Corn Cheese',
          price: 1.5,
          deliveryTime: 15,
          image: new URL('@/assets/images/corncheese.jpg', import.meta.url).href,
          rating: 4,
        },
        {
          id: 10,
          title: 'Chow Mein',
          price: 1.5,
          deliveryTime: 15,
          image: new URL('@/assets/images/ChowMein.webp', import.meta.url).href,
          rating: 4,
        },
        {
          id: 11,
          title: 'Fried Rice',
          price: 2.0,
          deliveryTime: 20,
          image: new URL('@/assets/images/FriedRice.webp', import.meta.url).href,
          rating: 3,
        },
        {
          id: 12,
          title: 'Sichuan Pork',
          price: 1.5,
          deliveryTime: 15,
          image: new URL('@/assets/images/SichuanPork.webp', import.meta.url).href,
          rating: 4,
        },
  ],
  Japan: [
        {
          id: 1,
          title: 'Sushi',
          price: 1.5,
          deliveryTime: 15,
          image: new URL('@/assets/images/sushi.avif', import.meta.url).href,
          rating: 4,
        },
        {
          id: 2,
          title: 'Udon',
          price: 2.0,
          deliveryTime: 20,
          image: new URL('@/assets/images/udon.avif', import.meta.url).href,
          rating: 3,
        },
        {
          id: 3,
          title: 'Tempura',
          price: 1.5,
          deliveryTime: 15,
          image: new URL('@/assets/images/tempura.avif', import.meta.url).href,
          rating: 4,
        },
        {
          id: 4,
          title: 'Sashimi',
          price: 1.5,
          deliveryTime: 15,
          image: new URL('@/assets/images/sashimi.avif', import.meta.url).href,
          rating: 4,
        },
        {
          id: 5,
          title: 'Ramen',
          price: 1.5,
          deliveryTime: 15,
          image: new URL('@/assets/images/ramen.avif', import.meta.url).href,
          rating: 4,
        },
        {
          id: 6,
          title: 'Tonkatsu',
          price: 2.0,
          deliveryTime: 20,
          image: new URL('@/assets/images/Tonkatsu.avif', import.meta.url).href,
          rating: 3,
        },
        {
          id: 7,
          title: 'MisoSoup',
          price: 2.0,
          deliveryTime: 20,
          image: new URL('@/assets/images/misosoup.avif', import.meta.url).href,
          rating: 3,
        },
        {
          id: 8,
          title: 'Curry Rice',
          price: 1.5,
          deliveryTime: 15,
          image: new URL('@/assets/images/curryrice.avif', import.meta.url).href,
          rating: 4,
        },
        {
          id: 9,
          title: 'Gyoza',
          price: 1.5,
          deliveryTime: 15,
          image: new URL('@/assets/images/Gyoza.avif', import.meta.url).href,
          rating: 4,
        },
        {
          id: 10,
          title: 'Takoyaki',
          price: 1.5,
          deliveryTime: 15,
          image: new URL('@/assets/images/Takoyaki.avif', import.meta.url).href,
          rating: 4,
        },
        {
          id: 11,
          title: 'Bento',
          price: 2.0,
          deliveryTime: 20,
          image: new URL('@/assets/images/bento.jpeg', import.meta.url).href,
          rating: 3,
        },
        {
          id: 12,
          title: 'Oden',
          price: 1.5,
          deliveryTime: 15,
          image: new URL('@/assets/images/Oden.avif', import.meta.url).href,
          rating: 4,
        },
  ],
  Italy: [
        {
          id: 1,
          title: 'Gnocchi',
          price: 1.5,
          deliveryTime: 15,
          image: new URL('@/assets/images/Gnocchi.jpg', import.meta.url).href,
          rating: 4,
        },
        {
          id: 2,
          title: 'Fettuccine',
          price: 2.0,
          deliveryTime: 20,
          image: new URL('@/assets/images/Fettuccine.jpg', import.meta.url).href,
          rating: 3,
        },
        {
          id: 3,
          title: 'Lasagna',
          price: 1.5,
          deliveryTime: 15,
          image: new URL('@/assets/images/Lasagna.jpg', import.meta.url).href,
          rating: 4,
        },
        {
          id: 4,
          title: 'Chicken Alfredo Pasta',
          price: 1.5,
          deliveryTime: 15,
          image: new URL('@/assets/images/Chicken-Alfredo.jpg', import.meta.url).href,
          rating: 4,
        },
        {
          id: 5,
          title: 'Spaghetti',
          price: 1.5,
          deliveryTime: 15,
          image: new URL('@/assets/images/Spaghetti.webp', import.meta.url).href,
          rating: 4,
        },
        {
          id: 6,
          title: 'Spaghetti Carbonara',
          price: 2.0,
          deliveryTime: 20,
          image: new URL('@/assets/images/spaghettiCarbonara.jpg', import.meta.url).href,
          rating: 3,
        },
        {
          id: 7,
          title: 'Spaghetti Bolognese',
          price: 2.0,
          deliveryTime: 20,
          image: new URL('@/assets/images/spaghetti-bolognese.webp', import.meta.url).href,
          rating: 3,
        },
        {
          id: 8,
          title: 'Pizza',
          price: 1.5,
          deliveryTime: 15,
          image: new URL('@/assets/images/pizza.jpg', import.meta.url).href,
          rating: 4,
        },
        {
          id: 9,
          title: 'Gyoza',
          price: 1.5,
          deliveryTime: 15,
          image: new URL('@/assets/images/Gyoza.avif', import.meta.url).href,
          rating: 4,
        },
        {
          id: 10,
          title: 'Takoyaki',
          price: 1.5,
          deliveryTime: 15,
          image: new URL('@/assets/images/Takoyaki.avif', import.meta.url).href,
          rating: 4,
        },
        {
          id: 11,
          title: 'Bento',
          price: 2.0,
          deliveryTime: 20,
          image: new URL('@/assets/images/bento.jpeg', import.meta.url).href,
          rating: 3,
        },
        {
          id: 12,
          title: 'Oden',
          price: 1.5,
          deliveryTime: 15,
          image: new URL('@/assets/images/Oden.avif', import.meta.url).href,
          rating: 4,
        },
  ],
};

function selectCountry(country) {
  if (selectedCountry.value === country) {
    selectedCountry.value = null; // deselect if clicked again
  } else {
    selectedCountry.value = country;
  }
}
</script>

<style scoped>
.food {
  display: flex;
  flex-direction: column;
  width: 100%;
  min-height:auto;
  background-color: white;
}

.app-container {
  display: flex;
  gap: 2rem;
  padding: 1rem;
}

.menu-sidebar {
  width: 25%;
  border: 1px solid #ffffff;
  padding: 20px;
  overflow-y: auto;
  box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
  border-radius: 10px;
}

.menu-sidebar h2 {
  text-align: center;
  background-color:  #5a5244;
  color: white;
  padding: 10px;
  font-family: 'IBM Plex Sans Condensed', sans-serif;
  border-radius: 5px;
}

.menu-group h3 {
  margin-top: 15px;
  font-size: 18px;
  color: #5a5244;
}

.menu-group ul {
  list-style: none;
  padding: 0;
}

.menu-group li {
  margin-bottom: 8px;
}

.menu-group button {
  background: #fff;
  border: 1px solid #ddd;
  padding: 8px 12px;
  cursor: pointer;
  border-radius: 5px;
  width: 100%;
  text-align: left;
  transition: all 0.3s ease;
}

.menu-group button:hover,
.menu-group button.active {
  background-color: #5a5244;
  color: white;
  transform: scale(1.03);
}

.food-display {
  width: 75%;
  height: 50rem; /* fixed height */
  overflow-y: auto;
}
.food-display::-webkit-scrollbar {
  width: 10px;
}

.food-display::-webkit-scrollbar-thumb {
  background-color: #5a5244;
  border-radius: 4px;
}

.food-display::-webkit-scrollbar-track {
  background: #f0f0f0;
}

.country-card {
  margin-bottom: 1.5rem;
  background-color: #fff;
  border: 1px solid #ddd;
  border-radius: 10px;
  text-align: center;
  box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
  padding: 1rem;
  transition: all 0.3s ease;
}

.contain-food {
  display: flex;
  flex-wrap: wrap;
  gap: 1rem;
  justify-content: center;
  padding: 1rem 0;
}

.contain-food > * {
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.contain-food > *:hover {
  transform: scale(1.05);
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

.country-card h3 {
  margin-bottom: 10px;
  font-size: 18px;
  color: #333;
}

/* Fade transition */
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.6s ease, transform 0.6s ease;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
  transform: translateY(10px);
}
</style>
