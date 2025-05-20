<template>
    <div class="Manage-Account">
        <Nav_bar/>
        <div class="">
            <h1>welcome to Manage-Account</h1>
        </div>
        <Footer_bar/>
    </div>
</template>
<script>
import Nav_bar from '@/components/nav_bar.vue';
import Footer_bar from '@/components/footer_bar.vue';

    export default {
        name: "manage_account",
        components:{
            Footer_bar,
            Nav_bar
        }
    }
</script>
<style scoped>
.Manage-Account{
    width: 100%;
    height: 20rem;
}
</style>
