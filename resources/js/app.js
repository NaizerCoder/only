import {createApp} from 'vue/dist/vue.esm-bundler'
import router from "./router.js"
import Index from './views/index/Index.vue'
import store from './store'


import './bootstrap';
import '../css/app.css'

const app = createApp({
    el: '#app',
    components:{
        'index': Index,
    }
});

app.use(router)
app.use(store)
app.mount('#app');
