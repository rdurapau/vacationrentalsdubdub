<template>
    <section class="welcome-background" v-show="visible">

        <section class="welcome-container">

            <section class="logo"></section>
            <div class="welcome-home"></div>

            <h1>True vacation rentals for the perfect getaway.</h1>

            <p>Looking for a orem ipsum dolor sit amet, consectetur adipiscing elit. Mauris luctus semper nunc a aliquam. Cras id dapibus nisi. Suspendisse tristique nec velit vitae molestie. Vivamus convallis ipsum ac porta finibus.</p>

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

