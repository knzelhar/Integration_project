import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap/dist/js/bootstrap.bundle.min.js'
import axios from 'axios';
// import VueCookies from 'vue-cookies'
const app = createApp(App)
app.use(router)
// app.use(VueCookies)
app.mount('#app')
let token = JSON.parse( localStorage.getItem('token') );
if( token ){
 axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
}
