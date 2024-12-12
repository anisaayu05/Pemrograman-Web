// Import createApp from Vue
import { createApp } from 'vue';

// Import App component
import App from './App.vue';

// Import router configuration
import router from './router';

// Create Vue app
const app = createApp(App);

// Use router with the Vue app
app.use(router);

// Mount the app to the DOM
app.mount('#app');
