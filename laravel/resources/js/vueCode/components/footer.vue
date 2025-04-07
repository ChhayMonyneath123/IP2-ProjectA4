<template>
    <footer class="bg-[#4b3b36] text-white py-10 mt-20 px-6">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div>
          <h4 class="font-bold text-lg mb-2">La Libre</h4>
          <p>Enjoy your meal with pleasure!</p>
          <div class="flex space-x-4 mt-4">
            <i class="fab fa-facebook"></i>
            <i class="fab fa-instagram"></i>
            <i class="fab fa-twitter"></i>
          </div>
        </div>
        <div>
          <h4 class="font-semibold mb-2">Information</h4>
          <ul class="text-sm space-y-1">
            <li>About</li>
            <li>Product</li>
            <li>Blog</li>
          </ul>
        </div>
        <div>
          <h4 class="font-semibold mb-2">Company</h4>
          <ul class="text-sm space-y-1">
            <li>Community</li>
            <li>Career</li>
            <li>Our Story</li>
          </ul>
        </div>
        <div>
          <h4 class="font-semibold mb-2">Contact</h4>
          <ul class="text-sm space-y-1">
            <li>Getting Started</li>
            <li>Pricing</li>
            <li>Resources</li>
          </ul>
        </div>
      </div>
      <p class="text-center text-xs mt-10">2024 all Right Reserved Term of use La Libre</p>
    </footer>
  </template>
  
  <script>
  export default {
    name: "FooterSection",
  };
  </script>
  
  <style scoped>
  footer {
    font-family: 'Instrument Sans Variable', sans-serif;
  }
  </style>
  