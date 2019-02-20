<template>
    <div>
        <button @click.prevent="approveSpot" class="bg-primary hover:bg-primary-dark text-white font-bold py-2 px-4 rounded">
            Approve
        </button>
        <button @click.prevent="rejectSpot" class="bg-danger hover:bg-primary-dark text-white font-bold py-2 px-4 rounded">
            Reject
        </button>
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
