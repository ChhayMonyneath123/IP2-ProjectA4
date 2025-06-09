<template>
  <div id="app">
    <!-- How it works Section -->
    <!-- How it works Section -->
    <section class="how-it-works">
      <div class="container">
        <h2>How it works</h2>
        <div class="steps-grid">
          <!-- Step 1 -->
          <div class="step-item">
            <div class="icon-circle">
              <i class="fas fa-search-location"></i>
            </div>
            <h3>Find your perfect food</h3>
          </div>

          <!-- Step 2 -->
          <div class="step-item">
            <div class="icon-circle">
              <i class="fas fa-map-marker-alt"></i>
            </div>
            <h3>Select your current address</h3>
          </div>

          <!-- Step 3 -->
          <div class="step-item">
            <div class="icon-circle">
              <i class="fas fa-credit-card"></i>
            </div>
            <h3>Choose payment method</h3>
          </div>

          <!-- Step 4 -->
          <div class="step-item">
            <div class="icon-circle">
              <i class="fas fa-motorcycle"></i>
            </div>
            <h3>Fast delivery</h3>
          </div>

          <!-- Step 5 -->
          <div class="step-item">
            <div class="icon-circle">
              <i class="fas fa-utensils"></i>
            </div>
            <h3>Enjoy your meal</h3>
          </div>
        </div>
      </div>
    </section>

    <!-- Font Awesome CDN -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    />

    <!-- Why Choose Us Section -->
    <section class="why-choose-us" style="padding: 2rem 0">
      <div
        class="container"
        style="
          display: flex;
          align-items: flex-start;
          gap: 2rem;
          flex-wrap: wrap;
        "
      >
        <!-- Features Column -->
        <div class="features" style="flex: 1; min-width: 300px">
          <div
            class="features-row"
            style="
              display: flex;
              flex-wrap: wrap;
              gap: 2rem;
              justify-content: center;
            "
          >
            <!-- Feature Box -->
            <div
              class="feature-item"
              style="
                flex: 1 1 200px;
                display: flex;
                flex-direction: column;
                align-items: center;
                text-align: center;
                padding: 1rem;
              "
            >
              <i class="fas fa-shipping-fast fa-2x" style="color: 583e16"></i>
              <h3 style="margin: 0.5rem 0">Fastest Delivery</h3>
              <p>
                Enjoy your favorite dishes and drinks delivered hot and fresh to
                your door, quickly and hassle-free.
              </p>
            </div>

            <div
              class="feature-item"
              style="
                flex: 1 1 200px;
                display: flex;
                flex-direction: column;
                align-items: center;
                text-align: center;
                padding: 1rem;
              "
            >
              <i class="fas fa-utensils fa-2x" style="color: 583e16"></i>
              <h3 style="margin: 0.5rem 0">Super Taste</h3>
              <p>
                Experience rich, delicious flavors expertly prepared to satisfy
                your cravings.
              </p>
            </div>

            <div
              class="feature-item"
              style="
                flex: 1 1 200px;
                display: flex;
                flex-direction: column;
                align-items: center;
                text-align: center;
                padding: 1rem;
              "
            >
              <i class="fas fa-star fa-2x" style="color: 583e16"></i>
              <h3 style="margin: 0.5rem 0">Best Quality</h3>
              <p>
                We use only the finest ingredients, cooked to perfection in
                every bite.
              </p>
            </div>

            <div
              class="feature-item"
              style="
                flex: 1 1 200px;
                display: flex;
                flex-direction: column;
                align-items: center;
                text-align: center;
                padding: 1rem;
              "
            >
              <i class="fas fa-list-alt fa-2x" style="color: 583e16"></i>
              <h3 style="margin: 0.5rem 0">Diverse Menu</h3>
              <p>
                Explore a wide variety of meals and drinks crafted to delight
                every palate.
              </p>
            </div>
          </div>
        </div>

        <!-- Description Side -->
        <div class="image-side" style="flex: 1; min-width: 300px">
          <h2>Why should you choose us?</h2>
          <p>
            Choose our restaurant for a premium dining experience with the
            finest ingredients, expertly prepared to deliver rich, delicious
            flavors. We offer a diverse menu of mouthwatering meals and
            refreshing drinks, all crafted to satisfy your cravings. Enjoy fast,
            reliable delivery, bringing your favorite dishes straight to your
            door, hot and fresh. Whether you're craving comfort food or a
            specialty drink, we’ve got you covered with convenience and
            exceptional taste — every time!
          </p>
        </div>
      </div>
    </section>

    <!-- Subscribe Banner -->
    <section class="subscribe-banner">
      <div class="container">
        <h3>Subscribe To Us and Get 50% Discount</h3>
        <div class="subscribe-form">
          <input type="email" placeholder="Email Address" v-model="email" />
          <button @click="subscribe">Sign in</button>
        </div>
      </div>
    </section>

  </div>
</template>

<script setup>
import { ref } from "vue";

const email = ref("");

const subscribe = () => {
  if (email.value && email.value.includes("@")) {
    alert(`Thank you for subscribing, ${email.value}!`);
    email.value = "";
  } else {
    alert("Please enter a valid email address.");
  }
};
</script>

<style>
body {
  margin: 0;
  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
  color: #333;
  line-height: 1.6;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px;
}

h1,
h2,
h3 {
  font-family: "Montserrat", sans-serif;
}

.how-it-works {
  padding: 10px 0;
  background-color: #a1998a;
  text-align: center;
  width: 100%;
}

.how-it-works h2 {
  font-size: 3em;
  margin-bottom: 60px;
}

.steps-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
  gap: 50px;
  padding: 20px;
}

.step-item {
  background-color: #a1998a;
  transition: transform 0.3s ease;
}

.step-item:hover {
  transform: translateY(-10px);
}

.icon-circle {
  width: 80px;
  height: 80px;
  background-color: #564949;
  border-radius: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
  margin: 0 auto 20px;
}

.icon-circle i {
  font-size: 3em;
  color: #fff;
}

.why-choose-us {
  padding: 80px 0;
  background-color: #fff;
  text-align: center;
}

.features-row {
  display: flex;
  gap: 30px;
  flex-wrap: wrap;
  justify-content: center;
}

.features-column {
  display: flex;
  flex-direction: column;
  gap: 30px;
  flex: 1 1 300px;
}

.feature-item {
  padding: 30px;
  border: #564949;
  border-radius: 15px;
  transition: background-color 0.3s ease;
  text-align: center;
}

.feature-item:hover {
  background-color: #b5b5b5;
}

.feature-icon {
  width: 70px;
  height: 70px;
  margin-bottom: 20px;
}

.subscribe-banner {
  width: 80%;
  height: 200px;
  background-image: url("@/assets/images/Promotion.png");
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  padding: 40px;
  margin: 20px auto; /* auto centers the banner horizontally */
  color: #ffffff;
  text-align: center;
  border-radius: 20px;

  display: flex;
  justify-content: center;  /* Horizontal centering */
  align-items: center;      /* Vertical centering */
  flex-direction: column;   /* Optional: stack content vertically */
}


.subscribe-banner h3 {
  font-size: 2em;
  margin-bottom: 20px;
}

.subscribe-form {
  max-width: 400px;
  margin: 0 auto;
  display: flex;
  gap: 10px;
}

.subscribe-form input[type="email"] {
  flex-grow: 1;
  padding: 12px 15px;
  font-size: 1em;
  border: none;
  border-radius: 5px;
}

.subscribe-form button {
  background-color: #333;
  color: #fff;
  border: none;
  padding: 12px 20px;
  font-size: 1em;
  border-radius: 5px;
  cursor: pointer;
}

/* Responsive */
@media (max-width: 768px) {
  .how-it-works h2,
  .why-choose-us h2 {
    font-size: 2.5em;
    margin-bottom: 40px;
  }

  .steps-grid,
  .features-row {
    flex-direction: column;
    align-items: center;
  }
}
.text {
  margin-bottom: 20px;
}
.text p {
  font-size: 36px;
  margin-bottom: 10px;
}
.image-side {
  font-size: medium;
  .image-side h2 {
    font-size: 36px;
    margin-bottom: 20px;
    text-align: left;
  }
}
.image-side p {
  margin-bottom: 20px;
  font-size: 20px;
  line-height: 2;
  text-align: left;
}
</style>
