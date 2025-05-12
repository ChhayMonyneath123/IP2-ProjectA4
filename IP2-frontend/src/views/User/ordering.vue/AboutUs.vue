<template>
  <div class="aboutContain">
    <Nav_bar/>
      <div class="about">
        <h1>welcome to about</h1>
      </div>
    <FooterBar/>
  </div>
</template>

<script>
import FooterBar from '@/components/FooterBar.vue';
import Nav_bar from '@/components/nav_bar.vue';

export default {
  name: "AboutUs",
  components:{
    FooterBar,
    Nav_bar
  }
}
</script>

<style scoped>
.about{
    width: 100%;
    height: 20rem;
    display: flex;
    justify-content: center;
    align-content: center;
}
</style>
