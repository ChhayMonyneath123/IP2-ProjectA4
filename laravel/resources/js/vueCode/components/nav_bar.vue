<template>
  <nav class="navbar">
    <div class="logo-section">
      <img src="@/assets/logo/logofood_station.png" alt="La Libre Logo" class="logo" />
      <span class="brand-name">La Libre</span>
    </div>

    <ul class="nav-links">
      <li>Home</li>
      <li>Menu</li>
      <li>Contact</li>
      <li>About US</li>
    </ul>

    <div class="search-section">
      <input type="text" placeholder="Searching...." />
      <img src="@/assets/icons/search.png" alt="Search" class="search-icon" />
    </div>

    <div class="icon-buttons">
      <img src="@/assets/icons/cart.png" alt="Cart" class="icon" />
      <img src="@/assets/icons/wishlist.png" alt="Wishlist" class="icon" />
      <img src="@/assets/icons/menu.png" alt="Menu" class="menu-icon" />
    </div>
  </nav>
</template>

<style scoped>
.navbar {
  width: 100%;
  max-width: 100%;
  background-color: #F8F7F3;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 5px 2%;
  font-family: 'IBM Plex Sans Condensed', sans-serif;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  flex-wrap: wrap;
  box-sizing: border-box;
}

.logo-section {
  display: flex;
  align-items: center;
  gap: 10px;
}

.logo {
  height: 60px;
}

.brand-name {
  font-size: 1.75rem;
  font-weight: bold;
  white-space: nowrap;
}

.nav-links {
  display: flex;
  gap: 40px;
  list-style: none;
  margin: 10px 0;
  flex-wrap: wrap;
}

.nav-links li {
  cursor: pointer;
  font-size: 1.125rem;
  white-space: nowrap;
}

.search-section {
  display: flex;
  align-items: center;
  background: #f0efeb;
  border-radius: 20px;
  padding: 5px 10px;
  margin: 10px 0;
}

.search-section input {
  border: none;
  background: transparent;
  outline: none;
  font-family: inherit;
  width: 20rem;
}

.search-icon {
  width: 18px;
  height: 18px;
  margin-left: 10px;
}

.icon-buttons {
  display: flex;
  gap: 20px;
  align-items: center;
}

.icon {
  width: 22px;
  height: 22px;
  cursor: pointer;
}

.menu-icon {
  width: 20px;
  height: 20px;
  cursor: pointer;
}

/* Responsive Design */
@media (max-width: 1024px) {
  .navbar {
    flex-direction: column;
    align-items: flex-start;
  }

  .nav-links {
    justify-content: center;
    gap: 25px;
    width: 100%;
  }

  .search-section,
  .icon-buttons {
    width: 100%;
    justify-content: flex-start;
    margin-top: 10px;
  }
}

@media (max-width: 600px) {
  .navbar {
    padding: 10px 20px;
  }

  .brand-name {
    font-size: 1.25rem;
  }

  .nav-links {
    flex-direction: column;
    gap: 10px;
  }

  .search-section input {
    width: 100px;
  }

  .icon {
    width: 20px;
    height: 20px;
  }

  .menu-icon {
    width: 18px;
    height: 18px;
  }
}
</style>
