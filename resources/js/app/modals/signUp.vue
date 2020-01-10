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
                <!-- <ul class="progress-list">
                    <li class="personal current">
                        <img
                            src="/img/personal-info.svg"
                            alt="Personal Info"
                        >
                        <div class="label">
                            Personal Info
                        </div>
                    </li>
                    <li class="location">
                        <div class="icon">
                            <svg>
                                <g>
                                    <path d="M12.75,24c-1.241,0-2.25-1.009-2.25-2.25v-3.518c0-0.414,0.336-0.75,0.75-0.75S12,17.818,12,18.232v3.518
                              c0,0.414,0.336,0.75,0.75,0.75h6c0.414,0,0.75-0.336,0.75-0.75v-3.518c0-0.414,0.336-0.75,0.75-0.75S21,17.818,21,18.232v3.518
                              c0,1.241-1.009,2.25-2.25,2.25H12.75z" />
                                    <path d="M23.25,18.232c-0.186,0-0.364-0.068-0.501-0.193l-6.5-5.847C16.11,12.068,15.932,12,15.747,12
                              c-0.185,0-0.363,0.069-0.502,0.193l-6.5,5.847c-0.138,0.124-0.316,0.192-0.501,0.192c-0.212,0-0.415-0.091-0.558-0.248
                              c-0.134-0.149-0.202-0.341-0.192-0.542c0.011-0.2,0.099-0.384,0.248-0.518l6.5-5.847c0.415-0.373,0.949-0.578,1.505-0.578
                              c0.555,0,1.09,0.205,1.504,0.578L21,14.449V12c0-0.414,0.336-0.75,0.75-0.75S22.5,11.586,22.5,12v3.799l1.251,1.126
                              c0.149,0.134,0.237,0.318,0.248,0.518c0.01,0.2-0.057,0.392-0.191,0.541C23.666,18.141,23.463,18.232,23.25,18.232z" />
                                    <path d="M8.25,12.75c-2.481,0-4.5-2.019-4.5-4.5s2.019-4.5,4.5-4.5s4.5,2.019,4.5,4.5S10.731,12.75,8.25,12.75z M8.25,5.25
                              c-1.654,0-3,1.346-3,3s1.346,3,3,3s3-1.346,3-3S9.904,5.25,8.25,5.25z" />
                                    <path d="M8.25,24C7.745,24,7.278,23.749,7,23.328c-0.701-1.056-2.448-3.863-4.038-6.922C0.996,12.626,0,9.882,0,8.25
                              C0,3.701,3.701,0,8.25,0s8.25,3.701,8.25,8.25C16.5,8.664,16.164,9,15.75,9C15.337,9,15,8.664,15,8.25
                              c0-3.722-3.028-6.75-6.75-6.75S1.5,4.528,1.5,8.25c0,2.881,4.396,10.702,6.75,14.25C8.664,22.5,9,22.836,9,23.25S8.664,24,8.25,24z
                              " />
                                </g>
                            </svg>
                        </div>
                        <div class="label">
                            Property Location
                        </div>
                    </li>
                    <li class="details">
                        <div class="icon">
                            <span>
                                <svg>
                                    <g>
                                        <path d="M10.498,15.75c-0.827,0-1.5-0.673-1.5-1.5v-3.399l-0.27,0.225c-0.135,0.112-0.305,0.174-0.48,0.174
                            c-0.223,0-0.433-0.098-0.576-0.27c-0.265-0.318-0.222-0.792,0.096-1.056l4.5-3.75C12.402,6.062,12.573,6,12.748,6
                            s0.346,0.062,0.48,0.174l4.5,3.75c0.154,0.128,0.249,0.309,0.267,0.508c0.018,0.199-0.042,0.394-0.171,0.548
                            c-0.143,0.172-0.353,0.27-0.576,0.27c-0.175,0-0.345-0.062-0.48-0.174l-0.27-0.225v3.399c0,0.827-0.673,1.5-1.5,1.5H10.498z
                            M10.498,14.25h4.5V9.601l-2.25-1.875l-2.25,1.875V14.25z" />
                                        <path d="M0.749,24c-0.201,0-0.389-0.078-0.531-0.22c-0.224-0.224-0.283-0.566-0.147-0.852l2.911-6.113
                            c-0.974-1.702-1.486-3.632-1.484-5.596C1.507,5.033,6.547,0,12.733,0l0.036,0.375V0c2.102,0,4.157,0.587,5.941,1.697
                            c2.548,1.585,4.327,4.071,5.01,7.001s0.186,5.946-1.399,8.494c-1.587,2.552-4.073,4.333-6.999,5.015
                            c-0.848,0.198-1.714,0.298-2.574,0.298c0,0,0,0,0,0c-1.944,0-3.864-0.514-5.565-1.489l-6.113,2.912C0.97,23.975,0.859,24,0.749,24z
                            M12.743,1.5C7.37,1.503,3.006,5.862,2.998,11.221c-0.003,1.825,0.506,3.609,1.47,5.158c0.136,0.219,0.151,0.487,0.04,0.719
                            l-2.174,4.567l4.567-2.175C7,19.441,7.112,19.416,7.223,19.416c0.14,0,0.278,0.039,0.397,0.114c1.55,0.964,3.325,1.474,5.131,1.474
                            c0.746,0,1.497-0.087,2.232-0.258c2.536-0.591,4.69-2.135,6.066-4.346c2.839-4.565,1.435-10.589-3.13-13.429
                            C16.372,2.009,14.592,1.5,12.77,1.5c-0.004,0-0.031,0-0.033,0L12.743,1.5z" />
                                    </g>
                                </svg>
                            </span>
                        </div>
                        <div class="label">
                            Property Details
                        </div>
                    </li>
                    <li class="photos">
                        <div class="icon">
                            <span>
                                <svg>
                                    <g>
                                        <path d="M1.501,18c-0.827,0-1.5-0.673-1.5-1.5v-15c0-0.827,0.673-1.5,1.5-1.5h13.5c0.827,0,1.5,0.673,1.5,1.5v15
                            c0,0.827-0.673,1.5-1.5,1.5H1.501z M1.501,16.5h13.5v-3h-13.5V16.5z M15.001,12v-0.468l-3.804-4.348
                            c-0.041-0.047-0.086-0.087-0.136-0.122c-0.127-0.089-0.274-0.135-0.427-0.135c-0.044,0-0.089,0.004-0.133,0.012
                            c-0.198,0.035-0.37,0.145-0.484,0.309L6.691,12H15.001z M4.861,12l3.926-5.612c0.343-0.492,0.859-0.822,1.451-0.927
                            c0.131-0.023,0.265-0.035,0.398-0.035c0.46,0,0.904,0.14,1.284,0.406c0.15,0.105,0.287,0.228,0.407,0.365l2.675,3.057V1.5h-13.5
                            l0,10.5H4.861z" />
                                        <path d="M17.757,24c-0.161,0-0.321-0.026-0.474-0.077L6.519,20.334c-0.197-0.065-0.303-0.278-0.237-0.474l0.237-0.711
                            c0.031-0.094,0.099-0.172,0.188-0.217c0.053-0.026,0.11-0.04,0.168-0.04c0.04,0,0.08,0.006,0.119,0.019L17.757,22.5l4.743-14.23
                            l-3.982-1.328c-0.392-0.131-0.605-0.556-0.474-0.948c0.102-0.307,0.387-0.513,0.71-0.513c0.081,0,0.161,0.013,0.239,0.039
                            l3.982,1.327c0.38,0.127,0.688,0.394,0.867,0.752c0.179,0.359,0.208,0.766,0.081,1.146l-4.743,14.23
                            C18.976,23.587,18.404,24,17.757,24z" />
                                        <path d="M5.064,7.501c-1.344,0-2.438-1.094-2.438-2.438S3.72,2.625,5.064,2.625s2.438,1.094,2.438,2.438S6.409,7.501,5.064,7.501z
                            M5.064,4.125c-0.517,0-0.938,0.421-0.938,0.938s0.421,0.938,0.938,0.938S6.002,5.58,6.002,5.063S5.581,4.125,5.064,4.125z" />
                                    </g>
                                </svg>
                            </span>
                        </div>
                        <div class="label">
                            Property Photos
                        </div>
                    </li>
                </ul> -->
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
                                        placeholder="Email Address"
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
                                        placeholder="Phone Number"
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
                    <div class="row">
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

        <!-- <section class="container-body">
            <div class="column progress-list-column">
                
            </div>

            <div class="column form-stuffs">
                <div class="row form-and-null">
                    <div class="column actual-form">
                        <form action="">
                            <fieldset class="section-wrap inactive active">
                                <section class="sub-section-row">
                                    <div class="sub-column">

                                    </div>

                                    <div class="sub-column">
                                        <h1>Personal Info</h1>
                                    </div>
                                </section>

                                <section class="sub-section-row">
                                    <div class="section-description sub-column">
                                        <section class="description-detail">
                                            <h2>Nice to meet you!</h2>
                                            <p>The only information that will be shared with guests is your name phone number so they can contact you directly.</p>
                                        </section>
                                    </div>

                                    <div class="sub-column">
                                        <section class="fieldset required">
                                            <input
                                                type="text"
                                                id="full-name"
                                                class="filled"
                                                value="Josiah Platt"
                                            >
                                            <label for="full-name">Full Name</label>
                                        </section>

                                        <section class="fieldset">
                                            <section class="fieldset">
                                                <input
                                                    type="text"
                                                    id="email-address"
                                                >
                                                <label for="email-address">Email Address</label>
                                            </section>

                                            <section class="fieldset">
                                                <input
                                                    type="text"
                                                    id="confirm-email"
                                                >
                                                <label for="confirm-email">Confirm Email</label>
                                            </section>
                                        </section>

                                        <section class="fieldset">
                                            <section class="fieldset">
                                                <input
                                                    type="text"
                                                    id="phone-number"
                                                >
                                                <label for="phone-number">Phone Number</label>
                                            </section>
                                            <section class="fieldset">
                                                <input
                                                    type="text"
                                                    id="date-of-birth"
                                                >
                                                <label for="date-of-birth">Date of Birth</label>
                                            </section>
                                        </section>
                                    </div>
                                </section>

                                <h2 class="section-title">Amenities</h2>
                                <section class="sub-section-row">
                                    <div class="section-description sub-column">
                                        <section class="description-detail">
                                            <h2>Amenities</h2>
                                            <p>Amenities are not required, but the more the merrier - Help your guests feel more at home.</p>
                                        </section>
                                    </div>

                                    <div class="sub-column">

                                        <ul class="amenities">
                                            <li>
                                                <input
                                                    type="checkbox"
                                                    name="amenity1"
                                                    id="amenity1"
                                                    value="Cheese"
                                                >
                                                <label for="amenity1">Old Cheese</label>
                                            </li>
                                            <li>
                                                <input
                                                    type="checkbox"
                                                    name="amenity1"
                                                    id="amenity2"
                                                    value="Cheese"
                                                >
                                                <label for="amenity2">Bikes</label>
                                            </li>
                                            <li>
                                                <input
                                                    type="checkbox"
                                                    name="amenity1"
                                                    id="amenity3"
                                                    value="Cheese"
                                                >
                                                <label for="amenity3">Scissors</label>
                                            </li>
                                            <li>
                                                <input
                                                    type="checkbox"
                                                    name="amenity1"
                                                    id="amenity4"
                                                    value="Cheese"
                                                >
                                                <label for="amenity4">Guns</label>
                                            </li>
                                            <li>
                                                <input
                                                    type="checkbox"
                                                    name="amenity1"
                                                    id="amenity5"
                                                    value="Cheese"
                                                >
                                                <label for="amenity5">Oxygen</label>
                                            </li>
                                        </ul>
                                    </div>
                                </section>

                                <section class="sub-section-row">
                                    <div class="section-description sub-column">
                                        <section class="description-detail">
                                            <h2>Property description</h2>
                                            <p>To help people understand why they should choose your property during their time off, write as detailed a description as you desire.</p>
                                        </section>
                                    </div>

                                    <div class="sub-column">
                                        <section class="fieldset required">
                                            <textarea
                                                type="text"
                                                id="property-description"
                                            ></textarea>
                                            <label for="property-description">Property Description</label>
                                        </section>
                                    </div>
                                </section>
                            </fieldset>
                        </form>
                    </div>
                </div>

                <div class="row action-row">
                    <button
                        class="btn secondary"
                        onclick="window.location.href='/static'"
                    >Back</button>
                    <button
                        class="btn"
                        onclick="window.location.href='/static/done'"
                    >Save & Continue</button>
                </div>
            </div>
        </section> -->
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
        // section: "personal-info",
        section: "property-details",
        isAddressSelected: false,
        map: false,
        errors: {},
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
        }
    }),

    watch: {
        section(newValue) {
            if (newValue === "property-location") this.initMap();
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
