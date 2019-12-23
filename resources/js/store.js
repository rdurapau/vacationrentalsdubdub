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
    getSpots({ commit, rootState }) {
        return new Promise((resolve, reject) =>
            axios
                .get("/api/spots?output=geojson")
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
