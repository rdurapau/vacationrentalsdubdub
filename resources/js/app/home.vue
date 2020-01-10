<template>
    <div class="container-fluid app-container">

        <main-nav />

        <div class="container-fluid map-container">
            <div class="row">
                <div class="col-md-6 no-padding">

                    <map-box />

                </div>
                <div class="col-md-6 map-sidebar">

                    <sidebar-home v-if="sidebar === 'home'" />
                    <sidebar-single v-if="sidebar === 'single'" />
                    <sidebar-contact v-if="sidebar === 'contact'" />

                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from "vuex";

import mainNav from "./components/mainNav.vue";
import mapBox from "./components/mapBox.vue";
import sidebarHome from "./components/sidebar-home.vue";
import sidebarSingle from "./components/sidebar-single.vue";
import sidebarContact from "./components/sidebar-contact.vue";

export default {
    components: {
        mainNav,
        mapBox,
        sidebarHome,
        sidebarSingle,
        sidebarContact
    },

    data: () => ({}),

    mounted() {
        // ANTHONY: Consider refatcoring this
        switch (this.$router.currentRoute.name) {
            case "contact":
                this.$store.commit("setSidebar", "contact");
                break;

            case "singleSpot":
                this.$store
                    .dispatch(
                        "triggerNewActiveSpot",
                        this.$router.currentRoute.params.spotID
                    )
                    .catch(err => {
                        console.error(err);
                        this.$store.commit("setSidebar", "home");
                    });
                break;

            case "index":
            default:
                this.$store.commit("setSidebar", "home");
                break;
        }
    },

    computed: {
        ...mapGetters(["sidebar"])
    },

    methods: {}
};
</script>

<style lang="sass">
.map-container
    flex-grow: 1

    > .row
        height: 100%

    .map-sidebar
        background: #FFF
        height: 100%
        box-shadow: 0px 5px 9px rgba(31, 32, 65, 0.1)
        overflow: hidden


        
               
</style>
