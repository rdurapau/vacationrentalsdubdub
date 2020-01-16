<template>
    <div id="map-wrapper">
        <div class="map-filter">
            <div id="search-geocoder"></div>
            <ul class="filters">
                <li :class="{'active': priceFilterIsActive, 'filtering': (minPrice !== '' || maxPrice !== '')}">
                    <i
                        class="fas fa-dollar-sign"
                        @click="priceFilterIsActive = !priceFilterIsActive"
                    ></i>

                    <div class="filter-container price">
                        <p class="title">Price Per Night</p>
                        <input
                            type="text"
                            placeholder="Min"
                            v-model="minPrice"
                        >
                        <span>to</span>
                        <input
                            type="text"
                            placeholder="Max"
                            v-model="maxPrice"
                        >
                    </div>
                </li>
                <li :class="{'active': bathsFilterIsActive, 'filtering': (minBaths !== '' || maxBaths !== '')}">
                    <i
                        class="fas fa-shower"
                        @click="bathsFilterIsActive = !bathsFilterIsActive"
                    ></i>

                    <div class="filter-container price">
                        <p class="title">Bathrooms</p>
                        <input
                            type="text"
                            placeholder="Min"
                            v-model="minBaths"
                        >
                        <span>to</span>
                        <input
                            type="text"
                            placeholder="Max"
                            v-model="maxBaths"
                        >
                    </div>
                </li>
                <li :class="{'active': bedsFilterIsActive, 'filtering': (minBeds !== '' || maxBeds !== '')}">
                    <i
                        class="fas fa-bed"
                        @click="bedsFilterIsActive = !bedsFilterIsActive"
                    ></i>

                    <div class="filter-container price">
                        <p class="title">Bedrooms</p>
                        <input
                            type="text"
                            placeholder="Min"
                            min="0"
                            v-model="minBeds"
                        >
                        <span>to</span>
                        <input
                            type="text"
                            placeholder="Max"
                            min="0"
                            v-model="maxBeds"
                        >
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import mapboxgl from "mapbox-gl";
import MapboxGeocoder from "@mapbox/mapbox-gl-geocoder";

mapboxgl.accessToken =
    "pk.eyJ1IjoiY2FiZWViIiwiYSI6ImNqczIxdGlsNzA5b280M28yMmI2eHZzcWIifQ.HcTinfBh6KX4myzAFTNqKQ";

export default {
    data: () => ({
        map: false,
        geocoder: false,
        mapStyle: "streets-v11",
        json: false,
        hoverMarker: false,
        mouseLeftSpot: true,

        priceFilterIsActive: false,
        bathsFilterIsActive: false,
        bedsFilterIsActive: false,

        minPrice: "",
        maxPrice: "",
        minBaths: "",
        maxBaths: "",
        minBeds: "",
        maxBeds: ""
    }),

    watch: {
        priceFilterIsActive(value) {
            if (value) {
                this.bathsFilterIsActive = false;
                this.bedsFilterIsActive = false;
            }
        },
        bathsFilterIsActive(value) {
            if (value) {
                this.priceFilterIsActive = false;
                this.bedsFilterIsActive = false;
            }
        },
        bedsFilterIsActive(value) {
            if (value) {
                this.priceFilterIsActive = false;
                this.bathsFilterIsActive = false;
            }
        },
        minPrice() {
            this.refreshMap();
        },
        maxPrice() {
            this.refreshMap();
        },
        minBaths() {
            this.refreshMap();
        },
        maxBaths() {
            this.refreshMap();
        },
        minBeds() {
            this.refreshMap();
        },
        maxBeds() {
            this.refreshMap();
        }
    },

    mounted() {
        this.initMap();
    },

    methods: {
        ...mapActions(["getSpots"]),

        getFilters() {
            var filters = {};
            if (this.minPrice && this.minPrice !== "")
                filters.minPrice = this.minPrice.replace(/\D/g, "");
            if (this.maxPrice && this.maxPrice !== "")
                filters.maxPrice = this.maxPrice.replace(/\D/g, "");
            if (this.minBaths && this.minBaths !== "")
                filters.minBaths = this.minBaths.replace(/\D/g, "");
            if (this.maxBaths && this.maxBaths !== "")
                filters.maxBaths = this.maxBaths.replace(/\D/g, "");
            if (this.minBeds && this.minBeds !== "")
                filters.minBeds = this.minBeds.replace(/\D/g, "");
            if (this.maxBeds && this.maxBeds !== "")
                filters.maxBeds = this.maxBeds.replace(/\D/g, "");

            return filters;
        },

        hasActiveFilters() {
            return (
                this.minPrice !== "" ||
                this.maxPrice !== "" ||
                this.minBaths !== "" ||
                this.maxBaths !== "" ||
                this.minBeds !== "" ||
                this.maxBeds !== ""
            );
        },

        refreshMap() {
            let filters = [];

            console.log(this.hasActiveFilters());

            if (this.hasActiveFilters()) {
                var filteredData = this.json.features;

                this.getSpots(this.getFilters())
                    .then(spots => this.parseGeoJSON(spots))
                    .catch(err => console.error(err));
            } else {
                this.map.getSource("places").setData(this.json);
            }

            // this.updateMarkers();
        },

        initMap() {
            this.map = new mapboxgl.Map({
                container: "map-wrapper",
                style: "mapbox://styles/mapbox/" + this.mapStyle,
                center: [-99.16951, 31.417772],
                zoom: 5.5,
                marker: true
            });

            this.map.on("load", () => {
                this.map.resize();
                this.getSpots(this.getFilters())
                    .then(spots => this.parseGeoJSON(spots))
                    .catch(err => console.error(err));
            });

            window.addEventListener("load", event => {
                if (this.map !== false) this.map.resize();
            });

            this.geocoder = new MapboxGeocoder({
                accessToken: mapboxgl.accessToken,
                country: "US",
                types: "region,district,place,locality,neighborhood,poi",
                placeholder: "Search",
                flyTo: false,
                marker: false,
                mapboxgl: mapboxgl
            });

            document
                .getElementById("search-geocoder")
                .appendChild(this.geocoder.onAdd(this.map));
            document.querySelector(
                "#search-geocoder .mapboxgl-ctrl-geocoder input"
            ).id = "property-location-input";

            this.map.on("load", () => {
                this.geocoder.on("result", this.addressSelected);
                // this.geocoder.on("clear", this.addressCleared);
                // this.map.on("dragend", this.mapMoved);
                // this.map.on("zoomend", this.mapMoved);
            });
        },

        parseGeoJSON(json) {
            // Assign the global geoJson to a variable so it can be filtered non-destructively
            this.json = json;
            this.json.features.forEach(feature => {
                feature.properties.active = 0;
            });

            if (typeof this.map.getSource("places") === "undefined") {
                this.map.addSource("places", {
                    type: "geojson",
                    data: json
                });
                this.addDataLayers();
                this.addMapEvents();
            } else {
                this.map.getSource("places").setData(json);
            }
        },

        addDataLayers() {
            this.map.addLayer({
                id: "single-spot-border",
                type: "circle",
                source: "places",
                paint: {
                    "circle-color": "#fff",
                    "circle-radius": 9
                }
            });

            this.map.addLayer({
                id: "single-spot",
                type: "circle",
                source: "places",
                paint: {
                    "circle-radius": 5,
                    "circle-color": [
                        "match",
                        ["get", "active"],
                        1,
                        "#F69158",
                        "#9080F0"
                    ]
                }
            });
        },

        addMapEvents() {
            this.map.on("styledata", () => {
                if (!this.map.getSource("places")) {
                    if (!this.map.isSourceLoaded("places")) {
                        this.map.addSource("places", {
                            type: "geojson",
                            data: json
                        });
                    }
                }
            });

            ///////////////////////
            // Click Events
            this.map.on("click", "single-spot", e => {
                var features = this.map.queryRenderedFeatures(e.point, {
                    layers: ["single-spot"]
                });

                if (features[0]) {
                    this.$store
                        .dispatch("triggerNewActiveSpot", features[0].id)
                        .catch(err => console.error(err));
                }
            });

            this.map.on("click", "single-spot-border", e => {
                var features = this.map.queryRenderedFeatures(e.point, {
                    layers: ["single-spot"]
                });

                if (features[0]) {
                    this.$store
                        .dispatch("triggerNewActiveSpot", features[0].id)
                        .catch(err => console.error(err));
                }
            });

            ///////////////////////
            // Hover Events
            this.map.on("mouseenter", "single-spot", e => {
                this.mouseLeftSpot = false;
                this.map.getCanvas().style.cursor = "pointer";

                var features = this.map.queryRenderedFeatures(e.point, {
                    layers: ["single-spot"]
                });

                if (features[0]) this.newHoverMarker(features[0]);
            });

            this.map.on("mouseleave", "single-spot", () => {
                this.mouseLeftSpot = true;
            });

            this.map.on("mouseenter", "single-spot-border", e => {
                this.mouseLeftSpot = false;
                this.map.getCanvas().style.cursor = "pointer";

                var features = this.map.queryRenderedFeatures(e.point, {
                    layers: ["single-spot"]
                });

                if (features[0]) this.newHoverMarker(features[0]);
            });

            this.map.on("mouseleave", "single-spot-border", () => {
                this.maybeHideHoverMarker();
            });
        },

        newHoverMarker(feature) {
            this.hideHoverMarker();
            this.hoverMarker = this.showMarkerForSpot(feature);
        },

        showMarkerForSpot(feature) {
            // AB: bad code, find out why this is being turned into a string in the first place
            if (typeof feature.properties.photos === "string") {
                feature.properties.photos = JSON.parse(
                    feature.properties.photos
                );
            }

            let el = document.createElement("div");
            el.addEventListener(
                "click",
                event => {
                    console.log(event.target);
                },
                false
            );
            el.className = "marker";
            var HTML = "";
            HTML = HTML + '<div class="spot-marker">';
            HTML = HTML + "<section>";

            feature.properties.photos.slice(0, 6).map(p => {
                HTML =
                    HTML +
                    `<div class="img" style="background-image:url('${p}')"></div>`;
            });

            HTML = HTML + '<div class="info">';
            HTML = HTML + "<h1>" + feature.properties.name + "</h1>";
            HTML = HTML + "<p>$" + feature.properties.price + " Per Night</p>";
            HTML = HTML + "</div>";
            HTML = HTML + "</section>";
            HTML = HTML + "</div>";
            el.innerHTML = HTML;

            let coords = feature.geometry.coordinates;
            let marker = new mapboxgl.Marker({
                element: el,
                offset: {
                    x: 0,
                    y: -150
                }
            }).setLngLat(coords);
            marker.addTo(this.map);
            return marker;
        },

        maybeHideHoverMarker() {
            if (this.mouseLeftSpot) {
                this.hideHoverMarker();
            }
        },

        hideHoverMarker() {
            if (typeof this.hoverMarker === "object") {
                this.hoverMarker.remove();
            }
        },

        addressSelected(event) {
            let coords = event.result.geometry.coordinates;

            this.getSpots(this.getFilters())
                .then(spots => this.parseGeoJSON(spots))
                .catch(err => console.error(err));

            this.addressIsSelected = true;
            this.map.jumpTo({
                center: coords,
                zoom: 11
            });
        }
    }
};
</script>

<style lang="sass">
.spot-marker
    background: #FFF

#map-wrapper
    height: 100%
    width: 100%
    display: block 

    .mapboxgl-canvas-container
        height: 100%
        width: 100%
        display: block
        outline: none
    
    canvas.mapboxgl-canvas
        outline: none

    .map-filter
        position: absolute
        z-index: 10
        top: 20px
        left: 20px
        height: 45px
        width: 400px
        background: #fff
        border-radius: 4px
        transition: all .25s ease-out
        -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.25)
        -moz-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.25)
        box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.25)

        #search-geocoder
            width: 60%
            height: 100%
            float: left

            .mapboxgl-ctrl-geocoder
                height: 100%
                box-shadow: 0 0 0 0 rgba(0,0,0,0)

                .mapboxgl-ctrl-geocoder--icon-search
                    margin-top: 5px

                .mapboxgl-ctrl-geocoder--icon-close
                    margin-top: 9px

                .mapboxgl-ctrl-geocoder--input
                    height: 100%
                    -webkit-box-shadow: inset -20px 0px 10px -10px rgba(255,255,255,1)
                    -moz-box-shadow: inset -20px 0px 10px -10px rgba(255,255,255,1)
                    box-shadow: inset -20px 0px 10px -10px rgba(255,255,255,1)
        
        
        
        .filters
            padding: 0px
            float: right
            list-style-type: none
            height: 100%
            
            li
                float: right
                height: 100%
                text-align: center
                cursor: pointer
                transition: all .25s ease-out

                &:hover 
                    background: #f5f5f5

                i
                    color: #757576
                    padding: 17px 20px

                &.filtering
                    background: #f4f3f3 !important
                
                &.active
                    background: #eeeeee !important

                    .filter-container
                        display: block

                .filter-container
                    &.price
                        right: 0px
                        left: auto

                    p
                        text-align: left
                        margin: 0 0 0 5px
                        font-size: 14px
                        color: #858585

                    display: none
                    position: absolute
                    z-index: 10
                    top: 60px
                    left: 0px
                    height: 62px
                    background: #fff
                    border-radius: 4px
                    transition: all .25s ease-out
                    -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.25)
                    -moz-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.25)
                    box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.25)

                    input
                        float: left
                        border: none
                        padding: 7px 7px
                        font-size: 22px
                        width: 100px
                    
                    span
                        float: left
                        border: none
                        padding: 9px 7px
                        font-size: 14px
                        color: #a4a4a4
                
    
</style>
