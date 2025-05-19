<template>
    <div class="Manage-Account">
        <Nav_bar/>
        <div class="">
            <h1>welcome to Manage-Account</h1>
        </div>
        <FooterBar/>
    </div>
</template>
<script>
import Nav_bar from '@/components/nav_bar.vue';
import FooterBar from '@/components/FooterBar.vue';

    export default {
        name: "manage_account",
        components:{
            FooterBar,
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
