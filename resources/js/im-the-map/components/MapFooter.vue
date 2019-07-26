<template>
    <footer>
        <ul class="navigation">
            <li><a href="#" @click.prevent="showTermsModal">Terms of Services</a></li>
            <li>&copy; SweetSpot</li>
        </ul>
    </footer>
</template>

<script>
    export default {
        methods: {
            showTermsModal() {
                console.log('terms')
                this.$store.commit('showInformationalModal', 'terms');
            }
        }
    }
</script>

