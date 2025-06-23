<template>
  <div class="container">
    <div class="comment-form">
      <h3>Leave a Comment</h3>
      <p>Please feel free to give us a feedback!</p>

      <div class="user-info">
        <img :src="user.avatar" class="avatar" />
        <div class="user-meta">
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
      <div class="button-wrapper">
        <button @click="submit">Submit Comment</button>
      </div>
    </div>
  </div>
</template>


<script>
import axios from 'axios';

export default {
  name: 'Commentinfo',
  props: {
    productId: { type: Number, required: true }
  },
  data() {
    return {
      form: {
        rating: 0,
        comment: ''
      },
      user: {
        id: null,
        name: '',
        date: '',
        avatar: ''
      }
    };
  },
  mounted() {
    // Fetch logged-in user info on mount
    axios.get('http://localhost:8000/api/users')
      .then((response) => {
        const userData = response.data.data;
        this.user = {
          user_id: userData.user_id,
          name: userData.name,
          avatar: userData.avatar,
          date: new Date().toLocaleDateString()
        };
      })
      .catch((error) => {
        console.error('Failed to load user', error);
        this.user = {
          id: 0,
          name: "Guest",
          avatar: "https://randomuser.me/api/portraits/lego/1.jpg",
          date: new Date().toLocaleDateString()
        };
      });
  },
  methods: {
    submit() {
      if (this.form.rating && this.form.comment) {
        const payload = {
          rating: this.form.rating,
          comment: this.form.comment,
          user_id: this.user.id
        };

        axios.post(`/api/products/${productId}/ratings`, {
          rating: this.form.rating,
          comment: this.form.comment,
          user_id: this.user.id // required because no session/auth
        })
          .then(res => {
            this.$emit('submit', {
              ...this.form,
              name: this.user.name,
              date: this.user.date,
              avatar: this.user.avatar,
              id: res.data.data.id
            });

            this.form.rating = 0;
            this.form.comment = '';
          })
          .catch(err => {
            const message = err.response?.data?.message || 'Failed to submit review.';
            alert(message);
          });
      } else {
        alert('Please complete all fields.');
      }
    }
  }
};
</script>


<style scoped>
/* Global container match (same as Rating Overview) */
.container {
  max-width: 100vw;
  /* match other sections */
  margin: 0 auto;
  padding: 0 20px;
  box-sizing: border-box;
}

/* Comment form itself */
.comment-form {
  width: 100%;
  padding: 20px 30px;
  background-color: #ffffff;
  border: 1px solid #e0dcd5;
  border-radius: 14px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
  box-sizing: border-box;
  margin-top: 40px;
  display: flex;
  justify-content: center;
  flex-direction: column;
}

/* Headings */
h3 {
  font-size: 26px;
  margin-bottom: 6px;
  color: #402e2e;
  font-weight: 600;
}

p {
  margin: 0 0 16px 0;
  font-size: 15px;
  color: #555;
}

/* User section */
.user-info {
  display: flex;
  align-items: flex-start;
  gap: 16px;
  margin-bottom: 24px;

}

.avatar {
  width: 60px;
  height: 60px;
  border-radius: 50%;
  object-fit: cover;
}

.user-meta {
  flex: 1;
}

.date {
  font-size: 12px;
  color: #999;
  margin-top: 2px;
}

/* Rating stars */
.wrapper {
  display: flex;
  align-items: center;
  gap: 4px;
  /* reduced from 8px to 4px */
  line-height: 1;
  margin-top: 6px;
}

.label {
  font-size: 14px;
  color: #333;
  margin: 0;
  line-height: 1;
}

.stars {
  display: flex;
  align-items: center;
  gap: 2px;
  /* reduced from 4px to 2px */
  font-size: 17px;
  color: #ccc;
}

.stars .selected {
  color: #f7b400;
  cursor: pointer;
}


/* Textarea */
textarea {
  width: 98%;
  min-height: 120px;
  padding: 14px;
  font-size: 15px;
  border-radius: 6px;
  border: 1px solid #31261b;
  resize: vertical;
  font-family: inherit;
  transition: border-color 0.2s, box-shadow 0.2s;
}

textarea:focus {
  outline: none;
  border-color: #31261b;
  box-shadow: 0 0 6px rgba(56, 53, 43, 0.35);
  background-color: #fffef5;
}

/* Button wrapper and alignment */
.button-wrapper {
  display: flex;
  justify-content: flex-end;
  margin-top: 24px;
}

button {
  padding: 12px 24px;
  background-color: #31261b;
  color: white;
  border: none;
  border-radius: 6px;
  font-weight: 500;
  font-size: 14px;
  cursor: pointer;
  transition: background-color 0.2s ease;
}

button:hover {
  background-color: #2c241f;
}

/* Responsive */
@media (max-width: 768px) {
  .comment-form {
    padding: 24px;
  }

  .wrapper {
    flex-direction: column;
    align-items: flex-start;
  }

  .button-wrapper {
    justify-content: center;
  }
}
</style>