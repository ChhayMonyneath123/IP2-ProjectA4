<template>
    <div class="orderingPage">
        <Nav_bar/>
        <div class="ordering">
            <h1>welcome to ordering</h1>
        </div>
        <FooterBar/>
    </div>
</template>
<script>
import Nav_bar from '@/components/nav_bar.vue';
import FooterBar from '@/components/FooterBar.vue';

    export default {
        name: "Drink",
        components:{
            FooterBar,
            Nav_bar
        }
    }
</script>
<style scoped>
.orderingPage{
    width: 100%;
    height: 20rem;
}
</style>
