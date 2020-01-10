<template>
    <div id="map-wrapper"></div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import mapboxgl from "mapbox-gl";
import mapboxGeocoder from "@mapbox/mapbox-gl-geocoder";

mapboxgl.accessToken =
    "pk.eyJ1IjoiY2FiZWViIiwiYSI6ImNqczIxdGlsNzA5b280M28yMmI2eHZzcWIifQ.HcTinfBh6KX4myzAFTNqKQ";

export default {
    data: () => ({
        map: false,
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
            zoom: 5.5
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

        // document.onreadystatechange = () => {
        //   if (document.readyState == "complete") {
        //     self.resizeMap();
        //   }
        // };
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

</style>
