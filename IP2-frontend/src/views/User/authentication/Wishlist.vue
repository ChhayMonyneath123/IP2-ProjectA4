<template>
  <div class="wishlist">
    <h2>Your Wishlist</h2>
    
    <div v-if="loading" class="loading">Loading...</div>
    
    <div v-else-if="items.length === 0" class="empty-wishlist">
      <p>Your wishlist is empty</p>
      <router-link to="/products">Browse Products</router-link>
    </div>
    
    <div v-else class="wishlist-items">
      <div v-for="item in items" :key="item.id" class="wishlist-item">
        <img :src="item.image_url" :alt="item.name">
        <div class="item-details">
          <h3>{{ item.name }}</h3>
          <div class="item-price">${{ item.price.toFixed(2) }}</div>
        </div>
        <button @click="removeItem(item.id)" class="remove-btn">
          Remove
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      loading: true,
      items: []
    }
  },
  async created() {
    await this.fetchWishlist();
    this.loading = false;
  },
  methods: {
    async fetchWishlist() {
      try {
        const response = await axios.get('/api/wishlist');
        this.items = response.data;
      } catch (error) {
        console.error('Error fetching wishlist:', error);
      }
    },
    async removeItem(productId) {
      try {
        await axios.delete(`/api/wishlist/${productId}`);
        this.items = this.items.filter(item => item.id !== productId);
      } catch (error) {
        console.error('Error removing item:', error);
      }
    }
  }
}
</script>

<style scoped>
.wishlist {
  max-width: 1200px;
  margin: 0 auto;
  padding: 2rem;
}

.wishlist-items {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
  gap: 1.5rem;
  margin-top: 1rem;
}

.wishlist-item {
  border: 1px solid #e0e0e0;
  border-radius: 8px;
  padding: 1rem;
  display: flex;
  flex-direction: column;
}

.wishlist-item img {
  width: 100%;
  height: 180px;
  object-fit: contain;
  margin-bottom: 1rem;
}

.item-details {
  flex-grow: 1;
  margin-bottom: 1rem;
}

.item-details h3 {
  margin: 0 0 0.5rem;
  font-size: 1rem;
}

.item-price {
  font-weight: bold;
  color: #2c3e50;
  font-size: 1.1rem;
}

.remove-btn {
  background-color: #ff4444;
  color: white;
  border: none;
  padding: 0.5rem;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.2s;
}

.remove-btn:hover {
  background-color: #cc0000;
}

.empty-wishlist {
  text-align: center;
  padding: 2rem;
}

.empty-wishlist a {
  color: #3490dc;
  text-decoration: none;
}

.empty-wishlist a:hover {
  text-decoration: underline;
}

.loading {
  text-align: center;
  padding: 2rem;
}
</style>