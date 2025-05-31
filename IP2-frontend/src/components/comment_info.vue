<template>
  <div class="comment-form">
    <h3>Leave a Comment</h3>
    <p>Please feel free to give us a feedback!</p>

    <div class="user-info">
      <img :src="user.avatar" class="avatar" />
      <div class="container">
        <strong>{{ user.name }}</strong>
        <p class="date">{{ user.date }}</p>
        <div class="wrapper">
          <p class="label">Your Rating:</p>
          <div class="stars">
            <i v-for="n in 5" :key="n" class="fas fa-star" :class="{ selected: n <= form.rating }"
              @click="form.rating = n"></i>
          </div>
        </div>

      </div>
    </div>

    <textarea v-model="form.comment" placeholder="Your Message" />
    <button @click="submit">Submit Comment</button>
  </div>
</template>

<script>
export default {
  name: 'Commentinfo',
  data() {
    return {
      form: {
        rating: 0,
        comment: ''
      },
      user: {
        name: 'Ella Mondre',
        date: 'March 14, 2025',
        avatar: 'https://randomuser.me/api/portraits/women/45.jpg'
      }
    };
  },
  methods: {
    submit() {
      if (this.form.rating && this.form.comment) {
        this.$emit('submit', {
          ...this.form,
          name: this.user.name,
          date: this.user.date,
          avatar: this.user.avatar
        });
        this.form.rating = 0;
        this.form.comment = '';
      } else {
        alert('Please complete all fields.');
      }
    }
  }
};
</script>

<style scoped>
.comment-form {
  margin-top: 40px;
  margin-bottom: 10%;


}

h3 {
  font-size: 28px;
  margin-bottom: 2px;
  color: #402E2E;
}

.user-info {
  display: flex;
  gap: 12px;
  margin: 10px 0;
  margin-top: 40px;
}


.avatar {
  width: 60px;
  height: 60px;
  border-radius: 50%;
}

.date {
  font-size: 10px;
  margin-top: 0px;
  color: #888;
}
.wrapper{
  display: flex;
  flex-direction: row;
  gap: 10px;
}

.label {
  font-size: 13px;
  margin-top: 0px;
  font-weight: 500;
  
}

.stars {
  font-size: 16px;
  margin-top: 0px;
  color: #ccc;
}

.stars .selected {
  color: #f7b400;
  cursor: pointer;
}

textarea {
  width: 98.5%;
  height: 120px;
  padding: 10px;
  font-size: 14px;
  border-radius: 4px;
  border: 1px solid #31261B;
  resize: vertical;
}

button {
  margin-top: 15px;
  padding: 10px 30px;
  display: flex;
  margin-left: 90%;
  background-color: #31261B;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

button:hover {
  background-color: #2c241f;
}
</style>