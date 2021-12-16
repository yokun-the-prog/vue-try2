
require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuetify from 'vuetify'; //★
import axios from 'axios';
import 'vuetify/dist/vuetify.min.css'; //★
import '@mdi/font/css/materialdesignicons.css'; //★
import store from './store';
// import auth from './auth';


Vue.component('app-component', require('./components/App.vue').default);
Vue.use(VueRouter);
Vue.use(Vuetify);
Vue.prototype.$axios = axios;



export default new Vuetify({
    icons: {
        iconfont: 'mdi'
    },
    theme: {
        dark: false,
    }
})

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

const router = new VueRouter({
    // mode: 'history',
    routes: [
        {
            path: '/spot',
            name: 'spot',
            component: () => import('./components/spot/Spot.vue'),
        },
        {
            path: '/plan',
            name: 'plan',
            component: () => import('./components/plan/Plan.vue'),
        },
        {
            path: '/history',
            name: 'history',
            component: () => import('./components/history/History.vue'),
        },
        {
            path: '/board',
            name: 'board',
            component: () => import('./components/board/Board.vue'),
        },
    ]
});

const app = new Vue({
    el: '#app',
    router,
    store,
    vuetify: new Vuetify(), 
});


