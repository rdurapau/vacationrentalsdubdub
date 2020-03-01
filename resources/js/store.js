import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)


var headers = () => ({
    'Authorization': 'Bearer ' + localStorage.getItem('token')
});

const state = {
    isAuth: false, // Auth status
    token: false, // Auth status
    user: false, // Auth status


    ////////////
    // OLD
    showContactPage: false,

    activeSpot: 0,
    spotDetailsVisible: false,
    detailsLoading: false,
    submitPropertyModalVisible: false,

    cancelConfirmationModalVisible: false,

    visibleInformationalModal: '',

    welcomeWindowVisible: false,

    uploads: []
}

const getters = {
    isAuth: state => (state.isAuth)
}

const mutations = {
    isAuth(state, payload) {
        state.isAuth = payload;
    },
    setUser(state, payload) {
        state.user = payload;
    },
    setToken(state, payload) {
        state.isAuth = true;
        state.token = payload;
    },












    ////////////
    // OLD
    newActiveSpot(state, payload) {
        state.activeSpot = payload;

        // Update query string
        if ('URLSearchParams' in window) {
            var searchParams = new URLSearchParams(window.location.search)
            searchParams.set("spot", payload.id);
            var newRelativePathQuery = window.location.pathname + '?' + searchParams.toString();
            history.pushState(null, '', newRelativePathQuery);
        }
    },
    showDetailsCard() {
        state.spotDetailsVisible = true;
    },
    closeSpotDetails() {
        state.spotDetailsVisible = false;
        Vue.set(state, 'activeSpot', 0);

        // Update query string
        if ('URLSearchParams' in window) {
            var searchParams = new URLSearchParams(window.location.search)
            searchParams.delete("spot");

            var newRelativePathQuery = (searchParams.toString())
                ? window.location.pathname + '?' + searchParams.toString()
                : window.location.pathname;
            history.pushState(null, '', newRelativePathQuery);
        }
    },
    detailsAreLoading() {
        state.detailsLoading = true;
    },
    detailsFinishedLoading() {
        state.detailsLoading = false;
    },

    showSubmitPropertyModal() {
        state.submitPropertyModalVisible = true;
    },
    hideSubmitPropertyModal() {
        state.submitPropertyModalVisible = false;
    },

    showCancelConfirmationModal() {
        state.cancelConfirmationModalVisible = true;
    },
    hideCancelConfirmationModal() {
        state.cancelConfirmationModalVisible = false;
    },

    showWelcomeWindow() {
        state.welcomeWindowVisible = true;
    },
    hideWelcomeWindow() {
        state.welcomeWindowVisible = false;
    },

    showInformationalModal(state, which) {
        state.visibleInformationalModal = which;
    },
    closeInformationalModal() {
        state.visibleInformationalModal = '';
    },

    addUploadToTopOfList(state, payload) {
        state.uploads.unshift(payload);
        console.log(state.uploads);
    },
    addUploadToList(state, payload) {
        state.uploads.push(payload);
        console.log(state.uploads);
    },
    removeUploadFromList(state, payload) {
        console.log(payload);
        // console.log(state.uploads.indexOf(payload));
        state.uploads.splice(
            state.uploads.findIndex(item => item.filename === payload.name),
            1
        );
        // state.uploads.splice(state.uploads.indexOf(payload), 1);
    }
}


const actions = {
    signUp({ commit }, signUp) {
        return new Promise((resolve, reject) =>
            axios
                .post(`/api/sign-up`, signUp)
                .then(({ data }) => resolve(data))
                .catch(err => reject(err)))
    },
    login({ commit }, login) {
        return new Promise((resolve, reject) =>
            axios
                .post(`/api/login`, login)
                .then(({ data }) => resolve(data))
                .catch(err => reject(err)))
    },


    getSpots({ commit, rootState }, filters) {
        return new Promise((resolve, reject) =>
            axios
                .get("/api/spots", {
                    params: {
                        output: 'geojson'
                    }
                })
                .then(({ data }) => resolve(data))
                .catch(err => reject(err)))
    },
    getMySpots({ commit }) {
        return new Promise((resolve, reject) =>
            axios
                .get(`/api/my-spots`, {
                    headers: headers()
                })
                .then(({ data }) => resolve(data))
                .catch(err => reject(err)))
    },
    getSpot({ commit }, spotID) {
        return new Promise((resolve, reject) =>
            axios
                .get(`/api/spots/${spotID}`)
                .then(({ data }) => resolve(data))
                .catch(err => reject(err)))
    },
    updateSpot({ commit }, spot) {
        return new Promise((resolve, reject) =>
            axios
                .post(`/api/spots/${spot.id}`, spot)
                .then(({ data }) => resolve(data))
                .catch(err => reject(err)))
    },
    createNewSpot({ commit }, spot) {
        return new Promise((resolve, reject) =>
            axios
                .post(`/api/spots/new`, spot, {
                    headers: headers()
                })
                .then(({ data }) => resolve(data))
                .catch(err => reject(err)))
    },



    getSpotData({ commit }, id) {
        return axios.get('/api/spots/' + id)
    },
    triggerNewActiveSpot({ commit, dispatch }, id) {
        commit('detailsAreLoading');
        commit('showDetailsCard');
        return dispatch('getSpotData', id)
            .then(response => {
                commit('detailsFinishedLoading');
                commit('newActiveSpot', response.data);
            })
            .catch(error => console.log(error));
    }
}

export default new Vuex.Store({
    actions,
    state,
    getters,
    mutations,
})
