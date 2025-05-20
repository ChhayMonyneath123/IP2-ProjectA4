<template>
    <div class="drink">
        <Nav_bar />
        <div class="drink-content">
            <div class="drink-nav-link">
                <span><router-link to="/" class="disable">Home &gt;</router-link></span>
                <span><router-link to="/menu" class="disable">Menu &gt;</router-link></span>
                <a href="#">Drink</a>
            </div>
            <div class="drink-nav-button">
                <button type="button">View more</button>
            </div>
        </div>
        <div class="drink-menu">
            <h2>picture of Drink</h2>
        </div>
        <Footer_bar/>
    </div>
</template>

<script>
import Nav_bar from '@/components/nav_bar.vue';
import Footer_bar from '@/components/footer_bar.vue';
export default {
name: "drink",
components: {
    Nav_bar,
    Footer_bar
}
}
</script>

<style scoped>
.drink {

flex-direction: column;
width: 100%;
min-height: 100vh;
background-color: #f9f9f9;
}

.drink-content {
    display: flex;
    justify-content: space-between;
padding: 1rem;
}

.drink-nav-link {
display: flex;
align-items: center;
font-size: 14px;
margin-bottom: 1rem;
}

.drink-nav-link span {
margin-right: 5px;
}

.drink-nav-link .disable {
color: black;
text-decoration: none;
}

.drink-nav-link a {
color: black;
text-decoration: underline;
}
.drink-nav-button button{
    padding: 5px 10px;
    font-size: 15px;
    box-shadow: 1px 2px 2px rgba(59, 59, 59, 0.616);
}
.drink-menu{
    width: 100%;
    height: 20rem;
    display: flex;
    justify-content: center;
    align-content: center;
}

</style>
