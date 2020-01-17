<template>
    <div class="mb-8">
        <div>
            <!-- <div class="card mb-6 py-3 px-6"> -->
                <div class="flex justify-end">
                    <button @click.prevent="approveSpot" class="bg-primary hover:bg-primary text-white font-bold py-2 px-4 rounded mr-4">
                        Approve Submission
                    </button>
                    <button @click.prevent="rejectSpot" class="bg-danger text-white font-bold py-2 px-4 rounded">
                        Reject Submission
                    </button>
                </div>
            <!-- </div> -->
        </div>
    </div>
</template>

<script>
export default {
    props: ['resourceName', 'resourceId', 'field'],

    methods: {
        approveSpot(){
            console.log('Approved!')
        },
        rejectSpot(){
            console.log('Rejected!')
        }
    },

    mounted() {
        
    },
}
</script>
