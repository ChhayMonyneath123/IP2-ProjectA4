<template>
    <div class="all-products">
        <div class="breadcrumb">
            <span><router-link to="/" class="disable">Home &gt;</router-link></span>
            <a href="#">Menu</a>
        </div>
        <div class="header-title">All Products</div>
        <div class="filters">
            <span></span>
            <select class="filter-box" v-model="filters.category" @mousedown="hasClickedCategory = true">
                <option value="" disabled selected hidden>Category</option>
                <option v-for="item in filterValue.categories"
                    :key="item.value"
                    :value="item.value"
                >{{ item.name }}
                </option>
            </select>
            <select class="filter-box" v-model="filters.price" @mousedown="hasClickedCategory = true">
                <option :disabled="!hasClickedCategory" value="">Price </option>
                <option v-for="item in filterValue.prices"
                    :key="item.value"
                    :value="item.value"
                >{{ item.price }}
                </option>
            </select>


        <!-- Serving Filter -->
        <select class="filter-box" v-model="filters.serving">
            <option value="">Serving</option>
            <option value="10">More than 10</option>
            <option value="9">Serving 9</option>
            <option value="8">Serving 8</option>
            <option value="7">Serving 7</option>
            <option value="6">Serving 6</option>
        </select>

        <!-- Cooking Filter -->
        <select class="filter-box" v-model="filters.cooking">
            <option value="">Cooking</option>
            <option value="1">1 hour</option>
            <option value="50">50 hours</option>
            <option value="40">40 hours</option>
            <option value="30">30 hours</option>
            <option value="20">20 hours</option>
            <option value="10">10 hours</option>
        </select>

        <button class="search-btn" @click="handleSearch">🔍</button>
        </div>
    </div>
</template>

<script>
import { reactive, watch } from 'vue';
import { useRouter } from 'vue-router';


export default {
name: 'all_product_menu',
setup() {
    const router = useRouter();

    const filters = reactive({
    category: '',
    price: '',
    serving: '',
    cooking: ''
    });

    const filterValue = {
    categories: [
        { name: 'Foods', value: 'foods', route: '/food' },
        { name: 'Drinks', value: 'drinks', route: '/drink' },
        { name: 'Desserts', value: 'desserts', route: '/dessert' }
    ],
    prices:[
        {price: 'From 1$-5$', route:'/food'},
        {price: 'From 5$-10$', route:'/food'},
        {price: 'From 10$-15$', route:'/food'},
    ]
    };

    const handleSearch = () => {
    console.log('Filters:', filters);
    };

    watch(
    () => filters.category,
    (value) => {
        if (!value) return; // Don't redirect if placeholder is selected
        const match = filterValue.categories.find(item => item.value === value);
        if (match) {
        router.push(match.route);
        }
    }
    );

    return {
    filters,
    handleSearch,
    filterValue
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

.breadcrumb span .disable {
color: white;
text-decoration: none;
margin-left: 10px;
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
box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

.filter-box {
width: 10%;
padding: 0.5rem;
font-size: 1rem;
border: none;
border-radius: 6px;
}

.filter-box option[disabled] {
color: gray;
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
