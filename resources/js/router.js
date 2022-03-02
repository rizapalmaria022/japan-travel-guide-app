import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)

import Place from './components/pages/PlaceComponent'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Place
        }
    ],
});
