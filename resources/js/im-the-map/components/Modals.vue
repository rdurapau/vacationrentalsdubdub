<template>
    <section class="modal-background" v-show="modalIsVisible">

        <section class="modal-container">          

            <div class="loading-overlay" :class="{visible: isSubmitting}">
                <span></span>
            </div>

            <section class="container-head">
                <h1 class="logo"></h1>
                <a href="" class="close" @click.prevent="closeModal"></a>
            </section>

            <section class="container-body submit-intro-outro" v-if="visibleScreen === 'intro'">
                <div class="modal-intro-outro">
                    <ul class="intro-outro-columns">
                        <li>
                            <h1>Join the SweetSpot fam</h1>
                            <p>You’re just a few steps away from listing your property for the world to find! Nunc tristique at massa sed ultrices. Nulla facilisi. Curabitur at est sit amet metus fringilla dictum a tincidunt urna.</p>
                            <a class="btn btn-special" href="#" @click.prevent="visibleScreen = 'newPropertyForm'">Sweet! Let’s get started.</a>
                        </li>
                        <li class="homestead">
                            <span class="house"></span>
                        </li>
                    </ul>
                </div>
            </section>

            <section class="container-body submit-intro-outro" v-if="visibleScreen === 'success'">
                <div class="modal-intro-outro">
                    <ul class="intro-outro-columns">
                        <li>
                            <span class="email-sent"></span>
                            <h1>Sweet! Your property has been submitted.</h1>
                            <p class="complete">Now just kick back and relax while our team reviews your submission. Be sure to check your email for a welcome message from us shortly - It will contain a unique link you can use to update your property info.</p>
                            <a class="btn btn-special" @click.prevent="closeModal">Awesome! Take me home.</a>
                        </li>
                    </ul>
                </div>
            </section>

            <submit-spot v-if="visibleScreen === 'newPropertyForm'"
                :amenities="amenities"
                v-on:success="visibleScreen = 'success'"
                v-on:submitting="isSubmitting = true"
                v-on:not-submitting="isSubmitting = false"
            ></submit-spot>

        </section>

    </section>
</template>

<script>
    import SubmitSpot from './SubmitSpot.vue';
    Vue.component('submit-spot', SubmitSpot);

    export default {
        props: ['amenities'],
        data() {
            return {
                visibleScreen : 'intro',
                isSubmitting: false
            }
        },
        methods: {
            closeModal() {
                this.visibleScreen = 'intro';
                this.$store.commit('hideSubmitPropertyModal')
            }
        },
        computed: {
            modalIsVisible() {
                return this.$store.state.submitPropertyModalVisible;
            }
        },
        mounted() {

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

