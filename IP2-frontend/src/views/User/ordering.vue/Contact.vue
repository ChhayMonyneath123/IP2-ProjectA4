<template>
    <div class="contact">
        <Nav_bar/>
        <Breadcrumb/>
        <div class="contactUs">
            <div class="pic1" :style="{ backgroundImage: `url(${contactUs})` }">
            </div>
            <h1 class="title">Plan your meal at La Libre</h1>
            <h2 class="title1">Experience exceptional dining at La Libre. Contact us to make a reservation, 
ask about our menu, or learn more about our restaurant. We're here to help 
make your visit memorable.</h2>
            <div class="info">
                <div><img :src="location" alt="location"></div>
                <div><img :src="email" alt="email"></div>
                <div><img :src="phone" alt="phone"></div>
                <div><img :src="time" alt="time"></div>
            </div>
            <div class="contactbox">
            <!-- Message Form -->
                <div class="messageform">
                        <div class="formbox">
                    <h2>Leave a message here!</h2>
                    <form @submit.prevent="sendMessage">
                    <input 
                        type="text" 
                        v-model="form.name" 
                        placeholder="Your Name" 
                        required 
                        class="form-input"
                    />
                    <input 
                        type="email" 
                        v-model="form.email" 
                        placeholder="Your Gmail" 
                        required 
                        class="form-input"
                    />
                    <input 
                        type="tel" 
                        v-model="form.phone" 
                        placeholder="Your Phone number" 
                        required 
                        class="form-input"
                    />
                    <textarea 
                        v-model="form.message" 
                        placeholder="Message" 
                        rows="4" 
                        required 
                        class="form-textarea"
                    ></textarea>
                    <button type="submit" class="send-button">Send Message</button>
                    </form>
                </div>
                </div>

                <!-- Right side - Map -->
                <div class="mapbox">
                <a 
                    href="https://maps.app.goo.gl/DvFvZNMB7UHim5A37?g_st=com.google.maps.preview.copy" 
                    target="_blank" 
                    class="maplink"
                >
                    <img 
                    :src="map" 
                    alt="La Libre Restaurant Location Map" 
                    class="mapimage"
                    />
                </a>
                </div>
            
            </div>
            <h1 class="title">Follow us on social media</h1>
            
            <!-- Social Media Section -->
            <div class="socialbox">
                <!-- Facebook -->
                <div class="socialitem">
                    <a 
                        href="https://www.facebook.com/PavilionPhnomPenh" 
                        target="_blank" 
                        class="sociallink"
                    >
                        <img 
                            :src="facebook" 
                            alt="Follow us on Facebook" 
                            class="socialimage"
                        />
                    </a>
                </div>

                <!-- Instagram -->
                <div class="socialitem">
                    <a 
                        href="https://www.instagram.com/tenedorlibrelastinajas/" 
                        target="_blank" 
                        class="sociallink"
                    >
                        <img 
                            :src="instagram" 
                            alt="Follow us on Instagram" 
                            class="socialimage"
                        />
                    </a>
                </div>
            </div>
            
        </div>
        <Footer_bar/>
    </div>
</template>

<script>
import Nav_bar from '@/components/nav_bar.vue';
import Footer_bar from '@/components/footer_bar.vue';
import Breadcrumb from '@/components/breadcrumb.vue';
// Import images
import contactUs from '@/assets/images/ContactUs.png';
import email from '@/assets/images/ContactEmail.png';
import location from '@/assets/images/Contactlocation.png';
import phone from '@/assets/images/Contactphone.png';
import time from '@/assets/images/ContactTime.png';
import map from '@/assets/images/ContactMap.png';
import facebook from '@/assets/images/ContactFB.png';
import instagram from '@/assets/images/ContactIG.png';

export default {
    name: "contact",
    components: {
        Footer_bar,
        Nav_bar,
        Breadcrumb
    },
    data() {
        return {
            // Make images available in template and CSS
            contactUs,
            email,
            location,
            phone,
            time,
            map,
            facebook,
            instagram,
            // Form data
            form: {
                name: '',
                email: '',
                phone: '',
                message: ''
            }
        }
    },
    methods: {
        sendMessage() {
            // Just show an alert for now - no Telegram integration yet
            alert(`Message received from ${this.form.name}!`);
            this.resetForm();
        },
        
        resetForm() {
            this.form = {
                name: '',
                email: '',
                phone: '',
                message: ''
            };
        }
    }
}
</script>

<style scoped>
.contact {
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

.contactUs {
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

.title {
    font-family: 'Kavoon', serif;
    font-size: 3rem;
    color: black;
    text-align: center;
    margin: 3rem 0 1.5rem 0;
}

.title1 {
    font-family: 'Inter', sans-serif;
    font-size: 1.2rem;
    color: #666;
    text-align: center;
    margin: 0 0 3rem 0;
    max-width: 800px;
    padding: 0 2rem;
    line-height: 1.6;
}

.info {
    display: flex;
    justify-content: center;
    gap: 10rem;
    align-items: center;
    margin: 3rem 0;
    width: 100%;
    max-width: 1600px;
}

.info img {
    height: 15rem;
}

.contactbox {
    display: flex;
    max-width: 1200px;
    margin: 3rem auto;
    gap: 3rem;
    padding: 2rem;
    box-sizing: border-box;
}

.messageform {
    flex: 1;
    min-width: 300px;
}

.formbox {
    background: white;
    border: 2px solid #ddd;
    border-radius: 8px;
    padding: 2rem;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.formbox h2 {
    font-family: 'Inter', sans-serif;
    font-size: 1.8rem;
    font-weight: bold;
    text-align: center;
    margin-bottom: 2rem;
    color: #333;
}

.form-input,
.form-textarea {
    width: 100%;
    padding: 1rem;
    margin-bottom: 1.5rem;
    border: none;
    border-bottom: 2px solid #ddd;
    font-family: 'Inter', sans-serif;
    font-size: 1rem;
    background: transparent;
    transition: border-color 0.3s;
    box-sizing: border-box;
}

.form-input:focus,
.form-textarea:focus {
    outline: none;
    border-bottom-color: #00E5FF;
}

.form-input::placeholder,
.form-textarea::placeholder {
    color: #999;
}

.form-textarea {
    resize: vertical;
    min-height: 100px;
}

.send-button {
    width: 100%;
    padding: 1rem 2rem;
    background-color: #6B5B52;
    color: white;
    border: none;
    border-radius: 5px;
    font-family: 'Inter', sans-serif;
    font-size: 1.1rem;
    font-weight: 500;
    cursor: pointer;
    transition: background-color 0.3s;
}

.send-button:hover {
    background-color: #5a4a42;
}

.mapbox {
    flex: 1;
    min-width: 300px;
}

.maplink {
    display: block;
    width: 100%;
    height: 100%;
    text-decoration: none;
}

.mapimage {
    width: 100%;
    height: 700px;
    object-fit: cover;
    border-radius: 8px;
    cursor: pointer;
    transition: opacity 0.3s;
}

.mapimage:hover {
    opacity: 0.9;
}

/* Social Media Styles - FIXED */
.socialbox {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 4rem;
    margin: 2rem auto 4rem auto;
    padding: 2rem;
    width: 100%;
    max-width: 1000px;
}

.socialitem {
    flex: 1;
    max-width: 500px;
    text-align: center;
}

.sociallink {
    display: block;
    text-decoration: none;
    transition: transform 0.3s ease;
}

.sociallink:hover {
    transform: scale(1.05);
}

.socialimage {
    width: 100%;
    height: 700px;
    max-width: 500px;
    object-fit: fill;
    border-radius: 15px;
    cursor: pointer;
    transition: opacity 0.3s ease;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.socialimage:hover {
    opacity: 0.9;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
}

/* Responsive Design */
@media (max-width: 768px) {
    .contactbox {
        flex-direction: column;
        gap: 1rem;
        padding: 0.5rem;
    }
    
    .formbox {
        padding: 1rem;
    }
    
    .formbox h2 {
        font-size: 1.5rem;
    }
    
    .info {
        gap: 1rem;
        flex-wrap: wrap;
    }
    
    .info img {
        height: 6rem;
    }
    
    .title {
        font-size: 2.5rem;
    }
    
    .title1 {
        font-size: 1rem;
    }
    
    .socialbox {
        flex-direction: column;
        gap: 1rem;
        padding: 1rem;
        max-width: 500px;
    }
    
    .socialitem {
        max-width: 100%;
        width: 100%;
    }
    
    .socialimage {
        max-width: 280px;
        width: 100%;
    }
}

@media (max-width: 480px) {
    .info {
        gap: 0.5rem;
    }
    
    .info img {
        height: 3rem;
    }
    
    .title {
        font-size: 2rem;
    }
    
    .socialbox {
        gap: 1rem;
        padding: 0.5rem;
        max-width: 350px;
    }
    
    .socialimage {
        max-width: 250px;
    }
}
</style>