<template>
  <div class="admin-reviews-container">
    <div class="header">
      <h1>Admin Reviews</h1>
      <p class="subtitle">Manage customer reviews and responses</p>
    </div>

    <div class="controls">
      <div class="sort-control">
        <label for="sort">Sort By:</label>
        <select id="sort" v-model="sortBy" @change="fetchReviews">
          <option value="created_at">Time</option>
          <option value="rating">Rating</option>
          <option value="user.name">User</option>
        </select>
        
        <select v-model="sortOrder" @change="fetchReviews">
          <option value="desc">Descending</option>
          <option value="asc">Ascending</option>
        </select>
      </div>
    </div>

    <div v-if="loading" class="loading-state">
      <div class="spinner"></div>
      <p>Loading reviews...</p>
    </div>

    <div v-else-if="error" class="error-state">
      <i class="fas fa-exclamation-circle"></i>
      <p>Failed to load reviews. Please try again.</p>
      <button @click="fetchReviews" class="btn-retry">Retry</button>
    </div>

    <div v-else>
      <div v-if="reviews.data.length === 0" class="empty-state">
        <i class="fas fa-comment-slash"></i>
        <p>No reviews found</p>
      </div>

      <div v-else class="reviews-list">
        <div v-for="review in reviews.data" :key="review.id" class="review-card">
          <div class="review-header">
            <div class="user-info">
              <!-- <img 
                :src="review.user.avatar || defaultAvatar" 
                :alt="review.user.name"
                class="user-avatar"
              > -->
              <div class="user-details">
                <h3 class="user-name">{{ review.user.name }}</h3>
                <p class="user-role">{{ review.user.role }}</p>
              </div>
            </div>
            
            <div class="review-meta">
              <div class="rating">
                <span 
                  v-for="n in 5" 
                  :key="n" 
                  class="star" 
                  :class="{ filled: n <= review.rating }"
                >★</span>
              </div>
              <div class="date">{{ formatDate(review.created_at) }}</div>
            </div>
          </div>

          <div class="review-content">
            <p>{{ review.message }}</p>
          </div>

          <div v-if="review.reply" class="review-reply">
            <div class="reply-header">
              <strong>Your Reply:</strong>
              <small>{{ formatDate(review.updated_at) }}</small>
            </div>
            <p>{{ review.reply }}</p>
          </div>

          <div class="review-actions">
            <button 
              v-if="!review.showReply" 
              @click="toggleReply(review)"
              class="btn-reply"
            >
              <i class="fas fa-reply"></i> {{ review.reply ? 'Edit Reply' : 'Reply' }}
            </button>
            
            <button 
              @click="startEditing(review)"
              class="btn-edit"
            >
              <i class="fas fa-edit"></i> Edit
            </button>
            
            <button 
              @click="confirmDelete(review.id)"
              class="btn-delete"
            >
              <i class="fas fa-trash"></i> Delete
            </button>
          </div>

          <div v-if="review.showReply" class="reply-editor">
            <textarea 
              v-model="review.replyText" 
              placeholder="Write your reply..."
              rows="3"
            ></textarea>
            <div class="editor-actions">
              <button 
                @click="submitReply(review)"
                :disabled="!review.replyText.trim()"
                class="btn-save"
              >
                <i class="fas fa-check"></i> Send
              </button>
              <button @click="toggleReply(review)" class="btn-cancel">
                <i class="fas fa-times"></i> Cancel
              </button>
            </div>
          </div>

          <div v-if="review.editing" class="edit-editor">
            <textarea 
              v-model="review.editedMessage" 
              rows="3"
            ></textarea>
            <div class="editor-actions">
              <button 
                @click="saveEdit(review)"
                :disabled="!review.editedMessage.trim() || review.editedMessage === review.message"
                class="btn-save"
              >
                <i class="fas fa-check"></i> Save
              </button>
              <button @click="cancelEdit(review)" class="btn-cancel">
                <i class="fas fa-times"></i> Cancel
              </button>
            </div>
          </div>
        </div>

        <div class="pagination" v-if="reviews.meta && reviews.meta.last_page > 1">
          <button 
            v-for="page in reviews.meta.last_page" 
            :key="page"
            @click="changePage(page)"
            :class="{ active: page === reviews.meta.current_page }"
          >
            {{ page }}
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

export default {
  data() {
    return {
      reviews: {
        data: [],
        meta: {
          last_page: 1,
    current_page: 1,
        }
      },
      loading: true,
      error: false,
      sortBy: 'created_at',
      sortOrder: 'desc',
      defaultAvatar: 'https://ui-avatars.com/api/?background=random&name=User',
    };
  },
  created() {
    this.fetchReviews();
  },
  methods: {
    async fetchReviews(page = 1) {
      this.loading = true;
      this.error = false;
      
      try {
        const response = await axios.get('http://localhost:8000/api/reviews', {
          params: {
            sort_by: this.sortBy,
            order: this.sortOrder,
            page: page
          }
        });
        
        this.reviews = {
          data: response.data.data.map(review => ({
            ...review,
            showReply: false,
            replyText: review.reply || '',
            editing: false,
            editedMessage: review.message
          })),
          meta: response.data.meta
        };
      } catch (error) {
        console.error('Error fetching reviews:', error);
        this.error = true;
        toast.error('Failed to load reviews');
      } finally {
        this.loading = false;
      }
    },
    formatDate(dateString) {
      const options = { year: 'numeric', month: 'short', day: 'numeric' };
      return new Date(dateString).toLocaleDateString(undefined, options);
    },
    toggleReply(review) {
      review.showReply = !review.showReply;
      if (!review.showReply) {
        review.replyText = review.reply || '';
      }
    },
    startEditing(review) {
      review.editing = true;
      review.editedMessage = review.message;
    },
    cancelEdit(review) {
      review.editing = false;
    },
    async saveEdit(review) {
      try {
        await axios.put(`http://localhost:8000/api/reviews/${review.id}`, {
          message: review.editedMessage
        });
        
        review.message = review.editedMessage;
        review.editing = false;
        toast.success('Review updated successfully');
      } catch (error) {
        console.error('Error updating review:', error);
        toast.error('Failed to update review');
      }
    },
    confirmDelete(reviewId) {
      if (confirm('Are you sure you want to delete this review?')) {
        this.deleteReview(reviewId);
      }
    },
    async deleteReview(reviewId) {
      try {
        await axios.delete(`http://localhost:8000/api/reviews/${reviewId}`);
        this.reviews.data = this.reviews.data.filter(r => r.id !== reviewId);
        toast.success('Review deleted successfully');
      } catch (error) {
        console.error('Error deleting review:', error);
        toast.error('Failed to delete review');
      }
    },
    async submitReply(review) {
      try {
        await axios.post(`http://localhost:8000/api/reviews/${review.id}/reply`, {
          reply: review.replyText
        });
        
        review.reply = review.replyText;
        review.showReply = false;
        toast.success('Reply sent successfully');
      } catch (error) {
        console.error('Error sending reply:', error);
        toast.error('Failed to send reply');
      }
    },
    changePage(page) {
      this.fetchReviews(page);
    }
  }
};
</script>

<style scoped>
.admin-reviews-container {
  max-width: 900px;
  margin: 0 auto;
  padding: 20px;
}

.header {
  margin-bottom: 30px;
  text-align: center;
}

.header h1 {
  font-size: 2rem;
  color: #333;
  margin-bottom: 5px;
}

.subtitle {
  color: #666;
  font-size: 1rem;
}

.controls {
  margin-bottom: 20px;
  display: flex;
  justify-content: flex-end;
}

.sort-control {
  display: flex;
  align-items: center;
  gap: 10px;
}

.sort-control label {
  font-weight: 500;
}

.sort-control select {
  padding: 8px 12px;
  border: 1px solid #ddd;
  border-radius: 4px;
  background-color: white;
}

.loading-state, .error-state, .empty-state {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 40px;
  text-align: center;
}

.loading-state .spinner {
  width: 40px;
  height: 40px;
  border: 4px solid #f3f3f3;
  border-top: 4px solid #3498db;
  border-radius: 50%;
  animation: spin 1s linear infinite;
  margin-bottom: 15px;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

.error-state i {
  font-size: 2rem;
  color: #e74c3c;
  margin-bottom: 15px;
}

.btn-retry {
  padding: 8px 16px;
  background-color: #3498db;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  margin-top: 15px;
}

.empty-state i {
  font-size: 2rem;
  color: #95a5a6;
  margin-bottom: 15px;
}

.reviews-list {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.review-card {
  background-color: white;
  border-radius: 8px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  padding: 20px;
}

.review-header {
  display: flex;
  justify-content: space-between;
  margin-bottom: 15px;
  flex-wrap: wrap;
  gap: 15px;
}

.user-info {
  display: flex;
  align-items: center;
  gap: 12px;
}

.user-avatar {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  object-fit: cover;
}

.user-name {
  font-size: 1.1rem;
  margin: 0;
  color: #333;
}

.user-role {
  margin: 0;
  font-size: 0.8rem;
  color: #666;
}

.review-meta {
  display: flex;
  flex-direction: column;
  align-items: flex-end;
  gap: 5px;
}

.rating {
  display: flex;
  gap: 2px;
}

.star {
  color: #ddd;
  font-size: 1.1rem;
}

.star.filled {
  color: #f1c40f;
}

.date {
  font-size: 0.8rem;
  color: #666;
}

.review-content {
  margin-bottom: 15px;
  line-height: 1.5;
  color: #333;
}

.review-reply {
  background-color: #f8f9fa;
  border-left: 3px solid #3498db;
  padding: 12px;
  margin-bottom: 15px;
  border-radius: 0 4px 4px 0;
}

.reply-header {
  display: flex;
  justify-content: space-between;
  margin-bottom: 8px;
  font-size: 0.9rem;
}

.reply-header strong {
  color: #2c3e50;
}

.reply-header small {
  color: #7f8c8d;
}

.review-actions {
  display: flex;
  gap: 10px;
  margin-top: 15px;
}

.review-actions button {
  padding: 8px 12px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  display: flex;
  align-items: center;
  gap: 5px;
  font-size: 0.9rem;
}

.btn-reply {
  background-color: #3498db;
  color: white;
}

.btn-edit {
  background-color: #2ecc71;
  color: white;
}

.btn-delete {
  background-color: #e74c3c;
  color: white;
}

.reply-editor, .edit-editor {
  margin-top: 15px;
}

.reply-editor textarea, .edit-editor textarea {
  width: 100%;
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 4px;
  resize: vertical;
  margin-bottom: 10px;
}

.editor-actions {
  display: flex;
  gap: 10px;
  justify-content: flex-end;
}

.editor-actions button {
  padding: 8px 16px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  display: flex;
  align-items: center;
  gap: 5px;
}

.btn-save {
  background-color: #2ecc71;
  color: white;
}

.btn-save:disabled {
  background-color: #bdc3c7;
  cursor: not-allowed;
}

.btn-cancel {
  background-color: #95a5a6;
  color: white;
}

.pagination {
  display: flex;
  justify-content: center;
  gap: 5px;
  margin-top: 30px;
}

.pagination button {
  padding: 8px 12px;
  border: 1px solid #ddd;
  background-color: white;
  cursor: pointer;
  border-radius: 4px;
}

.pagination button.active {
  background-color: #3498db;
  color: white;
  border-color: #3498db;
}

@media (max-width: 768px) {
  .review-header {
    flex-direction: column;
  }
  
  .review-meta {
    align-items: flex-start;
  }
  
  .review-actions {
    flex-wrap: wrap;
  }
}
</style>