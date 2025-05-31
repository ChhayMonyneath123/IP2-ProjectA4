<template>
  <section class="review-section">
    <div class="container">
      <div class="wrapper">
        <h3>Rating Overview:</h3>
        <p class="average">4.1 ⭐</p>
      </div>
      <div class="image">
        <img src="@/assets/images/rating_overall.png">
      </div>
      


    </div>


    <Review_card v-for="review in reviews" :key="review.id" :review="review" />

    <Commentinfo @submit="addReview" />
  </section>
</template>

<script>
import Review_card from './review_card.vue';
import Commentinfo from './comment_info.vue';

export default {
  components: { Review_card, Commentinfo },
  data() {
    return {
      reviews: [
        {
          id: 1,
          name: 'Jochido Nitacha',
          date: 'March 1, 2025',
          rating: 5,
          comment: 'The foods are very delicious and well-cook. The delivery is accurate and fast.',
          avatar: 'https://randomuser.me/api/portraits/women/40.jpg'
        }
      ]
    }
  },
  methods: {
    addReview(newReview) {
      this.reviews.push({ ...newReview, id: this.reviews.length + 1 });
    }
  }
}
</script>

<style scoped>

.review-section {
  max-width: 85%;
  margin: 0 auto;
  padding: 20px;
  

}

.container {
  display: flex;
  flex-direction: row;
  font-family: 'Instrument Sans', sans-serif;
  gap: 20px;

  
}
.image{
  width: 70%;
  display: flex;
  justify-content: center;
  align-items: center;


}
.image img{
    width: 70%;
    height: 80%;
}
.wrapper {
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
}

.average {
  font-size: 36px;
  font-weight: bold;
}
</style>
