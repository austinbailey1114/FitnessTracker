import Vuex from 'vuex'
import Vue from 'vue'
import createPersistedState from 'vuex-persistedstate'

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        key: null,
        user_id: null
    },
    getters: {
        getKey: state => state.key,
        getId: state => state.user_id
    },
    mutations: {
        setKey(state, key) {
            state.key = key;
        },
        setId(state, user_id) {
            state.user_id = user_id;
        }
    },
    plugins: [createPersistedState()]

});
