<template>
  <div class="aboutContain">
    <Nav_bar/>
    <Breadcrumb/>
      <div class="about">
        <h1>welcome to about</h1>
      </div>
    <Footer_bar/>
  </div>
</template>

<script>
import Breadcrumb from '@/components/breadcrumb.vue';
import Footer_bar from '@/components/footer_bar.vue';
import Nav_bar from '@/components/nav_bar.vue';

export default {
  name: "AboutUs",
  components:{
    Footer_bar,
    Nav_bar,
    Breadcrumb
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
