<template>
  <section class="review-section">
    <h3>Rating Overview:</h3>
    <p class="average">4.1 ⭐</p>
    <!-- optional: rating bars here -->

    <Review_card
      v-for="review in reviews"
      :key="review.id"
      :review="review"
    />

    <Commentinfo @submit="addReview" />
  </section>
</template>

<script>
import Review_card from './review_card.vue';
import Commentinfo from './commentinfo.vue';

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
  max-width: 100%;
  margin: 0 auto;
  padding: 20px;
}
.average {
  font-size: 24px;
  font-weight: bold;
  margin-bottom: 20px;
}
</style>
