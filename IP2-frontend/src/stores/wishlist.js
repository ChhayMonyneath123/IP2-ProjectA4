import { defineStore } from 'pinia'
import axios from 'axios'

export const useWishlistStore = defineStore('wishlist', {
    state: () => ({
        wishlistItems: [],
        wishlistCount: 0,
        loading: false,
        error: null
    }),

    getters: {
        getWishlistCount: (state) => state.wishlistCount,
        getWishlistItems: (state) => state.wishlistItems,
        isInWishlist: (state) => (productId) => {
            return state.wishlistItems.some(item => item.product_id === productId);
        }
    },

    actions: {
        async addToWishlist(productId) {
            const userId = 1; // Replace with actual user ID from auth store
            
            this.loading = true;
            this.error = null;

            try {
                console.log('Adding to wishlist:', { productId, userId });
                
                const response = await axios.post('/api/wishlist/add', {
                    product_id: productId,
                    user_id: userId
                });

                console.log('Wishlist API Response:', response.data);

                if (response.data.success) {
                    this.wishlistCount = response.data.wishlist_count;
                    this.showSuccessMessage(response.data.message);
                    await this.fetchWishlistItems();
                } else {
                    this.error = response.data.message;
                    this.showErrorMessage(response.data.message);
                }
            } catch (error) {
                console.error('Wishlist Error:', error);
                this.error = error.response?.data?.message || 'Failed to add item to wishlist';
                this.showErrorMessage(this.error);
            } finally {
                this.loading = false;
            }
        },

        async removeFromWishlist(wishlistId) {
            const userId = 1; // Replace with actual user ID from auth store
            
            this.loading = true;
            this.error = null;

            try {
                console.log('Removing from wishlist:', { wishlistId, userId });
                
                const response = await axios.delete(`/api/wishlist/remove/${wishlistId}`, {
                    data: { user_id: userId }
                });

                console.log('Remove wishlist response:', response.data);

                if (response.data.success) {
                    this.wishlistCount = response.data.wishlist_count;
                    this.showSuccessMessage(response.data.message);
                    await this.fetchWishlistItems();
                }
            } catch (error) {
                this.error = error.response?.data?.message || 'Failed to remove item from wishlist';
                this.showErrorMessage(this.error);
            } finally {
                this.loading = false;
            }
        },

        async fetchWishlistItems() {
            const userId = 1; // Replace with actual user ID from auth store
            
            this.loading = true;
            this.error = null;

            try {
                console.log('Fetching wishlist items for user:', userId);
                
                const response = await axios.get('/api/wishlist/items', {
                    params: { user_id: userId }
                });

                console.log('Wishlist items response:', response.data);

                if (response.data.success) {
                    this.wishlistItems = response.data.wishlist_items;
                    this.wishlistCount = response.data.wishlist_summary.total_items;
                    
                    console.log('Wishlist items loaded:', this.wishlistItems);
                    console.log('Wishlist count:', this.wishlistCount);
                } else {
                    console.error('fetchWishlistItems failed:', response.data);
                }
            } catch (error) {
                this.error = error.response?.data?.message || 'Failed to fetch wishlist items';
                console.error('Fetch Wishlist Error:', error);
                console.error('Error response:', error.response);
            } finally {
                this.loading = false;
            }
        },

        async checkWishlistStatus(productId) {
            const userId = 1; // Replace with actual user ID from auth store
            
            try {
                console.log('Checking wishlist status for product:', productId);
                
                const response = await axios.get('/api/wishlist/check', {
                    params: { user_id: userId, product_id: productId }
                });

                console.log('Wishlist status response:', response.data);

                if (response.data.success) {
                    return response.data.in_wishlist;
                }
            } catch (error) {
                console.error('Check wishlist status error:', error);
            }
            return false;
        },

        async toggleWishlist(productId) {
            // Helper method to toggle wishlist status
            const isCurrentlyInWishlist = this.isInWishlist(productId);
            
            if (isCurrentlyInWishlist) {
                // Find the wishlist item and remove it
                const wishlistItem = this.wishlistItems.find(item => item.product_id === productId);
                if (wishlistItem) {
                    await this.removeFromWishlist(wishlistItem.wishlist_id);
                }
            } else {
                // Add to wishlist
                await this.addToWishlist(productId);
            }
        },

        showSuccessMessage(message) {
            console.log('✅ Wishlist Success:', message);
            // You can integrate with a toast notification library here
            // Example with vue-toastification:
            // import { useToast } from "vue-toastification";
            // const toast = useToast();
            // toast.success(message);
        },

        showErrorMessage(message) {
            console.error('❌ Wishlist Error:', message);
            // You can integrate with a toast notification library here
            // Example with vue-toastification:
            // import { useToast } from "vue-toastification";
            // const toast = useToast();
            // toast.error(message);
        },

        clearWishlist() {
            this.wishlistItems = [];
            this.wishlistCount = 0;
            this.error = null;
        }
    }
});