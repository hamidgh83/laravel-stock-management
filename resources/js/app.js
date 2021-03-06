require("./bootstrap");

import Vue from 'vue'
import VueRouter from 'vue-router';
import store from "./stores/user";
import router from './router'

Vue.use(VueRouter);

const app = new Vue({
    el: '#app',
    router,
    store
});