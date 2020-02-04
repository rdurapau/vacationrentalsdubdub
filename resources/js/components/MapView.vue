<template>
    <div id="map-wrapper"></div>
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
        json: false,
        hoverMarker: false,
        mouseLeftSpot: false
    }),

    mounted() {
        this.initMap();
    },

    methods: {
        ...mapActions(["getSpots"]),

        initMap() {
            this.map = new mapboxgl.Map({
                container: "map-wrapper",
                style: "mapbox://styles/mapbox/streets-v11",
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
                .getElementById("geocoder")
                .appendChild(this.geocoder.onAdd(this.map));

            this.map.on("load", () => {
                this.geocoder.on("result", this.addressSelected);
            });
        },

        addressSelected(event) {
            let coords = event.result.geometry.coordinates;

            // this.getSpots()
            //     .then(spots => this.parseGeoJSON(spots))
            //     .catch(err => console.error(err));

            this.map.jumpTo({
                center: coords,
                zoom: 11
            });
        },

        parseGeoJSON(json) {
            this.json = json;
            this.json.features.forEach(feature => {
                feature.properties.active = 0;
            });

            if (typeof this.map.getSource("places") === "undefined") {
                this.addMapLayers(json);
                this.addMapEvents();
            } else {
                this.map.getSource("places").setData(json);
            }
        },

        addMapLayers(json) {
            this.map.addSource("places", {
                type: "geojson",
                data: json
            });
            this.map.addLayer({
                id: "single-spot-border",
                type: "circle",
                source: "places",
                paint: {
                    "circle-color": "#fff",
                    "circle-radius": 8
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
                        "#FF0000"
                    ]
                }
            });

            // Active
            this.map.addSource("active", {
                type: "geojson",
                data: {
                    type: "FeatureCollection",
                    features: []
                }
            });
            this.map.addLayer({
                id: "active-spot-border",
                type: "circle",
                source: "active",
                paint: {
                    "circle-radius": 8,
                    "circle-color": "#fff"
                }
            });
            this.map.addLayer({
                id: "active-spot",
                type: "circle",
                source: "active",
                paint: {
                    "circle-radius": 5,
                    "circle-color": "#fc7e7e"
                }
            });

            // Favorite
            // this.map.addSource("favorite", {
            //     type: "geojson",
            //     data: {
            //         type: "FeatureCollection",
            //         features: []
            //     }
            // });
            // this.map.addLayer({
            //     id: "favorite-spot-border",
            //     type: "circle",
            //     source: "favorite",
            //     paint: {
            //         "circle-radius": 8,
            //         "circle-color": "#fff"
            //     }
            // });
            // this.map.addLayer({
            //     id: "favorite-spot",
            //     type: "circle",
            //     source: "favorite",
            //     paint: {
            //         "circle-radius": 5,
            //         "circle-color": "##9180F1"
            //     }
            // });
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

                this.$router.push(`/spot/${features[0].id}`);
                this.map.getSource("active").setData({
                    type: "FeatureCollection",
                    features: [features[0]]
                });
            });

            this.map.on("click", "single-spot-border", e => {
                var features = this.map.queryRenderedFeatures(e.point, {
                    layers: ["single-spot"]
                });

                this.$router.push(`/spot/${features[0].id}`);
                this.map.getSource("active").setData({
                    type: "FeatureCollection",
                    features: [features[0]]
                });
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
                    `<div class="img" style="background: url('${p}') no-repeat center center"></div>`;
            });

            HTML = HTML + "</section>";
            HTML = HTML + '<div class="info">';
            HTML = HTML + "<h1>" + feature.properties.name + "</h1>";
            HTML = HTML + "</div>";
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
            if (
                this.hoverMarker &&
                typeof this.hoverMarker.remove === "function"
            ) {
                this.hoverMarker.remove();
            }
        },

        addressSelected(event) {
            let coords = event.result.geometry.coordinates;

            this.getSpots()
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

<style lang="scss">
#map-wrapper {
    height: 100%;
    width: 100%;
}
</style>