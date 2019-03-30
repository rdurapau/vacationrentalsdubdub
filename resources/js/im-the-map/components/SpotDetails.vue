<template>
    <section class="spot-details">
        <section class="hero">
    </section>
</template>

<script>
    let mapboxgl = require('mapbox-gl');
    // let geoJSON = require('geojson')

    // console.log(geoJSON);
    // GeoJSON.parse(data, {Point: ['lat', 'lng']});

    mapboxgl.accessToken = process.env.MIX_MAPBOX_APP_KEY;

    export default {
        data() {
            return {
                'map' : '',
                'popups' : [],
                'mapSearch': '',
                'activeFilters' : {
                    'pets' : false,
                    'sleeps' : 0
                },
                'filterDropdownIsVisible': false,
                'filterDropdownData': {
                    'pets' : false,
                    'sleeps' : 0
                },
                'geolocateControl' : '',
                'geolocationSupported' : false,
                'geolocationStatus' : '',
                'maxSleeps' : 12,

                'currentLocationText' : 'Current Location'
            }
        },
        methods: {
            applyDropdownFilters() {
                Vue.set(this.activeFilters,'pets',this.filterDropdownData.pets);
                Vue.set(this.activeFilters,'sleeps',this.filterDropdownData.sleeps);
                this.applyFilters();
                this.hideFilterDropdown();
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

                this.map.setFilter('clusters', filters);
                this.map.setFilter('unclustered-point', filters);
                this.map.setFilter('cluster-count', filters);
            },
            removePetFilter() {
                Vue.set(this.activeFilters,'pets',false);
                this.applyFilters();
            },
            removeSleepsFilter() {
                Vue.set(this.activeFilters,'sleeps',0);
                this.applyFilters();
            },
            clearSearch() {
                this.mapSearch = '';
                if (this.geolocateControl._watchState != 'OFF') {
                    this.geolocateControl.trigger();
                }
            },

            /*
             * Geolocate Methods
             */
            getUserLocation() {
                if (this.geolocationSupported) {
                    this.geolocateControl.trigger();
                    // navigator.geolocation.getCurrentPosition(
                    //     function success(position) {
                    //         // for when getting location is a success
                    //         console.log('latitude', position.coords.latitude, 'longitude', position.coords.longitude);
                    //     },
                    //     function error(error_message) {
                    //         // for when getting location results in an error
                    //         console.error('An error has occured while retrieving location ', error_message)
                    //     }
                    // );
                }
            },
            geolocateEvent() {
                this.geolocationStatus = 'active';
                console.log(Object.assign({},this.geolocateControl));
            },
            geolocateStart() {
                this.geolocationStatus = 'pending';
                console.log(Object.assign({},this.geolocateControl));
            },
            geolocateEnd() {
                this.geolocationStatus = '';
                console.log(Object.assign({},this.geolocateControl));
            },
            

            /*
             * Filter Dropdown
             */
            toggleFilterDropdown() {
                if (this.filterDropdownIsVisible) {
                    this.hideFilterDropdown();
                } else {
                    this.showFilterDropdown();
                }
            },
            showFilterDropdown() {
                Vue.set(this.filterDropdownData,'sleeps',this.activeFilters.sleeps);
                Vue.set(this.filterDropdownData,'pets',this.activeFilters.pets);
                this.filterDropdownIsVisible = true;
            },
            hideFilterDropdown() {
                // Vue.set(this.filterDropdownData,'sleeps',this.filters.sleeps);
                // Vue.set(this.filterDropdownData,'pets',this.filters.pets);
                this.filterDropdownIsVisible = false;
            },
            incFilterSleeps(){
                if (this.filterDropdownData.sleeps < this.maxSleeps) {
                    this.filterDropdownData.sleeps++;
                }
            },
            decFilterSleeps(){
                if (this.filterDropdownData.sleeps > 0) {
                    this.filterDropdownData.sleeps--;
                }
            },
            newGeolocate(val) {
                console.log('geolocate', val);
            }
        },
        computed: {
            csrf() {
                return window.Laravel.csrfToken;
            },
            filterPet() {
                if (this.activeFilters.pets) {
                   return  ['==', 'pets', true]
                }
            },
            filterSleeps() {
                if (this.activeFilters.sleeps && this.activeFilters.sleeps > 0) {
                    return ['>=', 'sleeps', parseInt(this.activeFilters.sleeps)]
                }
            },
            geolocatorClass() {
                return {
                    pending : this.geolocationStatus == 'pending',
                    active : this.geolocationStatus == 'active'
                }
            },
            showClearSearchButton() {
                return (this.geolocationStatus == 'active' || this.mapSearch.length);
            },
            showGeolocateButton() {
                return (!this.showClearSearchButton && this.geolocationSupported);
            }


            // self.map.setFilter('clusters', ['>=', 'sleeps', 10]);
            // self.map.setFilter('unclustered-point', ['>=', 'sleeps', 10]);
            // self.map.setFilter('cluster-count', ['>=', 'sleeps', 10]);
        },
        mounted() {
            // console.log(mapboxgl);
            this.map = new mapboxgl.Map({
                container: 'map-wrapper',
                style: 'mapbox://styles/mapbox/light-v10',
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
                        "circle-color": "#45AEF1",
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

                // Old geolocate method
                this.geolocateControl = new mapboxgl.GeolocateControl({
                    positionOptions: {
                        enableHighAccuracy: true
                    },
                    trackUserLocation: true,
                    fitBoundsOptions: {
                        maxZoom : 12
                    }
                })
                this.map.addControl(this.geolocateControl);
                if ('geolocation' in navigator) {
                    this.geolocationSupported = true;        
                }
                let self = this;
                this.geolocateControl.on('geolocate', (val) => self.geolocateEvent(val));
                this.geolocateControl.on('trackuserlocationstart', () => self.geolocateStart())
                this.geolocateControl.on('trackuserlocationend', () => self.geolocateEnd());

                // inspect a cluster on click
                // this.map.on('click', 'clusters', function (e) {
                //     var features = self.map.queryRenderedFeatures(e.point, {
                //         layers: ['clusters']
                //     });
                //     if (features.length) {
                //         var clusterId = features[0].properties.cluster_id;
                //         self.map.getSource('places').getClusterExpansionZoom(clusterId, function (err, zoom) {
                //             if (err)
                //                 return;

                //             self.map.easeTo({
                //                 center: features[0].geometry.coordinates,
                //                 zoom: zoom
                //             });
                //         });
                //     }
                // });

                this.map.on('click', 'unclustered-point', function (e) {
                    alert('SHOW ME SPOT #'+e.features[0].properties.id + ', KNAVE')
                });

                this.map.on('moveend', function() {
                    self.popups.forEach((popup) => {
                        popup.remove();
                    });
                    self.popups = [];

                    var visibleFeatures = self.map.queryRenderedFeatures({layers:['unclustered-point']});

                    if (visibleFeatures) {
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
                    }
                });
            })
        },
        watch: {
            'geolocateControl.geolocate' : 'newGeolocate'
        },
    }
</script>

<style>
    #map-wrapper {
        position:fixed;
        width:100vw;
        height:100vh;
    }
</style>

