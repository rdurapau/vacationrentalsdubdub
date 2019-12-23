<template>
  <div class="sidebar-home">
    <div class="row-3">
      <img
        src="/images/ww-logo.webp"
        class="ww-logo"
        alt="logo"
      >
    </div>
    <div class="row-3">
      <p class="intro">
        Finally, <br />
        an easy way to find <br />
        Vacation Rentals <br />
        <span class="text-red">W</span>ith <span class="text-red">W</span>ebsites
      </p>
    </div>
    <div class="row-3">
      <img
        src="/images/dubdub-logo.webp"
        class="dubdub-logo"
        alt="logo"
      >
    </div>
  </div>
</template>

<script>
export default {
  data: () => ({}),

  mounted() {},

  computed: {},

  methods: {}
};
</script>

<style lang="scss">
.sidebar-home {
  height: 100%;

  .row-3 {
    display: block;
    width: 100%;
    height: 33%;

    p.intro {
      padding: 0 50px;
      text-align: center;
      font: normal normal 700 50px/1.4em montserrat, sans-serif;
    }

    img {
      display: block;
      margin: auto;

      &.ww-logo {
        width: 150px;
        margin-top: 50px;
      }

      &.dubdub-logo {
        width: 60%;
      }
    }
  }
}
</style>
