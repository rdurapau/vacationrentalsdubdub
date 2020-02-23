import VeeValidateLaravel from 'vee-validate-laravel';
import VeeValidate from 'vee-validate'
import VueRouter from 'vue-router'
import VModal from 'vue-js-modal'
import Vue from 'vue';

// Store
import store from './store.js';
import router from './router.js';

// Components
import AppHeader from './components/AppHeader.vue';
import MapView from './components/MapView.vue';
import { diffByUnit } from 'fullcalendar';


Vue.component('AppHeader', AppHeader);
Vue.component('MapView', MapView);

Vue.use(VueRouter);
Vue.use(VeeValidate);
Vue.use(VeeValidateLaravel);
Vue.use(VModal, { dynamic: true, injectModalsContainer: true })

Vue.prototype.$mapBus = new Vue();

const app = new Vue({
    store,
    router,

    data: () => ({
        hasSeenSplashScreen: (localStorage.getItem('hasSeenSplashScreen') === 'true')
    }),

    mounted() {
        if (localStorage.getItem('token')) this.$store.commit("setToken", localStorage.getItem('token'));

        if (!this.hasSeenSplashScreen) {
            setTimeout(() => {
                localStorage.setItem('hasSeenSplashScreen', 'true')
                this.hasSeenSplashScreen = true;
                console.log('seen')
            }, 3000)
        }
    },
    methods: {
        errorHandler(err, cb) {
            console.error(err)

            if (typeof cb === 'function' && err.response) cb(err.response)
        }
    }
}).$mount('#app');
