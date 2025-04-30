<template>
  <nav class="navbar">
    <div class="logo">La Libre</div>
    <ul class="nav-links">
      <li><router-link to="/">Home</router-link></li>
      <li><router-link to="/menu">Menu</router-link></li>
      <li><router-link to="/contact">Contact</router-link></li>
      <li><router-link to="/about">About Us</router-link></li>
    </ul>
    <div class="search-cart">
      <input type="text" placeholder="Searching..." />
      <router-link to="/cart">🛒</router-link>
    </div>
  </nav>
</template>

<script>
export default {
  name: "FooterComponent",
};
</script>

<style scoped>
.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: #f8f8f8;
  padding: 10px 20px;
  border-bottom: 1px solid #e0e0e0;
}

.logo {
  font-size: 24px;
  font-weight: bold;
}

.nav-links {
  list-style: none;
  display: flex;
  gap: 20px;
}

.nav-links li {
  display: inline;
}

.nav-links a {
  text-decoration: none;
  color: #333;
}

.search-cart {
  display: flex;
  align-items: center;
}

.search-cart input {
  padding: 5px;
  margin-right: 10px;
}
</style>