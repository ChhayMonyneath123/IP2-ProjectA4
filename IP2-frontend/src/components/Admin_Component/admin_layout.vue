<template>
  <div class="admin-layout">
    <aside class="sidebar">
      <div class="sidebar-header">
        <img
          src="@/assets/logofood_station.png"
          alt="Logo"
          class="sidebar-logo-icon"
        />
        <span class="sidebar-logo-text">La Libre</span>
      </div>
      <nav class="sidebar-nav">
        <ul>
          <li>
            <router-link
              to="/admin/dashboard"
              class="nav-item"
              active-class="active"
            >
              <i class="fas fa-tachometer-alt icon"></i>
              <span class="nav-text">Dashboard</span>
            </router-link>
          </li>
          <li>
            <router-link
              to="/admin/orders"
              class="nav-item"
              active-class="active"
            >
              <i class="fas fa-shopping-cart icon"></i>
              <span class="nav-text">Orders</span>
            </router-link>
          </li>
          <li>
            <router-link
              to="/admin/stocks"
              class="nav-item"
              active-class="active"
            >
              <i class="fas fa-boxes icon"></i>
              <span class="nav-text">Stocks</span>
            </router-link>
          </li>
          <li>
            <router-link
              to="/admin/delivery"
              class="nav-item"
              active-class="active"
            >
              <i class="fas fa-truck icon"></i>
              <span class="nav-text">Delivery</span>
            </router-link>
          </li>
          <li>
            <router-link
              to="/admin/users"
              class="nav-item"
              active-class="active"
            >
              <i class="fas fa-users icon"></i>
              <span class="nav-text">Users</span>
            </router-link>
          </li>
          <li>
            <router-link
              to="/admin/reviews"
              class="nav-item"
              active-class="active"
            >
              <i class="fas fa-star icon"></i>
              <span class="nav-text">Reviews</span>
            </router-link>
          </li>
          <li>
            <router-link
              to="/admin/chats"
              class="nav-item"
              active-class="active"
            >
              <i class="fas fa-comments icon"></i>
              <span class="nav-text">Chats</span>
            </router-link>
          </li>
          <li>
            <router-link
              to="/admin/manage-account"
              class="nav-item"
              active-class="active"
            >
              <i class="fas fa-user-cog icon"></i>
              <span class="nav-text">Manage Account</span>
            </router-link>
          </li>
        </ul>
      </nav>
      <div class="sidebar-version">v10.00</div>
    </aside>

    <main class="main-content">
      <header class="top-header">
        <div class="header-left">
          <div class="header-icon-text">
            <!-- <img :src="currentHeaderIcon" :alt="currentHeaderText" class="header-main-icon" />  -->
            <span>{{ currentHeaderText }}</span>
          </div>
        </div>
        <div class="header-right">
          <div class="header-icon-wrapper notification-icon">
            <i class="fas fa-bell"></i>
          </div>
          <div class="header-icon-wrapper profile-icon">
            <i class="fas fa-message"></i>
          </div>
          <div class="header-icon-wrapper profile-icon">
            <img src="@/assets/images/profile.jpg" alt="Profile Icon" />
          </div>
        </div>
      </header>

      <router-view/>
    </main>
  </div>
</template>

<script>
import DashboardPage from "@/views/Admin/authentication/DashboardPage.vue";

export default {
  name: "Admin_Layout", // Component name matching the file path
  computed: {
    currentHeaderText() {
      // Get the name of the current route and display it as header text
      const routeName = this.$route.name;
      // Optional: prettify the name for display
      if (routeName) {
        // This regex adds space before capital letters (e.g., "ManageAccount" -> "Manage Account")
        return routeName.replace(/([A-Z])/g, " $1").trim();
      }
      return "Dashboard"; // Default if route name is not found
    },
    currentHeaderIcon() {
      // Map route names to specific icon imports
      switch (this.$route.name) {
        case "Dashboard":
          return dashboardIcon;
        case "Reviews":
          return reviewIcon;
        case "Chats":
          return chatIcon;
        // Add cases for other routes and their respective icon imports:
        // case 'Orders': return ordersIcon;
        // case 'Stocks': return stocksIcon;
        // case 'Delivery': return deliveryIcon;
        // case 'Users': return usersIcon;
        // case 'ManageAccount': return manageAccountIcon;
        default:
          return DashboardPage; // Default icon if no match
      }
    },
  },
};
</script>

<style scoped>
/* Base layout styles */
.admin-layout {
  display: flex;
  min-height: 100vh;
  max-width: 100%; /* Ensures full width */
  background-color: #f8f8f8;
  font-family: "Arial", sans-serif;
}

/* Sidebar Styling */
.sidebar {
  width: 250px;
  background-color: #ffffff;
  box-shadow: 2px 0 5px rgba(0, 0, 0, 0.05);
  display: flex;
  flex-direction: column;
  padding: 20px 0;
  flex-shrink: 0;
}

.sidebar-header {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 0 20px 20px;
  border-bottom: 1px solid #eee;
  margin-bottom: 20px;
}

.sidebar-logo-icon {
  width: 40px;
  height: 40px;
  object-fit: contain;
}

.sidebar-logo-text {
  font-size: 1.4em;
  font-weight: bold;
  color: #2c3e50;
}

.sidebar-nav ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

.nav-item {
  display: flex;
  align-items: center;
  gap: 15px;
  padding: 12px 20px;
  text-decoration: none;
  color: #555;
  font-size: 1em;
  transition: background-color 0.2s, color 0.2s;
  border-left: 5px solid transparent;
}

.nav-item:hover {
  background-color: transparent;
}

.nav-item.active {
  background-color: #e0e0e0;
  color: #a08c79;
  font-weight: bold;
  border-left-color: #a08c79;
}

.nav-item .icon {
  width: 20px;
  height: 20px;
  border-radius: 3px;
}

.sidebar-version {
  margin-top: auto;
  padding: 20px;
  font-size: 0.8em;
  color: #bbb;
  text-align: center;
}

/* Main Content and Header Styling */
.main-content {
  flex-grow: 1;
  display: flex;
  flex-direction: column;
  width: 100%;
}

.top-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 20px 0;
  background-color: #ffffff;
  border-bottom: 1px solid #eee;
  margin-bottom: 20px;
  width: 100%; /* Force full viewport width */
  /* margin-left: 10vw; */
  position: relative; /* Needed for proper alignment */
}

.header-left {
  display: flex;
  align-items: center;
  gap: 15px;

}

.header-icon-text {
  display: flex;
  align-items: center;
  gap: 10px;
  font-size: 1.6em;
  font-weight: bold;
  color: #333;
  padding-left: 10px;
}

.header-main-icon {
  width: 30px;
  height: 30px;
  object-fit: contain;
}

.header-right {
  display: flex;
  align-items: center;
  gap: 20px;
}

.header-icon-wrapper {
  width: 35px;
  height: 35px;
  border-radius: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: #f0f0f0;
  cursor: pointer;
  transition: background-color 0.2s;
}

.header-icon-wrapper:hover {
  background-color: #e6e6e6;
}

.header-icon-wrapper img {
  width: 60%;
  height: 60%;
  object-fit: contain;
}


</style>
