require('./bootstrap');
window.Vue = require('vue');

import Cookie from "./helpers/cookies";
import router from './router/router';
import store from './store/store';
import './helpers/outside-click';

// let cookie = new Cookie();
// cookie.deleteCookie('user');

// Components
Vue.component('navigation', require('./components/global/Navigation.vue').default);


const app = new Vue({
    el: '#app',
    router,
    store,

    beforeCreate () {
        // check api token
        let cookie = new Cookie();

        if (cookie.getCookie('user') !== null) {
            let user = cookie.getCookie('user');

            const headers = {
                Authorization: "Bearer " + user.api_token
            };

            axios.post('/api/v1/api-token-check', {}, {headers : headers}).then(response => {
                console.log(response.data.message);
            }).catch(error => {
                console.log(error.response.data.errors);
                if(error.response.status === 401) {
                    cookie.deleteCookie('user');
                }
            })
        }
    },
});
