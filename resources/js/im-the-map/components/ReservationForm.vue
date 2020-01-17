<template>
    <section class="reservation-form">
        <transition name="fade">
            <div v-if="isSubmitting" class="loading-overlay"><span></span></div>
        </transition>
        <transition name="fade">
            <section class="success-message" v-if="showSuccessMessage">
                <div class="messages"></div>
                <h1>Reservation request sent!</h1>
                <p>Your request has been sent directly to the property owner.<br />You should hear from them shortly!</p>
                <a class="btn btn-special" href="#" @click.prevent="closeDetails">Sweet! Take me home.</a>
            </section>
        </transition>

        <h2>Make a reservation</h2>
        <button class="back-btn" @click.prevent="goBack">
            <svg width="52" height="52" viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="26" cy="25.6274" r="17" transform="rotate(45 26 25.6274)" fill="white" stroke="#cccccc" stroke-width="2"/>
                <path d="M34.25 26.004H18.5" stroke="#cccccc" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M22.25 29.754L18.5 26.004L22.25 22.254" stroke="#cccccc" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>

        <div class="spot-deets">
            <div class="img" :style="'background-image:url('+spot.photo+')'"></div>
            <div class="text">
                <div>
                    <small v-text="'$' + spot.price + ' per night'"></small>
                    <h2 v-text="spot.name"></h2>
                    <ul>
                        <li v-for="deet in spotDeets" v-text="deet"></li>
                    </ul>
                </div>
            </div>
        </div>

        <p class="reservation-disclaimer">Once you submit this form, you will be in direct communication with the property owner. All follow-up communication will be handled through your personal email with the property owner.</p>

        <form class="sweetspot-form">
                   
                <section class="fieldset form-row">

                    <section class="fieldset required single-field"
                        :class="{'has-error': errors.has('name')}">
                        <input type="text" id="full-name" name="name" v-model="name" :disabled="isSubmitting"
                            :class="{'filled': (name.length || name > 0), 'ouch': errors.has('name')}"
                            
                            v-validate="'required|max:100'" data-vv-as="Full Name" />
                        <label for="full-name">Your Full Name</label>
                        <span class="errors"
                            v-if="errors.has('name')">{{ errors.first('name') }}</span>
                    </section>

                    <section class="fieldset single-field"
                        :class="{'has-error': errors.has('phone')}">
                        <input type="phone" name="phone" id="phone-number" v-model="phone" :disabled="isSubmitting"
                            :class="{'filled': (phone.length || phone > 0), 'ouch': errors.has('phone')}"
                            v-validate="'required'" data-vv-as="Phone"  />
                        <label for="phone-number">Phone Number</label>
                        <span class="errors"
                            v-if="errors.has('phone')">{{ errors.first('phone') }}</span>
                    </section>

                </section>

                <section class="fieldset form-row">

                    <section class="fieldset single-field"
                        :class="{'has-error': errors.has('email')}">
                        <input type="text" id="email-address" name="email" v-model="email" :disabled="isSubmitting"
                            :class="{'filled': (email.length || email > 0), 'ouch': errors.has('email')}"
                            v-validate="'required|email'" data-vv-as="Email"  />
                        <label for="email-address">Email Address</label>
                        <span class="errors"
                            v-if="errors.has('email')">{{ errors.first('email') }}</span>
                    </section>

                    <section class="fieldset single-field"
                        :class="{'has-error': errors.has('email_confirmation')}">
                        <input type="text" id="confirm-email" name="email_confirmation" :disabled="isSubmitting"
                            v-model="email_confirmation"
                            :class="{'filled': (email_confirmation.length || email_confirmation > 0), 'ouch': errors.has('email_confirmation')}"
                            v-validate="{ is: email, required: true }"
                            data-vv-as="Email Confirmation" />
                        <label for="confirm-email">Confirm Email</label>
                        <span class="errors"
                            v-if="errors.has('email_confirmation')">{{ errors.first('email_confirmation') }}</span>
                    </section>

                </section>

                <section class="fieldset form-row">

                    <section class="fieldset single-field has-prefix"
                        :class="{'filled': dates.length,'has-error': errors.has('dates')}">
                        <!-- <input type="text" id="dates" name="dates" v-model="dates" :disabled="isSubmitting"
                            :class="{'filled': (dates.length || dates > 0), 'ouch': errors.has('dates')}"
                            /> -->
                        <span class="prefix calendar"></span>
                        <flat-pickr
                            v-model="dates"
                            id="dates"
                            name="dates"
                            :config="flatPickrConfig"
                            v-validate="'required'"
                            ref="dates-field"
                        />
                        <label for="dates" @click="focusDatesField">Trip Dates</label>
                        <span class="errors"
                            v-if="errors.has('dates')">{{ errors.first('dates') }}</span>
                    </section>

                </section>
                
                <div class="check-group rounded">
                    <input type="checkbox" name="terms_agree" id="terms_agree" v-model="terms_agree" />
                    <label for="terms_agree">I have read and agree to the <a href="#" @click.prevent="showTerms">SweetSpot terms of service</a></label>
                </div>

                <div class="row action-row">
                    <button class="btn secondary" @click.prevent="goBack" type="button">Cancel</button>

                    <button class="btn" id="new-property-submit" name="new-property-submit" @click.prevent="submitForm">Send Request</button>
                </div>
        </form>
    </section>
</template>

<script>
    import { Validator } from 'vee-validate';
    import flatPickr from 'vue-flatpickr-component';

    export default {
        props: [
            'spot'
        ],
        components: {
            flatPickr
        },
        data() {
            return {
                'name' : '',
                'phone' : '',
                'email' : '',
                'email_confirmation' : '',
                'dates' : '',
                'terms_agree' : false,

                'isSubmitting' : false,
                'showSuccessMessage' : false,

                'flatPickrConfig': {
                    enableTime: false,
                    // altInput: true,
                    dateFormat: "M j, Y",
                    // dateFormat: "Y-m-d",
                    // altFormat: "M j, Y",
                    minDate: 'today',
                    mode: 'range',
                    position: 'bottom center',
                },
            }
        },
        computed: {
            spotDeets() {
                return [
                    'Sleeps ' + this.spot.sleeps,
                    this.spot.beds + ' Bed' + (this.spot.beds !== 1 ? 's' : ''),
                    this.spot.baths + ' Bath' + (this.spot.baths !== 1 ? 's' : '')
                ]
            },
            checkoutDateConfig() {
                let obj = Object.assign({},this.flatPickrConfig);
                obj.minDate = this.dates
            },
            formattedDate() {
                return this.dates.replace(" to ", " - ");
            },
            showTerms() {
                this.$store.commit('showInformationalModal', 'terms');
            }
        },
        methods: {
            goBack() {
                this.$emit('close');
            },
            closeDetails() {
                this.$emit('close-details')
            },
            focusDatesField(ev) {
                this.$refs['dates-field'].fp.open()
            },
            submitForm(event) {
                this.$validator.validateAll().then(() => {
                    if (!this.errors.items.length) {
                        this.sendRequest();
                    }
                });
            },
            sendRequest() {
                this.isSubmitting = true;
                // this.$emit('submitting');
                let fields = [
                    'name',
                    'phone',
                    'email',
                    'email_confirmation',
                    'terms_agree',
                ];
                let self = this;
                let formData = {}
                fields.forEach((field) => {
                    formData[field] = self[field];
                });
                formData.dates = this.formattedDate;
                
                axios.post('/api/spots/'+this.spot.id+'/requests', formData)
                    .then(response => {
                        this.showSuccessMessage = true;
                        this.isSubmitting = false;
                        // this.$emit('not-submitting');
                        // this.$emit('success');
                    })
                    .catch(err => {
                        this.$setLaravelValidationErrorsFromResponse(err.response.data)
                        this.isSubmitting = false;
                        // this.$emit('not-submitting');
                    });
            }
        },
        watch: {

        },
        mounted() {

        }
    }
</script>

