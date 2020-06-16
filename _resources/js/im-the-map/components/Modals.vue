<template>
    <section
        class="modal-background"
        v-if="modalIsVisible"
        v-bind:style="containerStyleObj"
    >

        <section class="modal-container">

            <section class="container-head">
                <h1 class="logo"></h1>
                <a
                    href=""
                    class="close"
                    @click.prevent="closeButtonClicked"
                ></a>
            </section>

            <section
                class="container-body"
                v-if="showingTerms"
            >

                <div class="tos">

                    <h1 v-html="content.tos.heading"></h1>

                    <div
                        class="dynamic-body"
                        v-html="content.tos.body"
                    ></div>

                </div>

            </section>

            <section
                class="container-body"
                v-else
            >
                <div class="about-us">
                    <ul class="about-us-columns">
                        <li>
                            <h1 v-html="content.about.heading"></h1>
                            <div
                                class="dynamic-body"
                                v-html="content.about.body"
                            ></div>
                        </li>
                    </ul>
                </div>
            </section>

        </section>

    </section>
</template>

<script>
export default {
    props: ["content"],
    data() {
        return {
            modalHeight: "100%"
        };
    },
    methods: {
        closeButtonClicked() {
            this.$store.commit("closeInformationalModal");
        }
    },
    computed: {
        modalIsVisible() {
            return this.$store.state.visibleInformationalModal;
        },
        showingTerms() {
            return this.modalIsVisible && this.modalIsVisible === "terms";
        },
        containerStyleObj() {
            return {
                height: this.modalHeight
            };
        }
    },
    watch: {
        "$store.state.activeSpot": "activeSpotChanged"
    },
    mounted() {
        this.modalHeight = window.innerHeight + "px";
        let self = this;
        window.onresize = function() {
            self.modalHeight = window.innerHeight + "px";
        };
    }
};
</script>

<style>
.mapboxgl-ctrl-geocoder.mapboxgl-ctrl {
    width: 100%;
}
</style>

