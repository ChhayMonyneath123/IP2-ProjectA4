<template>
    <div class="dessert">
        <Nav_bar />
        <div class="dessert-content">
            <div class="dessert-nav-link">
                <span><router-link to="/" class="disable">Home &gt;</router-link></span>
                <span><router-link to="/menu" class="disable">Menu &gt;</router-link></span>
                <a href="#">dessert</a>
            </div>
            <div class="dessert-nav-button">
                <button type="button">View more</button>
            </div>
        </div>
        <div class="dessert-menu">
            <h2>picture of dessert</h2>
        </div>
        <FooterBar />
    </div>
</template>

<script>
import Nav_bar from '@/components/nav_bar.vue';
import FooterBar from '@/components/FooterBar.vue';

export default {
name: "dessert",
components: {
    Nav_bar,
    FooterBar
}
}
</script>

<style scoped>
.dessert {

flex-direction: column;
width: 100%;
min-height: 100vh;
background-color: #f9f9f9;
}

.dessert-content {
    display: flex;
    justify-content: space-between;
padding: 1rem;
}

.dessert-nav-link {
display: flex;
align-items: center;
font-size: 14px;
margin-bottom: 1rem;
}

.dessert-nav-link span {
margin-right: 5px;
}

.dessert-nav-link .disable {
color: black;
text-decoration: none;
}

.dessert-nav-link a {
color: black;
text-decoration: underline;
}
.dessert-nav-button button{
    padding: 5px 10px;
    font-size: 15px;
    box-shadow: 1px 2px 2px rgba(59, 59, 59, 0.616);
}
.dessert-menu{
    width: 100%;
    height: 20rem;
    display: flex;
    justify-content: center;
    align-content: center;
}

</style>
