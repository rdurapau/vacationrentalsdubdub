<template>
    <div class="new-spot-done">
        <h1 class="text-center mt-4">
            Your submission is in review!
        </h1>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <p class="text-center">
                    We are currently reviewing your submission. We will drop you an email when we publish your spot!
                </p>
                <div
                    class="btn btn-primary btn-block mt-4"
                    @click="onClickEditSpot"
                >
                    Edit Your Spot
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        spot: Object
    },

    methods: {
        onClickEditSpot() {
            this.$router.push(`/spot/${this.spot.id}`);
        }
    }
};
</script>

<style lang="scss">
.new-spot-done {
    position: relative;
    top: 50%;
    transform: translateY(-50%);
}
</style>
