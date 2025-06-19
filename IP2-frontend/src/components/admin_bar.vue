<template>
  <nav class="navbar" role="navigation" aria-label="Main Navigation">
    <div class="left-section">
      <div class="logo-section">
        <img src="@/assets/logofood_station.png" alt="La Libre Logo" class="logo" />
        <span class="brand-name">La Libre</span>
      </div>

      <span class="title" aria-live="polite">{{ currentTitle }}</span>

      <div class="nav-items" role="tablist" aria-label="Navigation Tabs">
        <button
          v-for="item in navItems"
          :key="item.id"
          :class="['nav-button', { active: activeScreen === item.id }]"
          @click="setActiveScreen(item.id)"
          role="tab"
          :aria-selected="activeScreen === item.id"
          tabindex="0"
        >
          {{ item.label }}
        </button>
      </div>
    </div>

    <div class="right-section">
      <button class="icon-button" title="Notifications" aria-label="Notifications">🔔</button>
      <button class="icon-button" title="Messages" aria-label="Messages">💬</button>
      <img class="avatar" src="https://i.pravatar.cc/40" alt="User Avatar" />
    </div>
  </nav>
</template>

<script setup>
import { ref, computed } from 'vue';

const navItems = [
  { id: 'dashboard', label: 'Dashboard' },
  { id: 'profile', label: 'Profile' },
  { id: 'messages', label: 'Messages' },
  { id: 'settings', label: 'Settings' },
];

const activeScreen = ref('dashboard');

function setActiveScreen(id) {
  activeScreen.value = id;
}

const currentTitle = computed(() => {
  const found = navItems.find(item => item.id === activeScreen.value);
  return found ? found.label : '';
});
</script>

<style scoped>
.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px 20px;
  border-bottom: 1px solid #ddd;
  font-family: Arial, sans-serif;
  flex-wrap: wrap;
}

.left-section {
  display: flex;
  align-items: center;
  flex-wrap: wrap;
  gap: 20px;
  flex-grow: 1;
}

.logo-section {
  display: flex;
  align-items: center;
  gap: 10px;
  min-width: 150px;
}

.logo {
  height: 40px;
  object-fit: contain;
}

.brand-name {
  font-weight: bold;
  font-size: 20px;
  white-space: nowrap;
}

.title {
  font-size: 20px;
  font-weight: bold;
  min-width: 120px;
}

.nav-items {
  display: flex;
  gap: 15px;
  flex-wrap: wrap;
}

.nav-button {
  background: none;
  border: none;
  cursor: pointer;
  font-size: 16px;
  padding: 8px 12px;
  transition: color 0.2s, border-bottom 0.2s;
  border-bottom: 2px solid transparent;
  color: #333;
}

.nav-button:hover,
.nav-button:focus-visible {
  color: #555;
  outline: none;
}

.nav-button.active {
  font-weight: 600;
  border-bottom: 2px solid black;
  color: black;
}

.right-section {
  display: flex;
  align-items: center;
  gap: 15px;
  margin-top: 10px;
}

.icon-button {
  font-size: 20px;
  background: none;
  border: none;
  cursor: pointer;
  padding: 5px;
  color: #333;
  transition: color 0.2s;
}

.icon-button:hover,
.icon-button:focus-visible {
  color: #000;
  outline: none;
}

.avatar {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  cursor: pointer;
  object-fit: cover;
}

@media (max-width: 600px) {
  .navbar {
    flex-direction: column;
    align-items: flex-start;
  }

  .right-section {
    margin-top: 15px;
    width: 100%;
    justify-content: flex-start;
    gap: 20px;
  }

  .nav-items {
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 10px;
  }
}
</style>
