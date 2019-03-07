<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Submit Your Property</div>

                    <div class="card-body">
                        <form method="post" :action="'/spots/'+id">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="ownerName">Owner's Full Name</label>
                                    <input v-model="owner_name" type="text" name="owner_name" class="form-control" id="ownerName" />
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="propertyWebsite">Property Website</label>
                                    <input v-model="website" type="url" name="website" class="form-control" id="propertyWebsite" />
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="emailAddress">Email Address</label>
                                    <input v-model="email" type="email" name="email" class="form-control" id="emailAddress" />
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="phoneNumber">Phone Number</label>
                                    <input v-model="phone"  type="phone" name="phone" class="form-control" id="phoneNumber" />
                                </div>
                            </div>

                            <hr />
                            
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Property Name</label>
                                    <input v-model="name" type="text" name="name" class="form-control" id="name" />
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="price">Price per Night</label>
                                    <input v-model="price" type="text" name="price" class="form-control" id="price" />
                                </div>
                            </div>
                            <div class="form-row">
                                    <div class="form-group col-md-5">
                                        <label for="addressStreet">Street Address</label>
                                        <input type="text" name="address1" class="form-control" id="addressStreet" v-model="address1" />
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="addressCity">City</label>
                                        <input type="text" name="city" class="form-control" id="addressCity" v-model="city" />
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="addressState">State</label>
                                        <input type="text" name="state" class="form-control" id="addressState" v-model="state" />
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="addressPostalCode">Postal Code</label>
                                        <input type="text" name="postal_code" class="form-control" id="addressPostalCode" v-model="postal_code" />
                                    </div>
                                <!-- </fieldset> -->
                            </div>

                            <div class="form-group">
                                <label for="desc">Description</label>
                                <textarea v-model="desc" name="desc" class="form-control" id="desc" rows="3"></textarea>
                            </div>

                            <input type="hidden" name="lat" :value="lat" />
                            <input type="hidden" name="lng" :value="lng" />
                            <input type="hidden" name="_token" :value="csrf" />
                            <input type="hidden" name="_method" :value="'PATCH'" />
                            <input type="hidden" name="edit_token" :value="edit_token" />

                            <div class="text-right">
                                <a href="#" class="btn btn-mute">Cancel</a>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
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
        props: [
            'initdata',
            'token'
        ],
        data() {
            return {
                'id' : '',
                'edit_token' : '',
                'owner_name' : '',
                'website' : '',
                'email' : '',
                'email_confirm' : '',
                'phone' : '',
                'name' : '',
                'price' : '',
                'desc' : '',

                'address1' : '',
                'city' : '',
                'state' : '',
                'postal_code' : '',

                'lat': '',
                'lng': '',

                'map' : '',
                'geocoder': ''
            }
        },
        methods: {
            initSetup() {
                let fields = ['address1','city','desc','email','id','lat','lng','moderation_status','name','owner_name','phone','postal_code','price','state','website'];
                var self = this;
                fields.forEach((field) => {
                    self[field] = (self.initdata[field]) ? self.initdata[field] : '';
                });
                this.edit_token = this.token;
            }
        },
        computed: {
            csrf() {
                return window.Laravel.csrfToken;
            }
        },
        mounted() {
            this.initSetup();
        },
        watch: {
            
        },
    }
</script>

<style>
    .mapboxgl-ctrl-geocoder.mapboxgl-ctrl {
        width:100%;
    }
</style>

