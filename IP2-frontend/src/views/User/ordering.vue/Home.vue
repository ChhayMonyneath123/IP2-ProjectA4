<template>
  <div class="nav">
    <Nav_bar />
    <div class="ourmenu">
      <div class="banner">
        <div class="text-section">
          <h1>Tasty Food & Refreshing Drinks, Delivered Fast!</h1>
          <p>
            Satisfy your cravings with an extensive menu of delicious meals from
            top restaurants, all delivered hot and fresh to your doorstep.
            Whether you're in the mood for comfort food or something new, we
            offer a wide variety of options to suit every taste. Enjoy a
            seamless ordering experience with fast delivery, easy payments, and
            unbeatable flavors—everything you need, all in one place!
          </p>
          <router-link to="/menu">
            <button>Shop Now</button>
          </router-link>
        </div>

        <div class="image-section">
          <div class="image-overlay-large"></div>
        </div>
      </div>
    </div>

    <OurMenu />
    <Footer_bar />
  </div>
</template>

<script>
import Footer_bar from "@/components/footer_bar.vue";
import Nav_bar from "@/components/nav_bar.vue";
import OurMenu from "./HomeFeature/OurMenu.vue";

export default {
  name: "Home",
  components: {
    Nav_bar,
    OurMenu,
    Footer_bar,
  },
};
</script>

<style scoped>
/* Container */
.nav {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
}

/* Our menu wrapper */
.ourmenu {
  width: 100%;
  display: flex;
  justify-content: center;
  padding: 2rem;
  box-sizing: border-box;
}

/* Banner container */
.banner {
  width: 100%;
  height: 30rem;
  background-image: url("@/assets/images/bg.png");
  background-size: cover;
  background-position: center;
  display: flex;
  flex-direction: column;
  position: relative;
  color: white;
}

/* Responsive flex for medium and up */
@media (min-width: 768px) {
  .banner {
    flex-direction: row;
    justify-content: space-between;
    padding: 3rem;
  }
}

/* Text Section */
.text-section {
  flex: 1;
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  padding: 1rem;
  z-index: 10;
}

@media (min-width: 768px) {
  .text-section {
    align-items: flex-start;
    text-align: left;
    padding: 2rem;
  }
}

.text-section h1 {
  font-family: "Inter", sans-serif;
  font-weight: 700;
  font-size: 2rem;
  line-height: 1.2;
  margin-bottom: 0.5rem;
}

@media (min-width: 640px) {
  .text-section h1 {
    font-size: 2.5rem;
  }
}

@media (min-width: 1024px) {
  .text-section h1 {
    font-size: 3rem;
  }
}

.text-section p {
  font-family: "Inter", sans-serif;
  font-weight: 200;
  margin-bottom: 1.5rem;
}

@media (min-width: 640px) {
  .text-section p {
    font-size: 1.25rem;
  }
}

@media (min-width: 1024px) {
  .text-section p {
    font-size: 1.5rem;
  }
}

.text-section button {
  background-color: white;
  color: #2c3e50;
  font-weight: 700;
  padding: 0.75rem 2rem;
  border-radius: 9999px;
  border: none;
  cursor: pointer;
  text-transform: uppercase;
  letter-spacing: 0.05em;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  transition: background-color 0.3s ease-in-out;
  font-family: "Inter", sans-serif;
}

.text-section button:hover {
  background-color: #e5e7eb; /* Tailwind gray-200 */
}

/* Image Section */
.image-section {
  flex: 1;
  position: relative;
  height: 16rem;
  margin-top: 1.5rem;
  display: flex;
  align-items: center;
  justify-content: center;
}

@media (min-width: 768px) {
  .image-section {
    height: auto;
    margin-top: 0;
  }
}

/* Small overlay image */
.image-overlay-small {
  position: absolute;
  top: 50px;
  left: 80px;
  width: 6rem;
  height: 6rem;
  background-image: url("@/assets/images/sushi.png");
  background-size: cover;
  background-position: center;
  border-radius: 0.5rem;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
  transform: translate(1.5rem, -1.5rem);
  z-index: 20;
  max-height: 12.5rem;
  width: 100%;
}

@media (min-width: 640px) {
  .image-overlay-small {
    width: 8rem;
    height: 8rem;
    transform: translate(2rem, -2rem);
  }
}

@media (min-width: 768px) {
  .image-overlay-small {
    transform: translate(3rem, -3rem);
  }
}

/* Large overlay image */
.image-overlay-large {
  width: 100%;
  max-width: 20rem;
  height: 100%;
  max-height: 12.5rem;
  background-image: url("@/assets/images/sushi.png");
  background-size: cover;
  background-position: center;
  border-radius: 0.5rem;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
  z-index: 10;
}

@media (min-width: 640px) {
  .image-overlay-large {
    max-width: 24rem;
    max-height: 15rem;
  }
}

@media (min-width: 1024px) {
  .image-overlay-large {
    max-width: 28rem;
    max-height: 18rem;
  }
}
</style>
