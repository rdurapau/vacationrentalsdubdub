<template>
    <div id="map-wrapper">
        <div class="map-filter">
            <div id="search-geocoder"></div>
            <ul class="filters">
                <li>
                    <i class="fas fa-dollar-sign"></i>
                </li>
                <li>
                    <i class="fas fa-calendar-alt"></i>
                </li>
                <li>
                    <i class="fas fa-bed"></i>
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
        mouseLeftSpot: true
    }),

    computed: {},

    mounted() {
        this.map = new mapboxgl.Map({
            container: "map-wrapper",
            style: "mapbox://styles/mapbox/" + this.mapStyle,
            center: [-99.16951, 31.417772],
            zoom: 5.5,
            marker: true
        });

        this.map.on("load", () => {
            this.map.resize();
            this.getSpots()
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

    methods: {
        ...mapActions(["getSpots"]),

        parseGeoJSON(json) {
            // Assign the global geoJson to a variable so it can be filtered non-destructively
            this.json = json;
            this.json.features.forEach(feature => {
                feature.properties.active = 0;
            });

            this.map.addSource("places", {
                type: "geojson",
                data: json
            });

            this.addDataLayers();
            this.addMapEvents();
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
            el.className = "marker";
            var HTML = "";
            HTML = HTML + '<div class="spot-marker">';
            HTML = HTML + "<section>";

            feature.properties.photos.slice(0, 6).map(p => {
                HTML =
                    HTML +
                    `<div class="img" style="background-image:url('${p}')"></div>`;
            });

            HTML = HTML + "</section>";
            HTML = HTML + "</div>";
            el.innerHTML = HTML;

            let coords = feature.geometry.coordinates;
            let marker = new mapboxgl.Marker({
                element: el,
                offset: {
                    x: 0,
                    y: -120
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

            // this.getSpots()
            //     .then(spots => this.parseGeoJSON(spots))
            //     .catch(err => console.error(err));

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
                padding: 12px 19px
                transition: all .25s ease-out

                &:hover 
                    background: #f5f5f5

                i
                    color: #757576
                
    
</style>
