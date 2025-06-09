<template>
    <div class="product-card">
      <div class="product-info">
        <div class="info-cell">
          <h3 class="product-title">{{ title }}</h3>
        </div>
        <div class="info-cell">
          <p class="product-review">{{ description }}</p>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: "ExploreCard",
    props: {
      title: String,
      type: String,
      description: String,

    },
  };
  </script>
  
  <style scoped>
  .product-card {
    background-color: #f8f8f8;
    border-radius: 1rem;
    box-shadow: 0 2px 10px rgba(49, 49, 49, 0.1);
    width: 400px;
    height: 150px;
    border: 1px solid rgb(99, 97, 97);
    margin: 1rem;
    padding: 1rem;
    font-family: 'Instrument Sans', sans-serif;
  
    /* Make it a horizontal flex container to center grid content vertically */
    display: flex;
    align-items: center;
    justify-content: center;
  }
  
  .product-info {
    /* Grid with 2 equal columns */
    display: grid;
    grid-template-columns: 1fr 1fr;
    width: 100%;
    gap: 1rem;
    align-items: center;
  }
  
  .info-cell {
    /* Center text inside each grid cell */
    text-align: center;
  }
  
  .product-title {
    font-size: 20px;
    font-weight: bold;
    margin: 0;
  }
  
  .product-review {
    color: #777;
    font-size: 14px;
    margin: 0;
  }
  </style>
  