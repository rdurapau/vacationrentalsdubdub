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
                <h2
                    class="mt-2"
                    v-text="spot.name"
                ></h2>

                <div class="spot-info">
                    <span>{{spot.beds}}BR</span>
                    <span>{{spot.baths}}BA</span>
                    <span>Sleeps: {{spot.sleeps}}</span>
                    <span>{{spot.sqft}} SqFt</span>
                    <div
                        class="btn btn-sm btn-primary"
                        @click="openInNewTab(spot.website)"
                    >
                        Website
                    </div>
                    <a
                        class="btn btn-sm btn-primary"
                        :href="`tel:${spot.phone}`"
                    >
                        Call
                    </a>
                    <!-- <div class="btn btn-sm btn-primary">
                        <i class="fa fa-heart"></i>
                    </div> -->
                </div>

                <div
                    class="spot-description"
                    v-html="spot.desc"
                ></div>

                <!-- <calendar /> -->

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
        ...mapActions(["getSpot"]),

        openInNewTab(url) {
            window.open(url, "_blank").focus();
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
.spot-slideout {
    .spot-images {
        height: 40%;
        .image {
            cursor: pointer;
            float: left;
            width: 33.33333%;
            height: 33.33333%;
            box-shadow: inset 0px 0px 0px 2px #fff;
            -webkit-background-size: cover !important;
            -moz-background-size: cover !important;
            -o-background-size: cover !important;
            background-size: cover !important;
        }
    }

    .spot-info {
        width: 100%;
        margin-bottom: 3px;

        span {
            padding: 0 5px;
            border-right: 1px solid #000;
            font-size: 18px;

            &:first-child {
                padding-left: 0px;
            }

            &:last-of-type {
                border-right: none;
            }
        }
    }
}
</style>
