<template>
    <div>

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
            }
        },
        methods: {
            queryRendered() {
                console.log(this.map.queryRenderedFeatures([1,2,3,4,5,6,7,8,9,10,72,75]));
                console.log(this.map.queryRenderedFeatures().length);
            }
        },
        computed: {
            csrf() {
                return window.Laravel.csrfToken;
            },
            tempStores() {
                return {
                    "type": "FeatureCollection",
                    "features": [
                        {
                        "type": "Feature",
                        "geometry": {
                            "type": "Point",
                            "coordinates": [
                            -77.034084142948,
                            38.909671288923
                            ]
                        },
                        "properties": {
                            "phoneFormatted": "(202) 234-7336",
                            "phone": "2022347336",
                            "address": "1471 P St NW",
                            "city": "Washington DC",
                            "country": "United States",
                            "crossStreet": "at 15th St NW",
                            "postalCode": "20005",
                            "state": "D.C."
                        }
                        },
                        {
                        "type": "Feature",
                        "geometry": {
                            "type": "Point",
                            "coordinates": [
                            -77.049766,
                            38.900772
                            ]
                        },
                        "properties": {
                            "phoneFormatted": "(202) 507-8357",
                            "phone": "2025078357",
                            "address": "2221 I St NW",
                            "city": "Washington DC",
                            "country": "United States",
                            "crossStreet": "at 22nd St NW",
                            "postalCode": "20037",
                            "state": "D.C."
                        }
                        },
                        {
                        "type": "Feature",
                        "geometry": {
                            "type": "Point",
                            "coordinates": [
                            -77.043929,
                            38.910525
                            ]
                        },
                        "properties": {
                            "phoneFormatted": "(202) 387-9338",
                            "phone": "2023879338",
                            "address": "1512 Connecticut Ave NW",
                            "city": "Washington DC",
                            "country": "United States",
                            "crossStreet": "at Dupont Circle",
                            "postalCode": "20036",
                            "state": "D.C."
                        }
                        },
                        {
                        "type": "Feature",
                        "geometry": {
                            "type": "Point",
                            "coordinates": [
                            -77.0672,
                            38.90516896
                            ]
                        },
                        "properties": {
                            "phoneFormatted": "(202) 337-9338",
                            "phone": "2023379338",
                            "address": "3333 M St NW",
                            "city": "Washington DC",
                            "country": "United States",
                            "crossStreet": "at 34th St NW",
                            "postalCode": "20007",
                            "state": "D.C."
                        }
                        },
                        {
                        "type": "Feature",
                        "geometry": {
                            "type": "Point",
                            "coordinates": [
                            -77.002583742142,
                            38.887041080933
                            ]
                        },
                        "properties": {
                            "phoneFormatted": "(202) 547-9338",
                            "phone": "2025479338",
                            "address": "221 Pennsylvania Ave SE",
                            "city": "Washington DC",
                            "country": "United States",
                            "crossStreet": "btwn 2nd & 3rd Sts. SE",
                            "postalCode": "20003",
                            "state": "D.C."
                        }
                        },
                        {
                        "type": "Feature",
                        "geometry": {
                            "type": "Point",
                            "coordinates": [
                            -76.933492720127,
                            38.99225245786
                            ]
                        },
                        "properties": {
                            "address": "8204 Baltimore Ave",
                            "city": "College Park",
                            "country": "United States",
                            "postalCode": "20740",
                            "state": "MD"
                        }
                        },
                        {
                        "type": "Feature",
                        "geometry": {
                            "type": "Point",
                            "coordinates": [
                            -77.097083330154,
                            38.980979
                            ]
                        },
                        "properties": {
                            "phoneFormatted": "(301) 654-7336",
                            "phone": "3016547336",
                            "address": "4831 Bethesda Ave",
                            "cc": "US",
                            "city": "Bethesda",
                            "country": "United States",
                            "postalCode": "20814",
                            "state": "MD"
                        }
                        },
                        {
                        "type": "Feature",
                        "geometry": {
                            "type": "Point",
                            "coordinates": [
                            -77.359425054188,
                            38.958058116661
                            ]
                        },
                        "properties": {
                            "phoneFormatted": "(571) 203-0082",
                            "phone": "5712030082",
                            "address": "11935 Democracy Dr",
                            "city": "Reston",
                            "country": "United States",
                            "crossStreet": "btw Explorer & Library",
                            "postalCode": "20190",
                            "state": "VA"
                        }
                        },
                        {
                        "type": "Feature",
                        "geometry": {
                            "type": "Point",
                            "coordinates": [
                            -77.10853099823,
                            38.880100922392
                            ]
                        },
                        "properties": {
                            "phoneFormatted": "(703) 522-2016",
                            "phone": "7035222016",
                            "address": "4075 Wilson Blvd",
                            "city": "Arlington",
                            "country": "United States",
                            "crossStreet": "at N Randolph St.",
                            "postalCode": "22203",
                            "state": "VA"
                        }
                        },
                        {
                        "type": "Feature",
                        "geometry": {
                            "type": "Point",
                            "coordinates": [
                            -75.28784,
                            40.008008
                            ]
                        },
                        "properties": {
                            "phoneFormatted": "(610) 642-9400",
                            "phone": "6106429400",
                            "address": "68 Coulter Ave",
                            "city": "Ardmore",
                            "country": "United States",
                            "postalCode": "19003",
                            "state": "PA"
                        }
                        },
                        {
                        "type": "Feature",
                        "geometry": {
                            "type": "Point",
                            "coordinates": [
                            -75.20121216774,
                            39.954030175164
                            ]
                        },
                        "properties": {
                            "phoneFormatted": "(215) 386-1365",
                            "phone": "2153861365",
                            "address": "3925 Walnut St",
                            "city": "Philadelphia",
                            "country": "United States",
                            "postalCode": "19104",
                            "state": "PA"
                        }
                        },
                        {
                        "type": "Feature",
                        "geometry": {
                            "type": "Point",
                            "coordinates": [
                            -77.043959498405,
                            38.903883387232
                            ]
                        },
                        "properties": {
                            "phoneFormatted": "(202) 331-3355",
                            "phone": "2023313355",
                            "address": "1901 L St. NW",
                            "city": "Washington DC",
                            "country": "United States",
                            "crossStreet": "at 19th St",
                            "postalCode": "20036",
                            "state": "D.C."
                        }
                        }
                    ]
                };
            },
            fakeData() {
                return [
                    { name: 'Location A', category: 'Store', street: 'Market', lat: 39.984, lng: -75.343 },
                    { name: 'Location B', category: 'House', street: 'Broad', lat: 39.284, lng: -75.833 },
                    { name: 'Location C', category: 'Office', street: 'South', lat: 39.123, lng: -74.534 }
                ];
            }
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
                if (true) {
                    this.map.addSource('places', {
                        type: 'geojson',
                        data: "http://sweetspot.test/api/gj",
                        cluster: true,
                        clusterMaxZoom: 14, // Max zoom to cluster points on
                        clusterRadius: 50 // Radius of each cluster when clustering points (defaults to 50)
                    })
                    this.map.addLayer({
                        id: "clusters",
                        type: "circle",
                        source: "places",
                        filter: ["has", "point_count"],
                        paint: {
                            // Use step expressions (https://docs.mapbox.com/mapbox-gl-js/style-spec/#expressions-step)
                            // with three steps to implement three types of circles:
                            //   * Blue, 20px circles when point count is less than 100
                            //   * Yellow, 30px circles when point count is between 100 and 750
                            //   * Pink, 40px circles when point count is greater than or equal to 750
                            "circle-color": [
                                "step",
                                ["get", "point_count"],
                                "#51bbd6",
                                100,
                                "#f1f075",
                                750,
                                "#f28cb1"
                            ],
                            "circle-radius": [
                                "step",
                                ["get", "point_count"],
                                20,
                                100,
                                30,
                                750,
                                40
                            ]
                        }
                    });

                    this.map.addLayer({
                        id: "cluster-count",
                        type: "symbol",
                        source: "places",
                        filter: ["has", "point_count"],
                        layout: {
                            "text-field": "{point_count_abbreviated}",
                            "text-font": ["DIN Offc Pro Medium", "Arial Unicode MS Bold"],
                            "text-size": 12
                        }
                    });

                    this.map.addLayer({
                        id: "unclustered-point",
                        type: "circle",
                        source: "places",
                        filter: ["!", ["has", "point_count"]],
                        paint: {
                            "circle-color": "#11b4da",
                            "circle-radius": 4,
                            "circle-stroke-width": 1,
                            "circle-stroke-color": "#fff"
                        }
                    });

                    // inspect a cluster on click
                    let self = this;
                    this.map.on('click', 'clusters', function (e) {
                        var features = self.map.queryRenderedFeatures(e.point, {
                            layers: ['clusters']
                        });
                        var clusterId = features[0].properties.cluster_id;
                        self.map.getSource('places').getClusterExpansionZoom(clusterId, function (err, zoom) {
                            if (err)
                                return;

                            self.map.easeTo({
                                center: features[0].geometry.coordinates,
                                zoom: zoom
                            });
                        });
                    });
                    this.map.on('click', 'unclustered-point', function (e) {
                        self.queryRendered();
                        alert('SHOW ME SPOT #'+e.features[0].properties.id + ', KNAVE')
                    });
                } else {
                    let self = this;
                    this.map.addSource('places', {
                        type: 'geojson',
                        data: "http://sweetspot.test/api/geo",
                        // cluster: true,
                        // clusterMaxZoom: 14, // Max zoom to cluster points on
                        // clusterRadius: 50 // Radius of each cluster when clustering points (defaults to 50)
                    })
                    this.map.addLayer({
                        id: 'spots',
                        type: 'circle',
                        source: 'places',
                        paint: {
                            "circle-color": "#11b4da",
                            "circle-radius": 4,
                            "circle-stroke-width": 1,
                            "circle-stroke-color": "#fff"
                        }
                        // cluster: true,
                        // clusterMaxZoom: 14, // Max zoom to cluster points on
                        // clusterRadius: 50 // Radius of each cluster when clustering points (defaults to 50)
                    })
                    this.map.on('click', 'spots', function (e) {
                        // console.log('ok');
                        console.log(e.features[0].properties.id);
                        var coordinates = e.features[0].geometry.coordinates.slice();
                        var description = e.features[0].properties.description;
                        
                        // Ensure that if the map is zoomed out such that multiple
                        // copies of the feature are visible, the popup appears
                        // over the copy being pointed to.
                        while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
                            coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
                        }
                        
                        new mapboxgl.Popup()
                            .setLngLat(coordinates)
                            .setHTML(description)
                            .addTo(self.map);
                    });
                }
                

                

                // Manual way of adding points
                // this.tempStores.features.forEach(function(marker) {
                //     // Create a div element for the marker
                //     var el = document.createElement('div');
                //     // Add a class called 'marker' to each div
                //     el.className = 'marker';
                //     // By default the image for your custom marker will be anchored
                //     // by its center. Adjust the position accordingly
                //     // Create the custom markers, set their position, and add to map
                //     new mapboxgl.Marker(el, { offset: [0, -23] })
                //         .setLngLat(marker.geometry.coordinates)
                //         .addTo(self.map);

                //     el.addEventListener('click', function(e) {
                //         var activeItem = document.getElementsByClassName('active');
                //         // 1. Fly to the point
                //         flyToStore(marker);
                //         // 2. Close all other popups and display popup for clicked store
                //         createPopUp(marker);
                //         // 3. Highlight listing in sidebar (and remove highlight for all other listings)
                //         e.stopPropagation();
                //         if (activeItem[0]) {
                //         activeItem[0].classList.remove('active');
                //         }
                //         var listing = document.getElementById('listing-' + i);
                //         console.log(listing);
                //         listing.classList.add('active');
                //     });
                // });
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
    .marker {
        width:10px;
        height:10px;
        background:red;
    }
</style>

