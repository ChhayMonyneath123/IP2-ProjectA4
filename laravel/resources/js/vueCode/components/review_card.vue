<template>
  <div class="review-card">
    <div class="review-header">
      <img :src="review.avatar" class="avatar" alt="Avatar" />
      <div>
        <strong>{{ review.name }}</strong>
        <p class="date">{{ review.date }}</p>
        <p class="label">Rating:</p>
        <div class="stars">
          <i v-for="n in review.rating" :key="n" class="fas fa-star filled"></i>
          <i v-for="n in (5 - review.rating)" :key="'e' + n" class="fas fa-star empty"></i>
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
  }
};
</script>

<style scoped>
.review-card {
  border: 1px solid #4e3e2e;
  padding: 16px;
  margin-bottom: 16px;
  background: transparent;
  border-radius: 4px;
  box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
}
.review-header {
  display: flex;
  align-items: center;
  gap: 12px;
}
.avatar {
  width: 48px;
  height: 48px;
  border-radius: 50%;
  object-fit: cover;
}
.date {
  font-size: 12px;
  color: #888;
  margin: 2px 0;
}
.label {
  font-size: 13px;
  margin-top: 2px;
  font-weight: 500;
}
.stars {
  margin-top: 2px;
  font-size: 14px;
}
.filled {
  color: #f7b400;
}
.empty {
  color: #ddd;
}
.comment {
  margin-top: 12px;
  font-size: 14px;
}
</style>
