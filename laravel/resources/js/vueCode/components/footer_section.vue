<template>
<<<<<<< HEAD:laravel/resources/js/vueCode/components/footer_section.vue
    <footer class="text-white py-10 mt-20 px-6">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div>
          <h4 class="font-bold text-lg mb-2">La Libre</h4>
          <p>Enjoy your meal with pleasure!</p>
          <div class="flex space-x-4 mt-4">
            <i class="fab fa-facebook"></i>
            <i class="fab fa-instagram"></i>
            <i class="fab fa-twitter"></i>
          </div>
=======
  <footer class="footer">
    <div class="footer-content">
      <!-- Left: Brand & Social -->
      <div class="footer-brand">
        <div class="logo-wrapper">
          <img :src="'/assets/logo/logofood_station.png'" alt="La Libre Logo" class="logo" />
           <h2>La Libre</h2>
>>>>>>> PolliX:laravel/resources/js/vueCode/components/footer.vue
        </div>
        
        <p>Enjoy your meal with pleasure!</p>
        <div class="social-icons">
          <a href="#" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
          <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
          <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
        </div>
        <p class="copyright">
          © 2024 All Rights Reserved. <a href="#">Terms of Use</a> La Libre
        </p>
      </div>

      <!-- Right: Link Groups -->
      <div class="footer-links">
        <div class="link-group">
          <h4>Information</h4>
          <ul>
            <li><a href="#">About</a></li>
            <li><a href="#">Product</a></li>
            <li><a href="#">Blog</a></li>
          </ul>
        </div>
        <div class="link-group">
          <h4>Company</h4>
          <ul>
            <li><a href="#">Community</a></li>
            <li><a href="#">Career</a></li>
            <li><a href="#">Our story</a></li>
          </ul>
        </div>
        <div class="link-group">
          <h4>Contact</h4>
          <ul>
            <li><a href="#">Getting Started</a></li>
            <li><a href="#">Pricing</a></li>
            <li><a href="#">Resources</a></li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
</template>

<script setup>
</script>

<style scoped>
.footer {
  height: auto;
  background-color: #564c3b;
  color: white;
  padding: 10px 40px;
  font-family: 'Instrument Sans', sans-serif;
}

.footer-content {
  max-width: 100%;
  margin: auto;
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  gap: 50px;
}

.footer-brand {
  flex: 1 1 200px;

}
.logo-wrapper {
  display: flex;
  flex-direction: row;
  align-items: center;
}
.logo {
  width: 60px;

}

.footer-brand h2 {
  font-size: 24px;
  font-weight: bold;
  font-family: 'IBM Plex Sans Condensed', sans-serif;
  margin: 10px 0 5px;
  
<<<<<<< HEAD:laravel/resources/js/vueCode/components/footer_section.vue
  <script>
  export default {
    name: "Footer_Section",
  };
  </script>
  
  <style scoped>
  footer {
    font-family: 'Instrument Sans Variable', sans-serif;
    background-color: rgb(54, 46, 46);
=======
}

.footer-brand p {
  font-size: 14px;
  margin: 5px 0 15px;
  font-family: 'Instrument Sans Variable', sans-serif;
}

.social-icons {
  display: flex;
  gap: 10px;
  margin-bottom: 30px;
}

.social-icons a {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 36px;
  height: 36px;
  border-radius: 50%;
  border: 1px solid white;
  font-size: 14px;
  color: white;
  transition: background-color 0.3s, color 0.3s;
}

.social-icons a:hover {
  background-color: white;
  color: #564c3b;
}

.footer-links {
  display: flex;
  gap: 80px;
  flex: 2 1 300px;
  justify-content: flex-end;
  margin-top: 2%;
  
}

.link-group h4 {
  font-weight: 700;
  font-size: 14px;
  margin-bottom: 20px;
  font-family: 'Instrument Sans Variable', sans-serif;
}

.link-group ul {
  list-style: none;
  padding: 0;
  margin-bottom: 2%;
  font-family: 'Instrument Sans Variable', sans-serif;
}

.link-group li {
  margin-bottom: 10%;
}

.link-group a {
  text-decoration: none;
  color: white;
  font-size: 14px;
}

.link-group a:hover {
  text-decoration: underline;
  color: #ddd;
}

a {
  color: inherit;
}

a:hover {
  color: #ddd;
}

@media (max-width: 768px) {
  .footer-content {
    flex-direction: column;
    align-items: flex-start;
    gap: 30px;
>>>>>>> PolliX:laravel/resources/js/vueCode/components/footer.vue
  }

  .footer-links {
    flex-direction: column;
    gap: 20px;
    width: 100%;
  }
}
</style>
