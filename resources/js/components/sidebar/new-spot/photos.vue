<template>
    <div class="new-spot-photos">
        <h1>Photos</h1>
        <h6>Please upload 9 photos of your vacation home</h6>
        <br /><br />
        <vue-dropzone
            id="dropzone"
            :options="dropzoneOptions"
        ></vue-dropzone>

        <div
            class="btn btn-primary btn-block mt-4"
            @click="onClickPhotosSelected"
            v-if="photos.length >= 9"
        >
            Next
        </div>
        <button
            class="btn btn-primary btn-block btn-disabled mt-4"
            disabled
            v-else
        >
            Please upload {{ (9 - photos.length) }} more images
        </button>
    </div>
</template>

<script>
import vueDropzone from "vue2-dropzone";
import "vue2-dropzone/dist/vue2Dropzone.min.css";

export default {
    components: {
        vueDropzone
    },

    props: {
        onPhotosSelected: Function
    },

    data: function() {
        return {
            photos: [],
            dropzoneOptions: {
                url: "https://httpbin.org/post",
                thumbnailWidth: 100,
                // headers: { "My-Awesome-Header": "header value" },
                accept: file => {
                    this.photos.push(file);
                }
            }
        };
    },

    mounted() {},

    methods: {
        onClickPhotosSelected() {
            this.onPhotosSelected(this.photos);
        }
    }
};
</script>

<style lang="scss">
.new-spot-photos {
    padding: 15px;

    .vue-dropzone {
        padding: 0px !important;
        .dz-preview {
            .dz-image img {
                width: 100px !important;
                height: 100px !important;
            }
            .dz-progress {
                display: none;
            }
            .dz-details {
                background-color: #467fcf !important;
                .dz-size {
                    display: none !important;
                }
                .dz-filename {
                    font-size: 16px !important;
                }
            }
        }
    }
}
</style>
