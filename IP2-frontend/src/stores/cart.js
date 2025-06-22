import { defineStore } from 'pinia'
import axios from 'axios'

export const useCartStore = defineStore('cart', {
    state: () => ({
        cartItems: [],
        cartTotal: 0,
        cartItemCount: 0,
        loading: false,
        error: null
    }),

    getters: {
        getCartItemCount: (state) => state.cartItemCount,
        getCartTotal: (state) => state.cartTotal,
        getCartItems: (state) => state.cartItems
    },

    actions: {
        async addToCart(productId, quantity = 1) {
            const userId = 1;

            this.loading = true;
            this.error = null;

            try {
                console.log('Adding to cart:', { productId, quantity, userId });

                const response = await axios.post('/api/cart/add', {
                    product_id: productId,
                    quantity: quantity,
                    user_id: userId
                });

                console.log('Cart API Response:', response.data);

                if (response.data.success) {
                    this.cartTotal = response.data.cart_total;
                    this.cartItemCount = response.data.cart_item_count;
                    this.showSuccessMessage(response.data.message);
                    await this.fetchCartItems(userId);
                } else {
                    this.error = response.data.message;
                    this.showErrorMessage(this.error);
                }
            } catch (error) {
                console.error('Cart Error:', error);
                this.error = error.response?.data?.message || 'Failed to add item to cart';
                this.showErrorMessage(this.error);
            } finally {
                this.loading = false;
            }
        },

        async fetchCartItems(userId = 1) {
            console.log('fetchCartItems called with userId:', userId);
            this.loading = true;
            this.error = null;

            try {
                const response = await axios.get('/api/cart/items', {
                    params: { user_id: userId }
                });

                if (response.data.success) {
                    this.cartItems = response.data.cart_items;
                    this.cartTotal = response.data.cart_summary.total_amount;
                    this.cartItemCount = response.data.cart_summary.total_items;

                    console.log('Cart items loaded:', this.cartItems);
                    console.log('Cart total:', this.cartTotal);
                    console.log('Cart item count:', this.cartItemCount);
                } else {
                    console.error('fetchCartItems failed:', response.data);
                }
            } catch (error) {
                this.error = error.response?.data?.message || 'Failed to fetch cart items';
                console.error('Fetch Cart Error:', error);
            } finally {
                this.loading = false;
            }
        },

        async removeFromCart(cartId, userId = 1) {
            this.loading = true;
            this.error = null;

            try {
                const response = await axios.delete(`/api/cart/remove/${cartId}`, {
                    data: { user_id: userId }
                });

                if (response.data.success) {
                    this.showSuccessMessage(response.data.message);
                    await this.fetchCartItems(userId);
                }
            } catch (error) {
                this.error = error.response?.data?.message || 'Failed to remove item from cart';
                this.showErrorMessage(this.error);
            } finally {
                this.loading = false;
            }
        },

        async updateCartItem(cartId, newQuantity, userId = 1) {
            this.loading = true;
            this.error = null;

            try {
                console.log('Updating cart item:', { cartId, newQuantity, userId });

                const response = await axios.put(`/api/cart/update/${cartId}`, {
                    quantity: newQuantity,
                    user_id: userId
                });

                if (response.data.success) {
                    this.showSuccessMessage(response.data.message);
                    await this.fetchCartItems(userId); // Refresh cart after update
                } else {
                    this.error = response.data.message;
                    this.showErrorMessage(this.error);
                }
            } catch (error) {
                this.error = error.response?.data?.message || 'Failed to update cart item';
                console.error('Update Cart Error:', error);
                this.showErrorMessage(this.error);
            } finally {
                this.loading = false;
            }
        },

        clearCart() {
            this.cartItems = [];
            this.cartTotal = 0;
            this.cartItemCount = 0;
        },

        showSuccessMessage(message) {
            console.log('✅ Success:', message);
        },

        showErrorMessage(message) {
            console.error('❌ Error:', message);
        }
    }
});

