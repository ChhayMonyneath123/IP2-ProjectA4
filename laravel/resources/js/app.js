import './bootstrap';

import Alpine from 'alpinejs';

import '@fontsource/ibm-plex-sans-condensed';
import '@fontsource-variable/instrument-sans';
import "../css/app.css"
window.Alpine = Alpine;       
Alpine.start();                     

const app = createApp(MainApp);     
app.use(router)
app.mount('#app')               
