<template>
    <footer>
        <ul class="navigation">
            <li><a
                    href="#"
                    @click.prevent="showTermsModal"
                >Terms of Services</a></li>
            <li>&copy; VRWW</li>
        </ul>
    </footer>
</template>

<script>
export default {
    methods: {
        showTermsModal() {
            this.$store.commit("showInformationalModal", "terms");
        }
    }
};
</script>

