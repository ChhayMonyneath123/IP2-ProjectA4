<template>
  <div>
    <Nav_Bar/>

    <div class="container">
      <Breadcrumb />
        <!-- Title & Image -->
      <p>Pasta</p>
      <div class="wrapper">
      <h1>
        Chef’s spaghetti with cauliflower and carrots
      </h1>
      <img
        src="@/assets/images/spagetti.png"
        alt="Spaghetti with cauliflower and carrots"
      />

      <FoodInfo />
      <Rating />
      </div>
      

      <!-- Reviews -->
      <div class="mb-10">
        <CardReview
      name="Jochido Nitacha"
      date="March 1, 2025"
      :rating="5"
      :avatar="'profile.png'"
      message="The foods are very delicious and well-cook. The delivery is accurate and fast."
    />
    <CardReview
      name="Jochido Nitacha"
      date="March 1, 2025"
      :rating="5"
      :avatar="'profile.png'"
      message="The foods are very delicious and well-cook. The delivery is accurate and fast."
    />

      </div>

      <!-- Comment Form -->
      <div class="mb-10">
        <h3 class="text-xl font-semibold mb-2">Leave a Comment</h3>
        <p class="text-sm text-gray-600 mb-4">Please feel free to give us a feedback!</p>
        <div class="flex items-center gap-4 mb-4">
          <img class="w-10 h-10 rounded-full" src="@/assets/logo/profile.png" alt="Ella Mondre" />
          <div>
            <p class="font-semibold">Ella Mondre</p>
            <p class="text-xs text-gray-500">March 14, 2025 · Your Rating: ☆☆☆☆☆</p>
          </div>
        </div>
        <textarea
          class="w-full border rounded-md p-4 h-32 resize-none placeholder-gray-400"
          placeholder="Your Message"
        ></textarea>
        <button class="mt-4 px-6 py-2 bg-[#4b3b36] text-white rounded-md hover:bg-[#3a2e29]">
          Submit Comment
        </button>
      </div>
    </div>

    <Footer_Section/>
  </div>
</template>

<script>
import Nav_Bar from '@/vueCode/components/nav_bar.vue';
import Breadcrumb from '@/vueCode/components/breadcrumb.vue';
import FoodInfo from '@/vueCode/components/food-info.vue';
import Rating from '@/vueCode/components/rating.vue';
import Footer_Section from '@/vueCode/components/footer_section.vue';
import CardReview from '@/vueCode/components/review_card.vue'
export default {
  name: 'FoodDetailPage',
  components: {
    Nav_Bar,
    Breadcrumb,
    FoodInfo,
    Rating,
    Footer_Section,
    CardReview,
  },
};
</script>

<style scoped>
.container{
  padding: 2rem;
  max-width: 100%;
  background-color: aqua;

}
.container p{
  margin-left: 2rem;
  font-family: 'Kaushan Script', cursive;
}
.wrapper{
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
}

.wrapper h1{
  font-family: 'IBM Plex Sans Condensed'; 
  font-size: 54px; 
  font-weight: 700;
  display: flex;
  justify-content: center;
  text-align: wrap;
  padding-bottom: 1.5rem;
}
.wrapper img{
  width: 70%;
  height: 70%;
  display: flex;
  align-items: center;
}
</style>
