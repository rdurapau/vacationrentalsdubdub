import Vue from 'vue'
import Vuex from 'vuex'
// import VueLodash from 'vue-lodash'
// import lodash from 'lodash'
// Vue.use(VueLodash, lodash)

// import Toast from './components/Toast.vue'
// Vue.component('toast', Toast);
// import ToastConfirmation from './components/ToastConfirmation.vue'
// Vue.component('toast-confirmation', ToastConfirmation);

Vue.use(Vuex)

const state = {
    activeSpot: 0,
    spotDetailsVisible : false,
    detailsLoading: false,
    submitPropertyModalVisible: false
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
    },
    showDetailsCard() {
        state.spotDetailsVisible = true;
    },
    closeSpotDetails() {
        state.spotDetailsVisible = false;
        Vue.set(state, 'activeSpot', 0);
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
    getSpotData({commit},id) {
        return axios.get('/api/spots/'+id)
            // .then((response)  => commit.newActiveSpot(response.data))
            // .catch((error) => console.log(error));
    },
    triggerNewActiveSpot({commit, dispatch},id) {
        commit('detailsAreLoading');
        commit('showDetailsCard');
        dispatch('getSpotData',id)
            .then(response => {
                commit('detailsFinishedLoading');
                commit('newActiveSpot',response.data);
            })
            .catch(error => console.log(error));
        return new Promise((resolve) => resolve());
    }
} // ACTIONS

export default new Vuex.Store({
    actions,
    state,
    getters,
    mutations,
})
