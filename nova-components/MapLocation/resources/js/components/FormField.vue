<template>
    <default-field :field="field" :errors="errors" :fullWidthContent="true">
        <template slot="field">
            <div id="spot-form-geocoder" v-show="isCreating" class="mb-3"></div>
            <div id="form-map" style="height:200px" class="map-wrapper">
                <svg v-if="!isCreating || addressIsSelected" width="16" height="26" viewBox="0 0 16 26" fill="none" xmlns="http://www.w3.org/2000/svg" class="marker">
                    <ellipse cx="8" cy="24.5" rx="5" ry="1.5" fill="black" fill-opacity="0.1"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.0244141 8C0.0293565 3.58378 3.59557 0.00495989 7.99625 0C12.3969 0.00495989 15.9631 3.58378 15.9681 8C15.9681 11.514 10.9857 20.026 8.84525 23.523C8.66536 23.8206 8.34308 24.0017 7.99625 24C7.65007 24.0001 7.32864 23.8199 7.14725 23.524C5.00681 20.025 0.0244141 11.51 0.0244141 8ZM4.50854 8C4.50854 9.933 6.07004 11.5 7.99623 11.5C9.92243 11.5 11.4839 9.933 11.4839 8C11.4839 6.067 9.92243 4.5 7.99623 4.5C6.07004 4.5 4.50854 6.067 4.50854 8Z" fill="#9080F0"/>
                </svg>
            </div>

            <div class="icon-message text-sm mt-3" v-show="showIconMessage">
                <svg class="icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 15.75C13.6569 15.75 15 14.4069 15 12.75C15 11.0931 13.6569 9.75 12 9.75C10.3431 9.75 9 11.0931 9 12.75C9 14.4069 10.3431 15.75 12 15.75Z" stroke="#9080F0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 6.75C15.3137 6.75 18 9.43629 18 12.75C18 15.422 14.1 21.055 12.589 22.965C12.4468 23.145 12.2299 23.2501 12.0005 23.2501C11.7711 23.2501 11.5542 23.145 11.412 22.965C9.9 21.054 6 15.422 6 12.75C6 9.43629 8.68629 6.75 12 6.75Z" stroke="#9080F0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 0.75V3.75" stroke="#9080F0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M19 3.00293L17.25 5.43993" stroke="#9080F0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M5 3.00293L6.75 5.43993" stroke="#9080F0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M0.75 9L3.472 9.875" stroke="#9080F0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M23.2498 9L20.5278 9.875" stroke="#9080F0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span v-text="iconMessageText">Drag the map around for a more precise pin location.</span>
            </div>
        </template>
    </default-field>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova'
let mapboxgl = require('mapbox-gl');
let mapboxGeocoder = require('@mapbox/mapbox-gl-geocoder');
mapboxgl.accessToken = process.env.MIX_MAPBOX_APP_KEY;

export default {
    mixins: [FormField, HandlesValidationErrors],

    props: ['resourceName', 'resourceId', 'field'],

    data() {
        return {
            lat : 0,
            lng : 0,
            map : {},
            geocoder : {},

            address1 : '',
            city : '',
            state : '',
            postal_code : '',

            isCreating : false,
            addressIsSelected: false,
            mapHasMoved : false
        }
    },

    mounted() {
        this.lat = parseFloat(this.field.lat);
        this.lng = parseFloat(this.field.lng);

        if (!this.lat || !this.lng) {
            this.isCreating = true;
        }

        mapboxgl.accessToken = this.field.mapboxKey
        this.map = new mapboxgl.Map({
            container: 'form-map',
            style: 'mapbox://styles/mapbox/light-v10',
            center: [
                (this.lng || -98.3810608),
                (this.lat || 37.9507756)
            ],
            zoom: (this.isCreating ? 4 : 14)
        });
        this.map.addControl(new mapboxgl.NavigationControl({
            showCompass: false
        }));
        if (this.isCreating) {
            this.geocoder = new mapboxGeocoder({
                accessToken: mapboxgl.accessToken,
                mapboxgl: mapboxgl,
                countries: 'us',
                marker: false,
                types: 'address'
            });
            // this.map.addControl(this.geocoder);
            document.getElementById('spot-form-geocoder').appendChild(this.geocoder.onAdd(this.map));
            // let self = this;
            this.map.on('load', () => {
                this.geocoder.on('result', this.addressSelected);
                this.geocoder.on('clear', this.addressCleared);
            });
        }
        this.map.on('load', () => {
            this.map.on('dragend', this.mapMoved);
            this.map.on('zoomend', this.mapMoved);
        });
    },

    methods: {
        /*
         * Set the initial, internal value for the field.
         */
        setInitialValue() {
            this.value = this.field.value || ''
        },

        /**
         * Fill the given FormData object with the field's internal value.
         */
        fill(formData) {
            if (this.mapHasMoved) {
                formData.append('lat', this.lat || '');
                formData.append('lng', this.lng || '');

                if (this.isCreating) {
                    formData.append('address1', this.address1 || '');
                    formData.append('city', this.city || '');
                    formData.append('state', this.state || '');
                    formData.append('postal_code', this.postal_code || '');
                }
            }
        },

        /**
         * Update the field's internal value.
         */
        handleChange(value) {
            this.value = value
        },

        addressSelected(ev) {
            let context = ev.result.context;
            // this.map.getSource('single-point').setData(ev.result.geometry);
            let coords = ev.result.geometry.coordinates;

            this.address1 = ((ev.result.address) ? ev.result.address + ' ' : '') + ev.result.text;
            this.city = context.find(e => e.id.includes('place')).text;
            this.postal_code = context.find(e => e.id.includes('postcode')).text;
            this.state = context.find(e => e.id.includes('region')).text;
            this.lng = coords[0];
            this.lat = coords[1];
            
            this.addressIsSelected = true;
            this.mapHasMoved = true;
            this.map.jumpTo({
                center: coords,
                zoom: 16
            })
        },
        addressCleared(ev) {
            this.address_street = '';
            this.address_city = '';
            this.address_zip = '';
            this.address_state = '';

            this.map.jumpTo({
                center: [-98.5833, 39.833333],
                zoom: 2
            })
            this.lng = '';
            this.lat = '';
            
            this.addressIsSelected = false;
        },
        mapMoved(ev) {
            if (!this.isCreating || this.addressIsSelected) {
                let coords = this.map.getCenter();
                this.lat = coords.lat;
                this.lng = coords.lng;

                this.mapHasMoved = true;
            }
        }

    },

    computed : {
        showIconMessage() {
            return (!this.isCreating || this.addressIsSelected);
        },
        iconMessageText() {
            return (this.isCreating) ?
                'Drag the map around for a more precise pin location.' : 
                'Drag the map around to change the location of this spot'; 
                
        }
            
        // }
    }
}
</script>

<style lang="scss">
    @import '~mapbox-gl/dist/mapbox-gl.css';
    // @import '~mapbox-gl-geocoder/dist/mapbox-gl-geocoder.css';
    @import '~@mapbox/mapbox-gl-geocoder/dist/mapbox-gl-geocoder.css';
    .map-wrapper {
        position:relative;
    }
    .map-wrapper .marker {
        position: absolute;
        left: 50%;
        margin-left: -8px;
        top: 50%;
        margin-top: -22px;
        z-index: 20;
    }
    #spot-form-geocoder .mapboxgl-ctrl-geocoder {
        width:100%;
        max-width:none;
        z-index:100;

        box-shadow:0 2px 4px 0 rgba(0,0,0,.05);
        font-family:'Nunito', 'system-ui', 'BlinkMacSystemFont', '-apple-system', 'sans-serif';
        border:1px solid rgb(186, 202, 214);
        border-radius: .5rem;
    }
     .icon-message {
        display:flex;
        align-items:center;
        margin-top:18px;
        font-size:14px;
        .icon {
            flex:0 0 auto;
            margin-right:10px;
        }
        span {
            padding-top:3px;
            font-size:13px;
        }
    }

    
</style>
