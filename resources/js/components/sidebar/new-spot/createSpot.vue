<template>
    <section class="spot-slideout">
        <section class="spot-details">
            <!-- <section class="spot-images">
                <div
                    class="image"
                    v-for="(photo, i) in photos.slice(0, 9)"
                    :key="i"
                    :style="{'background': `url('${createObjectURL(photo)}') no-repeat center center`}"
                />
            </section> -->

            <div class="spot">

                <!-- <button
                    type="button"
                    class="btn mb-2 btn-primary"
                    @click="$router.push(`/spot/${spot.id}`)"
                >Preview Spot</button>

                <button
                    type="button"
                    class="btn mb-2 btn-primary"
                >Change Address</button> -->

                <div class="form-group mt-2">
                    <label for="spot-name">Spot Name</label>
                    <input
                        type="text"
                        class="form-control"
                        id="spot-name"
                        placeholder="Spot Name"
                        v-model="spot.name"
                    >
                </div>

                <div class="form-group">
                    <label for="Description">Description</label>
                    <textarea
                        class="form-control"
                        id="Description"
                        rows="5"
                        v-model="spot.desc"
                    ></textarea>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group mb-0">
                            <label for="Sleeps">Sleeps</label>
                            <input
                                type="number"
                                class="form-control"
                                id="Sleeps"
                                placeholder="Sleeps"
                                v-model="spot.sleeps"
                            >
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-0">
                            <label for="Beds">Beds</label>
                            <input
                                type="number"
                                class="form-control"
                                id="Beds"
                                placeholder="Beds"
                                v-model="spot.beds"
                            >
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-0">
                            <label for="Bathrooms">Bathrooms</label>
                            <input
                                type="number"
                                class="form-control"
                                id="Bathrooms"
                                placeholder="Bathrooms"
                                v-model="spot.baths"
                            >
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-0">
                            <label for="sqft">SQFT</label>
                            <input
                                type="number"
                                class="form-control"
                                id="sqft"
                                placeholder="1000 sqft"
                                v-model="spot.sqft"
                            >
                        </div>
                    </div>
                </div>

                <hr>
                <div class="form-group">
                    <label for="Website">Website</label>
                    <input
                        type="text"
                        class="form-control"
                        id="Website"
                        placeholder="Website"
                        v-model="spot.website"
                    >
                </div>
                <div class="form-group">
                    <label for="Phone">Phone</label>
                    <input
                        type="text"
                        class="form-control"
                        id="Phone"
                        placeholder="Phone"
                        v-model="spot.phone"
                    >
                </div>
                <div class="form-group">
                    <label for="Email">Email</label>
                    <input
                        type="text"
                        class="form-control"
                        id="Email"
                        placeholder="Email"
                        v-model="spot.email"
                    >
                </div>

                <button
                    type="button"
                    class="btn mb-2 btn-primary btn-block"
                    @click="onClickUpdate"
                >Create Spot</button>
            </div>

        </section>
    </section>
</template>

<script>
export default {
    props: {
        onSubmit: Function,
        spot: Object
    },

    data: () => ({
        photos: []
    }),

    mounted() {
        this.photos = this.spot.photos;
    },

    methods: {
        createObjectURL(file) {
            return URL.createObjectURL(file);
        },
        onClickUpdate() {
            this.onSubmit(this.spot);
        }
    }
};
</script>

<style lang="scss" scoped>
.spot {
    padding: 10px;
    overflow-y: scroll;
    height: 100%;
}
</style>
