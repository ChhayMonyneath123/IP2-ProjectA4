<template>
    <div class="mb-10">
      <h2 class="text-lg font-semibold mb-2">Rating Overview:</h2>
      <div class="flex items-center gap-2 text-2xl font-bold">
        4.1 <span class="text-yellow-500">★</span>
      </div>
      <!-- You can expand this section with bar visuals for each rating level -->
    </div>
  </template>
  
  <script>
  export default {
    name: "Rating",
  };
  </script>
  
  <style scoped>
  .text-yellow-500 {
    font-size: 1.5rem;
  }
  </style>
  