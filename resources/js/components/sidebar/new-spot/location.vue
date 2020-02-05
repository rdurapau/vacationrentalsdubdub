<template>
    <div class="new-spot-location">
        <h1>Property location</h1><br /><br />

        <div
            id="submit-property-geocoder"
            class="geocoder"
        >
            <label for="property-location-input">Property Address</label>
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
                v-if="addressIsSelected"
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

        <div
            class="icon-message"
            :class="{visible: addressIsSelected}"
        >
            <svg
                class="icon"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M12 15.75C13.6569 15.75 15 14.4069 15 12.75C15 11.0931 13.6569 9.75 12 9.75C10.3431 9.75 9 11.0931 9 12.75C9 14.4069 10.3431 15.75 12 15.75Z"
                    stroke="#9080F0"
                    stroke-width="1.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />
                <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M12 6.75C15.3137 6.75 18 9.43629 18 12.75C18 15.422 14.1 21.055 12.589 22.965C12.4468 23.145 12.2299 23.2501 12.0005 23.2501C11.7711 23.2501 11.5542 23.145 11.412 22.965C9.9 21.054 6 15.422 6 12.75C6 9.43629 8.68629 6.75 12 6.75Z"
                    stroke="#9080F0"
                    stroke-width="1.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />
                <path
                    d="M12 0.75V3.75"
                    stroke="#9080F0"
                    stroke-width="1.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />
                <path
                    d="M19 3.00293L17.25 5.43993"
                    stroke="#9080F0"
                    stroke-width="1.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />
                <path
                    d="M5 3.00293L6.75 5.43993"
                    stroke="#9080F0"
                    stroke-width="1.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />
                <path
                    d="M0.75 9L3.472 9.875"
                    stroke="#9080F0"
                    stroke-width="1.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />
                <path
                    d="M23.2498 9L20.5278 9.875"
                    stroke="#9080F0"
                    stroke-width="1.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />
            </svg>
            <span>Drag the map around for a more precise pin location.</span>

            <div
                class="btn btn-primary btn-block mt-4"
                @click="onClickLocationSelected"
                v-if="addressIsSelected"
            >
                Next
            </div>
        </div>
    </div>
</template>

<script>
import mapboxgl from "mapbox-gl";
import MapboxGeocoder from "@mapbox/mapbox-gl-geocoder";
mapboxgl.accessToken =
    "pk.eyJ1IjoiY2FiZWViIiwiYSI6ImNqczIxdGlsNzA5b280M28yMmI2eHZzcWIifQ.HcTinfBh6KX4myzAFTNqKQ";

export default {
    props: {
        onLocationSelected: Function
    },

    data: () => ({
        map: false,
        geocoder: false,
        addressIsSelected: false,
        address: {}
    }),

    mounted() {
        this.initMap();
    },

    methods: {
        initMap() {
            this.map = new mapboxgl.Map({
                container: "submit-property-map",
                style: "mapbox://styles/mapbox/streets-v11",
                center: [-99.16951, 31.417772],
                zoom: 5.5,
                marker: true
            });

            this.map.on("load", () => {
                this.map.resize();
            });

            window.addEventListener("load", event => {
                if (this.map !== false) this.map.resize();
            });

            this.geocoder = new MapboxGeocoder({
                accessToken: mapboxgl.accessToken,
                country: "US",
                types:
                    "address,region,district,place,locality,neighborhood,poi",
                placeholder: "Search",
                flyTo: false,
                marker: false,
                mapboxgl: mapboxgl
            });

            document
                .getElementById("submit-property-geocoder")
                .appendChild(this.geocoder.onAdd(this.map));

            this.map.on("load", () => {
                this.geocoder.on("result", this.addressSelected);
            });
        },

        addressSelected(event) {
            this.addressIsSelected = true;

            let context = event.result.context;
            let coords = event.result.geometry.coordinates;

            this.address.address1 =
                (event.result.address ? event.result.address + " " : "") +
                event.result.text;
            this.address.city = context.find(e => e.id.includes("place")).text;
            this.address.postal_code = context.find(e =>
                e.id.includes("postcode")
            ).text;
            this.address.state = context.find(e =>
                e.id.includes("region")
            ).text;
            this.address.lng = coords[0];
            this.address.lat = coords[1];

            this.map.jumpTo({
                center: event.result.geometry.coordinates,
                zoom: 15
            });
        },

        onClickLocationSelected() {
            this.onLocationSelected(this.address);
        }
    }
};
</script>

<style lang="scss">
.new-spot-location {
    padding: 15px;

    svg.mapboxgl-ctrl-geocoder--icon {
        display: none;
    }
}
</style>
