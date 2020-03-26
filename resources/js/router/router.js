'use strict';

window.Vue = require('vue');
import VueRouter from "vue-router";

Vue.use(VueRouter);

import HomePage from "../pages/HomePage";

const routes = [
    { path: '/', component: HomePage },
];


export default new VueRouter({
    mode: 'history',
    routes
});
