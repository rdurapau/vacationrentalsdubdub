<template>
    <section class="spot-details">
        <section class="hero">
            <button class="close"><span class="icon-clear-css"></span></button>
            <div class="controls">
                <a href="#" class="left"></a>
                <a href="#" class="right"></a>
                <nav>
                    <a href="#">1</a>
                    <a href="#" class="current">2</a>
                    <a href="#">3</a>
                </nav>
            </div>
            <div class="photos"> 
                <span :style="'background-image:url('+this.photos[0]+')'"></span>
            </div>
        </section>
        <section class="content">
            <article>
                <h2 v-text="spot.name">Lakefront Escape</h2>
                <section class="icon-deets">
                    <div>
                        <img src="/images/icons/person-circle.svg" />
                        <span>Sleeps {{spot.sleeps}}</span>
                    </div>
                    <div>
                        <img src="/images/icons/bed.svg" />
                        <span>{{spot.sleeps}} beds</span>
                    </div>
                    <div>
                        <img src="/images/icons/shower.svg" />
                        <span>{{spot.baths}} baths</span>
                    </div>
                </section>

                <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Sed posuere consectetur est at lobortis.</p>
                <p>Cras mattis consectetur purus sit amet fermentum. Etiam porta sem malesuada magna mollis euismod. Nullam quis risus eget urna mollis ornare vel eu leo. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>

                <h3>Amenities</h3>
                <ul class="amenities">
                    <li v-for="amenity in amenities" :class="amenity.icon">
                        <div class="icon"><img :src="'/images/icons/amenities/'+amenity.icon+'.svg'" /></div>
                        <span v-text="amenity.name"></span>
                    </li>
                </ul>
            </article>
            <aside>
                <h5><span>$</span><strong>{{spot.price}}</strong> per night</h5>
                <button class="btn btn-wide btn-purple btn-reservation">Make a reservation</button>
                <ul class="contact">
                    <li>(555) 555-5555</li>
                    <li>Visit Property Website</li>
                </ul>
            </aside>
        </section>
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
                'spot' : {},
                'photos' : [],
                'amenities' : [],
            }
        },
        methods: {
            getSpotDetails() {
                axios.get('/api/spots/1/')
                    .then((response)  => this.newSpotDetails(response.data))
                    .catch((error) => console.log(error));
            },
            newSpotDetails(newData) {
                let topLevels = {
                    amenities: 'amenities',
                    photos: 'photos'
                };
                for (var key in topLevels) {
                    if (newData.hasOwnProperty(key)) {
                        this[topLevels[key]] = newData[key];
                        // Vue.set(state, topLevels[key], initialState[key]);
                        delete newData[key];
                    } else {
                        // this[topLevels[key]] = false;
                        // state[topLevels[key]] = false;
                    }
                }
                if (newData.hasOwnProperty('photo')) {
                    this.photos.push(newData.photo);
                    delete newData.photo
                }
                this.spot = newData;
            }
        },
        computed: {
            
        },
        watch: {
            
        },
        mounted() {
            this.getSpotDetails();
        }
    }
</script>

<style>
    #map-wrapper {
        position:fixed;
        width:100vw;
        height:100vh;
    }
</style>

