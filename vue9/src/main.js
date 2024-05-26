import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap/dist/js/bootstrap.bundle.min.js'
import VueCookies from 'vue-cookies'
const app = createApp(App)
app.use(router)
app.use(VueCookies, { expires: '7d' })
app.mount('#app')
