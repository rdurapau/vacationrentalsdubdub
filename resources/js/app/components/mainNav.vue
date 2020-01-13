<template>
    <div class="vrww-mainnav">
        <img
            src="/images/icons_v2/logo.webp"
            class="logo"
            alt="logo"
        />

        <ul class="nav">
            <li @click="onClickShowAboutModal">
                <a>ABOUT</a>
            </li>
            <li @click="onClickContact">
                <a>CONTACT</a>
            </li>
            <li @click="showSignUpModal">
                <a>OWNER SIGN UP</a>
            </li>
            <li>
                <a href="/login">OWNER SIGN IN</a>
            </li>
        </ul>
    </div>
</template>

<script>
import signUpModal from "./../modals/signUp.vue";
import about from "./../modals/about.vue";

export default {
    data: () => ({}),

    mounted() {},

    computed: {},

    methods: {
        onClickContact() {
            this.$store.commit("setSidebar", "contact");
        },
        showSignUpModal() {
            this.$modal.show(
                signUpModal,
                {},
                {
                    width: "80%",
                    height: "80%"
                }
            );
        },
        onClickShowAboutModal() {
            this.$modal.show(
                about,
                {},
                {
                    width: "80%",
                    height: "80%"
                }
            );
        }
    }
};
</script>

<style lang="sass">
.vrww-mainnav 
    height: 60px

    .logo
        height: 80%
        margin-left: 20px
        margin-top: 5px
        float: left
        cursor: pointer


    ul.nav
        width: 80%
        height: 100%
        text-align: right
        display: block
        float: right

        li
            font: normal normal 700 16px/1.4em montserrat, sans-serif
            padding: 18px 35px 0
            text-decoration: none
            text-transform: uppercase
            color: #414141
            display: inline-block
            
            a
                color: #414141
                cursor: pointer

</style>
