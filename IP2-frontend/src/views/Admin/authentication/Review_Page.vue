<template>
  <div class="admin-reviews">
    <h1>Admin Reviews</h1>

    <label>
      Sort By:
      <select v-model="sortKey" @change="sortReviews">
        <option value="time">Time</option>
        <option value="rating">Rating</option>
        <option value="user">User</option>
      </select>
    </label>

    <div v-for="review in sortedReviews" :key="review.id" class="review-card">
      <div class="review-header">
        <img :src="review.user.avatar || defaultAvatar" alt="User avatar" class="avatar" />
        <div>
          <strong>{{ review.user.name }}</strong><br />
          <small>{{ review.user.role }}</small>
        </div>
        <div class="rating">
          <span v-for="n in 5" :key="n" class="star" :class="{ filled: n <= review.rating }">&#9733;</span>
        </div>
        <div class="date">{{ formatDate(review.created_at) }}</div>
      </div>

      <p class="review-message">{{ review.message }}</p>

      <div class="buttons">
        <button @click="toggleReply(review)">Reply</button>
        <button @click="enableEdit(review)">Edit</button>
        <button @click="deleteReview(review.id)">Delete</button>
      </div>

      <div v-if="editingReview && editingReview.id === review.id">
        <textarea v-model="editingReview.message"></textarea>
        <button @click="saveEdit">Save</button>
        <button @click="cancelEdit">Cancel</button>
      </div>

      <div v-if="review.showReply">
        <textarea v-model="review.reply"></textarea>
        <button @click="sendReply(review)">Send Reply</button>
        <button @click="toggleReply(review)">Cancel</button>
      </div>

      <hr />
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      reviews: [],
      sortKey: 'time',
      editingReview: null,
      defaultAvatar: 'https://via.placeholder.com/50',
    }
  },
  computed: {
    sortedReviews() {
      if (this.sortKey === 'time') {
        return [...this.reviews].sort((a, b) => new Date(b.created_at) - new Date(a.created_at))
      } else if (this.sortKey === 'rating') {
        return [...this.reviews].sort((a, b) => b.rating - a.rating)
      } else if (this.sortKey === 'user') {
        return [...this.reviews].sort((a, b) => a.user.name.localeCompare(b.user.name))
      }
      return this.reviews
    }
  },
  methods: {
    async fetchReviews() {
      try {
        const res = await axios.get('/reviews')
        // add reply and showReply fields for UI toggles
        this.reviews = res.data.map(r => ({ ...r, reply: '', showReply: false }))
      } catch (err) {
        console.error('Failed to load reviews', err)
      }
    },
    formatDate(date) {
      return new Date(date).toLocaleDateString()
    },
    toggleReply(review) {
      review.showReply = !review.showReply
      if (!review.showReply) review.reply = ''
    },
    enableEdit(review) {
      this.editingReview = { ...review }
    },
    cancelEdit() {
      this.editingReview = null
    },
    async saveEdit() {
      try {
        await axios.put(`/reviews/${this.editingReview.id}`, { message: this.editingReview.message })
        // update local data
        const idx = this.reviews.findIndex(r => r.id === this.editingReview.id)
        if (idx !== -1) this.reviews[idx].message = this.editingReview.message
        this.editingReview = null
      } catch (err) {
        console.error('Failed to save edit', err)
      }
    },
    async deleteReview(id) {
      if (!confirm('Are you sure to delete this review?')) return
      try {
        await axios.delete(`/reviews/${id}`)
        this.reviews = this.reviews.filter(r => r.id !== id)
      } catch (err) {
        console.error('Failed to delete review', err)
      }
    },
    async sendReply(review) {
      try {
        await axios.post(`/reviews/${review.id}/reply`, { reply: review.reply })
        alert('Reply sent!')
        review.showReply = false
        review.reply = ''
      } catch (err) {
        console.error('Failed to send reply', err)
      }
    }
  },
  mounted() {
    this.fetchReviews()
  }
}
</script>

<style scoped>
.admin-reviews {
  max-width: 900px;
  margin: auto;
  padding: 20px;
}
.review-card {
  background: white;
  border-radius: 5px;
  padding: 15px;
  margin-bottom: 20px;
  box-shadow: 0 0 6px #ccc;
}
.review-header {
  display: flex;
  align-items: center;
  gap: 15px;
  margin-bottom: 10px;
}
.avatar {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  object-fit: cover;
}
.rating {
  margin-left: auto;
  color: gold;
  font-size: 18px;
}
.star {
  color: #ccc;
}
.star.filled {
  color: gold;
}
.date {
  margin-left: 20px;
  color: #666;
  font-size: 0.9em;
}
.review-message {
  font-size: 1em;
  margin-bottom: 15px;
}
.buttons button {
  margin-right: 10px;
}
textarea {
  width: 100%;
  min-height: 60px;
  margin-bottom: 10px;
}
</style>
