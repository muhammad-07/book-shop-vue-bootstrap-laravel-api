// app.js

import { createApp } from 'vue';
import Vuex from 'vuex';
import './bootstrap';
import router from './routes';
// import { createRouter, createWebHashHistory, RouterLink } from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import state from './auth/state.js';

import App from './components/App.vue';
import Web from './components/Welcome.vue';


const app = createApp();

app.use(VueAxios, axios);
app.use(router);
app.use(state);
app.component('App', App);
app.component('Web', Web);

app.mount("#app");
