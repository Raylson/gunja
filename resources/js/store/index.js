import Vue from 'vue';
import Vuex from 'vuex';
import user from './modules/user';


// Load Vuex
Vue.use(Vuex);
// Vue.http.headers.common['Access-Control-Allow-Origin'] = '*';


// Create store
export default new Vuex.Store({
    modules: {
        user
    },
});