Nova.booting((Vue, router, store) => {
    Vue.component('index-edit-url', require('./components/IndexField'))
    Vue.component('detail-edit-url', require('./components/DetailField'))
    Vue.component('form-edit-url', require('./components/FormField'))
})
