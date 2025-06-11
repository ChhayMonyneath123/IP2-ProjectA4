<template>
    <div class="my-order">
        <Admin_bar/>
        <div class="">
            <Side_adbar/>
        </div>
        <Footer_bar/>
    </div>
</template>
<script>
import Footer_bar from '@/components/footer_bar.vue';
import Admin_bar from '@/components/admin_bar.vue';
import Side_adbar from '@/components/side_adbar.vue';
    export default {
        name: "my-order",
        components:{
            Footer_bar,
            Admin_bar,
            Side_adbar
        }
    }
</script>
<style scoped>
.my-order{
    width: 100%;
    height: 20rem;
}
</style>
