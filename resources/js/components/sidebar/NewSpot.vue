<template>
    <section class="spot-slideout">
        <section class="spot-details">
            <!-- <section class="spot-images">
                <div
                    class="image"
                    v-for="(photo, i) in photos.slice(0, 9)"
                    :key="i"
                    :style="{'background': `url('${photo}') no-repeat center center`}"
                />
            </section> -->

            <section class="content">
                <article>
                    <div class="form-group">
                        <label for="spot-name">Spot Name</label>
                        <input
                            type="text"
                            class="form-control"
                            id="spot-name"
                            aria-describedby="emailHelp"
                            placeholder="Spot Name"
                        >
                    </div>

                    <div class="form-group">
                        <label for="Description">Description</label>
                        <textarea
                            class="form-control"
                            id="Description"
                            rows="3"
                        ></textarea>
                    </div>

                    <div class="form-group">
                        <label for="Sleeps">Sleeps</label>
                        <input
                            type="number"
                            class="form-control"
                            id="Sleeps"
                            placeholder="Sleeps"
                        >
                    </div>
                    <div class="form-group">
                        <label for="Beds">Beds</label>
                        <input
                            type="number"
                            class="form-control"
                            id="Beds"
                            placeholder="Beds"
                        >
                    </div>
                    <div class="form-group">
                        <label for="Bathrooms">Bathrooms</label>
                        <input
                            type="number"
                            class="form-control"
                            id="Bathrooms"
                            placeholder="Bathrooms"
                        >
                    </div>

                    <hr>
                    <div class="form-group">
                        <label for="Website">Website</label>
                        <input
                            type="text"
                            class="form-control"
                            id="Website"
                            placeholder="Website"
                        >
                    </div>
                    <div class="form-group">
                        <label for="Phone">Phone</label>
                        <input
                            type="text"
                            class="form-control"
                            id="Phone"
                            placeholder="Phone"
                        >
                    </div>
                    <div class="form-group">
                        <label for="Email">Email</label>
                        <input
                            type="text"
                            class="form-control"
                            id="Email"
                            placeholder="Email"
                        >
                    </div>

                    <calendar />

                </article>
            </section>
        </section>
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
