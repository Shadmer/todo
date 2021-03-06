import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store/index'
import axios from 'axios'
import VueAxios from 'vue-axios'

Vue.use(VueAxios, axios)

Vue.config.productionTip = false

const debug = process.env.NODE_ENV !== 'production';
if (debug) {
    axios.defaults.baseURL = 'http://todo/';
}


new Vue({
    router,
    store,
    render: h => h(App)
}).$mount('#app');
