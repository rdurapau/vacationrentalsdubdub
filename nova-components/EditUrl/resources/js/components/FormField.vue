<template>
    <default-field :field="field" :errors="errors" :fullWidthContent="true">
        <template slot="field">
            <div class="flex align-center justify-start">
                <a class="text-primary" target="_blank" :href="field.value">{{field.value}}</a>
            </div>
            <div>
                <button class="bg-primary hover:bg-primary-dark text-white font-bold text-sm py-1 px-2 mt-2 rounded flex align-center justify-start">
                    <svg class="icon-refresh w-4 h-auto mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path fill="#fff" class="heroicon-ui" d="M5.41 16H18a2 2 0 0 0 2-2 1 1 0 0 1 2 0 4 4 0 0 1-4 4H5.41l2.3 2.3a1 1 0 0 1-1.42 1.4l-4-4a1 1 0 0 1 0-1.4l4-4a1 1 0 1 1 1.42 1.4L5.4 16zM6 8a2 2 0 0 0-2 2 1 1 0 0 1-2 0 4 4 0 0 1 4-4h12.59l-2.3-2.3a1 1 0 1 1 1.42-1.4l4 4a1 1 0 0 1 0 1.4l-4 4a1 1 0 0 1-1.42-1.4L18.6 8H6z"/>
                    </svg>
                    Generate New URL
                </button>
            </div>
        </template>
    </default-field>
</template>

    

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova'

export default {
    mixins: [FormField, HandlesValidationErrors],

    props: ['resourceName', 'resourceId', 'field'],

    methods: {
        /*
         * Set the initial, internal value for the field.
         */
        // setInitialValue() {
        //     this.value = this.field.value || ''
        // },

        // /**
        //  * Fill the given FormData object with the field's internal value.
        //  */
        // fill(formData) {
        //     formData.append(this.field.attribute, this.value || '')
        // },

        // /**
        //  * Update the field's internal value.
        //  */
        // handleChange(value) {
        //     this.value = value
        // },
    },
}
</script>
