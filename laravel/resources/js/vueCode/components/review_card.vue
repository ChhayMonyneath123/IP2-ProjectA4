<template>
  <div class="bg-white p-4 border rounded-lg mb-4">
    <div class="flex items-center gap-4 mb-2">
      <img class="w-10 h-10 rounded-full" :src="avatarUrl" :alt="name" />
      <div>
        <p class="font-semibold">{{ name }}</p>
        <p class="text-xs text-gray-500">{{ date }} · Rating: {{ stars }}</p>
      </div>
    </div>
    <p class="text-sm">{{ message }}</p>
  </div>
</template>

<script>
export default {
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
    }
  }
};
</script>

<style scoped>
img {
  object-fit: cover;
}
</style>
