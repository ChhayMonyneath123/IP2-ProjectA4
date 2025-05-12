<template>
    <div class="Nav">
        <Nav_bar />
        <div class="ourmenu">
            <h1>welcome to ourmenu</h1>
        </div>
        <FooterBar/>
    </div>
</template>

<script>
    import FooterBar from '@/components/FooterBar.vue';
    import Nav_bar from '@/components/nav_bar.vue';
    
    export default {
    name: 'Home',
    components: {
        Nav_bar,
        FooterBar
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
