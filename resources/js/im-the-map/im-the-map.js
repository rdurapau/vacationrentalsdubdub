require('../bootstrap');

import store from './store.js'

import ImTheMap from './components/ImTheMap.vue';
Vue.component('im-the-map', ImTheMap);

import SpotDetails from './components/SpotDetails.vue';
Vue.component('spot-details', SpotDetails);

import SubmitSpot from './components/SubmitSpot.vue';
Vue.component('submit-spot', SubmitSpot);

import Modals from './components/Modals.vue';
Vue.component('modals', Modals);

import Welcome from './components/WelcomeMob.vue';
Vue.component('welcome-mob', Welcome);

// $editGameBus for passing non-state data between components
Vue.prototype.$mapBus = new Vue();
const spotsMap = new Vue({
    store
}).$mount('#im-the-map');