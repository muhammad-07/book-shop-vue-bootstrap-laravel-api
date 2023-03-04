// app.js

import { createApp } from 'vue';
import './bootstrap';
import { routes } from './routes';
import { createRouter, createWebHashHistory, RouterLink } from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
// import { Bootstrap4Pagination } from 'laravel-vue-pagination';
// import {Bootstrap5Pagination}  from 'laravel-vue-pagination';



import App from './components/App.vue';
import Welcome from './components/Welcome.vue';

const router = createRouter({
    history: createWebHashHistory(),
    routes,
});


const app = createApp();


app.use(VueAxios, axios);
app.use(router);
app.component('App', App);
app.component('Welcome', Welcome)
app.mount("#app");
