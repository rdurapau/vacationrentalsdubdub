<template>
    <div>
        <div class="row header">
            <div class="col-md-6">

                <div
                    id="logo"
                    @click="$router.push('/')"
                ></div>

                <div id="geocoder"></div>

            </div>
            <div class="col-md-6">
                <nav class="main">
                    <ul>
                        <li @click="showAboutModal">
                            About
                        </li>

                        <li @click="$router.push('/contact')">
                            Contact
                        </li>

                        <li
                            v-if="!isAuth"
                            @click="showSubmitPropertyModal"
                        >
                            Owner Sign Up
                        </li>
                        <li
                            v-else
                            @click="onClickShowCalendar"
                        >
                            Calendar
                        </li>

                        <li
                            v-if="!isAuth"
                            @click="showSignInModal"
                        >
                            Sign In
                        </li>
                        <li
                            v-else
                            @click="onClickEditMySpot"
                        >
                            My Spot
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</template>

<script>
import aboutModal from "./modals/About.vue";
import SignUp from "./modals/SignUp.vue";
import signInModal from "./modals/SignIn.vue";
import editCalendarModal from "./modals/EditCalendar.vue";

import { mapActions, mapGetters } from "vuex";
import mapboxgl from "mapbox-gl";
import MapboxGeocoder from "@mapbox/mapbox-gl-geocoder";
mapboxgl.accessToken =
    "pk.eyJ1IjoiY2FiZWViIiwiYSI6ImNqczIxdGlsNzA5b280M28yMmI2eHZzcWIifQ.HcTinfBh6KX4myzAFTNqKQ";

export default {
    data: () => ({}),

    mounted() {},

    computed: {
        ...mapGetters(["isAuth"])
    },

    methods: {
        ...mapActions(["getMySpots"]),

        showAboutModal() {
            this.$modal.show(
                aboutModal,
                {},
                {
                    width: "70%",
                    height: "auto"
                }
            );
        },
        showSubmitPropertyModal() {
            this.$modal.show(
                SignUp,
                {},
                {
                    width: "40%",
                    height: "auto"
                }
            );
        },
        showSignInModal() {
            this.$modal.show(
                signInModal,
                {},
                {
                    width: "40%",
                    height: "auto"
                }
            );
        },
        onClickEditMySpot() {
            this.getMySpots()
                .then(spots => {
                    if (spots.length === 0) this.$router.push(`/spots/new`);
                    if (spots.length > 0)
                        this.$router.push(`/spots/${spots[0].id}/edit`);
                })
                .catch(err => this.$root.errorHandler(err));
        },
        onClickShowCalendar() {
            this.$modal.show(
                editCalendarModal,
                {},
                {
                    width: "40%",
                    height: "auto"
                }
            );
        }
    }
};
</script>

<style lang="scss">
.row.header {
    padding: 10px;
}

#logo {
    display: block;
    float: left;
    height: 55px;
    width: 250px;
    background: url("./../../img/logo.png") no-repeat 30px;
    background-size: contain;
}

#geocoder {
    float: left;
    margin: 0 0 0 20px;

    .mapboxgl-ctrl-geocoder {
        box-shadow: none;

        .mapboxgl-ctrl-geocoder--input {
            width: 300px;
            height: auto;
            font-size: 20px;
            border-radius: 3px;
            border: 2px solid rgba(0, 0, 0, 0.1);
            padding: 10px 40px;
        }
    }
}

nav.main {
    ul {
        li {
            padding: 0 30px;
            float: left;
            text-decoration: none;
            font-weight: 600;
            color: #29304c;
            font-size: 20px;
            cursor: pointer;
        }
    }
}
</style>