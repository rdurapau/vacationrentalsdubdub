require('../bootstrap');

import store from './store.js'

// import VeeValidate from 'vee-validate';
// Vue.use(VeeValidate);

import ImTheMap from './components/ImTheMap.vue';
Vue.component('im-the-map', ImTheMap);

import SpotDetails from './components/SpotDetails.vue';
Vue.component('spot-details', SpotDetails);

// new Vue({
//     el: '#im-the-map'
// });

// $editGameBus for passing non-state data between components
Vue.prototype.$mapBus = new Vue();
const spotsMap = new Vue({
    store
}).$mount('#im-the-map');

/*

let mapboxgl = require('mapbox-gl');
let MapboxGeocoder = require('mapbox-gl-geocoder');

mapboxgl.accessToken = process.env.MIX_MAPBOX_APP_KEY;
var map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/light-v10',
    center: [-79.4512, 43.6568],
    zoom: 13
});

var geocoder = new MapboxGeocoder({
    accessToken: mapboxgl.accessToken
});

map.addControl(geocoder);

// After the map style has loaded on the page, add a source layer and default
// styling for a single point.
map.on('load', function () {
    map.addSource('single-point', {
        "type": "geojson",
        "data": {
            "type": "FeatureCollection",
            "features": []
        }
    });

    map.addLayer({
        "id": "point",
        "source": "single-point",
        "type": "circle",
        "paint": {
            "circle-radius": 10,
            "circle-color": "#007cbf"
        }
    });

    // Listen for the `result` event from the MapboxGeocoder that is triggered when a user
    // makes a selection and add a symbol that matches the result.
    geocoder.on('result', function (ev) {
        map.getSource('single-point').setData(ev.result.geometry);
    });
});

*/