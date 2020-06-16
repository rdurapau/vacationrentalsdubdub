<template>
    <div class="new-spot-intro">
        <h1 class="text-center mt-4">
            List Your Spot on VRWW
        </h1>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <p class="text-center">
                    Complete the this short form to list your spot on VRWW. Once we receive your application we will review your listing and publish it.
                    <br>
                    <br>
                    <strong>All We need from you</strong><br>
                    Property Location<br>
                    Propery Photos<br>
                    Short Description<br>
                </p>
                <div
                    class="btn btn-primary btn-block mt-4"
                    @click="onClickGetStarted"
                >
                    Get Started
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        getStartedClicked: Function
    },

    methods: {
        onClickGetStarted() {
            this.getStartedClicked();
        }
    }
};
</script>

<style lang="scss">
.new-spot-intro {
    position: relative;
    top: 50%;
    transform: translateY(-50%);
}
</style>
