<template>
    <div class="dessert">
        <Nav_bar />
        <Breadcrumb/>
        <div class="dessert-content">
            
            <div class="dessert-nav-button">
                <button type="button">View more</button>
            </div>
        </div>
        <div class="dessert-menu">
            <h2>picture of dessert</h2>
        </div>
    </div>
    <Footer_bar />
</template>

<script>
import Nav_bar from '@/components/nav_bar.vue';
import Footer_bar from '@/components/footer_bar.vue';
import Breadcrumb from '@/components/breadcrumb.vue';
export default {
name: "dessert",
components: {
    Nav_bar,
    Footer_bar,
    Breadcrumb
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
    justify-content: flex-end;
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
