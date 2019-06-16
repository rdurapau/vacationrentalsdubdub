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

import MapFooter from './components/MapFooter.vue';
Vue.component('map-footer', MapFooter);

import Welcome from './components/Welcome.vue';
Vue.component('welcome', Welcome);

// $editGameBus for passing non-state data between components
Vue.prototype.$mapBus = new Vue();
const spotsMap = new Vue({
    store
}).$mount('#im-the-map');