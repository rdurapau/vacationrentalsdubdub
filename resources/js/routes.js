import home from './app/home.vue'

export default [
    {
        path: '/',
        name: 'index',
        component: home,
    },
    {
        path: '/contact',
        name: 'contact',
        component: home,
    },
    {
        path: '/spot/:spotID',
        name: 'singleSpot',
        component: home,
    },
];