<template>
    <section class="spot-slideout">

        <h1 class="text-center mt-4">
            List Your Spot on VRWW
        </h1>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <p class="text-center">
                    Complete the this short form to list your spot on VRWW. Once we receive your application we will review your listing and publish it.
                    <br>
                    <br>
                    <strong>All We need from you</strong><br>
                    Property Location<br>
                    Propery Photos<br>
                    Short Description<br>
                </p>

                <div class="btn btn-primary btn-block mt-4">
                    Get Started
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import mapboxgl from "mapbox-gl";
import { mapState, mapActions, mapGetters } from "vuex";

export default {
    data() {
        return {
            email: "",
            spot: {
                name: "",
                desc: "",

                sleeps: "",
                beds: "",
                baths: "",

                email: "",
                phone: "",
                website: "",

                address1: "",
                city: "",
                state: "",
                postal_code: "",
                lat: "",
                lng: "",
                amenity_ids: "",
                owner_name: "",
                photos: ""
            }
        };
    },

    mounted() {},

    methods: {
        ...mapActions(["createNewSpot"]),

        onClickCreateNewSpot() {
            this.createNewSpot()
                .then(spot => (this.spot = spot))
                .catch(err => this.$root.errorHandler(err));
        }
    }
};
</script>
