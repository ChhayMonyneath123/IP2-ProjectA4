import axios from 'axios'

axios.defaults.baseURL = 'http://localhost:8000/api';
axios.defaults.withCredentials = true; // if needed for cookies