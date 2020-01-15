import axios from 'axios'

const state = {
    sidebar: 'home',
    activeSpot: false,
};

const getters = {
    sidebar: state => state.sidebar,
    activeSpot: state => state.activeSpot,
};

const mutations = {
    setSidebar: (state, payload) => (state.sidebar = payload),
    setActiveSpot: (state, payload) => (state.activeSpot = payload),
};

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

    triggerNewActiveSpot({ commit, dispatch }, id) {
        return new Promise((resolve, reject) =>
            axios
                .get(`/api/spots/${id}`)
                .then(({ data }) => {
                    commit('setSidebar', 'single');
                    commit('setActiveSpot', data);
                    resolve(data)
                })
                .catch(err => reject(err))
        );
    }
};

export default {
    state,
    getters,
    mutations,
    actions,
};
