<template>
    <div>

        <div id="form-wrap">
            <input type="text" v-model="filters.sleeps" />
            <input type="checkbox" v-model="filters.pets" />
            <button class="run-it" @click="applyFilters">Filter</button>
        </div>
        
        <div id="map-wrapper"></div>

    </div>
</template>

<script>
    let mapboxgl = require('mapbox-gl');
    let geoJSON = require('geojson')

    console.log(geoJSON);
    // GeoJSON.parse(data, {Point: ['lat', 'lng']});

    mapboxgl.accessToken = process.env.MIX_MAPBOX_APP_KEY;

    export default {
        data() {
            return {
                'map' : '',
                'popups' : [],
                'filters' : {
                    'pets' : false,
                    'sleeps' : 0,
                    'price' : 0
                }
            }
        },
        methods: {
            queryRendered() {
                console.log(this.map.queryRenderedFeatures());
                console.log(this.map.queryRenderedFeatures({layers:['unclustered-point']}));
            },
            applyFilters() {
                let filters = [];
                if (this.filterPet) filters.push(this.filterPet);
                if (this.filterSleeps) filters.push(this.filterSleeps);
                if (filters.length) {
                    if (filters.length === 1) {
                        filters = filters[0];
                    } else {
                        filters.unshift("all");
                    }
                } else {
                    filters = undefined;
                }
                console.log(filters);
                this.map.setFilter('clusters', filters);
                this.map.setFilter('unclustered-point', filters);
                this.map.setFilter('cluster-count', filters);
            }
        },
        computed: {
            csrf() {
                return window.Laravel.csrfToken;
            },
            filterPet() {
                if (this.filters.pets) {
                   return  ['==', 'pets', true]
                }
            },
            filterSleeps() {
                if (this.filters.sleeps && this.filters.sleeps > 0) {
                    return ['>=', 'sleeps', parseInt(this.filters.sleeps)]
                }
            }

            // self.map.setFilter('clusters', ['>=', 'sleeps', 10]);
            // self.map.setFilter('unclustered-point', ['>=', 'sleeps', 10]);
            // self.map.setFilter('cluster-count', ['>=', 'sleeps', 10]);
        },
        mounted() {
            // console.log(mapboxgl);
            this.map = new mapboxgl.Map({
                container: 'map-wrapper',
                style: 'mapbox://styles/mapbox/streets-v9',
                center: [-98.3810608, 37.9507756],
                zoom: 4
            });

            this.map.on('load', () => {

                // Taken from:
                // https://docs.mapbox.com/mapbox-gl-js/example/cluster/
                this.map.addSource('places', {
                    type: 'geojson',
                    data: "http://sweetspot.test/api/spots?output=geojson",
                    cluster: true,
                    clusterMaxZoom: 12, // Max zoom to cluster points on
                    clusterRadius: 50 // Radius of each cluster when clustering points (defaults to 50)
                })
                
                // Adds the circles for the clusters
                this.map.addLayer({
                    id: "clusters",
                    type: "circle",
                    source: "places",
                    paint: {
                        "circle-color": "#2BC569",
                        "circle-radius": 14
                    },
                    maxzoom:11.999
                });

                // Adds the number labels on top of the circle clusters
                this.map.addLayer({
                    id: "cluster-count",
                    type: "symbol",
                    source: "places",
                    layout: {
                        "text-field": ["case",
                            ['all', 
                                ['has','point_count_abbreviated'], 
                                ['>', ['get', 'point_count_abbreviated'], 1]
                            ], ['get', 'point_count_abbreviated'],
                            "1"
                        ],
                        "text-font": ["DIN Offc Pro Black", "Arial Unicode MS Bold"],
                        "text-size": 15
                    },
                    paint: {
                        "text-color": "#fff"
                    },
                    maxzoom:11.999
                });

                // Adds the individual spot markers
                this.map.addLayer({
                    id: "unclustered-point",
                    type: "circle",
                    source: "places",
                    filter: ["!", ["has", "point_count"]],
                    paint: {
                        "circle-color": "#ff0000",
                        "circle-radius": 0,
                        "circle-stroke-width": 0,
                        "circle-stroke-color": "#fff"
                    },
                    minzoom: 12
                });

                // inspect a cluster on click
                let self = this;
                this.map.on('click', 'clusters', function (e) {
                    var features = self.map.queryRenderedFeatures(e.point, {
                        layers: ['clusters']
                    });
                    if (features.length) {
                        var clusterId = features[0].properties.cluster_id;
                        self.map.getSource('places').getClusterExpansionZoom(clusterId, function (err, zoom) {
                            if (err)
                                return;

                            self.map.easeTo({
                                center: features[0].geometry.coordinates,
                                zoom: zoom
                            });
                        });
                    }
                });

                this.map.on('click', 'unclustered-point', function (e) {
                    // self.queryRendered();
                    alert('SHOW ME SPOT #'+e.features[0].properties.id + ', KNAVE')
                });

                this.map.on('moveend', function() {
                    console.log('moveend');
                    self.popups.forEach((popup) => {
                        popup.remove();
                    });
                    self.popups = [];

                    var visibleFeatures = self.map.queryRenderedFeatures({layers:['unclustered-point']});
                    
                    console.log(visibleFeatures);

                    if (visibleFeatures) {
                        // var uniqueFeatures = getUniqueFeatures(features, "iata_code");

                        visibleFeatures.forEach((feature) => {
                            self.popups.push(
                                new mapboxgl.Popup({
                                    closeButton: false,
                                    closeOnClick : false
                                }).setLngLat(feature.geometry.coordinates)
                                .setHTML('<img src="'+feature.properties.photo+'"/><section><span>$'+feature.properties.price+'</span><span>B: '+feature.properties.baths+'</span><span>S: '+feature.properties.sleeps+'</span></section>')
                                .addTo(self.map)
                            )
                        });

                        

                        // Populate features for the listing overlay.
                        // renderListings(uniqueFeatures);
                        
                        // Clear the input container
                        // filterEl.value = '';
                        
                        // Store the current features in sn `airports` variable to
                        // later use for filtering on `keyup`.
                        // airports = uniqueFeatures;
                    }
                });
            })
        },
        watch: {
            
        },
    }
</script>

<style>
    #map-wrapper {
        position:fixed;
        width:100vw;
        height:100vh;
    }
    button.run-it {
        position:fixed;
        top:5px;
        right:5px;
        z-index:1000;
    }
</style>

