import VueRouter from 'vue-router';
import VModal from 'vue-js-modal'
import routes from './routes';
import store from './store';
import Vuex from 'vuex';
import Vue from 'vue';


Vue.use(Vuex);
Vue.use(VueRouter);
Vue.use(VModal, { dynamic: true, injectModalsContainer: true });


const app = new Vue({
    el: '#app',

    store: new Vuex.Store({
        modules: { store },
    }),

    router: new VueRouter({
        routes
    }),

    data: () => ({
        showSplashScreen: true,
    }),

    mounted() {
        setTimeout(() => (this.showSplashScreen = false), 5000);
    },
});
