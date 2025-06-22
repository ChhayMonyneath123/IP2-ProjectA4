// import './assets/main.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'
import axios from 'axios'
import App from './App.vue'
import router from './router'
import '@fortawesome/fontawesome-free/css/all.min.css'
import '@fontsource/instrument-sans';
import '@fontsource/ibm-plex-sans-condensed';

// Set axios baseURL BEFORE creating the app
axios.defaults.baseURL = 'http://localhost:8000'

const app = createApp(App)
const pinia = createPinia()

app.use(pinia)  // You had createPinia() twice - fixed this too
app.use(router)

app.mount('#app')