import VueRouter from 'vue-router'

import Intro from './components/sidebar/Intro.vue';
import contact from './components/sidebar/Contact.vue';
import singleSpot from './components/sidebar/SingleSpot.vue';
import editSpot from './components/sidebar/EditSpot.vue';
import newSpot from './components/sidebar/NewSpot.vue';



export default new VueRouter({
    routes: [{
        path: '/',
        name: 'home',
        component: Intro,
    },
    {
        path: '/contact',
        name: 'contact',
        component: contact,
    },
    {
        path: '/spot/:spot_id',
        name: 'singleSpot',
        component: singleSpot,
    }, {
        path: '/spots/:spot_id/edit',
        name: 'editSpot',
        component: editSpot,
    }, {
        path: '/spots/new',
        name: 'newSpot',
        component: newSpot,
    },
    ],
})