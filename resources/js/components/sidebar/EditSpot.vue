<template>
    <section
        class="spot-slideout"
        :class="{'visible-mob': spotDetailsVisible}"
    >
        <section
            class="spot-details"
            v-if="spot"
        >
            <section class="spot-images">
                <div
                    class="image"
                    v-for="(photo, i) in photos.slice(0, 9)"
                    :key="i"
                    :style="{'background': `url('${photo}') no-repeat center center`}"
                    @click="enlargePhoto(photo)"
                />
            </section>
            <section class="content">
                <input
                    type="text"
                    class="form-control hover-hidden title"
                    placeholder="Spot Name"
                    v-model="spot.name"
                    @change="update"
                >

                <div class="spot-info">
                    <div class="row">
                        <div class="col-md-3">
                            <small>Bed Rooms</small>
                            <input
                                type="text"
                                class="form-control hover-hidden compact"
                                placeholder="Bed Rooms"
                                v-model="spot.beds"
                                @change="update"
                            >
                        </div>
                        <div class="col-md-3">
                            <small>Bath Rooms</small>
                            <input
                                type="text"
                                class="form-control hover-hidden compact"
                                placeholder="Bath Rooms"
                                v-model="spot.baths"
                                @change="update"
                            >
                        </div>
                        <div class="col-md-3">
                            <small style="display:block;">Sleeps</small>
                            <input
                                type="text"
                                class="form-control hover-hidden compact"
                                placeholder="Sleeps"
                                v-model="spot.sleeps"
                                @change="update"
                            >
                        </div>
                        <div class="col-md-3">
                            <small style="display:block;">SqFT</small>
                            <input
                                type="text"
                                class="form-control hover-hidden compact"
                                placeholder="SqFT"
                                v-model="spot.sqft"
                                @change="update"
                            >
                        </div>
                    </div>

                    <!-- <div
                        class="btn btn-sm btn-primary"
                        @click="update(true)"
                    >
                        View Spot
                    </div> -->
                </div>

                <div class="form-group">
                    <textarea
                        class="form-control hover-hidden"
                        id="description"
                        rows="3"
                        v-model="spot.desc"
                        @change="update"
                    ></textarea>
                </div>

                <!-- <calendar /> -->

                <notifications position="bottom right" />

            </section>
        </section>
    </section>
</template>

<script>
import mapboxgl from "mapbox-gl";
import { mapState, mapActions, mapGetters } from "vuex";

import calendar from "./_calendar.vue";
import photoModal from "./../modals/Photo.vue";

export default {
    components: {
        calendar
    },

    data() {
        return {
            _spotID: false,
            spot: false
        };
    },

    computed: {
        spotID() {
            return this.$router.currentRoute.params.spot_id;
        },
        spotDetailsVisible() {
            return this.$store.state.spotDetailsVisible;
        },
        photos() {
            if (this.spot && this.spot.hasOwnProperty("photos")) {
                return this.spot.photos;
            }
        },
        photo() {
            if (this.spot && this.spot.hasOwnProperty("photo")) {
                return this.spot.photo;
            }
        }
    },

    mounted() {
        this.getSpot(this.spotID)
            .then(spot => (this.spot = spot))
            .catch(err => console.error(err));

        // AB Bad code.
        this._spotID = this.spotID;
        setInterval(() => {
            var routeSpotID = this.$router.currentRoute.params.spot_id;
            if (routeSpotID !== this._spotID) {
                this._spotID = routeSpotID;
                this.getSpot(routeSpotID)
                    .then(spot => (this.spot = spot))
                    .catch(err => console.error(err));
            }
        }, 500);
    },

    methods: {
        ...mapActions(["getSpot", "updateSpot"]),

        openInNewTab(url) {
            window.open(url, "_blank").focus();
        },

        update(redirect) {
            this.$notify("Spot Updated");

            this.updateSpot(this.spot).catch(err => console.error(err));

            // if (redirect === true) this.$router.push(`/spots/${this.spot.id}`);
        },

        enlargePhoto(photo) {
            this.$modal.show(
                photoModal,
                { photo },
                {
                    width: "60%",
                    height: "auto"
                }
            );
        }
    }
};
</script>

<style lang="scss">
.hover-hidden {
    border: 1px solid rgba(0, 0, 0, 0);

    &:hover {
        border: 1px solid rgba(206, 212, 218, 1);
    }

    &.title {
        font-family: "Montserrat", sans-serif;
        font-style: normal;
        font-weight: 700;
        color: #29304c;
        letter-spacing: -0.02em;
        padding: 0px;
        font-size: 24px;
    }

    &.compact {
        width: 85px;
        display: block;
        float: left;
    }
}
</style>