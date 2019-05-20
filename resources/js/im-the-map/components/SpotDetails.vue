<template>
    <section class="spot-slideout" v-if="spotDetailsVisible">
        <transition name="fade">
            <div v-if="isLoading" @click.prevent="isLoading = false" class="loading-overlay"><span></span></div>
        </transition>

        <reservation-form v-if="reservationFormVisible && spot" :spot="spot"
            v-on:close="hideReservationForm"
            v-on:close-details="close"
            />

        <section class="spot-details" v-else>
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
                <article>
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

                    <h3 v-if="amenities && amenities.length">Amenities</h3>
                    <ul class="amenities" v-if="amenities && amenities.length">
                        <li v-for="amenity in amenities" :class="amenity.icon">
                            <div class="icon"><img :src="'/images/icons/amenities/'+amenity.icon+'.svg'" /></div>
                            <span v-text="amenity.name"></span>
                        </li>
                    </ul>
                </article>
                <aside>
                    <h5><span>$</span><strong>{{spot.price}}</strong> per night</h5>
                    <button class="btn btn-wide btn-purple btn-reservation" @click.prevent="showReservationForm">Make a reservation</button>
                    <ul class="contact">
                        <li class="phone" v-if="spot.phone">
                            <a :href="'tel:'+spot.phone" v-text="spot.phone"></a>
                        </li>
                        <li class="link" v-if="spot.website">
                            <a :href="spot.website" target="_blank">Visit Property Website</a>
                        </li>
                    </ul>
                </aside>
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

