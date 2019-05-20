<template>
    <footer>
        <button class="submit" @click.prevent="showSubmitPropertyModal">Submit Your Property</button>
        <ul class="navigation">
            <li><a href="#" @click.prevent="showAboutModal">About Us</a></li>
            <li><a href="#" @click.prevent="showTermsModal">Terms of Services</a></li>
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
            showTermsModal() {
                console.log('terms')
                this.$store.commit('showInformationalModal', 'terms');
            },
            showAboutModal(which) {
                console.log('about')
                this.$store.commit('showInformationalModal', 'about');
            }
        },
        computed: {
            
        }
    }
</script>

