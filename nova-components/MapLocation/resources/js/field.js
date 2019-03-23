Nova.booting((Vue, router, store) => {
    Vue.component('index-map-location', require('./components/IndexField'))
    Vue.component('detail-map-location', require('./components/DetailField'))
    Vue.component('form-map-location', require('./components/FormField'))
})
