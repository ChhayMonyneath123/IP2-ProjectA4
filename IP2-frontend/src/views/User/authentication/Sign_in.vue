<template>
    <div class="Sign-In">
        <Nav_bar/>
        <div class="center">
            <h1>welcome to Sign-In</h1>
        </div>
        <Footer_bar/>
    </div>
</template>
<script>
import Nav_bar from '@/components/nav_bar.vue';
import Footer_bar from '@/components/footer_bar.vue';

    export default {
        name: "sign_in",
        components:{
            Footer_bar,
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
