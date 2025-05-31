<template>
    <div class="orderingPage">
        <Nav_bar/>
<<<<<<< HEAD
        <div class="ordering">
            <h1>welcome to ordering</h1>
        </div>
        <FooterBar/>
=======
        <Breadcrumb/>
        <div class="ordering">
            <h1>welcome to ordering</h1>
        </div>
        <Footer_bar/>
>>>>>>> Neath
    </div>
</template>
<script>
import Nav_bar from '@/components/nav_bar.vue';
<<<<<<< HEAD
import FooterBar from '@/components/FooterBar.vue';
=======
import Footer_bar from '@/components/footer_bar.vue';
import Breadcrumb from '@/components/breadcrumb.vue';
>>>>>>> Neath

    export default {
        name: "Drink",
        components:{
<<<<<<< HEAD
            FooterBar,
            Nav_bar
=======
            Footer_bar,
            Nav_bar,
            Breadcrumb
>>>>>>> Neath
        }
    }
</script>
<style scoped>
.orderingPage{
    width: 100%;
    height: 20rem;
}
</style>
