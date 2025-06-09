<template>
    <div class="Manage-Account">
        <Nav_bar />
        <Breadcrumb />
        <div class="account-settings">
            <!-- Sidebar -->
            <aside class="sidebar">
                <button class="btn btn-primary">My Profile</button>
                <button class="btn btn-secondary">
                    <span>⏎</span> Logout
                </button>
            </aside>

            <!-- Main Content -->
            <section class="form-section">
                <h2>Manage My Account</h2>

                <form @submit.prevent="isEditing ? saveChanges() : null">
                    <div class="form-grid">
                        <!-- Left Column -->
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
                                <input :readonly="!isEditing" v-model="form.phone" placeholder="Ex:012 345 567"
                                    type="text" />
                            </label>

                            <label>Bio
                                <textarea :readonly="!isEditing" v-model="form.bio"
                                    placeholder="Type something about you" />
                            </label>
                        </div>

                        <!-- Right Column -->
                        <div class="form-right">
                            <div class="photo-section">
                                <img :src="form.photo || defaultPhoto" class="profile-pic" />
                                <input type="file" @change="onPhotoChange" hidden ref="photoInput"
                                    :disabled="!isEditing" />
                                <button type="button" @click="$refs.photoInput.click()" v-if="isEditing">Change your
                                    photo</button>
                                <button type="button" class="danger" @click="removePhoto" v-if="isEditing">Delete your
                                    photo</button>
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

                    <!-- Button Area -->
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
import Nav_bar from '@/components/nav_bar.vue';
import Footer_bar from '@/components/footer_bar.vue';
import Breadcrumb from '@/components/breadcrumb.vue';

export default {
  name: "manage_acc",
  components: {
    Footer_bar,
    Nav_bar,
    Breadcrumb
  },
  data() {
    return {
      isEditing: false,
      defaultPhoto: 'https://via.placeholder.com/120',
      form: {
        username: 'Mary123',
        birthday: '2000-01-01',
        email: 'mary123@gmail.com',
        phone: '',
        bio: '',
        photo: '',
        oldPassword: '',
        newPassword: '',
        confirmPassword: ''
      },
      originalForm: null // <--- stores a copy for cancel
    };
  },
  methods: {
    toggleEdit() {
      // Deep copy current form into originalForm
      this.originalForm = JSON.parse(JSON.stringify(this.form));
      this.isEditing = true;
    },
    onPhotoChange(event) {
      const file = event.target.files[0];
      if (file) {
        this.form.photo = URL.createObjectURL(file);
      }
    },
    removePhoto() {
      this.form.photo = '';
    },
    saveChanges() {
      console.log('Form submitted:', this.form);
      alert('Changes saved!');
      this.isEditing = false;
      this.originalForm = null; // clear backup after saving
    },
    cancelEdit() {
      if (this.originalForm) {
        this.form = JSON.parse(JSON.stringify(this.originalForm)); // restore from copy
      }
      this.isEditing = false;
      this.originalForm = null;
    }
  }
};
</script>


<style scoped>
.Manage-Account {
    background-color: #F8F7F3;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    font-family: 'Segoe UI', 'Roboto', sans-serif;
}

.account-settings {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    background-color: #fff;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
    width: 90%;
    margin: 30px auto;
    border-radius: 12px;
    overflow: hidden;
}

/* Sidebar */
.sidebar {
    width: 240px;
    padding: 30px 20px;
    background: #f2f0e8;
    display: flex;
    flex-direction: column;
    gap: 20px;
    border-right: 1px solid #e2e0db;
}

.btn {
    padding: 14px 20px;
    font-size: 16px;
    font-weight: 500;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-primary {
    background-color: #4a3c2a;
    color: #fff;
}

.btn-primary:hover {
    background-color: #3b2f1f;
}

.btn-secondary {
    background-color: #eae7e3;
    color: #333;
}

.btn-secondary:hover {
    background-color: #dad6d1;
}

/* Form Section */
.form-section {
    flex: 1;
    padding: 20px 50px;
}

.form-section h2 {
    font-size: 28px;
    margin-bottom: 50px;
    text-align: center;
    color: #3a3a3a;
}

.form-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 40px;
    justify-content: space-between;
}

/* Left and Right Columns */
.form-left,
.form-right {
    flex: 1;
    min-width: 320px;
    display: flex;
    flex-direction: column;
    gap: 24px;
}

label {
    font-weight: 600;
    font-size: 15px;
    color: #333;
    display: flex;
    flex-direction: column;
    gap: 6px;
}

input,
textarea {
    padding: 12px 16px;
    font-size: 15px;
    border: 1.5px solid #ccc;
    border-radius: 10px;
    background: #fff;
    transition: 0.2s border-color ease;
}

input:focus,
textarea:focus {
    outline: none;
    border-color: #4a3c2a;
}

textarea {
    resize: vertical;
    min-height: 100px;
}

/* Profile Picture */
.photo-section {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 12px;
    margin-bottom: 20px;
}

.profile-pic {
    width: 130px;
    height: 130px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #ccc;
    background-color: #f4f4f4;
}

.danger {
    color: #c0392b;
    font-size: 14px;
    background: none;
    border: none;
    cursor: pointer;
    text-decoration: underline;
    transition: 0.2s color;
}

.danger:hover {
    color: #a93226;
}

/* Buttons */
.button-row {
    display: flex;
    justify-content: flex-end;
    gap: 20px;
    margin-top: 40px;
}

.edit-button,
.save-button {
    font-size: 16px;
    padding: 14px 36px;
    font-weight: 600;
    border: none;
    border-radius: 12px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.edit-button {
    background-color: #4a3c2a;
    color: white;
}

.edit-button:hover {
    background-color: #726c65;
}

.save-button {
    background-color: #4a3c2a;
    color: white;
}

.save-button:hover {
    background-color: #726c65;
}
.cancel-button {
  font-size: 16px;
  padding: 14px 36px;
  font-weight: 600;
  border: none;
  border-radius: 12px;
  cursor: pointer;
  background-color: #cccccc;
  color: #333;
  transition: background-color 0.3s ease;
}

.cancel-button:hover {
  background-color: #b5b5b5;
}


/* Responsive */
@media (max-width: 960px) {
    .account-settings {
        flex-direction: column;
    }

    .sidebar {
        width: 100%;
        flex-direction: row;
        justify-content: center;
        gap: 24px;
        border-right: none;
        border-bottom: 1px solid #ddd;
    }

    .form-section {
        padding: 40px 24px;
    }

    .edit-button,
    .save-button,
    .cancel-button {
        width: 90%;
        max-width: 320px;
    }
}
</style>