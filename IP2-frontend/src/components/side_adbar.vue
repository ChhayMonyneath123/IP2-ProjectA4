<template>
  <nav class="sidebar">
    <ul>
      <li
        v-for="item in menuItems"
        :key="item.name"
        :class="['menu-item', item.iconClass, { active: isActiveRoute(item.route) }]"
      >
        <router-link :to="item.route" class="menu-link">
          <span class="icon"></span>
          <span class="label">{{ item.name }}</span>
        </router-link>
      </li>
    </ul>
    <div class="version">v1.0.0</div>
  </nav>
</template>

<script>
export default {
  name: "Sidebar",
  data() {
    return {
      menuItems: [
        { name: "Dashboard", route: "/dashboard", iconClass: "icon-dashboard" },
        { name: "Orders", route: "/orders", iconClass: "icon-orders" },
        { name: "Stocks", route: "/stocks", iconClass: "icon-stocks" },
        { name: "Delivery", route: "/delivery", iconClass: "icon-delivery" },
        { name: "Users", route: "/users", iconClass: "icon-users" },
        { name: "Reviews", route: "/reviews", iconClass: "icon-reviews" },
        { name: "Chats", route: "/chats", iconClass: "icon-chats" },
        { name: "Manage Account", route: "/manage-account", iconClass: "icon-manage" },
      ],
    };
  },
  methods: {
    isActiveRoute(route) {
      return this.$route.path === route;
    },
  },
};
</script>

<style scoped>
.sidebar {
  width: 220px;
  background-color: #f7f5f0;
  padding: 16px 0;
  display: flex;
  flex-direction: column;
  height: 100vh;
  box-sizing: border-box;
  border-right: 1px solid #ddd;
  font-family: Arial, sans-serif;
}

ul {
  list-style: none;
  padding: 0;
  margin: 0;
  flex-grow: 1;
}

.menu-item {
  margin: 0;
}

.menu-link {
  display: flex;
  align-items: center;
  padding: 12px 24px;
  color: #333;
  text-decoration: none;
  font-size: 14px;
  gap: 12px;
  font-weight: 400;
}

.menu-item.active .menu-link {
  background-color: #d5cfa9;
  font-weight: 600;
  color: #000;
}

.menu-link:hover {
  background-color: #e6e1cc;
  color: #000;
}

.icon {
  display: inline-block;
  width: 18px;
  height: 18px;
  position: relative;
  background: transparent;
}

/* Dashboard icon: 4 squares */
.icon-dashboard::before,
.icon-dashboard::after,
.icon-dashboard > span::before,
.icon-dashboard > span::after {
  content: "";
  position: absolute;
  width: 6px;
  height: 6px;
  background: #333;
  border-radius: 1px;
}
.icon-dashboard::before {
  top: 0;
  left: 0;
}
.icon-dashboard::after {
  top: 0;
  right: 0;
}
.icon-dashboard > span::before {
  bottom: 0;
  left: 0;
}
.icon-dashboard > span::after {
  bottom: 0;
  right: 0;
}

/* Orders icon: 3 horizontal lines */
.icon-orders::before,
.icon-orders::after,
.icon-orders > span::before {
  content: "";
  position: absolute;
  height: 2px;
  width: 14px;
  background: #333;
  left: 2px;
  border-radius: 1px;
}
.icon-orders::before {
  top: 4px;
}
.icon-orders::after {
  top: 9px;
}
.icon-orders > span::before {
  top: 14px;
}

/* Stocks icon: bars */
.icon-stocks::before,
.icon-stocks::after,
.icon-stocks > span::before {
  content: "";
  position: absolute;
  bottom: 0;
  width: 4px;
  background: #333;
  border-radius: 1px;
}
.icon-stocks::before {
  height: 10px;
  left: 2px;
}
.icon-stocks::after {
  height: 14px;
  left: 8px;
}
.icon-stocks > span::before {
  height: 6px;
  left: 14px;
}

/* Delivery icon: rectangle + wheels */
.icon-delivery {
  background: #333;
  border-radius: 2px;
  height: 10px;
  width: 16px;
  position: relative;
}
.icon-delivery::before,
.icon-delivery::after {
  content: "";
  position: absolute;
  bottom: -4px;
  background: #333;
  border-radius: 50%;
  width: 6px;
  height: 6px;
}
.icon-delivery::before {
  left: 2px;
}
.icon-delivery::after {
  right: 2px;
}

/* Users icon: circle + half ellipse */
.icon-users::before,
.icon-users::after {
  content: "";
  position: absolute;
  background: #333;
  border-radius: 50%;
}
.icon-users::before {
  width: 10px;
  height: 10px;
  top: 0;
  left: 4px;
}
.icon-users::after {
  width: 14px;
  height: 6px;
  bottom: 0;
  left: 2px;
  border-radius: 8px / 4px;
}

/* Reviews icon: star (simple triangle) */
.icon-reviews::before,
.icon-reviews::after {
  content: "";
  position: absolute;
  background: transparent;
  border-style: solid;
  border-width: 0 7px 12px 7px;
  border-color: transparent transparent #333 transparent;
  top: 0;
  left: 1px;
  clip-path: polygon(50% 0%, 61% 35%, 98% 35%, 68% 57%, 79% 91%, 50% 70%, 21% 91%, 32% 57%, 2% 35%, 39% 35%);
}

/* Chats icon: speech bubble */
.icon-chats {
  width: 18px;
  height: 14px;
  background: #333;
  border-radius: 4px 4px 4px 0;
  position: relative;
}
.icon-chats::after {
  content: "";
  position: absolute;
  bottom: -5px;
  left: 4px;
  width: 0;
  height: 0;
  border-top: 5px solid #333;
  border-left: 5px solid transparent;
}

/* Manage Account icon: circle + gear teeth */
.icon-manage::before,
.icon-manage::after {
  content: "";
  position: absolute;
  background: #333;
  border-radius: 50%;
}
.icon-manage::before {
  width: 10px;
  height: 10px;
  top: 4px;
  left: 4px;
  box-shadow: 0 -6px 0 0 #333, 0 6px 0 0 #333, -6px 0 0 0 #333, 6px 0 0 0 #333;
}
.icon-manage::after {
  width: 6px;
  height: 6px;
  top: 7px;
  left: 7px;
  background: #f7f5f0;
}

.label {
  flex-grow: 1;
}
.version {
  text-align: center;
  font-size: 12px;
  color: #999;
  padding: 8px 0;
}
</style>
