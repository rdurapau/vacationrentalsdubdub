<template>
    <section class="spot-slideout">
        <section class="spot-details">
            <section class="spot-images">
                <div
                    class="image"
                    v-for="(photo, i) in spot.photos.slice(0, 9)"
                    :key="i"
                    :style="{'background': `url('${photo}') no-repeat center center`}"
                />
            </section>

            <div
                class="btn btn-primary btn-block mt-4"
                @click="onClickComplete"
            >
                Submit
            </div>
        </section>
    </section>
</template>

<script>
export default {
    props: {
        onComplete: Function,
        spot: Object
    },

    data: () => ({}),

    mounted() {},

    methods: {
        onClickComplete() {
            this.onComplete(this.spot);
        }
    }
};
</script>

<style lang="scss">
.new-spot-photos {
    padding: 10px;
}
</style>
