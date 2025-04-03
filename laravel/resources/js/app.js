import './bootstrap';                
import { createApp } from 'vue';    
import Alpine from 'alpinejs';    
import MainApp from './components/mainApp.vue'; 
import router from './router'

window.Alpine = Alpine;       
Alpine.start();                     

const app = createApp(MainApp);     
app.use(router)
app.mount('#app')               
