<template>
    <section
        class="modal-background"
        v-show="modalIsVisible"
    >
        <section
            class="modal-background whoa-there"
            v-show="confirmationModalIsVisible"
        >
            <div class="warning-modal">
                <h2 class="icon"></h2>
                <h1>Are you sure?</h1>
                <p>If you quit now you’ll lose your progress and need to start over. No real harm done though - we’re happy
                    to have you back any time.</p>
                <ul class="warning-controls">
                    <li><a
                            href="#"
                            @click.prevent="cancelClose"
                        >Cancel</a></li>
                    <li><a
                            href="#"
                            @click.prevent="confirmClose"
                        >Yep, I'm sure.</a></li>
                </ul>
            </div>
        </section>

        <section class="modal-container">

            <div
                class="loading-overlay"
                :class="{visible: isSubmitting}"
            >
                <span></span>
            </div>

            <section class="container-head">
                <h1 class="logo"></h1>
                <a
                    href=""
                    class="close"
                    @click.prevent="closeButtonClicked"
                ></a>
            </section>

            <section
                class="container-body submit-intro-outro"
                v-if="visibleScreen === 'success'"
            >
                <div class="modal-intro-outro">
                    <ul class="intro-outro-columns">
                        <li>
                            <span class="email-sent"></span>
                            <h1>Sweet! Your property has been submitted.</h1>
                            <p class="complete">Now just kick back and relax while our team reviews your submission. Be sure to check your email for a welcome message from us shortly - It will contain a unique link you can use to update your property info.</p>
                            <a
                                class="btn btn-special"
                                @click.prevent="closeButtonClicked"
                            >Awesome! Take me home.</a>
                        </li>
                    </ul>
                </div>
            </section>

            <submit-spot-form
                v-if="visibleScreen === 'newPropertyForm'"
                :amenities="amenities"
                v-on:success="visibleScreen = 'success'"
                v-on:submitting="isSubmitting = true"
                v-on:not-submitting="isSubmitting = false"
            ></submit-spot-form>

        </section>

        <component
            is="style"
            type="text/css"
        >
            @media screen and (max-width:559px) {
            section.modal-background {
            height:{{innerHeight}} !important;
            max-height:none !important;
            min-height:0 !important;
            margin:0 !important;
            }
            }
        </component>
    </section>
</template>

<script>
import SubmitSpotForm from "./SubmitSpotForm.vue";
Vue.component("submit-spot-form", SubmitSpotForm);

export default {
    props: ["amenities"],
    data() {
        return {
            visibleScreen: "newPropertyForm",
            isSubmitting: false,
            innerHeight: "100%"
        };
    },
    methods: {
        closeButtonClicked() {
            if (this.visibleScreen === "newPropertyForm") {
                this.$store.commit("showCancelConfirmationModal");
            } else {
                this.confirmClose();
            }
        },
        confirmClose() {
            this.visibleScreen = "newPropertyForm";
            this.$store.commit("hideCancelConfirmationModal");
            this.$store.commit("hideSubmitPropertyModal");
        },
        cancelClose() {
            this.$store.commit("hideCancelConfirmationModal");
        }
    },
    computed: {
        modalIsVisible() {
            return this.$store.state.submitPropertyModalVisible;
        },
        confirmationModalIsVisible() {
            return this.$store.state.cancelConfirmationModalVisible;
        }
    },
    watch: {
        "geocoder.result": "addressSelected"
    },
    mounted() {
        let self = this;
        self.innerHeight = window.innerHeight + "px";
        window.onresize = function() {
            self.innerHeight = window.innerHeight + "px";
        };
    }
};
</script>

<style>
.mapboxgl-ctrl-geocoder.mapboxgl-ctrl {
    width: 100%;
}
</style>

