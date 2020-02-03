<template>
    <section class="spot-slideout">
        <section
            class="spot-details"
            v-if="spot"
        >
            <section class="spot-images">
                <div
                    class="image"
                    v-for="(photo, i) in spot.photos.slice(0, 9)"
                    :key="i"
                    :style="{'background': `url('${photo}') no-repeat center center`}"
                />
            </section>

            <section class="content">
                <article class="scroll">
                    <div class="form-group">
                        <label for="spot-name">Spot Name</label>
                        <input
                            type="text"
                            class="form-control"
                            id="spot-name"
                            placeholder="Spot Name"
                            v-model="spot.name"
                        >
                    </div>

                    <div class="form-group">
                        <label for="Description">Description</label>
                        <textarea
                            class="form-control"
                            id="Description"
                            rows="5"
                            v-model="spot.desc"
                        ></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="Sleeps">Sleeps</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    id="Sleeps"
                                    placeholder="Sleeps"
                                    v-model="spot.sleeps"
                                >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="Beds">Beds</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    id="Beds"
                                    placeholder="Beds"
                                    v-model="spot.beds"
                                >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="Bathrooms">Bathrooms</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    id="Bathrooms"
                                    placeholder="Bathrooms"
                                    v-model="spot.baths"
                                >
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="form-group">
                        <label for="Website">Website</label>
                        <input
                            type="text"
                            class="form-control"
                            id="Website"
                            placeholder="Website"
                            v-model="spot.website"
                        >
                    </div>
                    <div class="form-group">
                        <label for="Phone">Phone</label>
                        <input
                            type="text"
                            class="form-control"
                            id="Phone"
                            placeholder="Phone"
                            v-model="spot.phone"
                        >
                    </div>
                    <button
                        type="button"
                        class="btn mb-2 btn-primary"
                        @click="onClickUpdate"
                    >Update</button>

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
