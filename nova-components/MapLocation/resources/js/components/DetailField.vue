<template>
    <panel-item :field="field" :fullWidthContent="true">
        <template slot="value">
            <div id="details-map" style="height:200px" class="map-wrapper">
                <svg width="16" height="26" viewBox="0 0 16 26" fill="none" xmlns="http://www.w3.org/2000/svg" class="marker">
                    <ellipse cx="8" cy="24.5" rx="5" ry="1.5" fill="black" fill-opacity="0.1"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.0244141 8C0.0293565 3.58378 3.59557 0.00495989 7.99625 0C12.3969 0.00495989 15.9631 3.58378 15.9681 8C15.9681 11.514 10.9857 20.026 8.84525 23.523C8.66536 23.8206 8.34308 24.0017 7.99625 24C7.65007 24.0001 7.32864 23.8199 7.14725 23.524C5.00681 20.025 0.0244141 11.51 0.0244141 8ZM4.50854 8C4.50854 9.933 6.07004 11.5 7.99623 11.5C9.92243 11.5 11.4839 9.933 11.4839 8C11.4839 6.067 9.92243 4.5 7.99623 4.5C6.07004 4.5 4.50854 6.067 4.50854 8Z" fill="#9080F0"/>
                </svg>
            </div>
        </template>
    </panel-item>
</template>

<script>
let mapboxgl = require('mapbox-gl');
mapboxgl.accessToken = process.env.MIX_MAPBOX_APP_KEY;

export default {
    props: ['resource', 'resourceName', 'resourceId', 'field'],
    data() {
        return {
            lat : 0,
            lng : 0
        }
    },
    mounted() {
        this.lat = parseFloat(this.field.lat);
        this.lng = parseFloat(this.field.lng);

        mapboxgl.accessToken = this.field.mapboxKey
        this.map = new mapboxgl.Map({
            container: 'details-map',
            style: 'mapbox://styles/mapbox/light-v10',
            center: [this.lng, this.lat],
            zoom: 16,
            interactive: false
        });
        this.map.addControl(new mapboxgl.NavigationControl({
            showCompass: false
        }));
    }
}
</script>

<style lang="scss">
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
    @import '~mapbox-gl/dist/mapbox-gl.css';
</style>