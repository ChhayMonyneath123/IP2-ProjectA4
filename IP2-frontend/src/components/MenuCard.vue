<template>
  <div class="product-card">
    <div class="product-info">
      <h3 class="product-title">{{ title }}</h3>
      <p class="product-review">{{ description }}</p>
    </div>
  </div>
</template>

<script>
export default {
  name: "all_product_card",
  props: {
    title: String,
    description: String,
  },
};
</script>

<style scoped>
.product-card {
  background-color: #f8f8f8;
  border-radius: 2rem;
  overflow: hidden;
  box-shadow: 0 2px 10px rgba(49, 49, 49, 0.1);
  width: 17%;
  border: 1px solid rgb(99, 97, 97);
  height: 10rem; /* Adjust height since image removed */
  margin-top: 2rem;
  padding: 16px;
  margin: 2rem;
  font-family: 'Instrument Sans', sans-serif;
  display: flex;
  flex-direction: column;
  justify-content: center;
  text-align: center;
}

.product-title {
  font-size: 22px;
  font-weight: bold;
  margin: 0 0 0.5rem 0;
}

.product-review {
  color: #777;
  font-size: 14px;
  margin: 0;
}

</style>
