<template>
    <div class="wishlist-page">
        <Nav_bar />
        <Breadcrumb />
        <h1>My Wishlist</h1>
        

        
        <div v-if="wishlistStore.loading" class="loading">
            <div class="spinner"></div>
            <p>Loading wishlist items...</p>
        </div>
        
        <div v-else-if="wishlistStore.wishlistItems.length === 0" class="empty-wishlist">
            <div class="empty-icon">
                <i class="fa-solid fa-heart"></i>
            </div>
            <h2>Your wishlist is empty</h2>
            <p>Save items you love to view them here.</p>
            <button @click="testFetchWishlist" class="refresh-btn">🔄 Refresh Wishlist</button>
            <router-link to="/menu" class="continue-shopping">
                <i class="fa-solid fa-arrow-left"></i>
                Continue Shopping
            </router-link>
        </div>
        
        <div v-else class="wishlist-content">
            <div class="wishlist-items">
                <div 
                    v-for="item in wishlistStore.wishlistItems" 
                    :key="item.wishlist_id"
                    class="wishlist-item"
                >
                    <div class="item-image">
                        <img :src="getImageUrl(item.product_image)" :alt="item.product_name">
                    </div>
                    
                    <div class="item-details">
                        <h3 class="item-name">{{ item.product_name }}</h3>
                        <p class="item-description">{{ item.product_description }}</p>
                        <div class="item-meta">
                            <span class="category" v-if="item.category_name">{{ item.category_name }}</span>
                            <span class="price">${{ item.product_price }}</span>
                        </div>
                    </div>
                    
                    <div class="item-actions">
                        <button 
                            @click="addToCart(item.product_id)" 
                            class="add-to-cart-btn"
                            :disabled="cartStore.loading"
                        >
                            <i class="fa-solid fa-cart-plus"></i>
                            Add to Cart
                        </button>
                        
                        <button 
                            @click="removeFromWishlist(item.wishlist_id)" 
                            class="remove-btn"
                            title="Remove from wishlist"
                        >
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <Footer_bar />
</template>

<script>
import { useWishlistStore } from "@/stores/wishlist";
import { useCartStore } from "@/stores/cart";
import { onMounted } from 'vue';
import Nav_bar from "./nav_bar.vue";
import Footer_bar from './footer_bar.vue';
import Breadcrumb from './breadcrumb.vue';

export default {
    name: "Wishlist",
    components: {
    Footer_bar,
    Nav_bar,
    Breadcrumb
  },
    setup() {
        const wishlistStore = useWishlistStore();
        const cartStore = useCartStore();

        onMounted(() => {
            console.log('Wishlist page mounted - loading wishlist items...');
            wishlistStore.fetchWishlistItems();
        });

        const testFetchWishlist = () => {
            console.log('Manual wishlist refresh triggered');
            wishlistStore.fetchWishlistItems();
        };

        const addToCart = async (productId) => {
            try {
                await cartStore.addToCart(productId, 1);
                console.log('Item added to cart from wishlist!');
            } catch (error) {
                console.error('Failed to add item to cart:', error);
            }
        };

        const removeFromWishlist = async (wishlistId) => {
            if (confirm('Are you sure you want to remove this item from your wishlist?')) {
                await wishlistStore.removeFromWishlist(wishlistId);
            }
        };

        const getImageUrl = (imagePath) => {
            if (!imagePath) return require('@/assets/default-product.png');
            if (imagePath.startsWith('http')) return imagePath;
            return `http://127.0.0.1:8000/storage/${imagePath}`;
        };

        return {
            wishlistStore,
            cartStore,
            testFetchWishlist,
            addToCart,
            removeFromWishlist,
            getImageUrl
        };
    }
};
</script>

<style scoped>
.wishlist-page {
    width: 100vw;
    min-height: 75vh;
    padding: 20px;
    margin: 0;
    box-sizing: border-box;
    font-family: 'Instrument Sans', sans-serif;
}

.wishlist-page h1 {
    color: #31261b;
    margin-bottom: 30px;
    font-size: 2.5em;
    text-align: center;
}

.loading {
    text-align: center;
    padding: 60px 20px;
    color: #666;
}

.spinner {
    border: 4px solid #f3f3f3;
    border-top: 4px solid #31261b;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    animation: spin 1s linear infinite;
    margin: 0 auto 20px;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.empty-wishlist {
    text-align: center;
    padding: 80px 20px;
    color: #666;
}

.empty-icon i {
    font-size: 4em;
    color: #ddd;
    margin-bottom: 20px;
}

.empty-wishlist h2 {
    color: #31261b;
    margin-bottom: 10px;
}

.refresh-btn {
    background: #31261b;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 20px;
    cursor: pointer;
    margin: 10px;
    transition: background-color 0.3s;
}

.refresh-btn:hover {
    background: #4a1f17;
}

.continue-shopping {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background-color: #31261b;
    color: white;
    text-decoration: none;
    padding: 12px 25px;
    border-radius: 25px;
    margin-top: 20px;
    transition: background-color 0.3s;
}

.continue-shopping:hover {
    background-color: #4a1f17;
}

.wishlist-content {
    width: 100%;
    
  
}

.wishlist-items {
    display: flex;
    flex-direction: column;
    gap: 20px;
    width: 100%;
    max-width: 800px;
    margin: 0 auto;
}

.wishlist-item {
    display: flex;
    background: transparent;
    border-radius: 0;
    padding: 20px 0;
    box-shadow: none;
    border: none;
    border-bottom: 1px solid #f0f0f0;
    transition: transform 0.2s ease;
}

.wishlist-item:hover {
    transform: none;
    box-shadow: none;
}

.item-image {
    width: 120px;
    height: 120px;
    border-radius: 10px;
    overflow: hidden;
    margin-right: 20px;
    flex-shrink: 0;
}

.item-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.item-details {
    flex: 1;
    margin-right: 20px;
}

.item-name {
    margin: 0 0 8px 0;
    font-size: 1.3em;
    color: #31261b;
    font-weight: bold;
}

.item-description {
    margin: 0 0 10px 0;
    color: #666;
    font-size: 0.9em;
    line-height: 1.4;
}

.item-meta {
    display: flex;
    gap: 15px;
    align-items: center;
}

.category {
    background-color: #f8f8f8;
    padding: 4px 10px;
    border-radius: 10px;
    font-size: 0.8em;
    color: #666;
}

.price {
    font-weight: bold;
    color: #31261b;
    font-size: 1.2em;
}

.item-actions {
    display: flex;
    flex-direction: column;
    gap: 10px;
    align-items: center;
    justify-content: center;
}

.add-to-cart-btn {
    background-color: #31261b;
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 25px;
    cursor: pointer;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: background-color 0.3s;
    white-space: nowrap;
}

.add-to-cart-btn:hover:not(:disabled) {
    background-color: #4a1f17;
}

.add-to-cart-btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

.remove-btn {
    background-color: #ff4444;
    color: white;
    border: none;
    padding: 8px 12px;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s;
    display: flex;
    align-items: center;
    justify-content: center;
}

.remove-btn:hover {
    background-color: #cc0000;
}

.debug-info {
    display: none;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .wishlist-page {
        padding: 15px;
    }
    
    .wishlist-page h1 {
        font-size: 2.2em;
    }
}

@media (max-width: 768px) {
    .wishlist-page {
        padding: 10px;
    }
    
    .wishlist-page h1 {
        font-size: 1.8em;
        margin-bottom: 20px;
    }
    
    .wishlist-item {
        flex-direction: column;
        text-align: center;
        padding: 15px;
    }
    
    .item-image {
        margin: 0 auto 15px auto;
        width: 100px;
        height: 100px;
    }
    
    .item-details {
        margin-right: 0;
        margin-bottom: 15px;
    }
    
    .item-meta {
        justify-content: center;
        flex-wrap: wrap;
    }
    
    .item-actions {
        flex-direction: row;
        justify-content: space-between;
        gap: 15px;
    }
    
    .add-to-cart-btn {
        flex: 1;
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .wishlist-page {
        padding: 5px;
    }
    
    .wishlist-page h1 {
        font-size: 1.5em;
    }
    
    .wishlist-item {
        padding: 10px;
    }
    
    .item-image {
        width: 80px;
        height: 80px;
    }
    
    .item-name {
        font-size: 1.1em;
    }
    
    .item-description {
        font-size: 0.8em;
    }
    
    .add-to-cart-btn {
        padding: 10px 15px;
        font-size: 0.9em;
    }
    
    .remove-btn {
        padding: 6px 10px;
    }
    
    .empty-wishlist {
        padding: 40px 10px;
    }
    
    .empty-icon i {
        font-size: 3em;
    }
}
</style>