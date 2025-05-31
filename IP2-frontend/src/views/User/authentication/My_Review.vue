<template>
    <div class="My_review">
        <Nav_bar/>
        <div class="">
            <h1>welcome to My_review</h1>
        </div>
        <Footer_bar/>
    </div>
</template>
<script>
import Nav_bar from '@/components/nav_bar.vue';
import Footer_bar from '@/components/footer_bar.vue';
    export default {
        name: "my-review",
        components:{
            Footer_bar,
            Nav_bar
        }
    }
</script>
<style scoped>
.My_review{
    width: 100%;
    height: 20rem;
}
</style>
