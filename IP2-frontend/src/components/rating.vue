<template>
  <section class="review-section">
    <!-- Rating Overview Section -->
    <div class="rating-overview">
      <div class="rating-summary">
        <!-- Left: Title, Average, Stars -->
        <div class="commentbar">
          <h2>Rating Overview</h2>
          <p class="rating-score">{{ averageRating }}</p>
          <div class="star-display">
            <i v-for="(icon, index) in starVisualArray" :key="index" :class="icon"></i>
          </div>
        </div>

        <!-- Right: Rating Bar Chart -->
        <div class="rating-bars">
          <div class="rating-row" v-for="rate in [5, 4, 3, 2, 1]" :key="rate">
            <div class="rating-bar-bg">
              <div class="rating-bar-fill" :style="{ width: getBarWidth(rate) + '%' }"></div>
            </div>
            <div class="rating-label">{{ rate }} ⭐</div>
          </div>
        </div>
      </div>
    </div>

    <!-- Individual Reviews -->
    <div class="review-list">
      <!-- Show message when reviews are loading -->
      <div v-if="loading">
        <p>Loading reviews...</p>
      </div>

      <!-- Show message when there are no reviews -->
      <div v-if="reviews.length === 0 && !loading">
        <p>No reviews yet. Be the first to leave a review!</p>
      </div>

      <!-- Display reviews -->
      <Review_card v-for="review in reviews" :key="review.id" :review="review"/>

    </div>

    <!-- Comment Submission -->
    <div class="comment-form-container">
      <Commentinfo :productId="product.product_id" @submit="addReview" />
    </div>
  </section>
</template>


<script>
import axios from 'axios';
import Review_card from './review_card.vue';
import Commentinfo from './comment_info.vue';

export default {
  name: 'RatingSection',
  components: { Review_card, Commentinfo },
  props: {
    product: { type: Object, required: true },
  },
  data() {
    return {
      reviews: [],
      loading: true,
      error: null,
    };
  },
  computed: {
    averageRating() {
      if (this.reviews.length === 0) return '0.0';
      const total = this.reviews.reduce((sum, r) => sum + r.rating, 0);
      return (total / this.reviews.length).toFixed(1);
    },
    ratingDistribution() {
      const total = this.reviews.length;
      const counts = { 5: 0, 4: 0, 3: 0, 2: 0, 1: 0 };
      this.reviews.forEach((r) => counts[r.rating]++);
      const percentages = {};
      Object.keys(counts).forEach((star) => {
        percentages[star] = total ? ((counts[star] / total) * 100).toFixed(0) : 0;
      });
      return percentages;
    },
    starVisualArray() {
      const avg = parseFloat(this.averageRating);
      const stars = [];
      for (let i = 1; i <= 5; i++) {
        if (i <= avg) {
          stars.push('fa-solid fa-star');
        } else if (i - avg <= 0.5) {
          stars.push('fa-solid fa-star-half-stroke');
        } else {
          stars.push('fa-regular fa-star');
        }
      }
      return stars;
    },
  },
  methods: {
    addReview(newReview) {
      axios
        .post(`http://localhost:8000/api/products/${this.product.product_id}/ratings`, newReview) // Corrected endpoint
        .then((response) => {
          this.reviews.unshift({ ...newReview, id: response.data.data.id }); // Add new review to the list
        })
        .catch((error) => {
          console.error('Error submitting review:', error.response || error);
          this.error = 'Failed to submit your review. Please check the backend and API route configuration.';
        });
    },
    getBarWidth(star) {
      return this.ratingDistribution[star] || 0;
    },
    fetchReviews() {
      axios
        .get(`http://localhost:8000/api/products/${this.product.product_id}/ratings`) // Corrected endpoint
        .then((res) => {
          this.reviews = res.data.data; // Assuming the response contains reviews in `data` field
        })
        .catch((err) => {
          console.error('Failed to fetch reviews', err);
          this.error = 'Failed to load reviews.';
        })
        .finally(() => {
          this.loading = false;
        });
    },
  },

  mounted() {
    this.fetchReviews(); // Fetch reviews when the component is mounted
  },
};
</script>

<style scoped>
.review-section {
  max-width: 85%;
  margin: 0 auto;
  padding: 16px;
}

/* Rating Overview */
.rating-overview {
  display: flex;
  flex-direction: column;
  padding: 16px;
  border-radius: 10px;
  max-width: 1600px;
  margin: 0 auto 32px auto;
}

/* Flex container */
.rating-summary {
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 32px;
}

/* Title + Average block */
.commentbar {
  display: flex;
  flex-direction: column;
  justify-content: center;
  min-width: 180px;
  text-align: center;
}

.commentbar h2 {
  font-size: 18px;
  font-weight: 600;
  margin-bottom: 6px;
  color: #333;
}

.rating-score {
  font-size: 52px;
  font-weight: bold;
  color: #2c2c2c;
  margin: 0;
}

.star-display {
  display: flex;
  justify-content: center;
  gap: 5px;
  margin-top: 4px;
  font-size: 20px;
  color: #ffb400;
}

.star-display i {
  transition: transform 0.2s ease;
}

.star-display i:hover {
  transform: scale(1.1);
}

/* Rating Bar Section */
.rating-bars {
  flex: 1;
  display: flex;
  flex-direction: column;
  gap: 10px;
  min-width: 220px;
}

.rating-row {
  display: flex;
  align-items: center;
  gap: 8px;
}

.rating-bar-bg {
  flex: 1;
  height: 12px;
  background-color: #ddd;
  border-radius: 6px;
  overflow: hidden;
}

.rating-bar-fill {
  height: 100%;
  background-color: #ffb400;
  border-radius: 6px;
  transition: width 0.3s ease;
}

.rating-label {
  font-size: 14px;
  min-width: 32px;
  color: #444;
}

/* Review Cards */
.review-list {
  margin: 24px 0;
  display: flex;
  flex-direction: column;
  gap: 14px;
}

/* Comment Submission Box */
.comment-form-container {
  margin-top: 20px;
  padding: 1%;
}
</style>
