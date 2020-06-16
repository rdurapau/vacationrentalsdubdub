require('../bootstrap');

import EditSpot from './components/EditSpot.vue';
Vue.component('edit-spot', EditSpot);

new Vue({
    el: '#edit-spot-wrapper'
});