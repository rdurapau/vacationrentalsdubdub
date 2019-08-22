<template>
    <section class="modal-background" v-if="modalIsVisible">

        <section class="modal-container">          

            <section class="container-head">
                <h1 class="logo"></h1>
                <a href="" class="close" @click.prevent="closeButtonClicked"></a>
            </section>

            <section class="container-body" v-if="showingTerms">

                <div class="tos">

                    <h1 v-html="content.tos.heading"></h1>

                    <div class="dynamic-body" v-html="content.tos.body"></div>

                </div>

            </section>

            <section class="container-body" v-else>
                <div class="about-us">
                    <ul class="about-us-columns">
                        <li>
                            <h1 v-html="content.about.heading"></h1>
                            <div class="dynamic-body" v-html="content.about.body"></div>

                            <img src="/images/signature.png" width="164" height="125" alt="">
                            <h3 class="name">Rick DuRapau</h3>
                            <p>Co-Founder, SweetSpot Vacation Rentals</p>
                        </li>
                        <li>
                            <span class="house"></span>
                        </li>
                    </ul>
                </div>
            </section>

        </section>

    </section>
</template>

<script>
    export default {
        props: [
            'content'
        ],
        // data() {
        //     return {
        //         showingTerms : true,
        //     }
        // },
        methods: {
            closeButtonClicked() {
                this.$store.commit('closeInformationalModal');
            },
        },
        computed: {
            modalIsVisible() {
                return this.$store.state.visibleInformationalModal;
            },
            showingTerms() {
                return (this.modalIsVisible && this.modalIsVisible === 'terms');
            }
        },
    }
</script>

<style>
    .mapboxgl-ctrl-geocoder.mapboxgl-ctrl {
        width:100%;
    }
</style>

