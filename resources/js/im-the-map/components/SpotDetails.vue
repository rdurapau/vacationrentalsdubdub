<template>
    <section class="spot-slideout" :class="{'visible-mob': spotDetailsVisible}">
        <transition name="fade">
            <div v-if="isLoading" @click.prevent="isLoading = false" class="loading-overlay"><span></span></div>
        </transition>

        <reservation-form v-if="reservationFormVisible && spot" :spot="spot"
            v-on:close="hideReservationForm"
            v-on:close-details="close"
            />

        <section class="spot-details" v-else-if="spotDetailsVisible && spot">
            <section class="hero">
                <button class="close" @click.prevent="close"><span class="icon-clear-css"></span></button>
                <div class="controls">
                    <a href="#" class="left" @click.prevent="prevPhoto"></a>
                    <a href="#" class="right" @click.prevent="nextPhoto"></a>
                    <nav>
                        <a href="#" 
                            v-for="(photo, index) in photos"
                            @click.prevent="goToPhoto(index)"
                            :class="{current: currentPhotoIndex == index}"
                            v-text="index + 1"
                        >
                        </a>
                    </nav>
                </div>
                <div class="photos" v-if="photos && photos.length">
                    <!-- <span v-for="photo in photos" :style="'background-image:url('+photo+')'"></span> -->
                    <span :style="'background-image:url('+photos[currentPhotoIndex]+')'"></span>
                </div>
            </section>
            <section class="content">
                <aside>
                    <div class="cost-row">
                        <h5><span>$</span><strong>{{spot.price}}</strong> per night</h5>
                        <button class="btn btn-wide btn-purple btn-reservation" @click.prevent="showReservationForm">Make a reservation</button>
                    </div>
                    <ul class="contact">
                        <li class="phone" v-if="spot.phone">
                            <a :href="'tel:'+spot.phone" v-text="spot.phone"></a>
                        </li>
                        <li class="link" v-if="spot.website">
                            <a :href="spot.website" target="_blank">Visit Property Website</a>
                        </li>
                    </ul>
                </aside>
                <article class="extra-padding">
                    <h2 v-text="spot.name"></h2>
                    <section class="icon-deets">
                        <div v-if="spot.sleeps">
                            <img src="/images/icons/person-circle.svg" />
                            <span>Sleeps {{spot.sleeps}}</span>
                        </div>
                        <div v-if="spot.sleeps">
                            <img src="/images/icons/bed.svg" />
                            <span>{{spot.beds}} beds</span>
                        </div>
                        <div v-if="spot.baths">
                            <img src="/images/icons/shower.svg" />
                            <span>{{spot.baths}} baths</span>
                        </div>
                    </section>

                    <div class="spot-description" v-html="spot.desc"></div>

                    <h3 v-if="amenities && amenities.length">Featured Amenities</h3>
                    <ul class="amenities" v-if="featuredAmenities && featuredAmenities.length">
                        <li v-for="amenity in featuredAmenities" :class="amenity.icon">
                            <div class="icon"><img :src="'/images/icons/amenities/'+amenity.icon+'.svg'" /></div>
                            <span v-text="amenity.name"></span>
                        </li>
                    </ul>

                    <div v-for="(group, title) in groupedAmenities" class="amenity-group">
                        <h4 v-text="title"></h4>
                        <ul class="amenities">
                            <li v-for="amenity in group">
                                <span v-text="amenity.name"></span>
                            </li>
                        </ul>
                    </div>
                </article>
            </section>
        </section>

        <section class="welcome-pane" v-else>
            <div class="welcome-home"></div>
            <section class="welcome-message">
                <h1>Better search. Better find.</h1>
                <ul>
                    <li>
                        <h1>Zoom. Hover. Click. Go.</h1>
                        <p>Searching has never been easier. Zoom, hover, and click. Easy, fast map-based search. No long-running lists.</p>
                    </li>
                    <li>
                        <h1>Places to go, not just to stay.</h1>
                        <p>Find yourself a True Vacation Rental - A place to go, not just to stay. Better places. Better owners. No hidden fees.</p>
                    </li>
                </ul>
            </section>
        </section>
    </section>
</template>

<script>
    let mapboxgl = require('mapbox-gl');
    import { mapState, mapGetters } from 'vuex';

    import ReservationForm from './ReservationForm.vue';
    Vue.component('reservation-form', ReservationForm);

    export default {
        data() {
            return {
                currentPhotoIndex: 0,
                reservationFormVisible: false
            }
        },
        methods: {
            close() {
                this.$store.commit('closeSpotDetails');
            },

            nextPhoto() {
                if ((this.currentPhotoIndex + 1) == this.photos.length) {
                    this.currentPhotoIndex = 0;
                } else {
                    this.currentPhotoIndex++;
                }
            },
            prevPhoto() {
                if (this.currentPhotoIndex == 0){
                    this.currentPhotoIndex = (this.photos.length - 1);
                } else {
                    this.currentPhotoIndex--;
                }
            },
            goToPhoto(index) {
                this.currentPhotoIndex = index;
            },
            resetNewSpot() {
                this.currentPhotoIndex = 0;
            },

            showReservationForm() {
                this.reservationFormVisible = true;
            },
            hideReservationForm() {
                this.reservationFormVisible = false;
            }
            // afterCardEnter() {
            //     this.$mapBus.$emit('detailsCardShown');
            // },
            // afterCardExit() {
            //     this.$mapBus.$emit('detailsCardHidden');
            // },
        },
        computed: {
            // isMobileSafari() {
            //     // return navigator.userAgent.match(/iOS/i) !== null;
            //     return /iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
            // },
            spotDetailsVisible() {
                return this.$store.state.spotDetailsVisible;
            },
            spot() {
                return this.$store.state.activeSpot;
            },
            amenities() {
                if (this.spot && this.spot.hasOwnProperty('amenities')) {
                    return this.spot.amenities;   
                }
            },
            featuredAmenities() {
                if (this.amenities) {
                    return this.amenities.filter(a => a.is_featured);
                }
                // return this.amenities.reduce((objectsByKeyValue, obj) => {
                //     const value = obj['is_featured'];
                //     objectsByKeyValue[value] = (objectsByKeyValue[value] || []).concat(obj);
                //     return objectsByKeyValue;
                // }, {});
            },
            groupedAmenities() {
                if (this.amenities) {
                    let nonfeatured = this.amenities.filter(a => !a.is_featured);
                    return nonfeatured.reduce((objectsByKeyValue, obj) => {
                        const value = obj['type'];
                        objectsByKeyValue[value] = (objectsByKeyValue[value] || []).concat(obj);
                        return objectsByKeyValue;
                    }, {});
                }
            },
            photos() {
                if (this.spot && this.spot.hasOwnProperty('photos')) {
                    return this.spot.photos;   
                }
            },
            photo() {
                if (this.spot && this.spot.hasOwnProperty('photo')) {
                    return this.spot.photo;   
                }
            },
            isLoading() {
                return this.$store.state.detailsLoading;
            },
            ...mapState([
                
            ]),
            ...mapGetters([
                
            ])  
        },
        watch: {
            spotDetailsVisible: function () {
                this.$nextTick(function () {
                    this.$mapBus.$emit('detailsCardToggled');
                });
            },
            spot: 'resetNewSpot'
        },
        mounted() {
            // this.$store.commit('triggerNewActiveSpot',55);
            // let self = this;
            // setInterval(function(){
            //     self.isOut = !self.isOut;
            // },3000);
            let self = this;
            document.addEventListener('keyup', function (evt) {
                switch(evt.keyCode) {
                    case 27:
                        self.close();
                        break;
                    case 39:
                        self.nextPhoto();
                        break;
                    case 37:
                        self.prevPhoto();
                        break;
                }
            });
        }
    }
</script>

