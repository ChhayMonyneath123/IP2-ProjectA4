<template>
  <div class="aboutContain">
    <Nav_bar/>
<<<<<<< HEAD
      <div class="about">
        <h1>welcome to about</h1>
      </div>
    <FooterBar/>
=======
    <Breadcrumb/>
      <div class="about">
        <h1>welcome to about</h1>
      </div>
    <Footer_bar/>
>>>>>>> Neath
  </div>
</template>

<script>
<<<<<<< HEAD
import FooterBar from '@/components/FooterBar.vue';
=======
import Breadcrumb from '@/components/breadcrumb.vue';
import Footer_bar from '@/components/footer_bar.vue';
>>>>>>> Neath
import Nav_bar from '@/components/nav_bar.vue';

export default {
  name: "AboutUs",
  components:{
<<<<<<< HEAD
    FooterBar,
    Nav_bar
=======
    Footer_bar,
    Nav_bar,
    Breadcrumb
>>>>>>> Neath
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
