Nova.booting((Vue, router, store) => {
    Vue.config.devtools = true
    Vue.component('index-belongs-to-many-checks', require('./components/IndexField'))
    Vue.component('detail-belongs-to-many-checks', require('./components/DetailField'))
    Vue.component('form-belongs-to-many-checks', require('./components/FormField'))
})
