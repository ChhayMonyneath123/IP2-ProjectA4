<template>
    <div class="flex flex-col md:flex-row items-start md:items-center gap-4 justify-between bg-[#f9f6ef] p-6 rounded-lg mb-10">
      <div class="flex items-center gap-4">
        <div class="flex items-center gap-2">
          <span class="material-icons text-xl">restaurant</span>
          <span class="text-sm font-medium">6 Serving</span>
        </div>
        <div class="flex items-center gap-2">
          <span class="material-icons text-xl">schedule</span>
          <span class="text-sm font-medium">15 mins</span>
        </div>
        <div class="flex items-center gap-2">
          <span class="material-icons text-xl">delivery_dining</span>
          <span class="text-sm font-medium">20 mins</span>
        </div>
      </div>
      <div class="flex gap-4">
        <button class="bg-white border border-gray-300 px-4 py-2 rounded-md hover:bg-gray-100">
          <span class="material-icons text-lg align-middle mr-1">shopping_cart</span> Add to Cart
        </button>
        <button class="bg-white border border-gray-300 px-4 py-2 rounded-md hover:bg-gray-100">
          <span class="material-icons text-lg align-middle">favorite_border</span>
        </button>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: "FoodInfo",
  };
  </script>
  
  <style scoped>
  .material-icons {
    vertical-align: middle;
  }
  </style>
  