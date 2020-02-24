import VueRouter from 'vue-router'

import Intro from './components/sidebar/Intro.vue';
import contact from './components/sidebar/Contact.vue';
import singleSpot from './components/sidebar/SingleSpot.vue';
import editSpot from './components/sidebar/EditSpot.vue';
import newSpot from './components/sidebar/NewSpot.vue';


const isAuth = (to, from, next) => {
    var jwt = localStorage.getItem('token');
    if (jwt && jwt !== '') {
        next();
    } else {
        next('/');
    }
}


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
        path: '/spot/:spot_id/edit',
        name: 'editSpot',
        component: editSpot,
        beforeEnter: isAuth,
    }, {
        path: '/spot-new',
        name: 'newSpot',
        component: newSpot,
        beforeEnter: isAuth,
    },

    {
        path: '/logout',
        name: 'logout',
        beforeEnter: (to, from, next) => {
            localStorage.removeItem('token');
            next('/');
        },
    },
    ]
})