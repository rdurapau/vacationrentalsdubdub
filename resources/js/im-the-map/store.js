import Vue from 'vue'
import Vuex from 'vuex'
// import VueLodash from 'vue-lodash'
// import lodash from 'lodash'

// import Toast from './components/Toast.vue'
// Vue.component('toast', Toast);
// import ToastConfirmation from './components/ToastConfirmation.vue'
// Vue.component('toast-confirmation', ToastConfirmation);

Vue.use(Vuex)
Vue.use(VueLodash, lodash)

const state = {
    activeSpot: 0
}

//  #     #                                                  
//  ##   ## #    # #####   ##   ##### #  ####  #    #  ####  
//  # # # # #    #   #    #  #    #   # #    # ##   # #      
//  #  #  # #    #   #   #    #   #   # #    # # #  #  ####  
//  #     # #    #   #   ######   #   # #    # #  # #      # 
//  #     # #    #   #   #    #   #   # #    # #   ## #    # 
//  #     #  ####    #   #    #   #   #  ####  #    #  ####                       
const mutations = {
    
}

//     #                                        
//    # #    ####  ##### #  ####  #    #  ####  
//   #   #  #    #   #   # #    # ##   # #      
//  #     # #        #   # #    # # #  #  ####  
//  ####### #        #   # #    # #  # #      # 
//  #     # #    #   #   # #    # #   ## #    # 
//  #     #  ####    #   #  ####  #    #  ####  
const actions = {
    
} // ACTIONS

export default new Vuex.Store({
    actions,
    state,
    getters,
    mutations,
})
