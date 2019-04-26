<template>
    <footer>
        <button class="submit" @click.prevent="showSubmitPropertyModal">Submit Your Property</button>
        <ul class="navigation">
            <li><a href="/about">About Us</a></li>
            <li><a href="/terms">Terms of Services</a></li>
            <li>&copy; SweetSpot</li>
        </ul>
    </footer>
</template>

<script>
    export default {
        methods: {
            showSubmitPropertyModal() {
                this.$store.commit('showSubmitPropertyModal');
            },
        },
        computed: {
            
        }
    }
</script>

