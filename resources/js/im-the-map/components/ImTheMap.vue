<template>
    <section id="main-map" :class="wrapperClass">

        <h1 class="logo" style="display:none"></h1>

        <section class="mobile-nav" :class="{active: mobileNavIsVisible}">

            <ul>
                <li>
                    <a href="" @click.prevent="showAboutModal">About Us</a>
                </li>
                <li>
                    <a href="" @click.prevent="showTermsModal">Terms of Service</a>
                </li>
            </ul>

            <button @click.prevent="showSubmitPropertyModal">List Your Spot</button>

        </section>

        <header>

            <section class="logo-and-menu">

                <div class="logo"></div>

                <div class="bun" :class="{active: mobileNavIsVisible}" @click.prevent="mobileNavIsVisible = !mobileNavIsVisible">
                    <div class="pickles"></div>
                    <div class="cheese"></div>
                    <div class="meat"></div>
                </div>

            </section>

            <section class="search-and-filters">
                <div class="search">

                    <button id="clear-search" @click.prevent="clearSearch" v-if="showClearSearchButton">
                        <span class="icon-clear-css"></span>
                    </button>

                    <div id="geocoder" ref="geocoder-wrap"></div>

                </div>

                <div class="filters-wrap">
                    <div class="filters" @click.prevent="toggleFilterDropdown" :class="{active: true}">
                        <svg width="21" height="12" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M7.24902 4.5C6.28253 4.5 5.49902 3.7165 5.49902 2.75C5.49902 1.7835 6.28253 1 7.24902 1C8.21552 1 8.99902 1.7835 8.99902 2.75C8.99902 3.21413 8.81465 3.65925 8.48646 3.98744C8.15827 4.31563 7.71315 4.5 7.24902 4.5Z"
                                stroke="#666666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M1 2.75H2.5" stroke="#666666" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M12 2.75H19.5" stroke="#666666" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M13.249 10.5C12.2825 10.5 11.499 9.7165 11.499 8.75C11.499 7.7835 12.2825 7 13.249 7C14.2155 7 14.999 7.7835 14.999 8.75C14.999 9.21413 14.8146 9.65925 14.4865 9.98744C14.1583 10.3156 13.7132 10.5 13.249 10.5Z"
                                stroke="#666666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M1 8.75H8.5" stroke="#666666" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M18 8.75H19.5" stroke="#666666" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        <span class="count" v-if="activeFiltersCount" v-text="activeFiltersCount"></span>
                    </div>

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
                </div>

            </section>

            <nav>
                <a href="#" @click.prevent="showAboutModal">About Us</a>
                <button @click.prevent="showSubmitPropertyModal">List Your Spot</button>
            </nav>

        </header>

        <ul class="style-switcher" :class="{open: styleSwitcherIsOpen}" v-if="false">
            <li class="default active" @click.prevent="changeMapStyle('light-v10')">
                <svg width="16" height="16" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15.7576 0.24538C15.4987 -0.0160459 15.0983 -0.0752622 14.7748 0.100015L0.438937 7.7677C0.102706 7.94845 -0.0677694 8.3345 0.0251477 8.70475C0.118065 9.075 0.450625 9.33482 0.832357 9.33538H6.66698V15.17C6.66688 15.5522 6.92697 15.8855 7.29778 15.9782C7.36323 15.9945 7.43038 16.003 7.49783 16.0035C7.80492 16.0032 8.08688 15.8338 8.23132 15.5628L15.8997 1.22626C16.0746 0.903888 16.0168 0.504907 15.7576 0.24538Z" fill="#29304C"></path>
                </svg>
            </li>
            <li class="streets" @click.prevent="changeMapStyle('streets-v11')">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M15.8941 15.3513L11.2274 0.351334C11.1625 0.142246 10.969 -0.000191338 10.7501 1.92923e-07H8.91674C8.82469 1.92923e-07 8.75007 0.0746196 8.75007 0.166667V1C8.75007 1.36819 8.4516 1.66667 8.08341 1.66667C7.71522 1.66667 7.41674 1.36819 7.41674 1V0.166667C7.41674 0.0746196 7.34212 1.92923e-07 7.25007 1.92923e-07H5.41674C5.19781 -0.000191338 5.00429 0.142246 4.93941 0.351334L0.272739 15.3513C0.225474 15.5031 0.253195 15.6683 0.347411 15.7963C0.441627 15.9244 0.59111 16 0.750073 16H7.25007C7.34212 16 7.41674 15.9254 7.41674 15.8333V13.3333C7.41674 12.9651 7.71522 12.6667 8.08341 12.6667C8.4516 12.6667 8.75007 12.9651 8.75007 13.3333V15.8333C8.75007 15.9254 8.82469 16 8.91674 16H15.4167C15.5757 16 15.7252 15.9244 15.8194 15.7963C15.9136 15.6683 15.9413 15.5031 15.8941 15.3513ZM8.08337 2.83333C8.45156 2.83333 8.75004 3.13181 8.75004 3.5V5C8.75004 5.36819 8.45156 5.66667 8.08337 5.66667C7.71518 5.66667 7.41671 5.36819 7.41671 5V3.5C7.41671 3.13181 7.71518 2.83333 8.08337 2.83333ZM7.41671 10.3333C7.41671 10.7015 7.71518 11 8.08337 11C8.45156 11 8.75004 10.7015 8.75004 10.3333V8C8.75004 7.63181 8.45156 7.33333 8.08337 7.33333C7.71518 7.33333 7.41671 7.63181 7.41671 8V10.3333Z" fill="#29304C"></path>
                </svg>          
            </li>
            <li class="satellite" @click.prevent="changeMapStyle('satellite-streets-v9')">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.64976 5.58781C5.05047 5.98464 5.69698 5.9816 6.09393 5.581L7.05262 4.61414C7.2434 4.42168 7.34987 4.16129 7.34859 3.8903C7.34732 3.61932 7.2384 3.35994 7.04581 3.16929L4.14454 0.29458C3.74326 -0.100571 3.0983 -0.0978339 2.70038 0.300708L1.74169 1.26825C1.34485 1.66896 1.3479 2.31547 1.7485 2.71242L4.64976 5.58781Z" fill="#29304C"></path>
                    <path d="M15.6993 11.8696L12.7966 8.99416C12.395 8.59957 11.7504 8.60261 11.3525 9.00097L10.3938 9.96851C9.99695 10.3692 10 11.0157 10.4006 11.4127L13.3032 14.2881C13.7039 14.6849 14.3504 14.6819 14.7474 14.2813L15.7054 13.311C16.1006 12.9108 16.0979 12.2664 15.6993 11.8696Z" fill="#29304C"></path>
                    <path d="M13.897 3.44986H13.9018C14.6677 3.44855 15.2877 2.82693 15.287 2.06102C15.2864 1.29511 14.6653 0.674561 13.8994 0.674561C13.1335 0.674561 12.5124 1.29511 12.5117 2.06102C12.5111 2.82693 13.1311 3.44855 13.897 3.44986Z" fill="#29304C"></path>
                    <path d="M4.76628 12.5964C4.01419 12.5964 3.4045 11.9867 3.4045 11.2346C3.4045 10.8586 3.09966 10.5537 2.72361 10.5537C2.34757 10.5537 2.04272 10.8586 2.04272 11.2346C2.04272 12.7388 3.2621 13.9582 4.76628 13.9582C5.14232 13.9582 5.44717 13.6533 5.44717 13.2773C5.44717 12.9012 5.14232 12.5964 4.76628 12.5964Z" fill="#29304C"></path>
                    <path d="M4.42578 14.6389C2.73358 14.6389 1.36178 13.2671 1.36178 11.5749C1.36178 11.1989 1.05693 10.894 0.680889 10.894C0.304844 10.894 0 11.1989 0 11.5749C0.00300129 14.018 1.98273 15.9977 4.42578 16.0007C4.80182 16.0007 5.10666 15.6959 5.10666 15.3198C5.10666 14.9438 4.80182 14.6389 4.42578 14.6389Z" fill="#29304C"></path>
                    <path d="M12.0954 3.87947C11.2941 3.08561 10.0011 3.0914 9.20702 3.8924L6.1546 6.97479C6.02773 7.10349 5.95723 7.27735 5.95864 7.45807C5.96004 7.63878 6.03323 7.81153 6.16209 7.93824L8.09649 9.85495C8.36361 10.119 8.7941 10.1169 9.05859 9.85018L12.111 6.7678C12.9041 5.96582 12.8971 4.6728 12.0954 3.87947Z" fill="#29304C"></path>
                    <path d="M3.72177 8.68112C3.52255 8.77711 3.38235 8.96387 3.3458 9.18197C3.30925 9.40007 3.38089 9.62233 3.53793 9.77803L6.27442 12.49C6.43138 12.6459 6.65426 12.7157 6.8721 12.6774C7.08994 12.6391 7.2756 12.4974 7.36997 12.2973C7.86374 11.2534 7.64545 10.0115 6.82526 9.1985C6.00508 8.38551 4.76133 8.17816 3.72177 8.68112Z" fill="#29304C"></path>
                </svg>
            </li>
        </ul>

        <div id="map-wrapper"></div>

    </section>
</template>

<script>
    let mapboxgl = require('mapbox-gl');
    let mapboxGeocoder = require('@mapbox/mapbox-gl-geocoder');
    // let mapboxGeocoder = require('mapbox-gl-geocoder');
    // let geoJSON = require('geojson')

    // console.log(geoJSON);
    // GeoJSON.parse(data, {Point: ['lat', 'lng']});

    mapboxgl.accessToken = process.env.MIX_MAPBOX_APP_KEY;

    export default {
        data() {
            return {
                map : '',
                popups : [],
                // markers : {},
                // markersOnScreen : {},
                activeMarker: {},
                hoverMarker: {},
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
                
                mapStyle: 'mapbox://styles/mapbox/streets-v11',
                styleSwitcherIsOpen : false,

                mobileSearchIsVisible : false,
                mobileNavIsVisible: false,
                
                geolocateControl : '',
                geolocationSupported : false,
                geolocationStatus : '',
                
                geocoder : {},

                maxSleeps : 12,
                currentLocationText : 'Current Location'
            }
        },
        methods: {
            changeMapStyle(style) {
                if (!this.styleSwitcherIsOpen) {
                    this.styleSwitcherIsOpen = true;
                    return false;
                }

                this.styleSwitcherIsOpen = false;
                if (this.mapStyle === style) {
                    return false;
                }
                this.mapStyle = style;
                this.map.setStyle('mapbox://styles/mapbox/' + style);
                this.addDataLayers();

            },
            applyDropdownFilters() {
                console.log('apply');
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
                Vue.nextTick(() => {
                    if (this.activeMarker && (typeof this.activeMarker.getLngLat == 'function')) {
                        console.log(this.activeMarker.getLngLat());
                        // this.activeMarker.setLngLat(this.activeMarker.getLngLat());
                    }
                })
                
                
            },

            /*
             * Geolocate Methods
             */
            getUserLocation() {
                if (this.geolocationSupported) {
                    this.geolocateControl.trigger();
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
                this.filterDropdownIsVisible = false;
            },
            
            toggleMobileSearch() {
                if (this.mobileSearchIsVisible) {
                    this.hideMobileSearch();
                } else {
                    this.showMobileSearch();
                }
            },
            showMobileSearch() {
                this.mobileSearchIsVisible = true;
                Vue.nextTick(() => {
                    this.$refs['geocoder-wrap'].querySelector('input[type="text"]').focus();
                })
            },
            hideMobileSearch() {
                this.mobileSearchIsVisible = false;
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
                let self = this;
                this.$store.dispatch('triggerNewActiveSpot', feature.id)
                    .then((response) => {self.newActiveSpot(feature)});
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
                // this.$store.commit('newActiveSpot', feature.id)
                
                // let markerArr = Object.entries(this.markers);
                // for (const [id, marker] of markerArr) {
                //     if (id == feature.id) {
                //         marker.getElement().classList.add('active');
                //     } else {
                //         marker.getElement().classList.remove('active');
                //     }
                // }

                this.gotoCoords(feature.geometry.coordinates);
                Vue.nextTick(() =>{
                    this.newActiveMarker(feature);                    
                });
            },

            newActiveMarker(feature) {
                this.hideActiveMarker();
                this.activeMarker = this.showMarkerForSpot(feature);
            },

            newHoverMarker(feature) {
                this.hideHoverMarker();
                if (feature.id !== this.activeSpot.id) {
                    this.hoverMarker = this.showMarkerForSpot(feature);
                }
            },

            showMarkerForSpot(feature) {
                let el = document.createElement('div');
                el.className = 'marker';
                el.innerHTML = '<div class="spot-marker"><div class="image" style="background-image:url('+feature.properties.photo+')"></div><section><span class="price">$'+feature.properties.price+'</span><span class="beds">'+feature.properties.beds+'</span><span class="baths">'+feature.properties.baths+'</span></section></div>';

                let coords = feature.geometry.coordinates;
                let marker = new mapboxgl.Marker({
                    element: el,
                    offset: {
                        x: 0,
                        y: -75
                    }
                }).setLngLat(coords);
                console.log(coords);
                marker.addTo(this.map);
                return marker;
            },

            hideActiveMarker() {
                if(!(Object.entries(this.activeMarker).length === 0 && this.activeMarker.constructor === Object)) {
                    this.activeMarker.remove();
                }
            },

            hideHoverMarker() {
                if(!(Object.entries(this.hoverMarker).length === 0 && this.hoverMarker.constructor === Object)) {
                    this.hoverMarker.remove();
                }
            },

            showSubmitPropertyModal() {
                this.$store.commit('showSubmitPropertyModal');
            },
            showAboutModal(which) {
                this.$store.commit('showInformationalModal', 'about');
            },
            showTermsModal() {
                this.$store.commit('showInformationalModal', 'terms');
            },
            // newGeolocate(val) {
            //     console.log('geolocate', val);
            // }

            /*
             *  Map Methods
             */

            updateMarkers() {
                return false;

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
            checkForInitSpot() {
                // Check if there's a spot parameter in the URL (ie ?spot=22)
                let uri = window.location.search.substring(1); 
                let params = new URLSearchParams(uri);
                let id = params.get('spot');

                // If there was a spot parameter in the query string, get that spot's geoJSON feature
                if (id) {
                    var feature = this.geoJson.features.find(feature => feature.id == id);
                    if (!feature) {
                        return false;
                    }
                } else {
                    return false;
                }
                
                let coords = feature.geometry.coordinates;
                let props = feature.properties;

                this.map.jumpTo({
                    center: coords,
                    zoom: 13,
                });
                
                Vue.nextTick(() => {
                    // nextTick so that they are added after the map moves
                    this.activeMarker = this.showMarkerForSpot(feature);
                    this.$store.dispatch('triggerNewActiveSpot', feature.id)
                        .then((response) => {this.newActiveSpot(feature)});
                });

            },
            addDataLayers() {
                this.map.addLayer({
                    id: "single-spot-border",
                    type: "circle",
                    source: "places",
                    paint: {
                        "circle-color": "#fff",
                        "circle-radius": 11
                    }
                });
                this.map.addLayer({
                    id: "single-spot",
                    type: "circle",
                    source: "places",
                    paint: {
                        "circle-color": "#9080F0",
                        "circle-radius": 7
                    }
                });
            },
            initData(geoJson) {
                let self = this;

                // Assign the global geoJson to a variable so it can be filtered non-destructively
                this.geoJson = geoJson;
                this.map.addSource('places', {
                    type: 'geojson',
                    data: this.geoJson,
                })

                this.addDataLayers();

                this.map.on('sourcedata', () => {
                    if (!self.mapIsLoaded && self.map.getSource('places') && self.map.isSourceLoaded('places')) {
                        self.mapIsLoaded = true;
                        self.checkForInitSpot()
                    }
                });

                // Add the search box
                this.geocoder = new mapboxGeocoder({
                    accessToken: mapboxgl.accessToken,
                    mapboxgl: mapboxgl,
                    countries: 'us',
                    zoom: 12,
                    marker: false
                    // types: 'postcode,district,place,locality,neighborhood'
                });
                document.getElementById('geocoder').appendChild(this.geocoder.onAdd(this.map));
                this.geocoder.on('mounted', function(){console.log('loaded')});

                this.searchBarVisible = true;

                this.map.on('data', function (e) {
                    if (e.sourceId !== 'places' || !e.isSourceLoaded) return;
                    
                    self.map.on('move', self.updateMarkers);
                    self.map.on('moveend', self.updateMarkers);
                    self.updateMarkers();
                });

                this.map.on('mouseenter', 'single-spot', function (e) {
                    self.map.getCanvas().style.cursor = 'pointer';
                    var features = self.map.queryRenderedFeatures(e.point, {
                        layers: ['single-spot']
                    });
                    if (features.length) {
                        self.newHoverMarker(features[0]);
                    }
                });
                this.map.on('mouseleave', 'single-spot', function () {
                    self.map.getCanvas().style.cursor = '';
                    self.hideHoverMarker();
                });

                this.map.on('click', 'single-spot', function (e) {
                    var features = self.map.queryRenderedFeatures(e.point, {
                        layers: ['single-spot']
                    });
                    if (features.length) {
                        self.$store.dispatch('triggerNewActiveSpot', features[0].id)
                            .then((response) => {self.newActiveSpot(features[0])});
                    }
                });

                this.map.on('zoomend', function(e){
                    self.resizeMap();
                    self.updateMarkers();
                });
            
                this.$mapBus.$on('detailsCardToggled',()=>this.resizeMap());

                // Fix for the map sometimes not being full viewport height on load
                document.onreadystatechange = () => { 
                    if (document.readyState == "complete") { 
                        self.resizeMap();
                    } 
                }

                // setTimeout(() => this.checkForInitSpot(), 1000);
            },
            activeSpotChanged() {
                console.log('changed');
                if (!this.$store.state.activeSpot) {
                    console.log('hide');
                    this.hideActiveMarker();
                }
            }

        },
        computed: {
            csrf() {
                return window.Laravel.csrfToken;
            },
            wrapperClass() {
                return {
                    'spot-selected' : this.activeSpot,
                    'mobile-search-visible' : this.mobileSearchIsVisible
                }
            },
            activeSpot() {
                return this.$store.state.activeSpot;
            },
            
            hasActiveFilters() {
                return this.activeFiltersCount > 0;
            },
            
            activeFiltersCount() {
                let c = 0;
                if (this.activeFilters.pets) c++;
                if (this.activeFilters.sleeps & this.activeFilters.sleeps > 0) c++;
                return c;
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
                style: this.mapStyle,
                // center: [-98.3810608, 37.9507756],
                center: [-99.169510, 31.417772],
                zoom:5.5
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
            '$store.state.activeSpot' : 'activeSpotChanged'
        },
    }
</script>

