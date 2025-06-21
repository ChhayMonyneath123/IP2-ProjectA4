<template>
    <div class="card">

        <div class="profile">
          <div class="class-image">
            <img :src="profile.avatar" class="avatar" alt="User" />
          </div>
          <div class="class-text">
            <h2>{{ profile.name }}</h2>
            <p>Administrator</p>
            <button @click="goToEdit">Edit</button>
          </div>
        </div>

        <div class="info">
          <h3>Personal Information</h3>
          <p>Email: <a :href="'mailto:' + profile.email">{{ profile.email }}</a></p>
          <p>Contact: {{ profile.phone }}</p>

          <hr class="line" />

          <h3>Account Restriction</h3>
          <div class="toggles">
            <label><input type="checkbox" /> Allow resetting password</label>
            <label><input type="checkbox" /> Allow user create new account</label>
          </div>
        </div>

        <button class="logout">Log Out</button>
    </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { useRouter } from 'vue-router';
import { eventBus } from '@/eventBus';

const router = useRouter();
function goToEdit() {
  router.push({ name: 'EditAccount' });
}

const profile = ref({
  name: 'Jonh Smith',
  email: 'jonhSmith123@gmail.com',
  phone: '+855 12 336 992',
  avatar: '/src/assets/logofood_station.png',
});

function handleAccountUpdate(data) {
  profile.value = {
    ...profile.value,
    ...data,
  };
}

onMounted(() => {
  eventBus.on('accountUpdated', handleAccountUpdate);
});
onUnmounted(() => {
  eventBus.off('accountUpdated', handleAccountUpdate);
});
</script>

<style scoped>
.card {
  background: #fff;
  padding: 20px;
  display: block;
  margin: 20px;
}
.profile {
  display: flex;
  margin: 20px;
  gap: 40px;
}
.profile .avatar {
  width: 120px;
  border-radius: 50%;
}
.profile button {
  margin-top: 10px;
  padding: 6px 12px;
  background: #d6c697;
  border-radius: 10px;
  border: none;
  cursor: pointer;
  width: 80px;
  height: 40px;
}
.profile button:hover {
  background: #c5b27f;
}
.info {
  flex: 1;
  display: block;
  margin-left: 50px;
  margin-top: 60px;
}
.toggles label {
  display: block;
  margin-top: 30px;
}
.logout {
  position: absolute;
  bottom: 20px;
  right: 20px;
  background: #d20000;
  color: white;
  border: none;
  border-radius: 5px;
  padding: 10px 20px;
  cursor: pointer;
}
.logout:hover {
  background: #b20000;
}
.line {
  border: none;
  height: 1px;
  background-color: black;
  margin: 40px 0;
}
</style>