<template>
    <div class="product-card">
        <div class="product-image">
            <img :src="image" alt="Product Image" />
        </div>
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
    name: "all_product_card",
    props: {
<<<<<<< HEAD
=======
        id: Number,
>>>>>>> Neath
        title: String,
        price: Number,
        deliveryTime: String,
        image: String,
        rating: Number,
    },
};
</script>

<style scoped>
body {
  font-family: 'Instrument Sans', sans-serif;

}
.product-card {
    background-color: #f8f8f8;
    border-radius: 2rem;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(49, 49, 49, 0.1);
    width: 17%;
    border: 1px solid rgb(99, 97, 97);
    height: 27rem;
    margin-top: 2rem;
    padding: 16px;
    margin: 2rem;
    font-family: 'Instrument Sans', sans-serif;
}
.product-image {
    width: 100%;
    height: 65%;
    border-radius: 2rem;
    overflow: hidden;
}
.product-image img{
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.product-info {
    display: flex;
    padding: 10px;
    margin-top: 1rem;
}
.card-left {
    width: 50%;
    height: 100%;
}
.card-right {
    width: 50%;
    height: 100%;
    padding: 0 0px 5px 25px;
}
.product-title {
    font-size: 22px;
    font-weight: bold;
    margin: 0;
}
.product-price {
    font-size: 16px;
    color: black;
    margin: 0;
}
.product-delivery {
    font-size: 12px;
    margin-top: 5px;
}
.ratings {
    font-size: 25px;
    margin: 0;
}
.star {
    color: #ddd;
}
.star.filled {
    color: #f39c12;
}

.button-container {
    display: flex;
    margin-top: 3px;
}
.add-to-cart,
.add-to-cart-heart {
    background-color: #31261b;
    color: #fff;
    border: none;
    cursor: pointer;
    font-size: 24px;
    padding: 10px;
    width: 40px;
    height: 40px;
    clip-path: circle(50% at 50% 50%);
    transition: background-color 0.3s;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-left: 10px;
}
.add-to-cart-heart {
    background-color: #5a5244;
}
.product-review {
    color: #777;
    margin-top: 5px;
}
.add-to-cart:hover {
    background-color: #4a1f17;
}
.add-to-cart-heart:hover {
    background-color: #4c3e36;
}
</style>