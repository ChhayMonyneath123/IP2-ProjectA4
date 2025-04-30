<template>
    <div class="all-products">
        <div class="breadcrumb">
            <span>Home &gt;</span>
            <a href="#">Menu</a>
        </div>
        <div class="header-title">All Products</div>
        <div class="filters">
            <select class="filter-box" v-model="filters.category">
                <option value="">Categories</option>
                <option value="category1">Category 1</option>
                <option value="category2">Category 2</option>
            </select>
            <select class="filter-box" v-model="filters.price">
                <option value="">Price</option>
                <option value="low">Low</option>
                <option value="high">High</option>
            </select>
            <select class="filter-box" v-model="filters.serving">
                <option value="">Serving</option>
                <option value="1">1</option>
                <option value="2">2</option>
            </select>
            <select class="filter-box" v-model="filters.cooking">
                <option value="">Cooking</option>
                <option value="baked">Baked</option>
                <option value="fried">Fried</option>
            </select>
            <button class="search-btn" @click="handleSearch">🔍</button>
        </div>
    </div>
</template>

<script>
import { reactive } from 'vue';
import '@fortawesome/fontawesome-free/css/all.css';
export default {
    name: 'AllProductMenu',
    setup() {
        const filters = reactive({
            category: '',
            price: '',
            serving: '',
            cooking: ''
        });

        const handleSearch = () => {
            console.log('Filters:', filters);
        };

        return {
            filters,
            handleSearch
        };
    }
};
</script>

<style scoped>
.all-products {
    font-family: Arial, sans-serif;
    background-color: #f9f6f0;
}

.breadcrumb {
    background-color: #6f665d;
    color: white;
    font-size: 14px;
    padding: 1rem;
}

.breadcrumb a {
    color: white;
    text-decoration: underline;
    margin-left: 5px;
}

.header-title {
    background-color: #6f665d;
    text-align: center;
    padding: 2rem 1rem 1rem;
    color: white;
    font-size: 2rem;
    font-weight: bold;
}

.filters {
    background-color: #6f665d;
    display: flex;
    justify-content: space-around;
    gap: 1rem;
    flex-wrap: wrap;
    padding: 1rem;
    box-shadow: 0 2px 4px rgba(0,0,0,0.2);
}
.filter-box {
    width: 10%;
}

.filters select {
    padding: 0.5rem;
    font-size: 1rem;
    border: none;
    border-radius: 6px;
}

.search-btn {
    background-color: transparent;
    border: 2px solid white;
    color: white;
    padding: 0.5rem 0.8rem;
    border-radius: 6px;
    font-size: 1.5rem;
    cursor: pointer;
}

.search-btn:hover {
    background-color: white;
    color: #6f665d;
}
</style>