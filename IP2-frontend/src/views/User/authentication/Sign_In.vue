<template>
    <div class="Sign-In">
        <Nav_bar/>
        <div class="center">
            <h1>welcome to Sign-In</h1>
        </div>
<<<<<<< HEAD
        <FooterBar/>
=======
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
>>>>>>> Neath

    export default {
        name: "sign_in",
        components:{
<<<<<<< HEAD
            FooterBar,
=======
            Footer_bar,
>>>>>>> Neath
            Nav_bar
        }
    }
</script>
<style scoped>
.Sign-In{
    width: 100%;
    height: 20rem;
}
.center{
    display: flex;
    justify-content: center;
    align-content: center;
}
</style>
