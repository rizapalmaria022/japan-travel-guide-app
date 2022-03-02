
import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)
window.axios = require('axios');
import App from './components/AppComponent'
import Place from './components/Pages/PlaceComponent'
import Home from './components/Pages/HomeComponent'

const router = new VueRouter({
    // mode: 'history',
    routes: [
        {
            path: '/home',
            name: 'home',
            component: Home
        }, 
        {
            path: '/place/:search',
            name: 'place',
            component: Place
        }
    ],
});
const app = new Vue({
    el: '#app',
    components: { App },
    router,
});