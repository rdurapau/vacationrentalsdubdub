<template>
    <div>
        <div class="flex w-full justify-end items-center">
           <!-- <a
                class="btn btn-success btn-icon btn-white"
                :href="'/nova-vendor/custom-resource-toolbar/export-quote/' + this.$parent.resourceId"
                style="background-color: var(--primary); color: white;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path class="heroicon-ui icon-thumb-up" d="M17.62 10H20a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H8.5c-1.2 0-2.3-.72-2.74-1.79l-3.5-7-.03-.06A3 3 0 0 1 5 9h5V4c0-1.1.9-2 2-2h1.62l4 8zM16 11.24L12.38 4H12v7H5a1 1 0 0 0-.93 1.36l3.5 7.02a1 1 0 0 0 .93.62H16v-8.76zm2 .76v8h2v-8h-2z"/></svg>
            </a>
            <a
                class="btn btn-danger btn-icon btn-white"
                :href="'/nova-vendor/custom-resource-toolbar/export-quote/' + this.$parent.resourceId"
                style="background-color: var(--primary); color: white;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path class="heroicon-ui icon-thumb-down" d="M6.38 14H4a2 2 0 0 1-2-2V4c0-1.1.9-2 2-2h11.5c1.2 0 2.3.72 2.74 1.79l3.5 7 .03.06A3 3 0 0 1 19 15h-5v5a2 2 0 0 1-2 2h-1.62l-4-8zM8 12.76L11.62 20H12v-7h7c.13 0 .25-.02.38-.08a1 1 0 0 0 .55-1.28l-3.5-7.02A1 1 0 0 0 15.5 4H8v8.76zM6 12V4H4v8h2z"/></svg>
            </a> -->
            

            <button title="Reject"
                class="btn btn-default bg-danger btn-icon btn-white mr-3"
                @click.prevent="rejectSpot"
                :disabled="isWorking"
            >
                <svg v-if="isWorking" viewBox="0 0 120 30" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="text-20 mx-0 my-1 h-auto block" style="width: 24px;"><circle cx="15" cy="15" r="15"><animate attributeName="r" from="15" to="15" begin="0s" dur="0.8s" values="15;9;15" calcMode="linear" repeatCount="indefinite"></animate><animate attributeName="fill-opacity" from="1" to="1" begin="0s" dur="0.8s" values="1;.5;1" calcMode="linear" repeatCount="indefinite"></animate></circle><circle cx="60" cy="15" r="9" fill-opacity="0.3"><animate attributeName="r" from="9" to="9" begin="0s" dur="0.8s" values="9;15;9" calcMode="linear" repeatCount="indefinite"></animate><animate attributeName="fill-opacity" from="0.5" to="0.5" begin="0s" dur="0.8s" values=".5;1;.5" calcMode="linear" repeatCount="indefinite"></animate></circle><circle cx="105" cy="15" r="15"><animate attributeName="r" from="15" to="15" begin="0s" dur="0.8s" values="15;9;15" calcMode="linear" repeatCount="indefinite"></animate><animate attributeName="fill-opacity" from="1" to="1" begin="0s" dur="0.8s" values="1;.5;1" calcMode="linear" repeatCount="indefinite"></animate></circle></svg>
                <svg v-else xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="fill-current text-white text-80">
                    <path class="heroicon-ui icon-thumb-down"
                        d="M6.38 14H4a2 2 0 0 1-2-2V4c0-1.1.9-2 2-2h11.5c1.2 0 2.3.72 2.74 1.79l3.5 7 .03.06A3 3 0 0 1 19 15h-5v5a2 2 0 0 1-2 2h-1.62l-4-8zM8 12.76L11.62 20H12v-7h7c.13 0 .25-.02.38-.08a1 1 0 0 0 .55-1.28l-3.5-7.02A1 1 0 0 0 15.5 4H8v8.76zM6 12V4H4v8h2z" />
                </svg>
            </button>

            <!-- <button
                class="bg-primary hover:bg-primary-dark text-white font-bold text-sm py-1 px-2 mt-2 rounded flex align-center justify-start"
                @click.prevent="approveSpot()"
                :disabled="isWorking"
            >
                    <svg v-if="isWorking" viewBox="0 0 120 30" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="text-20 mx-8 my-1 h-auto block" style="width: 32px;"><circle cx="15" cy="15" r="15"><animate attributeName="r" from="15" to="15" begin="0s" dur="0.8s" values="15;9;15" calcMode="linear" repeatCount="indefinite"></animate><animate attributeName="fill-opacity" from="1" to="1" begin="0s" dur="0.8s" values="1;.5;1" calcMode="linear" repeatCount="indefinite"></animate></circle><circle cx="60" cy="15" r="9" fill-opacity="0.3"><animate attributeName="r" from="9" to="9" begin="0s" dur="0.8s" values="9;15;9" calcMode="linear" repeatCount="indefinite"></animate><animate attributeName="fill-opacity" from="0.5" to="0.5" begin="0s" dur="0.8s" values=".5;1;.5" calcMode="linear" repeatCount="indefinite"></animate></circle><circle cx="105" cy="15" r="15"><animate attributeName="r" from="15" to="15" begin="0s" dur="0.8s" values="15;9;15" calcMode="linear" repeatCount="indefinite"></animate><animate attributeName="fill-opacity" from="1" to="1" begin="0s" dur="0.8s" values="1;.5;1" calcMode="linear" repeatCount="indefinite"></animate></circle></svg>
                    <span v-else class="flex align-center justify-start">
                        <svg class="icon-location w-4 h-auto mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <path fill="#fff" class="heroicon-ui" d="M4 4h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2zm16 3.38V6H4v1.38l8 4 8-4zm0 2.24l-7.55 3.77a1 1 0 0 1-.9 0L4 9.62V18h16V9.62z"/>
                        </svg>
                        Resend to Owner
                    </span>
                </button> -->

            <button title="Approve"
                class="btn btn-default bg-success btn-icon btn-white  mr-3"
                @click.prevent="approveSpot"
                :disabled="isWorking"
            >
                <svg v-if="isWorking" viewBox="0 0 120 30" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="text-20 mx-0 my-1 h-auto block" style="width: 24px;"><circle cx="15" cy="15" r="15"><animate attributeName="r" from="15" to="15" begin="0s" dur="0.8s" values="15;9;15" calcMode="linear" repeatCount="indefinite"></animate><animate attributeName="fill-opacity" from="1" to="1" begin="0s" dur="0.8s" values="1;.5;1" calcMode="linear" repeatCount="indefinite"></animate></circle><circle cx="60" cy="15" r="9" fill-opacity="0.3"><animate attributeName="r" from="9" to="9" begin="0s" dur="0.8s" values="9;15;9" calcMode="linear" repeatCount="indefinite"></animate><animate attributeName="fill-opacity" from="0.5" to="0.5" begin="0s" dur="0.8s" values=".5;1;.5" calcMode="linear" repeatCount="indefinite"></animate></circle><circle cx="105" cy="15" r="15"><animate attributeName="r" from="15" to="15" begin="0s" dur="0.8s" values="15;9;15" calcMode="linear" repeatCount="indefinite"></animate><animate attributeName="fill-opacity" from="1" to="1" begin="0s" dur="0.8s" values="1;.5;1" calcMode="linear" repeatCount="indefinite"></animate></circle></svg>
                <svg v-else xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="fill-current text-white text-80">
                    <path class="heroicon-ui icon-thumb-up" d="M17.62 10H20a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H8.5c-1.2 0-2.3-.72-2.74-1.79l-3.5-7-.03-.06A3 3 0 0 1 5 9h5V4c0-1.1.9-2 2-2h1.62l4 8zM16 11.24L12.38 4H12v7H5a1 1 0 0 0-.93 1.36l3.5 7.02a1 1 0 0 0 .93.62H16v-8.76zm2 .76v8h2v-8h-2z"/>
                </svg>
            </button>
        </div>
    </div>
</template> 

<script>
    export default {
        props: ['resourceId'],
        data() {
            return {
                isWorking : false
            }
        },
        mounted() {
            var elements = document.getElementById('nova').querySelectorAll('h4');
            [].forEach.call(elements, function(element) {
                if(element.innerHTML === 'Custom Detail Toolbar') {
                    element.parentNode.remove();
                }
            });
        },
        methods: {
            approveSpot() {
                this.submitRequest('approved');
            },
            rejectSpot() {
                this.submitRequest('rejected');
            },
            submitRequest(status, message) {
                this.isWorking = true;
                return Nova.request().put(
                    '/api/spots/'+this.resourceId+'/moderate',
                    {
                        'status' : status,
                        'message' : message
                    }
                ).then(response => {
                    this.$toasted.show('Submission was '+status, { type: 'success' });
                    this.$router.push('/resources/submissions');
                    
                }).catch(error => {
                    this.isWorking = false;
                });
            }
        }
    }
</script>