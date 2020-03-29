'use strict';

window.Vue = require('vue');
import VueRouter from "vue-router";

Vue.use(VueRouter);

import HomePage from "../pages/HomePage";
import PhoneCallConsultancy from "../pages/PhoneCallConsultancy";

const routes = [
    { path: '/', component: HomePage },
    { path: '/phone-call-consultancy', component: PhoneCallConsultancy },
];


export default new VueRouter({
    mode: 'history',
    routes
});
