<template>
    <default-field :field="field" :errors="errors">
        <template slot="field">
            <div id="map" style="height:200px"></div>
        </template>
    </default-field>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova'
let mapboxgl = require('mapbox-gl');

console.log(process.env)

mapboxgl.accessToken = process.env.MIX_MAPBOX_APP_KEY;

export default {
    mixins: [FormField, HandlesValidationErrors],

    props: ['resourceName', 'resourceId', 'field'],

    mounted() {
        mapboxgl.accessToken = this.field.mapboxKey
        this.map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/light-v10',
            center: [-98.5833, 39.833333],
            zoom: 2
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
            formData.append(this.field.attribute, this.value || '')
        },

        /**
         * Update the field's internal value.
         */
        handleChange(value) {
            this.value = value
        },
    },
}
</script>
