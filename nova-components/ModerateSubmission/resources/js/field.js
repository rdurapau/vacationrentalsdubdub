Nova.booting((Vue, router, store) => {
    Vue.component('index-moderate-submission', require('./components/IndexField'))
    Vue.component('detail-moderate-submission', require('./components/DetailField'))
    Vue.component('form-moderate-submission', require('./components/FormField'))
})
