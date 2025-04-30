<template>
    <div class="product-card">
        <img :src="image" alt="Product Image" class="product-image" />
        <div class="product-info">
            <div class="card-left">
                <h3 class="product-title">{{ title }}</h3>
                <p class="product-price">${{ price }}</p>
                <p class="product-review">1112 Reviews</p>
            </div>
            <div class="card-right">
                <div class="ratings">
                    <span v-for="star in 5" :key="star" class="star" :class="{ filled: star <= rating }">★</span>
                </div>
                <p class="product-delivery">Delivery: {{ deliveryTime }} mins</p>
                <div class="button-container">
                    <button class="add-to-cart"><i class="fa-solid fa-plus"></i></button>
                    <button class="add-to-cart-heart"><i class="fa-solid fa-heart"></i></button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "AllProductCard",
    props: {
        title: String,
        price: Number,
        deliveryTime: String,
        image: String,
        rating: Number,
    },
};
</script>

<style scoped>
.product-card {
    background-color: #f8f8f8;
    border-radius: 1rem;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(49, 49, 49, 0.1);
    width: 23%;
    margin: 10px;
    border: 1px solid gray;
    height: 27rem;
    margin-top: 2rem;
}

.product-image {
    width: 95%;
    height: 60%;
    object-fit: cover;
    padding: 17px;
    margin-left: 10px;
    border-radius: 2rem;
}

.product-info {
    display: flex;
    padding: 10px;
}

.card-left {
    width: 50%;
    height: 100%;
}

.card-right {
    width: 50%;
    height: 100%;
    padding: 0 10px;
}

.product-title {
    font-size: 27px;
    font-weight: bold;
    margin: 0;
}

.product-price {
    font-size: 18px;
    color: black;
    margin: 0;
}

.product-delivery {
    font-size: 17px;
    margin-top: 5px;
}

.ratings {
    font-size: 35px;
    margin: 0;
}

.star {
    color: #ddd;
}

.star.filled {
    color: #f39c12;
}

.button-container {
    display: flex; /* Use flexbox to align buttons */
    margin-top: 5px; /* Space above buttons */
}

.add-to-cart,
.add-to-cart-heart {
    background-color: #31261b; /* Default background color */
    color: #fff;
    border: none;
    cursor: pointer;
    font-size: 27px;
    padding: 10px;
    width: 50px;
    height: 50px;
    clip-path: circle(50% at 50% 50%);
    transition: background-color 0.3s; /* Smooth transition */
    display: flex;
    align-items: center;
    justify-content: center; /* Center icon horizontally */
    margin-left: 20px;
}

.add-to-cart-heart {
    background-color: #5a5244;
}

.product-review {
    color: #777;
    margin-top: 5px;
}

.add-to-cart:hover {
    background-color: #4a1f17; /* Darker shade on hover */
}

.add-to-cart-heart:hover {
    background-color: #4c3e36; /* Darker shade on hover */
}
</style>