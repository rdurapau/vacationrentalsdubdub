<template>
    <section class="spot-slideout">
        <edit-spot
            v-if="spot"
            :spot="spot"
        />
    </section>
</template>

<script>
import mapboxgl from "mapbox-gl";
import { mapState, mapActions, mapGetters } from "vuex";

// import editSpot from "./new-spot/editSpot.vue";

export default {
    components: {
        // editSpot
    },

    data() {
        return {
            spot: false
        };
    },

    computed: {
        spotID() {
            return this.$router.currentRoute.params.spot_id;
        }
    },

    mounted() {
        this.getSpot(this.spotID)
            .then(spot => (this.spot = spot))
            .catch(err => this.$root.errorHandler(err));
    },

    methods: {
        ...mapActions(["getSpot", "updateSpot"]),

        onClickUpdate() {
            this.updateSpot(this.spot).catch(err =>
                this.$root.errorHandler(err)
            );
        }
    }
};
</script>
