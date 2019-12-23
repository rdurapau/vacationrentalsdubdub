<template>
  <div class="vrww-mainnav">
    <img
      src="/images/icons_v2/logo.webp"
      class="logo"
      alt="logo"
    />

    <ul class="nav">
      <li>
        <a>WHEN?</a>
      </li>
      <li>
        <a>ABOUT</a>
      </li>
      <li>
        <a @click="onClickContact">CONTACT</a>
      </li>
      <li>
        <a>OWNER SIGN UP</a>
      </li>
      <li>
        <a href="/login">OWNER SIGN IN</a>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  data: () => ({}),

  mounted() {},

  computed: {},

  methods: {
    onClickContact() {
      this.$store.commit("setSidebar", "contact");
    }
  }
};
</script>

<style lang="sass">
.vrww-mainnav 
    height: 60px

    .logo
        height: 90%
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
            padding: 18px 45px 0
            text-decoration: none
            text-transform: uppercase
            color: #414141
            display: inline-block
            
            a
                color: #414141
                cursor: pointer

</style>
