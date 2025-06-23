<template>
  <div class="review-card">
    <div class="review-header">
      <img :src="review.user.avatar || fallback" class="profile-pic" />
      <div>
        <p class="review-name">{{ review.user.name }}</p>
        <p class="review-date">
  {{ new Date(review.created_at).toLocaleDateString() }}
</p>

        <div class="wrapper">
          <p class="label">Rating:</p>
          <div class="stars">
            <i
              v-for="n in review.rating"
              :key="`filled-${n}`"
              class="fas fa-star filled"
            ></i>
            <i
              v-for="n in (5 - review.rating)"
              :key="`empty-${n}`"
              class="fas fa-star empty"
            ></i>
          </div>
        </div>
      </div>
    </div>
    <p class="comment">{{ review.comment }}</p>
  </div>
</template>

<script>
export default {
  name: 'Review_card',
  props: {
    review: {
      type: Object,
      required: true
    }
  },
  computed: {
    formattedDate() {
      const date = new Date(this.review.date || this.review.created_at);
      return date.toLocaleDateString();
    }
  }
};
</script>

<style scoped>
.review-card {
  border: 1px solid #4e3e2e;
  padding: 10px;
  margin-bottom: 16px;
  background: transparent;
  border-radius: 10px;
  box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
}
.review-header {
  display: flex;
  gap: 12px;
}
.avatar {
  width: 60px;
  height: 60px;
  border-radius: 50%;
  object-fit: cover;
}
.date {
  font-size: 12px;
  color: #888;
  margin-top: 0px;
}
.wrapper {
  display: flex;
  flex-direction: row;
  gap: 10px;
}
.label {
  font-size: 13px;
  font-weight: 500;
}
.stars {
  font-size: 14px;
}
.filled {
  color: #f7b400;
}
.empty {
  color: #ddd;
}
.comment {
  font-size: 14px;
}
</style>
