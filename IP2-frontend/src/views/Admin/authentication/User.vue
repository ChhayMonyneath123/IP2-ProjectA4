<template>
  <div class="user-list">
    <h2>Users</h2>

    <p v-if="loading">Loading users...</p>
    <p v-if="error" class="error">{{ error }}</p>

    <table v-if="!loading && !error">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Role</th>
          <th>Created At</th>
          <th>Updated At</th>
          <th style="min-width: 180px;">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="user in users" :key="user.user_id">
          <td>{{ user.user_id }}</td>
          <td>
            <div v-if="editingUser && editingUser.user_id === user.user_id">
              <input v-model="editingUser.name" />
            </div>
            <div v-else>{{ user.name }}</div>
          </td>
          <td>
            <div v-if="editingUser && editingUser.user_id === user.user_id">
              <input v-model="editingUser.email" />
            </div>
            <div v-else>{{ user.email }}</div>
          </td>
          <td>
            <div v-if="editingUser && editingUser.user_id === user.user_id">
              <select v-model="editingUser.role">
                <option value="admin">Admin</option>
                <option value="user">User</option>
              </select>
            </div>
            <div v-else>{{ user.role }}</div>
          </td>
          <td>{{ formatDate(user.created_at) }}</td>
          <td>{{ formatDate(user.updated_at) }}</td>
          <td>
            <div v-if="editingUser && editingUser.user_id === user.user_id">
              <button class="action-btn save" @click="saveUser(editingUser)">💾 Save</button>
              <button class="action-btn cancel" @click="cancelEdit">❌ Cancel</button>
            </div>
            <div v-else>
              <button class="action-btn update" @click="startEdit(user)">✏️ Update</button>
              <button class="action-btn delete" @click="deleteUser(user.user_id)">🗑️ Delete</button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'UserList',
  data() {
    return {
      users: [],
      loading: false,
      error: null,
      editingUser: null,
    };
  },
  methods: {
    async fetchUsers() {
      this.loading = true;
      this.error = null;
      try {
        const response = await axios.get('http://localhost:8000/api/users');
        this.users = response.data;
      } catch (err) {
        this.error = err.response?.data?.message || err.message || 'Failed to load users';
      } finally {
        this.loading = false;
      }
    },
    formatDate(dateString) {
      if (!dateString) return '';
      const date = new Date(dateString);
      return date.toLocaleString();
    },
    startEdit(user) {
      this.editingUser = { ...user };
    },
    cancelEdit() {
      this.editingUser = null;
    },
    async saveUser(user) {
      try {
        await axios.put(`http://localhost:8000/api/users/${user.user_id}`, user);
        this.editingUser = null;
        this.fetchUsers();
      } catch (err) {
        alert(err.response?.data?.message || 'Failed to update user.');
        console.error(err);
      }
    },
    async deleteUser(user_id) {
      if (!confirm('Are you sure you want to delete this user?')) return;
      try {
        await axios.delete(`http://localhost:8000/api/users/${user_id}`);
        this.fetchUsers();
      } catch (err) {
        alert(err.response?.data?.message || 'Failed to delete user.');
        console.error(err);
      }
    },
  },
  created() {
    this.fetchUsers();
  },
};
</script>

<style scoped>
.user-list {
  max-width: 1000px;
  margin: 30px auto;
  font-family: Arial, sans-serif;
}

.error {
  color: red;
  margin: 10px 0;
}

table {
  width: 100%;
  border-collapse: collapse;
}

thead th {
  background-color: #eee;
  padding: 12px;
  text-align: left;
  border-bottom: 2px solid #ccc;
}

tbody td {
  padding: 12px;
  border-bottom: 1px solid #ddd;
}

tbody tr:hover {
  background-color: #f9f9f9;
}

input,
select {
  width: 100%;
  padding: 8px;
  box-sizing: border-box;
}

.action-btn {
  font-size: 16px;
  padding: 8px 10px;
  border-radius: 6px;
  color: white;
  border: none;
  margin: 5px 5px 5px 0;
  cursor: pointer;
}

.action-btn.update {
  background-color: #007bff;
}

.action-btn.save {
  background-color: #28a745;
}

.action-btn.cancel {
  background-color: #6c757d;
}

.action-btn.delete {
  background-color: #dc3545;
}
</style>
