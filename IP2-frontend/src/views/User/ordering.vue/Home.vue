<template>
    <div class="Nav">
        <Nav_bar />
        <div class="ourmenu">
            <h1>welcome to ourmenu</h1>
        </div>
<<<<<<< HEAD
        <FooterBar/>
=======
        <Footer_bar/>
>>>>>>> Neath
    </div>
</template>

<script>
<<<<<<< HEAD
    import FooterBar from '@/components/FooterBar.vue';
=======
import Footer_bar from '@/components/footer_bar.vue';
>>>>>>> Neath
    import Nav_bar from '@/components/nav_bar.vue';
    
    export default {
    name: 'Home',
    components: {
        Nav_bar,
<<<<<<< HEAD
        FooterBar
=======
        Footer_bar
>>>>>>> Neath
    }
    }
</script>

<style scoped>
.ourmenu{
    width: 100%;
    height: 20rem;
    display: flex;
    justify-content: center;
    align-content: center;
}
</style>
