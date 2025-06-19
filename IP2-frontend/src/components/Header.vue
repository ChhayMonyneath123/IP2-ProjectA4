<template>
    <nav class="navbar">
        <div class="logo-section">
        <!-- Use public folder or import for image -->
        <img src="../assets/logo/logo.png" alt="La Libre Logo" class="logo" />
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
        <i class="fas fa-bars icon" aria-label="Menu"></i>
        </div>
    </nav>
    </template>
    
    <script>
    export default {
    name: 'Navbar'
    }
    </script>
    
    <style scoped>
        .navbar {
        width: 100%;
        background-color: #f8f7f3;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 5px 2%;
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
        gap: 40px;
        list-style: none;
        margin: 10px 0;
        padding: 0;
        flex-wrap: wrap;
        }
    
        .nav-links li {
        font-size: 1.125rem;
        white-space: nowrap;
        }
    
        .nav-links a {
        text-decoration: none;
        color: inherit;
        }
    
        .nav-links a.router-link-exact-active {
        font-weight: bold;
        border-bottom: 2px solid black;
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
        margin-left: 10px;
        }
    
        .icon-buttons {
        display: flex;
        gap: 20px;
        align-items: center;
        }
    
        .icon {
        font-size: 1.2rem;
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
        }
    </style>