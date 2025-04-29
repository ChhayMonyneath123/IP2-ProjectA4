<template lang="">
    <div class="container">
        <NavbarComponent/>
        <div class="pic1"></div>
        <h1 class="title">We invite you to visit our restaurant</h1>
        <h1 class="title1">We invite you to visit La Libre, where our exceptional food and drink create
 an unforgettable dining experience. Come savor our carefully crafted menu in a warm, 
welcoming atmosphere that will keep you coming back.</h1>
        <div class="pic2"></div>
        <div class ="features-container">
            <div><img src="/resources/js/assets/images/feature1.png" alt="Feature 1"></div>
            <div><img src="/resources/js/assets/images/feature2.png" alt="Feature 2"></div>
            <div><img src="/resources/js/assets/images/feature3.png" alt="Feature 3"></div>
            <div><img src="/resources/js/assets/images/feature4.png" alt="Feature 4"></div>
        </div>
        <div class="chef"></div>
        <div class="question-container">
            <div class="question-img"></div>
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
</template>



<script>
    import NavbarComponent from '@/vueCode/components/nav_bar.vue';

  export default {
  components: {
    NavbarComponent,
    },
    data() {
    return {
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
  methods: {
    toggleItem(index) {
      // If clicking on already open item, close it. Otherwise, open clicked item
      this.activeItem = this.activeItem === index ? null : index;
    }
  }
}
  
</script>



<style>
@import url('https://fonts.googleapis.com/css2?family=Kavoon&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap');
    .container {
        max-width: 120rem;
        height: 2000px;
        
        
    }

    .pic1 {
        background-image: url('/resources/js/assets/images/aboutUs.png');
        background-size: cover; 
        background-position: center;
        display: flex;
        align-items: center;
        flex-direction: column;
        width: 100%;
        height: 15%;
    }
    .title {
        font-family: 'Kavoon';
        font-size: 25px; 
        color: black;
        text-align: center;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }
    .title1 {
        font-family: 'Inter';
        font-size: 20px; 
        color: gray;
        text-align: center;
        margin-top: 0rem;
        margin-bottom: 2rem;
        margin-left: 10%;
        margin-right: 10%;
    }

    .pic2 {
        background-image: url('/resources/js/assets/images/aboutUs2.png');
        background-size: cover; 
        background-position: center;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        width: 90%;
        aspect-ratio: 21/9;
        margin-left: auto;
        margin-right: auto;
    }
    .features-container {
        display: flex;
        justify-content: space-between;
        gap: 4rem;
        align-items: center;
        margin-top: 2rem;
        margin-bottom: 1rem;
        width: 90%;
        height: 15%;
        margin-left: auto;
        margin-right: auto;
    }
    .features-container img {
        width: 100%;
        height: 20%;
        /* box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); */
        transition: transform 0.3s;
    }
    .features-container img:hover {
        transform: scale(1.05);
    }
    .chef {
        background-image: url('/resources/js/assets/images/chef.png');
        background-size: contain; 
        background-repeat: no-repeat;
        background-position: center;
        display: flex;
        align-items: center;
        flex-direction: column;
        width: 90%;
        aspect-ratio: 16/9;
        margin-left: auto;
        margin-right: auto;
    }
    .question-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 0rem;
        margin-bottom: 5rem;
        width: 90%;
        
        margin-left: auto;
        margin-right: auto;
        gap: 1%;
    }
    .question-img {
        background-image: url('/resources/js/assets/images/question.png');
        background-size: contain; 
        background-position: center;
        background-repeat: no-repeat;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        
        width: 90%;
        aspect-ratio: 12/9;
        margin-left: 2rem;
        margin-right: auto;
        margin-top: 5%;
    }
    





        .faq-section {
    padding: 10px;
    font-family: 'Inter';
    width: 100%;
    }

    .faq-heading {
    text-align: center;
    font-size: 28px;
    font-weight: bold;
    margin-bottom: 20px;
    }

    .faq-container {
    max-width: 700px;
    margin: 0 auto;
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
    text-align: center;
    flex-grow: 1;
    }

    .faq-answer {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease;
    }

    .faq-item.active .faq-answer {
    max-height: 200px;
    padding: 0 20px 20px 20px;
    }

    .faq-answer p {
    margin: 0;
    color: #333;
    line-height: 1.5;
    }
</style>