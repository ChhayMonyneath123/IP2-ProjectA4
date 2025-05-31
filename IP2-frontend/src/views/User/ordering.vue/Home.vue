<template>
    <div class="Nav">
        <Nav_bar />
        <div class="ourmenu">
            <h1>welcome to ourmenu</h1>
        </div>
        <Footer_bar/>
    </div>
</template>

<script>
import Footer_bar from '@/components/footer_bar.vue';

    import Nav_bar from '@/components/nav_bar.vue';
    
    export default {
    name: 'Home',
    components: {
        Nav_bar,
        Footer_bar

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
