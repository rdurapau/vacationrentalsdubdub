<template>
    <fieldset class="section-wrap">

        <section class="sub-section-row">

            <div class="sub-column">

            </div>

            <div class="sub-column">
                <h1>Property Photos</h1>
            </div>


        </section>

        <section class="sub-section-row">

            <div class="section-description sub-column">
                <section class="description-detail">
                    <h2>Main Photo</h2>
                    <p>The main photo will be the photo shown on the SweetSpot map, and the first photo visitors see when they view your spot. Make it a good one! <small>(This is required)</small></p>
                </section>
            </div>

            <div class="sub-column main-photo-wrap photo-wrap">
                <dropzone
                    ref="mainDropzone"
                    id="main-photo-upload"
                    :options="mainDropOptions"
                    :useCustomSlot="true"
                    v-on:vdropzone-thumbnail="thumbnail"
                    v-on:vdropzone-success="mainUploadSuccess"
                    v-on:vdropzone-removed-file="fileRemoved"
                    class="spot-photos-upload single-image"
                    >
                    
                        <div class="dropzone-custom-content">
                            <button class="btn btn-upload-photos">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.75 1.5C0.75 1.08579 1.08579 0.75 1.5 0.75H15C15.4142 0.75 15.75 1.08579 15.75 1.5V16.5C15.75 16.9142 15.4142 17.25 15 17.25H1.5C1.08579 17.25 0.75 16.9142 0.75 16.5V1.5Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M15.75 12.75H0.75" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M18.7549 6.23096L22.7369 7.55796C22.9256 7.62093 23.0816 7.75629 23.1705 7.93427C23.2594 8.11225 23.2739 8.31826 23.2109 8.50696L18.4679 22.737C18.4049 22.9257 18.2695 23.0816 18.0916 23.1705C17.9136 23.2594 17.7076 23.274 17.5189 23.211L6.75488 19.623" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M5.25 12.75L9.4 6.81802C9.66417 6.43952 10.0879 6.20372 10.5488 6.17872C11.0097 6.15372 11.4564 6.34231 11.76 6.69002L15.75 11.25" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5.063 6.751C5.99526 6.751 6.751 5.99526 6.751 5.063C6.751 4.13074 5.99526 3.375 5.063 3.375C4.13074 3.375 3.375 4.13074 3.375 5.063C3.375 5.99526 4.13074 6.751 5.063 6.751Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>

                                <span>Upload main photo</span>
                            </button>
                            <p>or just drag it in</p>
                        </div>
                </dropzone>
            </div>

        </section>

        <section class="sub-section-row">

            <div class="section-description sub-column">
                <section class="description-detail">
                    <h2>Property Photos</h2>
                    <p>A handful of pictures can say a lot, right? This is your chance to show your spot off to the world. You can upload up to 20 photos, so don’t be shy. <small>(These are optional)</small></p>
                </section>
            </div>

            <div class="sub-column secondary-photos-wrap photo-wrap">
                <dropzone
                    ref="secondaryDropzone"
                    id="other-photos-upload"
                    :options="secondaryDropOptions"
                    :useCustomSlot="true"
                    v-on:vdropzone-thumbnail="thumbnail"
                    v-on:vdropzone-success="secondaryUploadSuccess"
                    v-on:vdropzone-removed-file="fileRemoved"
                    class="spot-photos-upload"
                    >
                        <div class="dropzone-custom-content">
                            <button class="btn btn-upload-photos btn-blue">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.75 1.5C0.75 1.08579 1.08579 0.75 1.5 0.75H15C15.4142 0.75 15.75 1.08579 15.75 1.5V16.5C15.75 16.9142 15.4142 17.25 15 17.25H1.5C1.08579 17.25 0.75 16.9142 0.75 16.5V1.5Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M15.75 12.75H0.75" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M18.7549 6.23096L22.7369 7.55796C22.9256 7.62093 23.0816 7.75629 23.1705 7.93427C23.2594 8.11225 23.2739 8.31826 23.2109 8.50696L18.4679 22.737C18.4049 22.9257 18.2695 23.0816 18.0916 23.1705C17.9136 23.2594 17.7076 23.274 17.5189 23.211L6.75488 19.623" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M5.25 12.75L9.4 6.81802C9.66417 6.43952 10.0879 6.20372 10.5488 6.17872C11.0097 6.15372 11.4564 6.34231 11.76 6.69002L15.75 11.25" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5.063 6.751C5.99526 6.751 6.751 5.99526 6.751 5.063C6.751 4.13074 5.99526 3.375 5.063 3.375C4.13074 3.375 3.375 4.13074 3.375 5.063C3.375 5.99526 4.13074 6.751 5.063 6.751Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>

                                <span>Upload photos</span>
                            </button>
                            <p>or just drag them in</p>
                        </div>
                </dropzone>
            </div>

        </section>

    </fieldset>
</template>

<script>
    import vue2Dropzone from 'vue2-dropzone';

    export default {
        components: {
            dropzone: vue2Dropzone
        },
        data() {
            return {
                // template: uploadThumbnailTemplate,

                mainDropOptions: {
                    url: '/api/temp-uploads',
                    thumbnailWidth: 600,
                    maxFilesize: 2,
                    maxFiles: 1,
                    addRemoveLinks: true,
                    dictRemoveFile: 'Remove',
                    previewTemplate: this.template()
                },
                secondaryDropOptions: {
                    url: '/api/temp-uploads',
                    thumbnailWidth: 200,
                    maxFilesize: 2,
                    addRemoveLinks: true,
                    dictRemoveFile: 'Remove',
                    previewTemplate: this.template()
                },
            }
        },
        methods: {
            template() {
                return `<div class="dz-preview dz-file-preview">
                    <div class="dz-image">
                        <div data-dz-thumbnail-bg></div>
                    </div>
                    <div class="dz-details">
                        <div class="dz-size"><span data-dz-size></span></div>
                        <div class="dz-filename"><span data-dz-name></span></div>
                    </div>
                    <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
                    <div class="dz-error-message"><span data-dz-errormessage></span></div>
                    <div class="dz-success-mark"><span></span></div>
                    <div class="dz-error-mark"><span>!</span></div>
                </div>`;
            },
            thumbnail(file, dataUrl) {
                var j, len, ref, thumbnailElement;
                if (file.previewElement) {
                    file.previewElement.classList.remove("dz-file-preview");
                    ref = file.previewElement.querySelectorAll("[data-dz-thumbnail-bg]");
                    for (j = 0, len = ref.length; j < len; j++) {
                        thumbnailElement = ref[j];
                        thumbnailElement.alt = file.name;
                        thumbnailElement.style.backgroundImage = 'url("' + dataUrl + '")';
                    }
                    return setTimeout(((function(_this) {
                        return function() {
                            return file.previewElement.classList.add("dz-image-preview");
                        };
                    })(this)), 1);
                }
            },
            mainUploadSuccess(file, response) {
                this.addUpload({
                    id : response.id,
                    filename : file.name
                }, true)
            },
            secondaryUploadSuccess(file, response) {
                this.addUpload({
                    id : response.id,
                    filename : file.name
                }, false)
            },
            fileRemoved(file) {
                console.log(file);
                this.removeUpload(file);
            },
            addUpload(path, isPrimary = false) {
                let mutation = isPrimary ? 'addUploadToTopOfList' : 'addUploadToList';
                this.$store.commit(mutation, path);
            },
            removeUpload(path) {
                this.$store.commit('removeUploadFromList', path);
            }
        },
        computed: {
            csrf() {
                return window.Laravel.csrfToken;
            },
            uploads() {
                return this.$store.state.uploads;
            }
        },
        mounted() {
            
        },
        watch: {
            
        },
    }
</script>

