<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Submit Your Property</div>

                    <div class="card-body">
                        <form method="post" action="/spots">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="ownerName">Owner's Full Name</label>
                                    <input v-model="owner_name" type="text" name="owner_name" class="form-control" id="ownerName" />
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="propertyWebsite">Property Website</label>
                                    <input type="url" name="website" class="form-control" id="propertyWebsite" />
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="emailAddress">Email Address</label>
                                    <input type="email" name="email" class="form-control" id="emailAddress" />
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="emailConfirm">Confirm Email Address</label>
                                    <input type="email" name="email_confirmation" class="form-control" id="emailConfirm" />
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="phoneNumber">Phone Number</label>
                                    <input type="phone" name="phone" class="form-control" id="phoneNumber" />
                                </div>
                            </div>

                            <hr />
                            
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Property Name</label>
                                    <input type="text" name="name" class="form-control" id="name" />
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="price">Price per Night</label>
                                    <input type="text" name="price" class="form-control" id="price" />
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-8 col-offset-2">
                                    <label for="name">Property Address</label>
                                    <!-- <input type="text" name="name" class="form-control" id="name" /> -->
                                    <div id="geocoder" class="geocoder"></div>
                                
                                    <div id="map" style="height:200px"></div>
                                </div>
                            </div>

                            <div class="form-row">
                                <!-- <fieldset disabled> -->
                                    <div class="form-group col-md-5">
                                        <label for="addressStreet">Street Address</label>
                                        <input type="text" name="address1" class="form-control" id="addressStreet" v-model="address_street" />
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="addressCity">City</label>
                                        <input type="text" name="city" class="form-control" id="addressCity" v-model="address_city" />
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="addressState">State</label>
                                        <input type="text" name="state" class="form-control" id="addressState" v-model="address_state" />
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="addressPostalCode">Postal Code</label>
                                        <input type="text" name="postal_code" class="form-control" id="addressPostalCode" v-model="address_zip" />
                                    </div>
                                <!-- </fieldset> -->
                            </div>

                            <div class="form-group">
                                <label for="desc">Description</label>
                                <textarea name="desc" class="form-control" id="desc" rows="3"></textarea>
                            </div>

                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="termsAgree">
                                <label class="form-check-label" for="termsAgree">I Have Read & Agree to the SweetSpot <a href="#">Terms of Service</a></label>
                            </div>

                            <input type="hidden" name="lat" :value="lat" />
                            <input type="hidden" name="lng" :value="lng" />
                            <input type="hidden" name="_token" :value="csrf" />

                            <div class="text-right">
                                <a href="#" class="btn btn-mute">Cancel</a>
                                <button type="submit" class="btn btn-primary">Save &amp; Continue</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    let mapboxgl = require('mapbox-gl');
    let MapboxGeocoder = require('mapbox-gl-geocoder');

    mapboxgl.accessToken = process.env.MIX_MAPBOX_APP_KEY;

    export default {
        data() {
            return {
                'owner_name' : '',
                'website' : '',
                'email' : '',
                'email_confirm' : '',
                'phone' : '',
                'name' : '',
                'price' : '',
                'desc' : '',
                'terms_agree': false,

                'address_street' : '',
                'address_city' : '',
                'address_state' : '',
                'address_zip' : '',

                'lat': '',
                'lng': '',

                'map' : '',
                'geocoder': ''
            }
        },
        methods: {
            addressSelected(ev) {
                console.log('selected');
                console.log(ev.result);
                let context = ev.result.context;
                this.map.getSource('single-point').setData(ev.result.geometry);

                this.address_street = ((ev.result.address) ? ev.result.address + ' ' : '') + ev.result.text;
                this.address_city = context.find(e => e.id.includes('place')).text;
                this.address_zip = context.find(e => e.id.includes('postcode')).text;
                this.address_state = context.find(e => e.id.includes('region')).text;

                let coords = ev.result.geometry.coordinates;
                this.lng = coords[0];
                this.lat = coords[1];
            }
        },
        computed: {
            csrf() {
                return window.Laravel.csrfToken;
            }
        },
        mounted() {
            // console.log(mapboxgl);
            this.map = new mapboxgl.Map({
                container: 'map',
                style: 'mapbox://styles/mapbox/streets-v9',
                center: [-98.5833, 39.833333],
                zoom: 2
            });
            this.geocoder = new MapboxGeocoder({
                accessToken: mapboxgl.accessToken,
                country : 'US',
                types: 'address'
            });
            document.getElementById('geocoder').appendChild(this.geocoder.onAdd(this.map));

            this.map.on('load', () => {
                this.map.addSource('single-point', {
                    "type": "geojson",
                    "data": {
                    "type": "FeatureCollection",
                    "features": []
                    }
                })
                this.map.addLayer({
                    "id": "point",
                    "source": "single-point",
                    "type": "circle",
                    "paint": {
                    "circle-radius": 10,
                    "circle-color": "#007cbf"
                    }
                });
                this.geocoder.on('result', this.addressSelected);
            })
            
        },
        watch: {
            'geocoder.result' : 'addressSelected'
        },
    }
</script>

<style>
    .mapboxgl-ctrl-geocoder.mapboxgl-ctrl {
        width:100%;
    }
</style>

