<template>
    <nav class="navbar">
      <div class="logo-section">
        <img src="@/assets/logofood_station.png" alt="La Libre Logo" class="logo" />
        <span class="brand-name">La Libre</span>
      </div>
  
      <ul class="nav-links">
        <li><router-link to="/">Home</router-link></li>
        <li><router-link to="/menu">Menu</router-link></li>
        <li><router-link to="/contact">Contact</router-link></li>
        <li><router-link to="/aboutUs">About Us</router-link></li>
      </ul>
  
      <div class="search-section">
        <input type="text" placeholder="Search..." aria-label="Search" />
        <i class="fas fa-search search-icon"></i>
      </div>
  
      <div class="icon-buttons">
        <i class="fas fa-shopping-cart icon" aria-label="Cart"></i>
        <i class="fas fa-heart icon" aria-label="Wishlist"></i>
  
        <div class="icon-menu">
          <button @click="toggleMenu" aria-label="Toggle Menu">
            <i class="fas fa-bars icon"></i>
          </button>
  
          <transition name="slide-fade">
            <div v-if="isMenuOpen" class="selectMenu">
              <ul>
                <li
                  v-for="item in menuItems"
                  :key="item.id"
                  @click="selectItem(item)"
                  class="menu-item"
                >
                  <span class="menu-icon" v-html="item.icon"></span>
                  {{ item.label }}
                </li>
              </ul>
            </div>
          </transition>
        </div>
      </div>
    </nav>
  </template>
  
  <script>
  export default {
    name: 'Navbar',
    data() {
      return {
        isMenuOpen: false,
        menuItems: [
          { id: 1, label: 'Manage My Account', icon: '<i class="fa-solid fa-user"></i>', route:'/manage_Account' },
          { id: 2, label: 'My Order', icon: '<i class="fa-solid fa-bag-shopping"></i>', route: '/my-order' },
          { id: 3, label: 'My Review', icon: '<i class="fa-solid fa-star"></i>' , route:'/my_review'},
          { id: 4, label: 'Sign In/Sign Up', icon: '<i class="fa-solid fa-arrow-up-from-bracket"></i>', route: '/sign-in' }
        ]
      };
    },
    methods: {
      toggleMenu() {
        this.isMenuOpen = !this.isMenuOpen;
      },
      selectItem(item) {
        console.log('Selected:', item.label);
        this.isMenuOpen = false;
        if (item.route) {
          this.$router.push(item.route);
        }
      }
    }
  };
  </script>
  
    
    <style scoped>
    .navbar {
        width: 100%;
        background-color: #f8f7f3;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.5rem 2%;
        font-family: 'IBM Plex Sans Condensed', sans-serif;
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
        gap: 2rem;
        list-style: none;
        padding: 0;
        margin: 10px 0;
    }
    
    .nav-links li {
        font-size: 1.125rem;
    }
    
    .nav-links a {
        text-decoration: none;
        color: inherit;
    }
    
    .router-link-exact-active {
        font-weight: bold;
        border-bottom: 2px solid black;
    }
    
    .search-section {
        display: flex;
        align-items: center;
        background: #f0efeb;
        border-radius: 20px;
        padding: 0.3rem 1rem;
        margin: 10px 0;
    }
    
    .search-section input {
        border: none;
        background: transparent;
        outline: none;
        font-family: inherit;
        width: 16rem;
    }
    
    .search-icon {
        margin-left: 10px;
    }
    
    .icon-buttons {
        display: flex;
        gap: 15px;
        align-items: center;
    }
    
    .icon {
        font-size: 1.2rem;
        cursor: pointer;
    }
    
    .icon-menu {
        position: relative;
    }
    
    .selectMenu {
        position: absolute;
        top: 2rem;
        right: 0;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 6px;
        min-width: 180px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        z-index: 1000;
    }
    
    .selectMenu ul {
        list-style: none;
        margin: 0;
        padding: 0;
    }
    
    .menu-item {
        padding: 12px 16px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .menu-item:hover {
        background-color: #f0f0f0;
    }
    
    .menu-icon {
        display: inline-block;
        font-size: 1rem;
    }
    
    /* Transition */
    .slide-fade-enter-active,
    .slide-fade-leave-active {
        transition: all 0.3s ease;
    }
    
    .slide-fade-enter-from,
    .slide-fade-leave-to {
        transform: translateY(-10px);
        opacity: 0;
    }
    
    /* Responsive */
    @media (max-width: 1024px) {
        .navbar {
        flex-direction: column;
        align-items: flex-start;
        }
    
        .nav-links {
        width: 100%;
        justify-content: flex-start;
        gap: 1.2rem;
        }
    
        .search-section,
        .icon-buttons {
        width: 100%;
        justify-content: flex-start;
        margin-top: 10px;
        }
    
        .search-section input {
        width: 100%;
        }
    }
    
    @media (max-width: 600px) {
        .brand-name {
        font-size: 1.3rem;
        }
    
        .nav-links {
        flex-direction: column;
        gap: 10px;
        }
    }
    </style>
    