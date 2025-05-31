<template>
    <div class="contact">
        <Nav_bar/>
        <Breadcrumb/>
        <div class="contactUs">
            <h1>welcome to contactUs</h1>
        </div>
        <Footer_bar/>
    </div>
</template>
<script>
import Nav_bar from '@/components/nav_bar.vue';
import Footer_bar from '@/components/footer_bar.vue';
import Breadcrumb from '@/components/breadcrumb.vue';

    export default {
        name: "contact",
        components:{
            Footer_bar,
            Nav_bar,
            Breadcrumb
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
