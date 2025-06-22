<template>
    <div class="cart-page">
        <h1>My Orders</h1>
        
        <div class="debug-info" style="background: #f0f0f0; padding: 10px; margin: 10px 0; font-family: monospace;">
            <p><strong>Debug Info:</strong></p>
            <p>Loading: {{ cartStore.loading }}</p>
            <p>Cart Items Count: {{ cartStore.cartItems.length }}</p>
            <p>Cart Total: {{ cartStore.cartTotal }}</p>
            <p>Cart Item Count: {{ cartStore.cartItemCount }}</p>
            <p>Error: {{ cartStore.error }}</p>
        </div>
        
        <div v-if="cartStore.loading" class="loading">
            <p>Loading cart items...</p>
        </div>
        
        <div v-else-if="cartStore.cartItems.length === 0" class="empty-cart">
            <p>Your cart is empty</p>
            <button @click="testFetchCartItems">🔄 Refresh Cart</button>
            <router-link to="/menu" class="continue-shopping">
                Continue Shopping
            </router-link>
        </div>
        
        <div v-else class="cart-content">
            <div class="cart-items">
                <div 
                    v-for="item in cartStore.cartItems" 
                    :key="item.cart_id"
                    class="cart-item"
                >
                    <img :src="item.product_image" :alt="item.product_name" class="item-image">
                    <div class="item-details">
                        <h3>{{ item.product_name }}</h3>
                        <p class="item-price">${{ item.unit_price }}</p>
                        <div class="quantity-controls">
                            <button @click="updateQuantity(item, item.quantity - 1)">-</button>
                            <span>{{ item.quantity }}</span>
                            <button @click="updateQuantity(item, item.quantity + 1)">+</button>
                        </div>
                    </div>
                    <div class="item-actions">
                        <p class="subtotal">${{ item.subtotal }}</p>
                        <button @click="removeItem(item.cart_id)" class="remove-btn">
                            Remove
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="cart-summary">
                <h3>Order Summary</h3>
                <div class="summary-row">
                    <span>Items ({{ cartStore.cartItemCount }}):</span>
                    <span>${{ cartStore.cartTotal }}</span>
                </div>
                <div class="summary-row total">
                    <span>Total:</span>
                    <span>${{ cartStore.cartTotal }}</span>
                </div>
                <button class="checkout-btn" @click="proceedToCheckout">
                    Proceed to Checkout
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import { useCartStore } from "@/stores/cart";
import { onMounted } from 'vue';

export default {
    name: "My_order",
    setup() {
        const cartStore = useCartStore();

        onMounted(() => {
            console.log('My_order.vue mounted - loading cart items...');
            cartStore.fetchCartItems(1);
        });

        const testFetchCartItems = () => {
            console.log('Manual refresh triggered');
            cartStore.fetchCartItems(1);
        };

        const updateQuantity = (item, newQuantity) => {
            if (newQuantity <= 0) {
                removeItem(item.cart_id);
            } else {
                console.log('Update quantity for', item.cart_id, 'to', newQuantity);
            }
        };

        const removeItem = (cartId) => {
            cartStore.removeFromCart(cartId, 1);
        };

        const proceedToCheckout = () => {
            console.log('Proceed to checkout');
        };

        return {
            cartStore,
            testFetchCartItems,
            updateQuantity,
            removeItem,
            proceedToCheckout
        };
    }
};
</script>

<style scoped>
.cart-page {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.loading {
    text-align: center;
    padding: 40px;
}

.empty-cart {
    text-align: center;
    padding: 40px;
}

.continue-shopping {
    background: #3a2e26;
    color: white;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
    margin: 10px;
    display: inline-block;
}

.cart-content {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 40px;
}

.cart-item {
    display: flex;
    background: white;
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.item-image {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius: 10px;
    margin-right: 20px;
}

.item-details {
    flex: 1;
}

.quantity-controls {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-top: 10px;
}

.quantity-controls button {
    width: 30px;
    height: 30px;
    border: 1px solid #ddd;
    background: white;
    cursor: pointer;
}

.item-actions {
    text-align: right;
}

.remove-btn {
    background: #ff4444;
    color: white;
    border: none;
    padding: 5px 10px;
    border-radius: 5px;
    cursor: pointer;
}

.cart-summary {
    background: #f8f8f8;
    padding: 20px;
    border-radius: 10px;
    height: fit-content;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
}

.summary-row.total {
    font-weight: bold;
    border-top: 1px solid #ddd;
    padding-top: 10px;
}

.checkout-btn {
    width: 100%;
    background: #3a2e26;
    color: white;
    border: none;
    padding: 15px;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    margin-top: 20px;
}
</style>
*/