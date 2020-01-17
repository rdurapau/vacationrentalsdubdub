<template>
    <card class="flex flex-col items-center justify-center relative">
        <div v-if="isLoaded" class="px-3 py-3 text-center">
            <h3 class="text-base text-80 font-bold mb-4">Pending Submissions</h3>
            <p class="text-center text-4xl">{{count}}</p>
            <router-link v-if="showButton" exact tag="button" class="bg-primary text-white text-xs font-bold py-1 px-4 rounded mx-auto mt-3" :to="{
                name: 'index',
                params: {
                    resourceName: 'submissions'
                }
            }">
                View
            </router-link>
        </div>
        <div v-else class="rounded-lg flex items-center justify-center absolute pin z-50 bg-white"><svg viewBox="0 0 120 30" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="text-60 mx-auto block" style="width: 50px;"><circle cx="15" cy="15" r="15"><animate attributeName="r" from="15" to="15" begin="0s" dur="0.8s" values="15;9;15" calcMode="linear" repeatCount="indefinite"></animate><animate attributeName="fill-opacity" from="1" to="1" begin="0s" dur="0.8s" values="1;.5;1" calcMode="linear" repeatCount="indefinite"></animate></circle><circle cx="60" cy="15" r="9" fill-opacity="0.3"><animate attributeName="r" from="9" to="9" begin="0s" dur="0.8s" values="9;15;9" calcMode="linear" repeatCount="indefinite"></animate><animate attributeName="fill-opacity" from="0.5" to="0.5" begin="0s" dur="0.8s" values=".5;1;.5" calcMode="linear" repeatCount="indefinite"></animate></circle><circle cx="105" cy="15" r="15"><animate attributeName="r" from="15" to="15" begin="0s" dur="0.8s" values="15;9;15" calcMode="linear" repeatCount="indefinite"></animate><animate attributeName="fill-opacity" from="1" to="1" begin="0s" dur="0.8s" values="1;.5;1" calcMode="linear" repeatCount="indefinite"></animate></circle></svg></div>
    </card>

    <!-- Recreating metric card -->
    <!-- <card class="flex flex-col items-start justify-start px-6 py-4">
        <div class="flex mb-4">
            <h3 class="mr-3 text-base text-80 font-bold">Pending Submissions</h3>
        </div>
        <p class="flex items-center text-4xl mb-4">
            51
        </p>
        <div class="flex items-center">
            <p class="text-80 font-bold"><span></span></p>
        </div>
    </card>-->
</template>

<script>
export default {
    props: [
        'card',

        // The following props are only available on resource detail cards...
        // 'resource',
        // 'resourceId',
        // 'resourceName',
    ],

    computed: {
        showButton() {
            return (this.count && this.card.showButton);
        }
    },

    data() {
        return {
            count: 0,
            isLoaded: false
        }
    },

    mounted() {
        console.log(this.card.showButton);
        axios.get('/nova-vendor/pending-submissions/count')
            .then((result) => {
                this.count = result.data
                this.isLoaded = true;
            })
            .catch((error) => console.log(error));
    },
}
</script>
