<template>
    <section class="spot-slideout">

        <intro
            v-if="stage == 'intro'"
            :getStartedClicked="onGetStarted"
        />

        <location
            v-if="stage == 'location'"
            :onLocationSelected="onLocation"
        />

        <photos
            v-if="stage == 'photos'"
            :onPhotosSelected="onPhotosSelected"
        />

        <edit-spot
            v-if="stage == 'edit-spot'"
            :spot="spot"
            :onSubmit="onSubmit"
        />

    </section>
</template>

<script>
import { mapState, mapActions, mapGetters } from "vuex";

import intro from "./new-spot/intro.vue";
import location from "./new-spot/location.vue";
import photos from "./new-spot/photos.vue";
import createSpot from "./new-spot/createSpot.vue";

export default {
    components: {
        intro,
        location,
        photos,
        createSpot
    },

    data: () => ({
        stage: "intro",
        // stage: "edit-spot",
        spot: {
            // Location
            address1: "",
            city: "",
            postal_code: "",
            state: "",
            lng: "",
            lat: "",

            // Photos
            photos: [],

            // Create Spot
            name: "",
            desc: "",
            sleeps: "",
            baths: "",
            beds: "",
            sqft: "",
            website: "",
            email: "",
            phone: ""
        }
    }),

    mounted() {},

    methods: {
        ...mapActions(["createNewSpot"]),

        onGetStarted() {
            this.stage = "location";
        },

        onLocation(location) {
            this.spot.address1 = location.address1;
            this.spot.city = location.city;
            this.spot.postal_code = location.postal_code;
            this.spot.state = location.state;
            this.spot.lng = location.lng;
            this.spot.lat = location.lat;

            this.stage = "photos";
        },

        onPhotosSelected(photos) {
            this.spot.photos = photos;
            this.stage = "edit-spot";
        },

        onSubmit(spot) {
            console.log("======");
            console.log(spot);

            this.createNewSpot(spot)
                .then(spot => {
                    console.log(spot);
                    this.spot = spot;
                })
                .catch(err => this.$root.errorHandler(err));
        }
    }
};
</script>
