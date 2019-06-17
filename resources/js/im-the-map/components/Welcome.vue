<template>
    <section class="welcome-background" v-show="visible">

        <section class="welcome-container">

            <section class="logo"></section>
            <div class="welcome-home"></div>

            <h1>True vacation rentals for the perfect getaway.</h1>

            <p>Find <strong>a place to go</strong>, not just to stay. That’s what you'll find here at SweetSpot — true vacation rentals and direct communication with the owners. We aim to provide a great experience online so you can get to your great experiences <em>out there</em>. No fuss.</p>

            <a class="btn btn-special" href="#" @click.prevent="close">Sweet! Let’s get started.</a>

            <br>
            <br>
            <br>
            <br>
            <br>

        </section>

    </section>
</template>

<script>
    export default {
        data() {
            return {
                visible : true
            }
        },
        methods: {
            close() {
                this.visible = false;
            },
        },
    }
</script>

