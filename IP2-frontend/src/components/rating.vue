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
            <i
              v-for="(icon, index) in starVisualArray"
              :key="index"
              :class="icon"
            ></i>
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
    <Review_card v-for="review in reviews" :key="review.id" :review="review" />

    <!-- Comment Submission -->
    <Commentinfo @submit="addReview" />
  </section>
</template>

<script>
import Review_card from './review_card.vue'
import Commentinfo from './comment_info.vue'

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
  computed: {
    averageRating() {
      if (this.reviews.length === 0) return '0.0'
      const total = this.reviews.reduce((sum, r) => sum + r.rating, 0)
      return (total / this.reviews.length).toFixed(1)
    },
    ratingDistribution() {
      const total = this.reviews.length
      const counts = { 5: 0, 4: 0, 3: 0, 2: 0, 1: 0 }
      this.reviews.forEach(r => counts[r.rating]++)
      const percentages = {}
      Object.keys(counts).forEach(star => {
        percentages[star] = total ? (counts[star] / total * 100).toFixed(0) : 0
      })
      return percentages
    },
    starVisualArray() {
      const avg = parseFloat(this.averageRating)
      const stars = []
      for (let i = 1; i <= 5; i++) {
        if (i <= avg) {
          stars.push('fa-solid fa-star')
        } else if (i - avg <= 0.5) {
          stars.push('fa-solid fa-star-half-stroke')
        } else {
          stars.push('fa-regular fa-star')
        }
      }
      return stars
    }
  },
  methods: {
    addReview(newReview) {
      this.reviews.push({ ...newReview, id: this.reviews.length + 1 })
    },
    getBarWidth(star) {
      return this.ratingDistribution[star] || 0
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

/* Rating Overview Box */
.rating-overview {
  display: flex;
  flex-direction: column;
  padding: 20px 20px;
  border-radius: 12px;
  max-width: 1800px;
  margin: 0 auto 40px auto;
}

/* Flex container for average + bars */
.rating-summary {
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 40px;
}

/* Title + Average block */
.commentbar {
  display: flex;
  flex-direction: column;
  justify-content: center;
  min-width: 220px;
  text-align: center;
}

.commentbar h2 {
  font-size: 20px;
  font-weight: 600;
  margin: 0 0 8px;
  color: #333;
}

/* Average rating text */
.rating-score {
  font-size: 64px;
  font-weight: bold;
  color: #2c2c2c;
  margin: 0;
}

/* Dynamic stars */
.star-display {
  display: flex;
  justify-content: center;
  gap: 6px;
  margin-top: 6px;
  font-size: 24px;
  color: #ffb400;
}

.star-display i {
  transition: transform 0.2s ease;
}

.star-display i:hover {
  transform: scale(1.2);
}

/* Bar chart layout */
.rating-bars {
  flex: 1;
  display: flex;
  flex-direction: column;
  gap: 12px;
  min-width: 250px;
}

.rating-row {
  display: flex;
  align-items: center;
  gap: 10px;
}

.rating-bar-bg {
  flex: 1;
  height: 14px;
  background-color: #ddd;
  border-radius: 8px;
  overflow: hidden;
}

.rating-bar-fill {
  height: 100%;
  background-color: #ffb400;
  border-radius: 8px;
  transition: width 0.3s ease;
}

.rating-label {
  font-size: 16px;
  min-width: 36px;
  color: #444;
}
</style>
