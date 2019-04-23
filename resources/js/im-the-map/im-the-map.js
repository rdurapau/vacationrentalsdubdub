require('../bootstrap');

import store from './store.js'

import ImTheMap from './components/ImTheMap.vue';
Vue.component('im-the-map', ImTheMap);

import SpotDetails from './components/SpotDetails.vue';
Vue.component('spot-details', SpotDetails);

import SubmitSpot from './components/SubmitSpot.vue';
Vue.component('submit-spot', SubmitSpot);

// $editGameBus for passing non-state data between components
Vue.prototype.$mapBus = new Vue();
const spotsMap = new Vue({
    store
}).$mount('#im-the-map');