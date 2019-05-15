require('../bootstrap');

import EditSpot from './components/EditSpotNew.vue';
Vue.component('edit-spot-new', EditSpot);

new Vue({
    el: '#edit-spot-wrapper'
});