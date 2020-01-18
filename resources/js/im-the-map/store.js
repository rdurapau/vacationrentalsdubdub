import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

const state = {
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

}

//  #     #                                                  
//  ##   ## #    # #####   ##   ##### #  ####  #    #  ####  
//  # # # # #    #   #    #  #    #   # #    # ##   # #      
//  #  #  # #    #   #   #    #   #   # #    # # #  #  ####  
//  #     # #    #   #   ######   #   # #    # #  # #      # 
//  #     # #    #   #   #    #   #   # #    # #   ## #    # 
//  #     #  ####    #   #    #   #   #  ####  #    #  ####                       
const mutations = {
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

//     #                                        
//    # #    ####  ##### #  ####  #    #  ####  
//   #   #  #    #   #   # #    # ##   # #      
//  #     # #        #   # #    # # #  #  ####  
//  ####### #        #   # #    # #  # #      # 
//  #     # #    #   #   # #    # #   ## #    # 
//  #     #  ####    #   #  ####  #    #  ####  
const actions = {
    getSpots({ commit, rootState }, filters) {

        var params = {
            output: 'geojson'
        }

        if (filters) {
            if (filters.minPrice) params.minPrice = filters.minPrice
            if (filters.maxPrice) params.maxPrice = filters.maxPrice
            if (filters.minBaths) params.minBaths = filters.minBaths
            if (filters.maxBaths) params.maxBaths = filters.maxBaths
            if (filters.minBeds) params.minBeds = filters.minBeds
            if (filters.maxBeds) params.maxBeds = filters.maxBeds
        }


        return new Promise((resolve, reject) =>
            axios
                .get("/api/spots", {
                    params
                })
                .then(({ data }) => resolve(data))
                .catch(err => reject(err)))
    },

    getSpotData({ commit }, id) {
        return axios.get('/api/spots/' + id)
        // .then((response)  => commit.newActiveSpot(response.data))
        // .catch((error) => console.log(error));
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
        // return new Promise((resolve) => resolve());
    }
} // ACTIONS

export default new Vuex.Store({
    actions,
    state,
    getters,
    mutations,
})
