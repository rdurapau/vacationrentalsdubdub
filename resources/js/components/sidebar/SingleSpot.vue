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
                <h2 v-text="spot.name"></h2>
                <section class="icon-deets">
                    <div v-if="spot.sleeps">
                        <img src="/images/icons/person-circle.svg" />
                        <span>Sleeps {{spot.sleeps}}</span>
                    </div>
                    <div v-if="spot.sleeps">
                        <img src="/images/icons/bed.svg" />
                        <span>{{spot.beds}} beds</span>
                    </div>
                    <div v-if="spot.baths">
                        <img src="/images/icons/shower.svg" />
                        <span>{{spot.baths}} baths</span>
                    </div>
                </section>

                <div
                    class="spot-description"
                    v-html="spot.desc"
                ></div>
                <br />
                <div class="btn-group">
                    <div
                        class="btn btn-primary"
                        @click="openInNewTab(spot.website)"
                    >Website</div>
                    <a
                        :href="`tel:${spot.phone}`"
                        class="btn btn-default"
                    >Phone</a>
                    <a
                        tabindex
                        class="btn btn-default"
                    >Favorite</a>
                </div>
                <br />

                <calendar />

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

    watch: {},

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
        },

        ////////
        // OLD
        close() {
            this.$store.commit("closeSpotDetails");
        },

        nextPhoto() {
            if (this.currentPhotoIndex + 1 == this.photos.length) {
                this.currentPhotoIndex = 0;
            } else {
                this.currentPhotoIndex++;
            }
        },
        prevPhoto() {
            if (this.currentPhotoIndex == 0) {
                this.currentPhotoIndex = this.photos.length - 1;
            } else {
                this.currentPhotoIndex--;
            }
        },
        goToPhoto(index) {
            this.currentPhotoIndex = index;
        },
        resetNewSpot() {
            this.currentPhotoIndex = 0;
        },

        showReservationForm() {
            this.reservationFormVisible = true;
        },
        hideReservationForm() {
            this.reservationFormVisible = false;
        }
    },
    computed: {
        spotID() {
            return this.$router.currentRoute.params.spot_id;
        },

        ////////////
        showContactPage() {
            return this.$store.state.showContactPage;
        },
        spotDetailsVisible() {
            return this.$store.state.spotDetailsVisible;
        },
        amenities() {
            if (this.spot && this.spot.hasOwnProperty("amenities")) {
                return this.spot.amenities;
            }
        },
        featuredAmenities() {
            if (this.amenities) {
                return this.amenities.filter(a => a.is_featured);
            }
        },
        groupedAmenities() {
            if (this.amenities) {
                let nonfeatured = this.amenities.filter(a => !a.is_featured);
                return nonfeatured.reduce((objectsByKeyValue, obj) => {
                    const value = obj["type"];
                    objectsByKeyValue[value] = (
                        objectsByKeyValue[value] || []
                    ).concat(obj);
                    return objectsByKeyValue;
                }, {});
            }
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
        },
        isLoading() {
            return this.$store.state.detailsLoading;
        },
        ...mapGetters([])
    }
};
</script>

<style lang="scss">
.contact-page {
    height: 100%;
}
.row-3 {
    height: 33.3333%;
}
.contact-page .contact img {
    width: 150px;
    display: block;
    margin: auto;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
    border-radius: 50%;
    border: 2px solid white;
    background-color: white;
    overflow: hidden;
}
.contact-page .contact p {
    text-align: center;
    margin-top: 0px;
    margin-bottom: 0px;
}
.contact-page .contact p.name {
    font-size: 20px;
    margin-top: 10px;
    font-weight: 700;
}
.contact-page .contact p.role {
    font-size: 18px;
    margin-top: 10px;
}
.contact-page .contact p.email {
    font-size: 18px;
    margin-top: 5px;
}
.contact-page .contact p.email a {
    color: inherit;
    text-decoration: none;
}
.contact-page .dubdub-logo {
    width: 50%;
    display: block;
    margin: 20px auto;
}

.spot-images {
    height: 40%;
    .image {
        box-shadow: inset 0px 0px 0px 2px #fff;
        width: 33.33333%;
        height: 33.33333%;
        float: left;
        -webkit-background-size: cover !important;
        -moz-background-size: cover !important;
        -o-background-size: cover !important;
        background-size: cover !important;
    }
}
</style>
