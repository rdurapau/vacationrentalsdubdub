<template>
    <panel-item :field="field">
        <template slot="value">
            <div class="flex align-center justify-start">
                <a class="text-primary" target="_blank" :href="field.value">{{field.value}}</a>
            </div>
            <div>
                <button
                    class="bg-primary hover:bg-primary-dark text-white font-bold text-sm py-1 px-2 mt-2 rounded flex align-center justify-start"
                    @click.prevent="resendEmail()"
                    :disabled="isWorking"
                >
                    <svg v-if="isWorking" viewBox="0 0 120 30" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="text-20 mx-8 my-1 h-auto block" style="width: 32px;"><circle cx="15" cy="15" r="15"><animate attributeName="r" from="15" to="15" begin="0s" dur="0.8s" values="15;9;15" calcMode="linear" repeatCount="indefinite"></animate><animate attributeName="fill-opacity" from="1" to="1" begin="0s" dur="0.8s" values="1;.5;1" calcMode="linear" repeatCount="indefinite"></animate></circle><circle cx="60" cy="15" r="9" fill-opacity="0.3"><animate attributeName="r" from="9" to="9" begin="0s" dur="0.8s" values="9;15;9" calcMode="linear" repeatCount="indefinite"></animate><animate attributeName="fill-opacity" from="0.5" to="0.5" begin="0s" dur="0.8s" values=".5;1;.5" calcMode="linear" repeatCount="indefinite"></animate></circle><circle cx="105" cy="15" r="15"><animate attributeName="r" from="15" to="15" begin="0s" dur="0.8s" values="15;9;15" calcMode="linear" repeatCount="indefinite"></animate><animate attributeName="fill-opacity" from="1" to="1" begin="0s" dur="0.8s" values="1;.5;1" calcMode="linear" repeatCount="indefinite"></animate></circle></svg>
                    <span v-else class="flex align-center justify-start">
                        <svg class="icon-location w-4 h-auto mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <path fill="#fff" class="heroicon-ui" d="M4 4h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2zm16 3.38V6H4v1.38l8 4 8-4zm0 2.24l-7.55 3.77a1 1 0 0 1-.9 0L4 9.62V18h16V9.62z"/>
                        </svg>
                        Resend to Owner
                    </span>
                </button>
            </div>
        </template>
    </panel-item>
</template>

<script>
export default {
    props: ['resource', 'resourceName', 'resourceId', 'field'],
    data() {
        return {
            isWorking: false,
        }
    },
    methods: {
        resendEmail() {
            this.isWorking = true;
            axios.post('/api/spots/'+this.resourceId+'/edit-token/email')
                .then(result => {
                    this.isWorking = false;
                    this.$toasted.show('Edit URL email sent to owner!', { type: 'success' })
                })
                .catch(error => {
                    this.isWorking = false;
                    this.$toasted.show("Hmm... that didn't work", {type : 'error'})
                });

        }
    }
}
</script>
