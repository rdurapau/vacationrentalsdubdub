<template>
    <section id="main-map" :class="wrapperClass">

        <!-- <div id="form-wrap">
            <input type="text" v-model="filters.sleeps" placeholder="How many people?" />
            <label for="filter-pets">
                <input type="checkbox" v-model="filters.pets" id="filter-pets" />
                Allows Pets
            </label>
            <button class="run-it" @click="applyFilters">Filter</button>
        </div> -->

        <section class="search-and-filter" v-show="mapIsLoaded">
            <section class="filters">
                <transition name="slide">
                    <div v-if="activeFilters.pets" @click.prevent="removePetFilter">
                        <svg class="icon-pets icon" width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.7305 9.76367C12.7799 9.81315 12.8789 9.92448 13.0273 10.0977C13.2005 10.2461 13.3118 10.3451 13.3613 10.3945C13.4108 10.444 13.5098 10.5553 13.6582 10.7285C13.8314 10.9017 13.9303 11.0254 13.9551 11.0996C14.0046 11.1491 14.1035 11.2604 14.252 11.4336C14.4004 11.6068 14.4746 11.7305 14.4746 11.8047C14.4993 11.8789 14.5612 12.015 14.6602 12.2129C14.7839 12.4108 14.821 12.5592 14.7715 12.6582C14.7467 12.7324 14.7591 12.8809 14.8086 13.1035C14.8828 13.3014 14.8828 13.4499 14.8086 13.5488C14.5365 14.5879 13.918 15.2064 12.9531 15.4043C12.7799 15.429 12.1738 15.3796 11.1348 15.2559C10.1204 15.1322 9.26693 15.0703 8.57422 15.0703H8.42578C7.73307 15.0703 6.86719 15.1322 5.82812 15.2559C4.8138 15.3796 4.22005 15.429 4.04688 15.4043C3.08203 15.2064 2.46354 14.5879 2.19141 13.5488C2.11719 13.054 2.20378 12.5469 2.45117 12.0273C2.69857 11.5078 2.92122 11.1367 3.11914 10.9141C3.3418 10.6914 3.72526 10.3079 4.26953 9.76367C4.51693 9.49154 4.83854 9.10807 5.23438 8.61328C5.65495 8.11849 5.98893 7.73503 6.23633 7.46289C6.68164 6.91862 7.13932 6.57227 7.60938 6.42383C7.70833 6.37435 7.79492 6.34961 7.86914 6.34961C8.01758 6.32487 8.22786 6.3125 8.5 6.3125C8.79688 6.3125 9.00716 6.32487 9.13086 6.34961C9.20508 6.34961 9.29167 6.37435 9.39062 6.42383C9.86068 6.57227 10.3184 6.91862 10.7637 7.46289C10.9863 7.73503 11.3079 8.11849 11.7285 8.61328C12.1491 9.10807 12.4831 9.49154 12.7305 9.76367ZM13.0273 6.94336C12.6562 6.54753 12.4707 6.07747 12.4707 5.5332C12.4707 4.98893 12.6562 4.51888 13.0273 4.12305C13.4232 3.72721 13.8932 3.5293 14.4375 3.5293C14.9818 3.5293 15.4395 3.72721 15.8105 4.12305C16.2064 4.51888 16.4043 4.98893 16.4043 5.5332C16.4043 6.07747 16.2064 6.54753 15.8105 6.94336C15.4395 7.31445 14.9818 7.5 14.4375 7.5C13.8932 7.5 13.4232 7.31445 13.0273 6.94336ZM9.46484 3.75195C9.09375 3.35612 8.9082 2.88607 8.9082 2.3418C8.9082 1.79753 9.09375 1.33984 9.46484 0.96875C9.86068 0.572917 10.3307 0.375 10.875 0.375C11.4193 0.375 11.877 0.572917 12.248 0.96875C12.6439 1.33984 12.8418 1.79753 12.8418 2.3418C12.8418 2.88607 12.6439 3.35612 12.248 3.75195C11.877 4.14779 11.4193 4.3457 10.875 4.3457C10.3307 4.3457 9.86068 4.14779 9.46484 3.75195ZM4.71484 3.75195C4.34375 3.35612 4.1582 2.88607 4.1582 2.3418C4.1582 1.79753 4.34375 1.33984 4.71484 0.96875C5.11068 0.572917 5.58073 0.375 6.125 0.375C6.66927 0.375 7.12695 0.572917 7.49805 0.96875C7.89388 1.33984 8.0918 1.79753 8.0918 2.3418C8.0918 2.88607 7.89388 3.35612 7.49805 3.75195C7.12695 4.14779 6.66927 4.3457 6.125 4.3457C5.58073 4.3457 5.11068 4.14779 4.71484 3.75195ZM1.15234 6.94336C0.78125 6.54753 0.595703 6.07747 0.595703 5.5332C0.595703 4.98893 0.78125 4.51888 1.15234 4.12305C1.54818 3.72721 2.01823 3.5293 2.5625 3.5293C3.10677 3.5293 3.56445 3.72721 3.93555 4.12305C4.33138 4.51888 4.5293 4.98893 4.5293 5.5332C4.5293 6.07747 4.33138 6.54753 3.93555 6.94336C3.56445 7.31445 3.10677 7.5 2.5625 7.5C2.01823 7.5 1.54818 7.31445 1.15234 6.94336Z" fill="white"/>
                        </svg>
                        <svg class="icon icon-remove" width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.65625 1.28125L5.9375 5L9.65625 8.71875L8.71875 9.65625L5 5.9375L1.28125 9.65625L0.34375 8.71875L4.0625 5L0.34375 1.28125L1.28125 0.34375L5 4.0625L8.71875 0.34375L9.65625 1.28125Z" fill="white"/>
                        </svg>
                    </div>
                </transition>
                <transition name="slide">
                    <div v-if="activeFilters.sleeps" @click.prevent="removeSleepsFilter">
                        <svg class="icon icon-people" width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2.30664 8.98633C3.76628 8.39258 5.16406 8.0957 6.5 8.0957C7.83594 8.0957 9.22135 8.39258 10.6562 8.98633C12.1159 9.55534 12.8457 10.3099 12.8457 11.25V12.8457H0.154297V11.25C0.154297 10.3099 0.871745 9.55534 2.30664 8.98633ZM8.72656 5.57227C8.10807 6.19076 7.36589 6.5 6.5 6.5C5.63411 6.5 4.89193 6.19076 4.27344 5.57227C3.65495 4.95378 3.3457 4.21159 3.3457 3.3457C3.3457 2.47982 3.65495 1.73763 4.27344 1.11914C4.89193 0.475911 5.63411 0.154297 6.5 0.154297C7.36589 0.154297 8.10807 0.475911 8.72656 1.11914C9.34505 1.73763 9.6543 2.47982 9.6543 3.3457C9.6543 4.21159 9.34505 4.95378 8.72656 5.57227Z" fill="white"/>
                        </svg>
                        <span v-text="activeFilters.sleeps"></span>
                        <svg class="icon icon-remove" width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.65625 1.28125L5.9375 5L9.65625 8.71875L8.71875 9.65625L5 5.9375L1.28125 9.65625L0.34375 8.71875L4.0625 5L0.34375 1.28125L1.28125 0.34375L5 4.0625L8.71875 0.34375L9.65625 1.28125Z" fill="white"/>
                        </svg>
                    </div>
                </transition>
            </section>
            <section class="search-wrapper" v-show="searchBarVisible">
                <svg class="icon-search" width="25" height="26" viewBox="0 0 25 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.7161 19.8028C18.8109 18.0626 20.7196 13.3324 18.9794 9.23761C17.2392 5.14285 12.509 3.23413 8.41421 4.97436C4.31946 6.71459 2.41074 11.4448 4.15097 15.5395C5.8912 19.6343 10.6214 21.543 14.7161 19.8028Z" stroke="#29304C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M17.2612 18.0845L23.5092 24.3333" stroke="#29304C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>

                <input type="text" class="map-search current-location" v-model="currentLocationText" v-if="geolocationStatus == 'active'"/>
                <!-- <input type="text" id="map-search" placeholder="Search" v-model="mapSearch" v-else /> -->
                
                <div id="geocoder"></div>

                <span class="test-loading"></span>

                <div class="button-wrapper" v-if="showGeolocateButton">
                    <button class="my-location" @click.prevent="getUserLocation()" :class="geolocatorClass">
                        <svg class="icon-location" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12 19.5C16.1421 19.5 19.5 16.1421 19.5 12C19.5 7.85786 16.1421 4.5 12 4.5C7.85786 4.5 4.5 7.85786 4.5 12C4.5 16.1421 7.85786 19.5 12 19.5Z" stroke="#CCCCCC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12 0.75V4.5" stroke="#CCCCCC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M0.75 12H4.5" stroke="#CCCCCC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12 23.25V19.5" stroke="#CCCCCC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M23.25 12H19.5" stroke="#CCCCCC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                    <button id="clear-search" @click.prevent="clearSearch" v-if="showClearSearchButton">
                        <span class="icon-clear-css"></span>
                    </button>
                </div>
            </section>

            <button id="filter-toggle" @click.prevent="toggleFilterDropdown" :class="{close: filterDropdownIsVisible}">
                <span class="icon-toggle-css"></span>
            </button>

            <section id="filters-dropdown" :class="{'visible' : filterDropdownIsVisible}">
                <div>
                    <label>Guests</label>
                    <div class="number-with-buttons">
                        <button class="circle-button" @click.prevent="decFilterSleeps">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.5 7.125H12.75" stroke="#CCCCCC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                        <input type="number" class="input-increment" v-model="filterDropdownData.sleeps" min="0" max="12" />
                        <button class="circle-button" @click.prevent="incFilterSleeps">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.5 7.125H12.75" stroke="#CCCCCC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M7.125 1.5V12.75" stroke="#CCCCCC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div>
                    <label for="toggle-pet-friendly">Pet Friendly?</label>
                    <div class="check-group">
                        <input type="checkbox" id="toggle-pet-friendly" v-model="filterDropdownData.pets" />
                        <label class="circle-button" for="toggle-pet-friendly">
                            <svg class="icon icon-check" width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 7.395L3.45 10.872C3.63855 11.1537 3.95158 11.3268 4.29037 11.337C4.62916 11.3471 4.95197 11.1929 5.157 10.923L13 1" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </label>
                    </div>
                </div>
                <div class="apply-row">
                    <a class="apply" href="#" @click.prevent="applyDropdownFilters">
                        Apply
                    </a>
                </div>
            </section>
        </section>

        <div id="map-wrapper"></div>

    </section>
</template>

<script>
    let mapboxgl = require('mapbox-gl');
    let mapboxGeocoder = require('mapbox-gl-geocoder');
    // let geoJSON = require('geojson')

    // console.log(geoJSON);
    // GeoJSON.parse(data, {Point: ['lat', 'lng']});

    mapboxgl.accessToken = process.env.MIX_MAPBOX_APP_KEY;

    export default {
        data() {
            return {
                map : '',
                popups : [],
                markers : {},
                markersOnScreen : {},
                mapSearch: '',

                geoJson : {},

                mapIsLoaded : false,
                searchBarVisible: false,
                activeFilters : {
                    pets : false,
                    sleeps : 0
                },
                filterDropdownIsVisible: false,
                filterDropdownData: {
                    pets : false,
                    sleeps : 0
                },
                
                geolocateControl : '',
                geolocationSupported : false,
                geolocationStatus : '',
                
                geocoder : {},

                maxSleeps : 12,
                currentLocationText : 'Current Location'
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

                if (this.hasActiveFilters) {
                    let activeFilters = this.activeFilters;

                    let filteredData = this.geoJson.features
                        .filter(feature => {
                            return (
                                    activeFilters.pets === false ||
                                    feature.properties.pets === activeFilters.pets
                                ) && (
                                    feature.properties.sleeps >= activeFilters.sleeps
                                )
                        })
                        // .filter(feature => feature.properties.sleeps >= )

                    console.log(Object.assign({},filteredData));

                    this.map
                        .getSource('places')
                        .setData({
                            type: 'FeatureCollection',
                            features: filteredData
                        });
                } else {
                    this.map.getSource('places').setData(this.geoJson);
                }
                
                this.updateMarkers();
            },
            // oldApplyFilters() {
            //     let filters = [];
                
            //     if (this.filterPet) filters.push(this.filterPet);
            //     if (this.filterSleeps) filters.push(this.filterSleeps);

            //     if (filters.length) {
            //         if (filters.length === 1) {
            //             filters = filters[0];
            //         } else {
            //             filters.unshift("all");
            //         }
            //     } else {
            //         filters = undefined;
            //     }

            //     this.map.setFilter('clusters', filters);
            //     this.map.setFilter('cluster-count', filters);
            //     this.map.setFilter('unclustered-point', filters);
            //     this.map.setFilter('unclustered-point-count', filters);

            //     this.updateMarkers();
            // },
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
            resizeMap() {
                this.map.resize();
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
            markerClicked(feature) {
                // Without details sliding in animation
                // this.$store.dispatch('triggerNewActiveSpot', feature.id)
                //     .then(() => {
                //         this.resizeMap();
                //         this.map.jumpTo({
                //             center: feature.geometry.coordinates,
                //             zoom: 14,
                //             duration: 2000
                //         })
                //     });

                // With details sliding in animation
                let self = this;
                this.$store.dispatch('triggerNewActiveSpot', feature.id)
                    .then((response) => {self.newActiveSpot(feature)});
                // setTimeout(function(){
                // }, 400);
            },
            gotoCoords(coords) {
                this.resizeMap();
                if (this.map.getZoom() >= 10) {
                    this.map.flyTo({
                        center: coords,
                        // zoom: 14,
                        // duration: 2000
                    })
                } else {
                    this.map.jumpTo({
                        center: coords,
                        zoom: 13,
                        // duration: 2000
                    });
                }
            },
            newActiveSpot(feature) {
                // this.activeSpot = feature.id;
                this.$store.commit('newActiveSpot', feature.id)
                
                let markerArr = Object.entries(this.markers);
                for (const [id, marker] of markerArr) {
                    if (id == feature.id) {
                        marker.getElement().classList.add('active');
                    } else {
                        marker.getElement().classList.remove('active');
                    }
                }

                this.gotoCoords(feature.geometry.coordinates)
            },
            // newGeolocate(val) {
            //     console.log('geolocate', val);
            // }

            /*
             *  Map Methods
             */

            updateMarkers() {
                // return false;

                var newMarkers = {};
                var features = this.map.querySourceFeatures('places');

                // for every cluster on the screen, create an HTML marker for it (if we didn't yet),
                // and add it to the map if it's not there already
                let self = this;
                features.forEach((feature) => {
                    var coords = feature.geometry.coordinates;
                    var props = feature.properties;
                    if (
                        (self.map.getZoom() <= 8) ||
                        props.cluster) return;
                    var id = props.id;

                    var marker = self.markers[id];
                    if (!marker) {
                        let el = document.createElement('div');
                        el.className = 'marker';
                        el.innerHTML = '<div class="spot-marker"><div class="image" style="background-image:url('+feature.properties.photo+')"></div><section><span class="price">$'+feature.properties.price+'</span><span class="beds">'+feature.properties.beds+'</span><span class="baths">'+feature.properties.baths+'</span></section></div>';

                        marker = self.markers[id] = new mapboxgl.Marker({
                            element: el,
                            offset: {
                                x: 0,
                                y: -75
                            }
                        }).setLngLat(coords);

                        el.addEventListener('click',function(){
                            self.markerClicked(feature);
                            el.classList.add('clicked')
                        });
                    }
                    newMarkers[id] = marker;

                    if (!self.markersOnScreen[id])
                        marker.addTo(self.map);
                });

                // for every marker we've added previously, remove those that are no longer visible
                for (let id in self.markersOnScreen) {
                    if (!newMarkers[id])
                        self.markersOnScreen[id].remove();
                }
                Vue.set(self, 'markersOnScreen', newMarkers);


                // for (var i = 0; i < features.length; i++) {
                //     var coords = features[i].geometry.coordinates;
                //     var props = features[i].properties;
                //     if (!props.cluster) continue;
                //     var id = props.cluster_id;

                //     var marker = markers[id];
                //     if (!marker) {
                //         var el = createDonutChart(props);
                //         marker = markers[id] = new mapboxgl.Marker({
                //             element: el
                //         }).setLngLat(coords);
                //     }
                //     newMarkers[id] = marker;

                //     if (!markersOnScreen[id])
                //         marker.addTo(map);
                // }
                // // for every marker we've added previously, remove those that are no longer visible
                // for (id in markersOnScreen) {
                //     if (!newMarkers[id])
                //         markersOnScreen[id].remove();
                // }
                // markersOnScreen = newMarkers;
            },
            initData(geoJson) {
                let self = this;

                // Assign the global geoJson to a variable so it can be filtered non-destructively
                this.geoJson = geoJson;

                // Taken from:
                // https://docs.mapbox.com/mapbox-gl-js/example/cluster/
                this.map.addSource('places', {
                    type: 'geojson',
                    data: this.geoJson,
                    cluster: true,
                    clusterRadius: 120, // Radius of each cluster when clustering points (defaults to 50)
                    clusterProperties: {"sum": ["+", ["get", "scalerank"]]}
                })

                // Add the search box
                this.geocoder = new mapboxGeocoder({
                    accessToken: mapboxgl.accessToken,
                    countries: 'usa',
                    types: 'postcode,district,place,locality,neighborhood'
                });
                // this.map.addControl(this.geocoder);
                document.getElementById('geocoder').appendChild(this.geocoder.onAdd(this.map));
                this.geocoder.on('mounted', function(){console.log('loaded')});
                this.geocoder.on('result', function (ev) {
                    self.map.getSource('places').setData(ev.result.geometry);
                });

                this.searchBarVisible = true;
                
                // Circles for the clusters
                this.map.addLayer({
                    id: "clusters",
                    type: "circle",
                    source: "places",
                    filter: [">=", "point_count", 1],
                    // filter: ['has', 'point_count'],
                    paint: {
                        "circle-color": "#45AEF1",
                        "circle-radius": 14
                    },
                    // maxzoom:8
                });

                // Number labels on top of the circle clusters
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
                    filter: [">=", "point_count", 1],
                    // filter: ['has', 'point_count'],
                    paint: {
                        "text-color": "#fff"
                    },
                    // maxzoom:8
                });

                // Single spot "clusters" while zoomed out
                this.map.addLayer({
                    id: "solo-clusters",
                    type: "circle",
                    source: "places",
                    // filter: [">=", "point_count", 1],
                    filter: ["==", "point_count", 1],
                    paint: {
                        "circle-color": "#45AEF1",
                        "circle-radius": 14
                    },
                    maxzoom:8
                });

                // Individual spot markers
                this.map.addLayer({
                    id: "unclustered-point",
                    type: "circle",
                    source: "places",
                    // filter: ["!has", "point_count"],
                    filter: ["any", 
                        ["!has", "point_count"],
                        ["==", "point_count", 1]
                    ],
                    paint: {
                        "circle-color": "#45AEF1",
                        "circle-radius": 14,
                        "circle-stroke-width": 0,
                        "circle-stroke-color": "#fff"
                    },
                    maxzoom: 8
                });

                // Number 1 on the unclustered point markers
                this.map.addLayer({
                    id: "unclustered-point-count",
                    type: "symbol",
                    source: "places",
                    // filter: ["!has", "point_count"],
                    filter: ["any", 
                        ["!has", "point_count"],
                        ["==", "point_count", 1]
                    ],
                    layout: {
                        "text-field": "1",
                        "text-font": ["DIN Offc Pro Black", "Arial Unicode MS Bold"],
                        "text-size": 15
                    },
                    paint: {
                        "text-color": "#fff"
                    },
                    maxzoom: 8
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
                
                // this.geolocationSupported = true;
                
                if ('geolocation' in navigator && location.protocol == 'https:') {
                    this.geolocationSupported = true;
                }

                this.geolocateControl.on('geolocate', (val) => self.geolocateEvent(val));
                this.geolocateControl.on('trackuserlocationstart', () => self.geolocateStart())
                this.geolocateControl.on('trackuserlocationend', () => self.geolocateEnd());

                this.map.on('data', function (e) {
                    if (e.sourceId !== 'places' || !e.isSourceLoaded) return;
                    
                    self.map.on('move', self.updateMarkers);
                    self.map.on('moveend', self.updateMarkers);
                    self.updateMarkers();
                });

                // inspect a cluster on click
                this.map.on('click', 'clusters', function (e) {
                    var features = self.map.queryRenderedFeatures(e.point, {
                        layers: ['clusters']
                    });
                    if (features.length) {
                        var clusterId = features[0].properties.cluster_id;
                        self.map.getSource('places').getClusterExpansionZoom(clusterId, function (err, zoom) {
                            if (err)
                                return;

                            self.map.flyTo({
                                center: features[0].geometry.coordinates,
                                zoom: zoom+.1
                            });
                        });
                    }
                });

                this.map.on('click', 'unclustered-point', function (e) {
                    var features = self.map.queryRenderedFeatures(e.point, {
                        layers: ['unclustered-point']
                    });
                    if (features.length) {
                        // var coords = features[0].geometry.coordinates;
                        self.map.flyTo({
                            center: features[0].geometry.coordinates,
                            zoom: 10
                        });
                    }
                });

                this.map.on('mouseenter', 'clusters', function () {
                    self.map.getCanvas().style.cursor = 'pointer';
                });
                this.map.on('mouseleave', 'clusters', function () {
                    self.map.getCanvas().style.cursor = '';
                });

                this.map.on('mouseenter', 'unclustered-point', function () {
                    self.map.getCanvas().style.cursor = 'pointer';
                });
                this.map.on('mouseleave', 'unclustered-point', function () {
                    self.map.getCanvas().style.cursor = '';
                });

                this.map.on('zoomend', function(e){
                    self.resizeMap();
                    self.updateMarkers();
                    // console.log('zoomend')
                });
            
                this.$mapBus.$on('detailsCardToggled',()=>this.resizeMap());

                // Fix for the map sometimes not being full viewport height on load
                document.onreadystatechange = () => { 
                    if (document.readyState == "complete") { 
                        self.resizeMap();
                    } 
                }
                this.mapIsLoaded = true;

            }

        },
        computed: {
            csrf() {
                return window.Laravel.csrfToken;
            },
            wrapperClass() {
                return {
                    'spot-selected' : this.activeSpot
                }
            },

            activeSpot() {
                return this.$store.state.activeSpot;
            },
            // filterPet() {
            //     if (this.activeFilters.pets) {
            //        return  ['==', 'pets', true]
            //     }
            // },
            // filterSleeps() {
            //     if (this.activeFilters.sleeps && this.activeFilters.sleeps > 0) {
            //         return ['>=', 'sleeps', parseInt(this.activeFilters.sleeps)]
            //     }
            // },
            
            
            // activeFiltersSet() {
            //     let filters = [];
            //     if (this.activeFilters.pets) {
            //         filters.
            //     }
            // },
            
            hasActiveFilters() {
                return (
                    this.activeFilters.pets ||
                    this.activeFilters.sleeps > 0
                )
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
            },

            // self.map.setFilter('clusters', ['>=', 'sleeps', 10]);
            // self.map.setFilter('unclustered-point', ['>=', 'sleeps', 10]);
            // self.map.setFilter('cluster-count', ['>=', 'sleeps', 10]);

        },
        mounted() {
            let self = this;
            // console.log(mapboxgl);
            this.map = new mapboxgl.Map({
                container: 'map-wrapper',
                style: 'mapbox://styles/mapbox/light-v10',
                center: [-98.3810608, 37.9507756],
                zoom: 4
            });

            this.map.on('load', () => {
                self.resizeMap();
                axios.get('/api/spots?output=geojson')
                    .then(response => self.initData(response.data));
                    // .then((response) => self.geoJson = response.data);
            });

            window.addEventListener("load", function(event) {
                self.resizeMap();
            });
            document.onreadystatechange = () => { 
                if (document.readyState == "complete") { 
                    self.resizeMap();
                } 
            }
        },
        watch: {
            // '$store.state.spotDetailsVisible' : 'testListener'
        },
    }
</script>

