<template>
  <div class="Manage-Account">
    <Nav_bar />
    <Breadcrumb />
    <div class="account-settings">
      <aside class="sidebar">
        <button class="btn btn-primary">My Profile</button>
        <button class="btn btn-secondary" @click="logout">
          <span>⏎</span> Logout
        </button>
      </aside>

      <section class="form-section">
        <h2>Manage My Account</h2>

        <form @submit.prevent="isEditing ? saveChanges() : null">
          <div class="form-grid">
            <div class="form-left">
              <label>User Name
                <input :readonly="!isEditing" v-model="form.username" type="text" />
              </label>
              <label>Birthday
                <input :readonly="!isEditing" v-model="form.birthday" type="date" />
              </label>
              <label>Email Address
                <input :readonly="!isEditing" v-model="form.email" type="email" />
              </label>
              <label>Phone Number
                <input :readonly="!isEditing" v-model="form.phone" placeholder="Ex:012 345 567" type="text" />
              </label>
              <label>Bio
                <textarea :readonly="!isEditing" v-model="form.bio" placeholder="Type something about you" />
              </label>
            </div>

            <div class="form-right">
              <div class="photo-section">
                <img :src="form.photo || defaultPhoto" class="profile-pic" />
                <input type="file" @change="onPhotoChange" hidden ref="photoInput" :disabled="!isEditing" />
                <button type="button" @click="$refs.photoInput.click()" v-if="isEditing">Change your photo</button>
                <button type="button" class="danger" @click="removePhoto" v-if="isEditing">Delete your photo</button>
              </div>

              <label>Old Password
                <input :readonly="!isEditing" v-model="form.oldPassword" type="password" />
              </label>
              <label>New Password
                <input :readonly="!isEditing" v-model="form.newPassword" type="password" />
              </label>
              <label>Confirm Password
                <input :readonly="!isEditing" v-model="form.confirmPassword" type="password" />
              </label>
            </div>
          </div>

          <div class="button-row">
            <button v-if="!isEditing" type="button" class="edit-button" @click="toggleEdit">
              ✏️ Edit Info
            </button>
            <button v-if="isEditing" type="button" class="cancel-button" @click="cancelEdit">
              ✖ Cancel
            </button>
            <button v-if="isEditing" type="submit" class="save-button">
              💾 Save Change
            </button>
          </div>
        </form>
      </section>
    </div>
    <Footer_bar />
  </div>
</template>

<script>
import axios from 'axios';
import Nav_bar from '@/components/nav_bar.vue';
import Footer_bar from '@/components/footer_bar.vue';
import Breadcrumb from '@/components/breadcrumb.vue';

export default {
  name: 'manage_acc',
  components: {
    Nav_bar,
    Footer_bar,
    Breadcrumb
  },
  data() {
    return {
      isEditing: false,
      defaultPhoto: 'https://via.placeholder.com/120',
      form: {
        username: '',
        birthday: '',
        email: '',
        phone: '',
        bio: '',
        photo: '',
        oldPassword: '',
        newPassword: '',
        confirmPassword: ''
      },
      originalForm: null
    };
  },
  methods: {
    toggleEdit() {
      this.originalForm = JSON.parse(JSON.stringify(this.form));
      this.isEditing = true;
    },
    async saveChanges() {
      try {
        const token = localStorage.getItem('authToken');
        const response = await axios.put(
          'http://localhost:8000/api/user/profile',
          this.form,
          {
            headers: {
              Authorization: `Bearer ${token}`,
              'Content-Type': 'application/json'
            }
          }
        );
        alert('Changes saved successfully!');
        console.log(response.data);
        this.isEditing = false;
        this.originalForm = null;
      } catch (error) {
        alert('Failed to save changes.');
        console.error(error);
      }
    },
    cancelEdit() {
      if (this.originalForm) {
        this.form = JSON.parse(JSON.stringify(this.originalForm));
      }
      this.isEditing = false;
      this.originalForm = null;
    },
    async loadUser() {
      try {
        const token = localStorage.getItem('authToken');
        const response = await axios.get('http://localhost:8000/api/userss', {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });
        const user = response.data;
        this.form.username = user.name;
        this.form.email = user.email;
      } catch (error) {
        alert('Failed to load user data.');
        console.error(error);
      }
    },
    onPhotoChange(event) {
      const file = event.target.files[0];
      if (file) {
        this.form.photo = URL.createObjectURL(file);
        // In real app: handle file upload to backend
      }
    },
    removePhoto() {
      this.form.photo = '';
    },
    logout() {
      localStorage.removeItem('authToken');
      this.$router.push('/login');
    }
  },
  created() {
    this.loadUser();
  }
};
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