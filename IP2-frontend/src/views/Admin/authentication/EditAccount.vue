<template>
  <div class="edit-account">
    <h2>Account</h2>
    <p>Settings your detail account here</p>
    <hr />

    <h3>My Profile</h3>

    <div class="profile-section">
      <div class="avatar-wrapper">
        <img :src="previewImage || defaultImage" alt="Profile" class="avatar" />
        <input type="file" ref="fileInput" @change="handleFileChange" hidden />
        <div class="button-group">
          <button class="btn green" @click="triggerFileInput">Upload</button>
          <button class="btn" @click="deleteImage">Delete</button>
        </div>
      </div>
    </div>

    <form class="form-grid" @submit.prevent="submitForm">
      <input type="text" v-model="form.firstName" placeholder="First Name" />
      <input type="text" v-model="form.lastName" placeholder="Last Name" />
      <input type="text" v-model="form.phone" placeholder="Phone Number" />
      <input type="email" v-model="form.email" placeholder="Email Address" />
      <input type="date" v-model="form.birthDate" placeholder="Birth Date" />
      <div class="password-wrapper">
            <input :type="showPassword ? 'text' : 'password'" v-model="form.password" placeholder="Password" />
            <span class="toggle" @click="togglePassword">
                <i :class="showPassword ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
            </span>
      </div>
    </form>

    <hr />

    <div class="footer-buttons">
      <button class="btn" @click="cancel">Cancel</button>
      <button class="btn green" type="submit" @click="submitForm">Save</button>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { eventBus } from '@/eventBus';

const router = useRouter();
const fileInput = ref(null);
const defaultImage = new URL('@/assets/logofood_station.png', import.meta.url).href;
const previewImage = ref(null);

const form = ref({
  firstName: '',
  lastName: '',
  email: '',
  phone: '',
  birthDate: '',
  password: '',
  avatar: '',
});

const showPassword = ref(false);

function togglePassword() {
  showPassword.value = !showPassword.value;
}

function triggerFileInput() {
  if (fileInput.value) {
    fileInput.value.click();
  }
}

function handleFileChange(e) {
  const file = e.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = () => {
      previewImage.value = reader.result;
      form.value.avatar = reader.result;
    };
    reader.readAsDataURL(file);
  }
}

function deleteImage() {
  previewImage.value = null;
  form.value.avatar = '';
}

function cancel() {
  router.push('/admin/manage-account');
}

function submitForm() {
  const updatedData = {
    firstName: form.value.firstName,
    lastName: form.value.lastName,
    name: `${form.value.firstName} ${form.value.lastName}`,
    email: form.value.email,
    phone: form.value.phone,
    birthDate: form.value.birthDate,
    password: form.value.password,
    avatar: form.value.avatar || defaultImage,
  };

  eventBus.emit('accountUpdated', updatedData);
  router.push('/admin/manage-account');
}
</script>

<style scoped>
.edit-account {
  padding: 2rem;
  max-width: 800px;
  margin-left: 1rem;
}
p {
  color: gray;
}
h2 {
  font-size: 1.8rem;
}
h3 {
  margin-top: 1.5rem;
}
hr {
  margin: 1rem 0;
}
.profile-section {
  display: flex;
  align-items: center;
  gap: 1rem;
}
.avatar-wrapper {
  display: flex;
  align-items: center;
  gap: 1rem;
}
.avatar {
  width: 80px;
  height: 80px;
  border-radius: 50%;
  object-fit: cover;
}
.button-group {
  display: flex;
  gap: 0.5rem;
}
.btn {
  padding: 0.5rem 1rem;
  border: 1px solid #ccc;
  background: white;
  cursor: pointer;
  border-radius: 4px;
}
.btn.green {
  background: #0f7c3e;
  color: white;
  border: none;
}
.form-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 1rem;
  margin-top: 1.5rem;
}
input {
  padding: 0.5rem;
  font-size: 1rem;
  border: 1px solid #ccc;
  border-radius: 4px;
}
.password-wrapper {
  position: relative;
  width: 100%;
}
.password-wrapper input {
  width: 100%;
  padding-right: 2.5rem;
  box-sizing: border-box;
}
.password-wrapper .toggle {
  position: absolute;
  right: 10px;
  top: 8px;
  cursor: pointer;
}
.footer-buttons {
  display: flex;
  justify-content: flex-end;
  gap: 1rem;
  margin-top: 1.5rem;
}
</style>
