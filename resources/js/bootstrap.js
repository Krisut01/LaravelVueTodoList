import axios from 'axios';
import { createApp } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

// Configure base URL for API requests (if applicable)
axios.defaults.baseURL = 'http://127.0.0.1:8000';  // Set to your backend API URL
axios.defaults.headers.common['Accept'] = 'application/json'; // Set default header for JSON

// Optional: Configure Axios for handling CSRF tokens or other settings
