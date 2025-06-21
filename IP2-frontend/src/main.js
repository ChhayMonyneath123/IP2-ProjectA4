// import './assets/main.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'
import axios from 'axios'

import App from './App.vue'
import router from './router'
import '@fortawesome/fontawesome-free/css/all.min.css'
import '@fontsource/instrument-sans';
import '@fontsource/ibm-plex-sans-condensed';
const app = createApp(App)

app.use(createPinia())
app.use(router)

app.mount('#app')
