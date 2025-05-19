<template>
    <div class="my-order">
        <Nav_bar/>
        <div class="">
            <h1>welcome to my-order</h1>
        </div>
        <FooterBar/>
    </div>
</template>
<script>
import Nav_bar from '@/components/nav_bar.vue';
import FooterBar from '@/components/FooterBar.vue';

    export default {
        name: "my-order",
        components:{
            FooterBar,
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
