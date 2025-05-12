<template>
    <div class="forget-password">
        <Nav_bar/>
        <div class="">
            <h1>welcome to </h1>
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
.forget-password{
    width: 100%;
    height: 20rem;
}
</style>
