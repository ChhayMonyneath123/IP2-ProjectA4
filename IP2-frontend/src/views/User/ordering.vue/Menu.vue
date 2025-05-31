<template>
    <div class="menu">
        <Nav_bar />
        <All_product_menu />
        <div v-if="$route.path === '/menu'" class="contain-card">
            <All_product_card v-for="product in products" :key="product.id" :title="product.title"
                :price="product.price" :deliveryTime="product.deliveryTime + ' mins'" :image="product.image"
                :rating="product.rating" @click="goToProductDetail(product.id)" />
            <div class="viewMore">
                <button type="button">View More</button>
            </div>
        </div>
        <router-view />


    </div>
    <Footer_bar />
</template>
<script>
import Nav_bar from '@/components/nav_bar.vue';
import Footer_bar from '@/components/footer_bar.vue';
import All_product_card from '@/components/all _product_card.vue';
import All_product_menu from '@/components/all_product_menu.vue';
import { useRouter } from 'vue-router';

export default {
    name: "MenuPage",
    components: {
        Footer_bar,
        Nav_bar,
        All_product_menu,
        All_product_card
    },
    data() {
        return {
            products: [
                {
                    id: 1,
                    title: 'Blueberry Cake',
                    price: 1.5,
                    deliveryTime: 15,
                    image: new URL('@/assets/images/p.jpg', import.meta.url).href,
                    rating: 4
                },
                {
                    id: 2,
                    title: 'Blueberry Cake',
                    price: 1.5,
                    deliveryTime: 15,
                    image: new URL('@/assets/images/p1.png', import.meta.url).href,
                    rating: 3
                },
                {
                    id: 3,
                    title: 'Blueberry Cake',
                    price: 1.5,
                    deliveryTime: 15,
                    image: new URL('@/assets/images/p2.png', import.meta.url).href,
                    rating: 4
                },
                {
                    id: 4,
                    title: 'Blueberry Cake',
                    price: 1.5,
                    deliveryTime: 15,
                    image: new URL('@/assets/images/p3.png', import.meta.url).href,
                    rating: 4
                },
                {
                    id: 5,
                    title: 'Blueberry Cake',
                    price: 1.5,
                    deliveryTime: 15,
                    image: new URL('@/assets/images/p4.png', import.meta.url).href,
                    rating: 4
                },
                {
                    id: 6,
                    title: 'Blueberry Cake',
                    price: 1.5,
                    deliveryTime: 15,
                    image: new URL('@/assets/images/p5.png', import.meta.url).href,
                    rating: 4
                },
                {
                    id: 7,
                    title: 'Blueberry Cake',
                    price: 1.5,
                    deliveryTime: 15,
                    image: new URL('@/assets/images/p6.png', import.meta.url).href,
                    rating: 4
                },
                {
                    id: 8,
                    title: 'Blueberry Cake',
                    price: 1.5,
                    deliveryTime: 15,
                    image: new URL('@/assets/images/p6.png', import.meta.url).href,
                    rating: 4
                },
            ]
        };
    },
    setup() {
        const router = useRouter();

        const goToProductDetail = (id) => {
            console.log("Navigating to product detail with ID:", id);
            router.push({ name: "detail", params: { id } });
        };

        return {
            goToProductDetail 
        };
    }
}
</script>
<style scoped>
.menu {
    width: 100%;
    height: auto;

}

.contain-card {
    width: 90%;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    padding: 4rem 2rem;
    margin: 0 auto;

}

.viewMore {
    display: flex;
    justify-content: center;
    align-content: center;
    margin-bottom: 5rem;
}

.viewMore button {
    font-size: 32px;
    font-weight: bold;
    border-radius: 30px;
    padding: 10px 20px;
    background-color: #31261b;
    color: white;
}
</style>
