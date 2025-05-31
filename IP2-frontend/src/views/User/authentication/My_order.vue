<template>
    <div class="my-order">
        <Nav_bar/>
        <div class="">
            <h1>welcome to my-order</h1>
        </div>
        <Footer_bar/>
    </div>
</template>
<script>
import Nav_bar from '@/components/nav_bar.vue';
import Footer_bar from '@/components/footer_bar.vue';
    export default {
        name: "my-order",
        components:{
            Footer_bar,
            Nav_bar
        }
    }
</script>
<style scoped>
.my-order{
    width: 100%;
    height: 20rem;
}
</style>
