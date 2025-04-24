import './bootstrap';                
import { createApp } from 'vue';    
import Alpine from 'alpinejs';    
import MainApp from './vueCode/mainApp.vue'; 
import router from './router'

import "../css/app.css"
window.Alpine = Alpine;       
Alpine.start();                     

const app = createApp(MainApp);     
app.use(router)
app.mount('#app')               
