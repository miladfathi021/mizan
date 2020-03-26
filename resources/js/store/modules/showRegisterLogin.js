// States
const state = {
    show: false,
};

// Getters
const getters = {
    show (state) {
        return state.show;
    }
};

// Mutations
const mutations = {
    showPage (state) {
        return state.show = true;
    },
    hidePage (state) {
        return state.show = false;
    }
};

// Actions
const actions = {
    show({ commit }) {
        commit('showPage');
    },
    hide({ commit }) {
        commit('hidePage');
    }
};

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}
