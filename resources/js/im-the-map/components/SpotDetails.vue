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
                <aside style="display: none;">
                    <div class="cost-row">
                        <h5><span>$</span><strong>{{spot.price}}</strong> per night</h5>
                        <button class="btn btn-wide btn-purple btn-reservation" @click.prevent="showReservationForm">Make a reservation`</button>
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
                        <div v-if="spot.phone">
                            <img width="20" src="/images/icons/phone.svg" />
                            <a :href="'tel:' + phone" style="display:inline-block; margin-left:5px;">{{phone}}</a>
                        </div>
                        <div v-if="spot.website" style="margin-left:10px;">
                            <img width="20" src="/images/icons/link.svg" />
                            <a :href="website" style="display:inline-block; margin-left:5px;">{{ website }}</a>
                        </div>
                    </section>

                    <div class="spot-description" v-html="spot.desc"></div>

<!--                    <aside class="content" style="margin-left: 0;">-->
<!--                        <div class="cost-row">-->
<!--                            <h5>Contact Us</h5>-->
<!--                        </div>-->
<!--                        <ul class="contact">-->
<!--                            <li class="phone" v-if="spot.phone">-->
<!--                                <a :href="'tel:' + phone" target="_blank">{{ phone }}</a>-->
<!--                            </li>-->
<!--                            <li class="link" v-if="spot.website">-->
<!--                                <a :href="website" target="_blank">Visit Property Website</a>-->
<!--                            </li>-->
<!--                        </ul>-->
<!--                    </aside>-->


                    <div style="margin-top:35px; width:100%;">
                        <v-calendar is-expanded :attributes="calendarAttrs"></v-calendar>
                    </div>


                    <div class="hidden" style="display: none;">
                        <h3 v-if="amenities && amenities.length">Featured Amenities</h3>
                        <ul class="amenities" v-if="featuredAmenities && featuredAmenities.length">
                            <li v-for="amenity in featuredAmenities" :class="amenity.icon">
                                <div class="icon"><img :src="'/images/icons/amenities/'+amenity.icon+'.svg'"/></div>
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
                    </div>
                </article>
            </section>
        </section>

        <section class="welcome-pane" v-else>
            <div class="welcome-home"></div>
            <section class="welcome-message">
                <ul>
                    <li>
                        <h1 style="font-size: 30pt; text-shadow: 3px 3px 3px #a0a0a0;">Better search:</h1>
                        <p style="font-size: 16px;">
                            Easy, fast map-based search ~ no lists.
                            <br />
                            Less clutter: <strong style="color:red; font-weight: 900;">Second Home Rentals</strong> only.
                            <br />
                            Direct link to Owners Website.
                        </p>
                    </li>
                    <li>
                        <h1 style="font-size: 30pt; text-shadow: 4px 4px 3px #a0a0a0;">Better find:</h1>
                        <p style="font-size: 16px;">
                            <strong style="color:red; font-weight: 900;">Second Home Rentals</strong> only.
                            <br />
                            Better Places ~ Better Owners
                            <br />
                            A place to GO - not just to STAY.
                        </p>
                    </li>
                </ul>
            </section>
        </section>
        <component is="style" type="text/css" scoped>
            @media not all and (min-resolution:.001dpcm)
        { @supports (-webkit-appearance:none) {
            .spot-details {
                height:{{innerHeight}} !important;
            }
        }}
        </component>
    </section>
</template>

<script>
    let mapboxgl = require('mapbox-gl');
    import { mapState, mapGetters } from 'vuex';

    import ReservationForm from './ReservationForm.vue';
    Vue.component('reservation-form', ReservationForm);

    import VCalendar from 'v-calendar';
    Vue.use(VCalendar);

    export default {
        data() {
            return {
                currentPhotoIndex: 0,
                reservationFormVisible: false,
                innerHeight: '100%',
                calendarAttrs: [
                    {
                        dot: {
                            color: 'red',
                            class: 'my-dot-class',
                        },
                        dates: [
                            new Date(2019, 10, 1), // Jan 1st
                            new Date(2019, 10, 12), // Jan 10th
                            new Date(2019, 10, 22), // Jan 22nd
                        ],
                        popover: {
                            label: '$450 Per Night'
                        }
                    },
                    {
                        dot: 'green',
                        dates: [
                            new Date(2019, 10, 4), // Jan 4th
                            new Date(2019, 10, 10), // Jan 10th
                            new Date(2019, 10, 15), // Jan 15th
                        ],
                        popover: {
                            label: '$500 Per Night'
                        }
                    },
                    {
                        dot: 'purple',
                        dates: [
                            new Date(2019, 10, 17), // Jan 12th
                            new Date(2019, 10, 26), // Jan 26th
                            new Date(2019, 10, 16), // Jan 15th
                        ],
                        popover: {
                            label: '$300 Per Night'
                        }
                    },
                ],
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
            },
            gotToOwnerWebsite() {
                alert("Hello");
            },
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
            website() {
                let w = this.spot.website;
                if (/(?!(http|https):\/\/)\w*/.test(w)) {
                    // Add a protocol to ensure that the URL doesn't get appended to the Sweetspot domain
                    return 'http://' + w;
                }
                return w;
            },
            phone() {
                var simple_phone = this.spot.phone.replace(/[\(\)\-. ]*/, '');
                if (simple_phone.length == 10)
                    return simple_phone.substr(0, 3) + '-' + simple_phone.substr(3, 3) + '-' + simple_phone.substr(6);
                return simple_phone;
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
            this.innerHeight = window.innerHeight + 'px';
            window.onresize = function() {
                self.innerHeight = window.innerHeight + 'px';
            }
        
        }
    }
</script>

