<template>
    <div class="drink">
        <Nav_bar />
        <Breadcrumb/>
        <div class="drink-content">
            
            <div class="drink-nav-button">
                <button type="button">View more</button>
            </div>
        </div>
        <div class="drink-menu">
            <h2>picture of Drink</h2>
        </div>
        
    </div>
    <Footer_bar/>
</template>

<script>
import Nav_bar from '@/components/nav_bar.vue';
import Footer_bar from '@/components/footer_bar.vue';
import Breadcrumb from '@/components/breadcrumb.vue';
export default {
name: "drink",
components: {
    Nav_bar,
    Footer_bar,
    Breadcrumb
}
}
</script>

<style scoped>
.drink {

flex-direction: column;
width: 100%;
height: 100vh;
background-color: #f9f9f9;
}

.drink-content {
    display: flex;
    justify-content: flex-end;
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
