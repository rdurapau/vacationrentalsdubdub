<template>
    <section class="modal-background" v-if="modalIsVisible">

        <section class="modal-container">          

            <section class="container-head">
                <h1 class="logo"></h1>
                <a href="" class="close" @click.prevent="closeButtonClicked"></a>
            </section>

            <section class="container-body" v-if="showingTerms">

                <div class="tos">

                    <h1>SweetSpot Terms of Service</h1>

                    <h3>1.1 Stuff &amp; Things</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In a dui neque. In rhoncus consectetur urna, sed luctus quam malesuada vehicula. Vivamus at ex eu sem dictum blandit nec id mi. Morbi hendrerit odio felis, a malesuada urna lobortis id. Proin laoreet sapien eu quam aliquet mattis.</p>
                    <p>Ut ac tellus sed metus suscipit ultricies. Praesent condimentum massa sit amet justo blandit, non vulputate urna sagittis. Sed cursus nisi risus, non varius mi molestie a. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vivamus non libero ac nisi vulputate placerat. Maecenas ut erat pellentesque, iaculis lorem id, fermentum dolor. Phasellus nunc enim, commodo et vestibulum et, ultricies nec erat. Vestibulum libero arcu, euismod pulvinar arcu sed, ultricies posuere lacus. Vivamus et dui ut est feugiat facilisis.</p>
                    <p>Praesent at est elementum, euismod lorem sit amet, cursus metus. Quisque dui erat, sollicitudin eu ante eu, sollicitudin pharetra dolor. Suspendisse quis augue aliquet augue dignissim finibus id quis ipsum. Nunc ut ligula in velit facilisis lacinia non sed nisl. Ut sapien dui, iaculis at mi egestas, luctus vestibulum orci.</p>
                    <p>Mauris malesuada diam nec gravida sagittis. Cras feugiat elit vitae mi elementum, at bibendum ante vestibulum. Aliquam varius volutpat gravida. Morbi est ante, tincidunt vitae lorem sed, dictum suscipit felis. Cras suscipit efficitur quam rutrum porta. Nunc vel elit lorem.</p>

                    <h3>1.2 Things &amp; Stuff</h3>
                    <p>Pellentesque molestie ac orci ut semper. Cras semper turpis justo, a tristique nisi mattis eget. Nulla a purus a ligula feugiat dignissim. Integer quis augue purus. Cras non iaculis eros, ut mollis orci. Aenean rutrum, magna non dapibus consectetur, quam turpis posuere arcu, sed venenatis lorem libero ac risus.</p>
                    <p>Cras et urna ligula. Phasellus vel enim augue. Aenean nec rhoncus ipsum, non feugiat massa. Donec erat dolor, dapibus eu ex non, pharetra semper urna. Fusce ac ipsum ac tortor pellentesque congue. Vestibulum imperdiet dui a faucibus pellentesque. Phasellus at tellus in tortor placerat tristique et quis ipsum. Etiam venenatis faucibus felis. Vivamus tempor suscipit dui at dapibus. Vivamus quis lectus non quam laoreet finibus eu quis eros. Etiam non ligula porttitor, feugiat leo eu, consectetur risus. Suspendisse potenti. Phasellus molestie libero ante, eget luctus turpis hendrerit sed.</p>
                    <p>Curabitur dictum arcu sed faucibus sollicitudin. Etiam at odio ligula. Nullam eget euismod metus. Integer sagittis mollis purus ut feugiat. Aenean ultricies vehicula nisi ut semper. Fusce in accumsan nibh, blandit dignissim nisi. Sed feugiat mi ultrices consectetur sollicitudin. Vivamus nec facilisis dolor.</p>

                </div>

            </section>

            <section class="container-body" v-else>
                <div class="about-us">
                    <ul class="about-us-columns">
                        <li>
                            <h1>Howdy, we’re SweetSpot</h1>
                            <h2>What Makes SweetSpot different?</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris luctus semper nunc a aliquam. Cras id dapibus nisi. Suspendisse tristique nec velit vitae molestie. Vivamus convallis ipsum ac porta finibus. Sed scelerisque odio vel lacus dapibus iaculis. Donec congue imperdiet ante laoreet efficitur. Nulla ut feugiat lectus. Nullam sit amet porttitor tellus. Morbi neque enim, fringilla imperdiet velit nec, gravida viverra leo. Donec suscipit auctor dictum.</p>
                            <h2>SweetSpot is more than just another place to plan your next vacation.</h2>
                            <p>Ut et risus ut urna convallis luctus vitae quis erat. Nunc imperdiet tellus a dolor gravida, sit amet euismod magna sodales. Suspendisse maximus diam id viverra ornare. Vestibulum sed massa ut nisl congue tincidunt quis non nunc. Pellentesque non imperdiet nisl. Integer ultricies libero nec mauris mattis, porttitor egestas elit eleifend. Nunc vestibulum volutpat nisl. In sed dictum eros.</p>
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

