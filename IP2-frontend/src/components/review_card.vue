<template>
  <div class="review-card" v-if="review">
    <div class="review-header">
      <div class="wrapper">
        <p class="label">Rating:</p>
        <div class="stars">
          <i v-for="n in review.rating" :key="`filled-${n}`" class="fas fa-star filled"></i>
          <i v-for="n in (5 - review.rating)" :key="`empty-${n}`" class="fas fa-star empty"></i>
        </div>
      </div>
    </div>
    <p class="comment">{{ review.comment }}</p>
  </div>
  <div v-else>
    <p>Loading review...</p>
  </div>
</template>

<script>
export default {
  name: 'Review_card',
  props: {
    review: {
      type: Object,
      required: true,
    },
  },
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

.profile-pic {
  width: 60px;
  height: 60px;
  border-radius: 50%;
  object-fit: cover;
}

.review-name {
  font-size: 16px;
  font-weight: bold;
}

.review-date {
  font-size: 12px;
  color: #888;
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
