import Vuex from 'vuex'
import Vue from 'vue'
import createPersistedState from 'vuex-persistedstate'

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        safelyStoredNumber: 0,
        isLoggedIn: false,
        key: null
    },
    getters: {
        safelyStoredNumber: state => state.safelyStoredNumber,
        isLoggedIn: state => state.isLoggedIn,
        key: state => state.key
    },
    mutations: {
        setKey(state, key) {
            state.key = key;
            state.isLoggedIn = true;
        }
    },
    plugins: [createPersistedState()]

});
