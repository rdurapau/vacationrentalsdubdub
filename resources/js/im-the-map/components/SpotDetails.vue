<template>
    <section
        class="spot-slideout"
        :class="{'visible-mob': spotDetailsVisible}"
    >
        <transition name="fade">
            <div
                v-if="isLoading"
                @click.prevent="isLoading = false"
                class="loading-overlay"
            ><span></span></div>
        </transition>

        <reservation-form
            v-if="reservationFormVisible && spot"
            :spot="spot"
            v-on:close="hideReservationForm"
            v-on:close-details="close"
        />

        <section
            class="spot-details"
            v-else-if="spotDetailsVisible && spot"
        >
            <section class="spot-images">
                <div
                    class="image"
                    v-for="(photo, i) in photos.slice(0, 6)"
                    :key="i"
                    :style="{'background': `url('${photo}') no-repeat center center`}"
                />
            </section>
            <section class="content">
                <article>
                    <h2 v-text="spot.name"></h2>
                    <h3>${{spot.price}} Per Night</h3>
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
                        <a
                            :href="spot.website"
                            class="btn btn-primary"
                        >Website</a>
                        <a
                            :href="`tel:${spot.phone}`"
                            class="btn btn-default"
                        >Phone</a>
                    </div>
                    <br />

                    <calendar />

                </article>
            </section>
        </section>

        <section
            class="welcome-pane"
            v-else-if="showContactPage"
        >
            <section class="contact-page">
                <div class="row-3">
                    <div class="contact">
                        <img
                            class="headshot"
                            width="100%"
                            src="/images/seth-headshot.webp"
                            alt="Seth Matthews"
                        />
                        <p class="name">Seth Matthews</p>
                        <p class="role">co-founder | Sales & Marketing</p>
                        <p class="email">
                            <a href="mailto:seth@vrww.app">
                                seth@vr<span class="text-red">ww</span>.app
                            </a>
                        </p>
                    </div>
                </div>
                <div class="row-3">
                    <div class="contact">
                        <img
                            class="headshot"
                            width="100%"
                            src="/images/rick-headshot.webp"
                            alt="Rick DuRapau"
                        />
                        <p class="name">Rick DuRapau</p>
                        <p class="role">co-founder | CVO</p>
                        <p class="email">
                            <a href="mailto:rick@vrww.app">
                                rick@vr<span class="text-red">ww</span>.app
                            </a>
                        </p>
                    </div>
                </div>
                <div class="row-3">

                    <img
                        class="dubdub-logo"
                        width="100%"
                        src="/images/dubdub-logo.webp"
                        alt="dubdub-logo"
                    />

                </div>
            </section>
        </section>

        <section
            class="welcome-pane"
            v-else
        >
            <section class="welcome-message">
                <div class="ww-container">
                    <img src="/images/ww-logo.webp">
                </div>

                <h1>
                    Finally, <br>
                    an easy way to find <br>
                    Vacation Rentals <br>
                    <span>W</span>ith <span>W</span>ebsites
                </h1>

                <div class="dubdub-container">
                    <img src="/images/dubdub-logo.webp">
                </div>
            </section>
        </section>

        <component
            is="style"
            type="text/css"
            scoped
        >
            @media not all and (min-resolution:.001dpcm)
            { @supports (-webkit-appearance:none) {
            .spot-details {
            height:{{innerHeight}} !important;
            }
            }}
        </component>
    </section>
</template>

<script>
let mapboxgl = require("mapbox-gl");
import { mapState, mapGetters } from "vuex";

import calendar from "./calendar";

import ReservationForm from "./ReservationForm.vue";
Vue.component("reservation-form", ReservationForm);

export default {
    components: { calendar },
    data() {
        return {
            currentPhotoIndex: 0,
            reservationFormVisible: false,
            innerHeight: "100%"
        };
    },
    methods: {
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
        showContactPage() {
            return this.$store.state.showContactPage;
        },
        spotDetailsVisible() {
            return this.$store.state.spotDetailsVisible;
        },
        spot() {
            return this.$store.state.activeSpot;
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
        ...mapState([]),
        ...mapGetters([])
    },
    watch: {
        spotDetailsVisible: function() {
            this.$nextTick(function() {
                this.$mapBus.$emit("detailsCardToggled");
            });
        },
        spot: "resetNewSpot"
    },
    mounted() {
        document.addEventListener("keyup", evt => {
            switch (evt.keyCode) {
                case 27:
                    this.close();
                    break;
                case 39:
                    this.nextPhoto();
                    break;
                case 37:
                    this.prevPhoto();
                    break;
            }
        });

        this.innerHeight = window.innerHeight + "px";
        window.onresize = () => (this.innerHeight = window.innerHeight + "px");
    }
};
</script>

<style lang="scss" scoped>
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
    height: 33.333%;
    .image {
        width: 33.33333%;
        height: 50%;
        float: left;
        -webkit-background-size: cover !important;
        -moz-background-size: cover !important;
        -o-background-size: cover !important;
        background-size: cover !important;
    }
}
</style>
