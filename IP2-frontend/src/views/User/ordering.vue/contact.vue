<template>
    <div class="contact">
        <Nav_bar/>
        <div class="contactUs">
            <h1>welcome to contactUs</h1>
        </div>
        <FooterBar/>
    </div>
</template>
<script>
import Nav_bar from '@/components/nav_bar.vue';
import FooterBar from '@/components/FooterBar.vue';

    export default {
        name: "contact",
        components:{
            FooterBar,
            Nav_bar
        }
    }
</script>
<style scoped>
.contactUs{
    width: 100%;
    height: 20rem;
    display: flex;
    justify-content: center;
    align-content: center;
}
</style>
