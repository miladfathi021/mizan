'use strict';

import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

import showRegisterLogin from "./modules/showRegisterLogin";
import user from "./modules/user";


export default new Vuex.Store({
    modules: {
        showRegisterLogin,
        user,
    }
});
