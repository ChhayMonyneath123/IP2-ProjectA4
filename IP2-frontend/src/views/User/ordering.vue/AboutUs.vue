<template>
    <div class="page-container">
        <NavbarComponent/>
        <div class="content-container">
            <div class="pic1" :style="{ backgroundImage: `url(${aboutUsImg})` }">
            </div>
            <h1 class="title">We invite you to visit our restaurant</h1>
            <h2 class="title1">We invite you to visit La Libre, where our exceptional food and drink create
 an unforgettable dining experience. Come savor our carefully crafted menu in a warm, 
welcoming atmosphere that will keep you coming back.</h2>
            <div class="pic2" :style="{ backgroundImage: `url(${aboutUs2Img})` }"></div>
            <div class="features-container">
                <div><img :src="feature1" alt="Feature 1"></div>
                <div><img :src="feature2" alt="Feature 2"></div>
                <div><img :src="feature3" alt="Feature 3"></div>
                <div><img :src="feature4" alt="Feature 4"></div>
            </div>
            <div class="chef" :style="{ backgroundImage: `url(${chefImg})` }"></div>
            <div class="question-container">
                <div class="question-img" :style="{ backgroundImage: `url(${questionImg})` }"></div>
                <div class="question-text">
                    <div class="faq-section">
                        <h1 class="faq-heading">Frequence Questions</h1>
                        <div class="faq-container">
                        <div 
                            v-for="(item, index) in faqItems" 
                            :key="index" 
                            class="faq-item"
                            :class="{ active: activeItem === index }"
                        >
                            <div class="faq-question" @click="toggleItem(index)">
                            <div class="toggle-button"></div>
                            <div class="question-text">{{ item.question }}</div>
                            </div>
                            <div class="faq-answer">
                            <p>{{ item.answer }}</p>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footerSection/>
    </div>
</template>

<script>
    import NavbarComponent from '@/components/nav_bar.vue';
    import footerSection from '@/components/footer_bar.vue';
    
    // Import images
    import feature1 from '@/assets/images/feature1.png';
    import feature2 from '@/assets/images/feature2.png';
    import feature3 from '@/assets/images/feature3.png';
    import feature4 from '@/assets/images/feature4.png';
    import aboutUsImg from '@/assets/images/aboutUs.png';
    import aboutUs2Img from '@/assets/images/aboutUs2.png';
    import chefImg from '@/assets/images/chef.png';
    import questionImg from '@/assets/images/question.png';

  export default {
  components: {
    NavbarComponent,
    footerSection,
    },
    data() {
    return {
      // Make images available in template and CSS
      feature1,
      feature2,
      feature3,
      feature4,
      aboutUsImg,
      aboutUs2Img,
      chefImg,
      questionImg,
      activeItem: null,
      faqItems: [
        {
          question: "Do you offer vegetarian/vegan options?",
          answer: "Yes, La Libre offers a variety of vegetarian and vegan dishes on our dedicated vegetable menu, ensuring all guests can enjoy a delicious dining experience regardless of dietary preferences."
        },
        {
          question: "Do you have parking available?",
          answer: "Yes, we offer complimentary parking for our guests in our private lot located just behind the restaurant. Additional street parking is also available nearby."
        },
        {
          question: "Are your ingredients locally sourced?",
          answer: "We pride ourselves on working with local farmers and producers whenever possible. Approximately 70% of our ingredients are sourced from within a 50-mile radius, supporting our local community and ensuring the freshest seasonal options."
        },
        {
          question: "Do you have any happy hour deals?",
          answer: "Yes! We offer happy hour specials Tuesday through Friday from 4-6pm, featuring discounted drinks and a selection of appetizers at reduced prices. Join us for special cocktails and small plates in our bar area."
        }
      ]
    }
  },
  computed: {
    // Ensure images are reactive
    backgroundImages() {
      return {
        aboutUs: this.aboutUsImg,
        aboutUs2: this.aboutUs2Img,
        chef: this.chefImg,
        question: this.questionImg
      };
    }
  },
  methods: {
    toggleItem(index) {
      this.activeItem = this.activeItem === index ? null : index;
    }
  }
}
  
</script>

<style>
@import url('https://fonts.googleapis.com/css2?family=Kavoon&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap');
/* Reset defaults to ensure full-screen  */
    html, body {
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
        overflow-x: hidden;
        box-sizing: border-box;
    }

    body {
        width: 100vw;
        max-width: 100%;
    }

    /* Full screen container */
    .page-container {
        width: 100vw;
        max-width: 100%;
        min-height: 100vh;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        overflow-x: hidden;
        display: flex;
        flex-direction: column;
    }

    .content-container {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .pic1 {
    background-size: 100% auto;
    background-position: center;
    background-repeat: no-repeat;
    width: 100%;
    padding-bottom: 40%; 
    position: relative;
    }

    @media (max-width: 480px) {
        .pic1 {
            padding-bottom: 70%; /* Even taller aspect ratio on mobile */
        }
    }
    
    .title {
        font-family: 'Kavoon';
        font-size: 3rem;
        color: black;
        text-align: center;
        margin-top: 3rem;
        margin-bottom: 1.5rem;
        width: 100%;
        max-width: 1400px;
        padding: 0 2rem;
        box-sizing: border-box;
    }
    
    .title1 {
        font-family: 'Inter';
        font-size: 1.5rem;
        color: gray;
        text-align: center;
        margin-top: 0;
        margin-bottom: 3rem;
        width: 100%;
        max-width: 1200px;
        padding: 0 2rem;
        box-sizing: border-box;
    }

    .pic2 {
        background-size: cover; 
        background-position: center;
        width: 100%;
        max-width: 1600px;
        aspect-ratio: 21/9;
        margin: 0 0 3rem 0;
    }
    
    .features-container {
        display: flex;
        justify-content: center;
        gap: 2rem;
        align-items: center;
        margin: 3rem 0;
        width: 100%;
        max-width: 1600px;
        padding: 0 2rem;
        box-sizing: border-box;
        flex-wrap: wrap;
    }
    
    .features-container > div {
        flex: 1 1 20%;
        min-width: 220px;
        max-width: 300px;
    }
    
    .features-container img {
        width: 100%;
        height: auto;
        transition: transform 0.3s;
    }
    
    .features-container img:hover {
        transform: scale(1.05);
    }
    
    .chef {
        background-image: v-bind('`url(${backgroundImages.chef})`');
        background-size: contain; 
        background-repeat: no-repeat;
        background-position: center;
        width: 100%;
        max-width: 1600px;
        aspect-ratio: 16/9;
        margin: 2rem 0;
    }
    
    .question-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 3rem 0 5rem 0;
        width: 100%;
        max-width: 1600px;
        padding: 0 2rem;
        box-sizing: border-box;
        gap: 5%;
        flex-wrap: wrap;
    }
    
    .question-img {
        background-image: v-bind('`url(${backgroundImages.question})`');
        background-size: contain; 
        background-position: center;
        background-repeat: no-repeat;
        flex: 1;
        min-width: 300px;
        aspect-ratio: 12/9;
    }
    
    .question-text {
        flex: 1;
        min-width: 300px;
    }

    /* FAQ styles */
    .faq-section {
        padding: 10px;
        font-family: 'Inter';
        width: 100%;
    }

    .faq-heading {
        text-align: center;
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 2rem;
    }

    .faq-container {
        max-width: 800px;
        width: 100%;
    }

    .faq-item {
        background-color: rgba(217, 217, 217, 1);
        border-radius: 12px;
        margin-bottom: 20px;
        overflow: hidden;
    }
    .faq-question {
        padding: 20px;
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    .toggle-button {
        width: 40px;
        height: 40px;
        background-color: #c2c2b4;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        position: relative;
        flex-shrink: 0;
    }

    .toggle-button::after {
        content: "+";
        font-size: 24px;
        color: #333;
    }

    .faq-item.active .toggle-button::after {
        content: "−";
    }

    .question-text {
        font-size: 20px;
        color: #666;
        flex-grow: 1;
    }

    .faq-answer {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease;
    }

    .faq-item.active .faq-answer {
        max-height: 300px;
        padding: 0 20px 20px 20px;
    }

    .faq-answer p {
        margin: 0;
        color: #333;
        line-height: 1.6;
        font-size: 1.1rem;
    }

    /* Media queries for responsive design */
    @media (max-width: 1200px) {
        .title {
            font-size: 2.5rem;
        }
        
        .title1 {
            font-size: 1.3rem;
        }
        
        .hero-text {
            font-size: 3.5rem;
        }
    }

    @media (max-width: 768px) {
        .question-container {
            flex-direction: column;
            gap: 2rem;
        }
        
        .question-img, .question-text {
            width: 100%;
            min-width: 100%;
        }
        
        .features-container {
            gap: 1rem;
        }
        
        .features-container > div {
            flex: 1 1 45%;
            min-width: 150px;
        }
        
        .title {
            font-size: 2rem;
        }
        
        .title1 {
            font-size: 1.1rem;
        }
        
        .hero-text {
            font-size: 3rem;
        }
        
        .faq-heading {
            font-size: 2rem;
        }
    }
    
    @media (max-width: 480px) {
        .features-container > div {
            flex: 1 1 100%;
            min-width: 100%;
        }
        
        .title {
            font-size: 1.8rem;
        }
        
        .title1 {
            font-size: 1rem;
        }
        
        .hero-text {
            font-size: 2.5rem;
        }
    }
</style>