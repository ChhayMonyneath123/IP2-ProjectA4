<template>
<<<<<<< HEAD
  <div class="bg-white p-4 border rounded-lg mb-4">
    <div class="flex items-center gap-4 mb-2">
      <img class="w-10 h-10 rounded-full" :src="avatarUrl" :alt="name" />
      <div>
        <p class="font-semibold">{{ name }}</p>
        <p class="text-xs text-gray-500">{{ date }} · Rating: {{ stars }}</p>
      </div>
    </div>
    <p class="text-sm">{{ message }}</p>
=======
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
>>>>>>> PolliX
  </div>
</template>

<script>
export default {
<<<<<<< HEAD
  name: "CardReview",
  props: {
    name: String,
    date: String,
    rating: Number,
    avatar: {
      type: String,
      required: true
    },
    message: String,
  },
  computed: {
    stars() {
      return '★★★★★'.slice(0, this.rating) + '☆☆☆☆☆'.slice(this.rating);
    },
    avatarUrl() {
      return new URL(`../../assets/logo/${this.avatar}`, import.meta.url).href;
=======
  name: 'Review_card',
  props: {
    review: {
      type: Object,
      required: true
>>>>>>> PolliX
    }
  }
};
</script>

<style scoped>
<<<<<<< HEAD
img {
  object-fit: cover;
}
=======
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
>>>>>>> PolliX
</style>
