<template>
    <div class="orderingPage">
        <Nav_bar/>
        <Breadcrumb/>
        <div class="ordering">
            <h1>welcome to ordering</h1>
        </div>
        <Footer_bar/>

    </div>
</template>
<script>
import Nav_bar from '@/components/nav_bar.vue';
import Footer_bar from '@/components/footer_bar.vue';
import Breadcrumb from '@/components/breadcrumb.vue';

    export default {
        name: "Drink",
        components:{
            Footer_bar,
            Nav_bar,
            Breadcrumb
        }
    }
</script>
<style scoped>
.orderingPage{
    width: 100%;
    height: 20rem;
}
</style>
