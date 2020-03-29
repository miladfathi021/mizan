import Cookie from "../../helpers/cookies";

// State
const state = {
    user: null,
};

const getters = {
    user (state) {
        let cookies = new Cookie();
        return state.user !== null ? state.user : cookies.getCookie('user');
    }
};

const mutations = {
    setAuthenticatedUser (state, user) {
        return state.user = user;
    }
};

const actions = {
    setUser ({ commit }, user) {
        commit('setAuthenticatedUser', user);
    }
};

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions,
}
