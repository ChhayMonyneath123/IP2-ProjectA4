<template>
  <div class="comment-form">
    <h3>Leave a Comment</h3>
    <p class="subheading">Please feel free to give us your feedback!</p>

    <!-- Rating section -->
    <div class="rating-section">
      <p>Your Rating:</p>
      <div class="stars">
        <i v-for="n in 5" :key="n" class="fas fa-star"
           :class="{ selected: n <= form.rating }"
           @click="form.rating = n"
           @mouseover="hoverRating(n)"
           @mouseleave="hoverRating(0)">
        </i>
      </div>
    </div>

    <!-- Review comment -->
    <textarea v-model="form.comment" placeholder="Your Message" rows="3"></textarea>

    <!-- Submit button with loading state -->
    <button :disabled="loading" @click.prevent="submit">
      <span v-if="loading" class="spinner"></span>
      {{ loading ? 'Submitting...' : 'Submit Comment' }}
    </button>

    <!-- Success or error message -->
    <p v-if="submitStatus" :class="{'success-message': submitStatus === 'success', 'error-message': submitStatus === 'error'}">
      {{ submitMessage }}
    </p>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  props: {
    productId: { type: Number, required: true }
  },
  data() {
    return {
      form: {
        rating: 0,
        comment: ''
      },
      loading: false,
      submitStatus: null,  // Track submission status
      submitMessage: '',    // Track the success/error message
      hoveredRating: 0,     // Track the hovered rating for hover effects
    };
  },
  methods: {
    submit() {
      // Check if all fields are completed
      if (this.form.rating && this.form.comment) {
        const newReview = {
          product_id: this.productId, // Use the correct prop to pass productId
          rating: this.form.rating,
          comment: this.form.comment,
        };

        this.loading = true;  // Set loading state to true
        // Ensure the URL corresponds to the backend route
        axios.post(`http://localhost:8000/api/products/${this.productId}/ratings`, newReview)
          .then((response) => {
            this.submitStatus = 'success';
            this.submitMessage = 'Review submitted successfully!';
            this.$emit('submit', newReview);  // Emit the review data to parent
            this.form.rating = 0;  // Reset the form
            this.form.comment = '';
          })
          .catch((error) => {
            console.error('Error submitting review:', error);
            this.submitStatus = 'error';
            this.submitMessage = 'Failed to submit your review. Please try again.';
          })
          .finally(() => {
            this.loading = false;  // Set loading state to false after request is complete
          });
      } else {
        this.submitStatus = 'error';
        this.submitMessage = 'Please complete all fields before submitting.';
      }
    },

    // Method to track hover on rating stars
    hoverRating(rating) {
      this.hoveredRating = rating;
    },
  }
}
</script>

<style scoped>
.comment-form {
  display: flex;
  flex-direction: column;
  gap: 5px; /* Reduced gap between elements */
  padding: 15px; /* Reduced padding */
  background-color: #ffffff;
  border-radius: 12px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  width: 100%;
}

h3 {
  font-size: 22px; /* Reduced font size */
  color: #333;
  margin-bottom: 5px; /* Reduced margin */
}

.subheading {
  font-size: 13px; /* Reduced font size */
  color: #777;
  margin-bottom: 10px; /* Reduced margin */
}

.rating-section {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.stars {
  display: flex;
  gap: 5px; /* Reduced gap between stars */
  font-size: 28px; /* Slightly reduced font size for stars */
  color: #ccc;
  cursor: pointer;
}

.stars .selected {
  color: #f7b400;
}

.stars i:hover {
  transform: scale(1.2);
  transition: transform 0.2s ease;
}

textarea {
  padding: 10px; /* Reduced padding */
  font-size: 14px; /* Reduced font size */
  border: 1px solid #ddd;
  border-radius: 6px;
  resize: none;
  font-family: 'Arial', sans-serif;
  transition: border-color 0.3s;
}

textarea:focus {
  border-color: #007BFF;
}

button {
  background-color: #564c3b;
  color: white;
  padding: 12px;
  border-radius: 8px;
  font-size: 16px;
  cursor: pointer;
  border: none;
  transition: background-color 0.3s, transform 0.2s;
}

button:disabled {
  background-color: #cccccc;
}

button:hover {
  background-color: #2e281f;
  transform: translateY(-2px);
}

button .spinner {
  border: 2px solid #fff;
  border-top: 2px solid transparent;
  border-radius: 50%;
  width: 20px;
  height: 20px;
  animation: spin 1s linear infinite;
  margin-right: 10px;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

.success-message {
  color: #4CAF50;
  font-size: 16px;
}

.error-message {
  color: #f44336;
  font-size: 16px;
}
</style>
