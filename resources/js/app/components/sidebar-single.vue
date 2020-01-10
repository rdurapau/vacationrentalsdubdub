<template>
    <div class="sidebar-single">
        <div class="row-3">
            <div
                v-for="photo in photos"
                :key="photo"
                class="spot-image"
                :style="{ backgroundImage: `url('${photo}')` }"
            ></div>
        </div>
        <div class="row-3 info">
            <h1>{{activeSpot.name}}</h1>
            <p class="desc">
                {{activeSpot.desc}}
            </p>
            <div class="row amenities">
                <div class="col-md-4">{{activeSpot.beds}} BR</div>
                <div class="col-md-4">{{activeSpot.baths}} BA</div>
                <div class="col-md-4">Sleeps {{activeSpot.sleeps}}</div>
            </div>

            <div class="row links">
                <div class="col-md-12">
                    <a :href="activeSpot.website"><i class="fas fa-home"></i> {{activeSpot.website.replace(/(^\w+:|^)\/\//, '')}}</a>
                </div>
                <div class="col-md-12">
                    <a :href="`tel:${activeSpot.phone}`"><i class="fas fa-phone"></i> {{activeSpot.phone.split('x')[0]}}</a>
                </div>
            </div>

        </div>
        <div class="row-3">
            <calendar />
        </div>
    </div>
</template>

<script>
import { mapGetters } from "vuex";
import calendar from "./calendar";

export default {
    components: { calendar },

    data: () => ({}),

    mounted() {},

    computed: {
        ...mapGetters(["activeSpot"]),

        photos() {
            return this.activeSpot.photos.slice(0, 9);
        }
    },

    methods: {}
};
</script>

<style lang="scss">
.sidebar-single {
    height: 100%;

    .row-3 {
        display: block;
        width: 100%;
        height: 33%;

        .spot-image {
            height: 33%;
            width: 33%;
            display: block;
            float: left;
            border: 3px solid #fff;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

        &.info {
            overflow: hidden;

            h1 {
                font-size: 2rem;
            }

            .desc {
                font-size: 18px;
            }

            .amenities > div {
                border-right: 1px solid #000;
                text-align: center;
                font-size: 18px;

                &:last-child {
                    border-right: none;
                }
            }

            .links a {
                color: #000;
                font-size: 18px;
                display: block;
                margin-top: 10px;
                display: block;
            }
        }
    }
}
</style>
