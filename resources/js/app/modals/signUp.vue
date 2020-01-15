<template>
    <div class="signup-modal">
        <div class="row">
            <div class="col-md-12">
                <img
                    src="/images/icons_v2/logo.webp"
                    class="logo"
                    alt="logo"
                />
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <ul class="progress-list">
                    <li
                        class="personal"
                        :class="{'current': (section === 'personal-info')}"
                    >
                        <div class="label">
                            Personal Info
                        </div>
                    </li>
                    <li
                        class="location"
                        :class="{'current': (section === 'property-location')}"
                    >
                        <div class="icon">
                        </div>
                        <div class="label">
                            Property Location
                        </div>
                    </li>
                    <li
                        class="details"
                        :class="{'current': (section === 'property-details')}"
                    >
                        <div class="icon">
                            <span>
                            </span>
                        </div>
                        <div class="label">
                            Property Details
                        </div>
                    </li>
                    <li
                        class="photos"
                        :class="{'current': (section === 'property-photos')}"
                    >
                        <div class="icon">
                            <span>

                            </span>
                        </div>
                        <div class="label">
                            Property Photos
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-md-9 sections">
                <section
                    v-if="section == 'personal-info'"
                    class="personal-info"
                >
                    <div class="row">
                        <div class="col-md-8">
                            <h1>Personal Info</h1>
                            <hr>
                            <section class="fieldset required">
                                <div class="form-group">
                                    <label for="full-name">Your Full Name</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="full-name"
                                        placeholder="Your Full Name"
                                        v-model="submission.name"
                                    >
                                    <label
                                        v-if="errors.name"
                                        class="form-label error"
                                    >{{errors.name.msg}}</label>
                                </div>
                                <div class="form-group">
                                    <label for="email-address">Email Address</label>
                                    <input
                                        type="email"
                                        class="form-control"
                                        id="email-address"
                                        placeholder="JohnSmith@gmail.com"
                                        v-model="submission.email"
                                    >
                                    <label
                                        v-if="errors.email"
                                        class="form-label error"
                                    >{{errors.email.msg}}</label>
                                </div>
                                <div class="form-group">
                                    <label for="phone-number">Phone Number</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="phone-number"
                                        placeholder="512-123-4567"
                                        v-model="submission.phone"
                                    >
                                    <label
                                        v-if="errors.phone"
                                        class="form-label error"
                                    >{{errors.phone.msg}}</label>
                                </div>
                            </section>
                        </div>
                        <div class="col-md-4 section-hint">
                            <h2>Nice to meet you!</h2>
                            <p>The only information that will be shared with guests is your name phone number so they can contact you directly.</p>
                            <p>Your email will be used for communication with us and for booking requests.</p>
                        </div>
                    </div>
                    <div class="bottom-nav">
                        <hr>
                        <button
                            class="btn btn-primary btn-lg"
                            @click="onClickPersonalInfoContinue"
                        >Save & Continue</button>
                    </div>
                </section>

                <section
                    v-if="section == 'property-location'"
                    class="property-location"
                >
                    <div class="row">
                        <div class="col-md-8">
                            <h1>Property Location</h1>
                            <hr>
                            <section class="fieldset required">

                                <div
                                    id="submit-property-geocoder"
                                    class="geocoder"
                                >
                                </div>

                                <div
                                    id="submit-property-map"
                                    style="height: 350px;width: 100%;"
                                >
                                    <svg
                                        width="16"
                                        height="26"
                                        viewBox="0 0 16 26"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="marker"
                                        v-if="isAddressSelected"
                                    >
                                        <ellipse
                                            cx="8"
                                            cy="24.5"
                                            rx="5"
                                            ry="1.5"
                                            fill="black"
                                            fill-opacity="0.1"
                                        />
                                        <path
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M0.0244141 8C0.0293565 3.58378 3.59557 0.00495989 7.99625 0C12.3969 0.00495989 15.9631 3.58378 15.9681 8C15.9681 11.514 10.9857 20.026 8.84525 23.523C8.66536 23.8206 8.34308 24.0017 7.99625 24C7.65007 24.0001 7.32864 23.8199 7.14725 23.524C5.00681 20.025 0.0244141 11.51 0.0244141 8ZM4.50854 8C4.50854 9.933 6.07004 11.5 7.99623 11.5C9.92243 11.5 11.4839 9.933 11.4839 8C11.4839 6.067 9.92243 4.5 7.99623 4.5C6.07004 4.5 4.50854 6.067 4.50854 8Z"
                                            fill="#9080F0"
                                        />
                                    </svg>
                                </div>

                            </section>
                        </div>
                        <div class="col-md-4 section-hint">
                            <h2>Property address</h2>
                            <p>The property address will be used to place a pin on the map for users browsing listing. The precise location will not be shared until booking.</p>
                        </div>
                    </div>
                    <div class="bottom-nav">
                        <hr>
                        <button
                            class="btn btn-primary btn-lg"
                            @click="onClickPropertyLocationContinue"
                            v-if="isAddressSelected"
                        >Save & Continue</button>
                        <button
                            class="btn btn-outline btn-lg"
                            @click="onClickPropertyLocationBack"
                        >Back</button>
                    </div>
                </section>

                <section
                    v-if="section == 'property-details'"
                    class="property-details"
                >
                    <div class="row mt-4">
                        <div class="col-md-8">
                            <h1>Property Details</h1>
                            <hr>
                            <section class="fieldset required">
                                <div class="form-group">
                                    <label for="property-title">Property Title</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="property-title"
                                        placeholder="Property Title"
                                        v-model="submission.name"
                                    >
                                    <label
                                        v-if="errors.name"
                                        class="form-label error"
                                    >{{errors.name.msg}}</label>
                                </div>
                                <div class="form-group">
                                    <label for="property-website">Property Website</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="property-website"
                                        placeholder="Property Website"
                                        v-model="submission.website"
                                    >
                                    <label
                                        v-if="errors.email"
                                        class="form-label error"
                                    >{{errors.email.msg}}</label>
                                </div>
                                <div class="form-group">
                                    <label for="price-per-night">Price Per Night</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="price-per-night"
                                        placeholder="Price Per Night"
                                        v-model="submission.phone"
                                    >
                                    <label
                                        v-if="errors.phone"
                                        class="form-label error"
                                    >{{errors.phone.msg}}</label>
                                </div>
                            </section>
                        </div>
                        <div class="col-md-4 section-hint">
                            <h2>Property Title</h2>
                            <p>The property title is a short, memorable description of your spot. It will appear at the top of your spot’s listing.</p>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-8">
                            <h3>Accommodations</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="property-title">Number of Beds</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="property-title"
                                            placeholder="Property Title"
                                            v-model="submission.name"
                                        >
                                        <label
                                            v-if="errors.name"
                                            class="form-label error"
                                        >{{errors.name.msg}}</label>
                                    </div>
                                    <div class="form-group">
                                        <label for="property-title">Comfortably Sleeps</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="property-title"
                                            placeholder="Property Title"
                                            v-model="submission.name"
                                        >
                                        <label
                                            v-if="errors.name"
                                            class="form-label error"
                                        >{{errors.name.msg}}</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="property-title">Number of Baths</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="property-title"
                                            placeholder="Property Title"
                                            v-model="submission.name"
                                        >
                                        <label
                                            v-if="errors.name"
                                            class="form-label error"
                                        >{{errors.name.msg}}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 section-hint">
                            <h2>Accommodations</h2>
                            <p>How many guests can your spot be expected to comfortably accomodate?</p>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-8">
                            <h3>Amenities</h3>
                            <h5 class="mt-2">Bed & Bath</h5>
                            <div
                                class="form-check form-check-inline"
                                v-for="(amenity, i) in amenities.bed"
                                :key="i"
                            >
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    id="inlineCheckbox1"
                                    :value="amenity.id"
                                >
                                <label
                                    class="form-check-label"
                                    for="inlineCheckbox1"
                                >{{amenity.name}}</label>
                            </div>

                            <h5 class="mt-2">Household</h5>
                            <div
                                class="form-check form-check-inline"
                                v-for="(amenity, i) in amenities.household"
                                :key="i"
                            >
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    id="inlineCheckbox1"
                                    :value="amenity.id"
                                >
                                <label
                                    class="form-check-label"
                                    for="inlineCheckbox1"
                                >{{amenity.name}}</label>
                            </div>

                            <h5 class="mt-2">Kitchen & Dining</h5>
                            <div
                                class="form-check form-check-inline"
                                v-for="(amenity, i) in amenities.kitchen"
                                :key="i"
                            >
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    id="inlineCheckbox1"
                                    :value="amenity.id"
                                >
                                <label
                                    class="form-check-label"
                                    for="inlineCheckbox1"
                                >{{amenity.name}}</label>
                            </div>

                            <h5 class="mt-2">Entertainment & Outdoors</h5>
                            <div
                                class="form-check form-check-inline"
                                v-for="(amenity, i) in amenities.entertainment"
                                :key="i"
                            >
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    id="inlineCheckbox1"
                                    :value="amenity.id"
                                >
                                <label
                                    class="form-check-label"
                                    for="inlineCheckbox1"
                                >{{amenity.name}}</label>
                            </div>

                            <h5 class="mt-2">Safety</h5>
                            <div
                                class="form-check form-check-inline"
                                v-for="(amenity, i) in amenities.safety"
                                :key="i"
                            >
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    id="inlineCheckbox1"
                                    :value="amenity.id"
                                >
                                <label
                                    class="form-check-label"
                                    for="inlineCheckbox1"
                                >{{amenity.name}}</label>
                            </div>
                        </div>
                        <div class="col-md-4 section-hint">
                            <h2>Amenities</h2>
                            <p>Amenities are not required, but the more the merrier - Help your guests feel more at home by selecting all that your spot offers.</p>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-8">

                            <wysiwyg v-model="propertyDescription" />

                        </div>
                        <div class="col-md-4 section-hint">
                            <h2>Property Description</h2>
                            <p>To help people understand why they should choose your property during their time off, write as detailed a description as you desire.</p>
                        </div>
                    </div>

                    <div class="bottom-nav">
                        <hr>
                        <button
                            class="btn btn-primary btn-lg"
                            @click="onClickPersonalInfoContinue"
                        >Save & Continue</button>
                    </div>
                </section>
            </div>
        </div>

    </div>
</template>

<script>
import { mapGetters } from "vuex";
import validator from "validator";

import mapboxgl from "mapbox-gl";
import MapboxGeocoder from "mapbox-gl-geocoder";
mapboxgl.accessToken =
    "pk.eyJ1IjoiY2FiZWViIiwiYSI6ImNqczIxdGlsNzA5b280M28yMmI2eHZzcWIifQ.HcTinfBh6KX4myzAFTNqKQ";

export default {
    components: {},

    data: () => ({
        section: "personal-info",
        // section: "property-details",
        isAddressSelected: false,
        map: false,
        errors: {},

        amenities: {
            bed: [
                {
                    id: 1,
                    name: "Bed linens"
                },
                {
                    id: 2,
                    name: "Extra pillows & blankets"
                },
                {
                    id: 3,
                    name: "Hangers"
                },
                {
                    id: 4,
                    name: "Iron"
                },
                {
                    id: 5,
                    name: "Closet / drawers"
                },
                {
                    id: 6,
                    name: "Bath towels"
                },
                {
                    id: 7,
                    name: "Toilet paper"
                },
                {
                    id: 8,
                    name: "Hair dryer"
                },
                {
                    id: 9,
                    name: "Soap"
                },
                {
                    id: 10,
                    name: "Shampoo"
                },
                {
                    id: 11,
                    name: "Toothpaste"
                }
            ],
            household: [
                {
                    id: 12,
                    name: "Air conditioning"
                },
                {
                    id: 13,
                    name: "Kitchen"
                },
                {
                    id: 14,
                    name: "Washing machine"
                },
                {
                    id: 15,
                    name: "Dryer"
                },
                {
                    id: 16,
                    name: "Pets in the house"
                }
            ],
            kitchen: [
                {
                    id: 17,
                    name: "Coffee maker"
                },
                {
                    id: 18,
                    name: "Coffee / tea"
                },
                {
                    id: 19,
                    name: "Dishes & silverware"
                },
                {
                    id: 20,
                    name: "Pots & pans"
                },
                {
                    id: 21,
                    name: "Dishwasher"
                },
                {
                    id: 22,
                    name: "Microwave"
                },
                {
                    id: 23,
                    name: "Refrigerator"
                },
                {
                    id: 24,
                    name: "Oven"
                },
                {
                    id: 25,
                    name: "Stove"
                }
            ],
            entertainment: [
                {
                    id: 26,
                    name: "Wifi"
                },
                {
                    id: 27,
                    name: "TV"
                },
                {
                    id: 28,
                    name: "Cable"
                },
                {
                    id: 29,
                    name: "Movies"
                },
                {
                    id: 30,
                    name: "Music"
                },
                {
                    id: 31,
                    name: "Books"
                },
                {
                    id: 32,
                    name: "Board games"
                },
                {
                    id: 33,
                    name: "Playing cards"
                },
                {
                    id: 34,
                    name: "Outdoor deck"
                },
                {
                    id: 35,
                    name: "Fire pit"
                },
                {
                    id: 36,
                    name: "Swimming pool"
                },
                {
                    id: 37,
                    name: "Hot tub"
                }
            ],
            safety: [
                {
                    id: 38,
                    name: "Smoke detector"
                },
                {
                    id: 39,
                    name: "Carbon monoxide detector"
                },
                {
                    id: 40,
                    name: "First aid kit"
                },
                {
                    id: 41,
                    name: "Fire extinguisher"
                }
            ]
        },
        submission: {
            // Personal Info
            name: "",
            email: "",
            phone: "",

            // Property Location
            address1: "",
            city: "",
            state: "",
            postal_code: "",
            lat: "",
            lng: "",

            website: "",
            price: "",

            desc: "",
            owner_name: "",
            sleeps: "",
            baths: "",
            beds: "",
            amenity_ids: [],

            photos: []
        },
        propertyDescription: ""
    }),

    watch: {
        section(newValue) {
            if (newValue === "property-location") {
                this.initMap();
            } else {
                this.hideMap();
            }
        }
    },

    mounted() {
        if (this.section === "property-location") this.initMap();
    },

    methods: {
        //////////////////////////////////////////////////
        // Personal Info
        onClickPersonalInfoContinue() {
            this.errors = {};

            if (this.submission.name == "") {
                this.errors = {
                    name: {
                        msg: "You must provide a name"
                    }
                };
                return;
            }

            if (!validator.isEmail(this.submission.email)) {
                this.errors = {
                    email: {
                        msg: "This email address is not valid"
                    }
                };
                return;
            }

            if (this.submission.phone == "") {
                this.errors = {
                    phone: {
                        msg: "You must provide a phone number"
                    }
                };
                return;
            }

            this.section = "property-location";
        },

        //////////////////////////////////////////////////
        // Property Location
        initMap() {
            setTimeout(() => {
                this.map = new mapboxgl.Map({
                    container: "submit-property-map",
                    style: "mapbox://styles/mapbox/light-v10",
                    center: [-98.5833, 39.833333],
                    zoom: 2
                });

                this.map.addControl(
                    new mapboxgl.NavigationControl({
                        showCompass: false
                    })
                );

                this.geocoder = new MapboxGeocoder({
                    accessToken: mapboxgl.accessToken,
                    country: "US",
                    types: "address",
                    placeholder: "Search Address",
                    flyTo: false
                });

                document
                    .getElementById("submit-property-geocoder")
                    .appendChild(this.geocoder.onAdd(this.map));
                document.querySelector(
                    "#submit-property-geocoder .mapboxgl-ctrl-geocoder input"
                ).id = "property-location-input";

                this.map.on("load", () => {
                    this.geocoder.on("result", this.addressSelected);
                    // this.geocoder.on("clear", this.addressCleared);
                    this.map.on("dragend", this.mapMoved);
                    this.map.on("zoomend", this.mapMoved);
                });
            }, 100);
        },

        hideMap() {
            $("#submit-property-map").html("");
            $("#submit-property-geocoder").html("");
        },

        addressSelected(ev) {
            let context = ev.result.context;
            let coords = ev.result.geometry.coordinates;

            this.submission.address1 =
                (ev.result.address ? ev.result.address + " " : "") +
                ev.result.text;
            this.submission.city = context.find(e =>
                e.id.includes("place")
            ).text;
            this.submission.state = context.find(e =>
                e.id.includes("region")
            ).text;
            this.submission.postal_code = context.find(e =>
                e.id.includes("postcode")
            ).text;
            this.submission.lng = coords[0];
            this.submission.lat = coords[1];

            this.isAddressSelected = true;
            this.map.jumpTo({
                center: coords,
                zoom: 16
            });
        },
        mapMoved(ev) {
            if (this.isAddressSelected) {
                let coords = this.map.getCenter();
                this.submission.lat = coords.lat;
                this.submission.lng = coords.lng;
            }
        },
        onClickPropertyLocationContinue() {
            if (this.isAddressSelected) this.section = "property-details";
        },
        onClickPropertyLocationBack() {
            this.section = "personal-info";
        },

        onClickPropertyDetailsContinue() {
            // validate
            this.section = "property-photos";
        },
        onClickPropertyDetailsBack() {
            this.section = "personal-location";
        },

        onClickPropertyPhotosContinue() {
            // validate
            // Submit
        },
        onClickPropertyPhotosBack() {
            this.section = "personal-photos";
        }
    }
};
</script>

<style lang="scss">
$bright: #fff;
$blue: #45aef1;
$purple: #9080f0;
$orange: #f69158;
$green: #4be981;
$dark: #29304c;
$grey: #666;
$light-grey: #ccc;

.v--modal-box {
    border-radius: 10px;
}

.form-label.error {
    color: #f00;
}

.signup-modal {
    padding: 20px;
    height: 100%;
    overflow-y: scroll;

    .logo {
        width: 170px;
    }

    ul.progress-list {
        list-style-type: none;
        padding: 20px 0 0 20px;

        li {
            width: 100%;
            display: block;
            height: 50px;
            color: #cdcdcd;

            &.current {
                color: #212529;
            }

            .icon {
                width: 100px;
                float: left;
            }

            .label {
                float: left;
            }
        }
    }

    .sections section {
        .section-hint {
            margin-top: 100px;

            h2 {
                font-size: 19px;
                font-style: normal;
                font-weight: 700;
                color: #29304c;
                padding-bottom: 10px;
            }
            p {
                font-size: 14px;
                color: #666;
                line-height: 20px;
            }
        }

        .mapboxgl-ctrl-geocoder {
            margin-bottom: 20px;
            width: 100%;

            #property-location-input {
                padding: 5px;
                width: 100%;
                border: none;
            }

            .geocoder-pin-right {
                display: none;
            }
        }

        #submit-property-map {
            position: relative;
            height: 350px;
            width: 100%;

            .marker {
                position: absolute;
                left: 50%;
                margin-left: -8px;
                top: 50%;
                margin-top: -22px;
                z-index: 20;
            }
        }

        .bottom-nav {
            .btn.btn-primary {
                color: #fff;
                float: right;
            }
            .btn.btn-outline {
                float: right;
            }
        }
    }
}
</style>
