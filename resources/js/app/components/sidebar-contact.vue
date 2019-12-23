<template>
  <div>
    <div class="contact">
      <img
        class="headshot"
        width="100%"
        src="/images/seth-headshot.webp"
        alt=""
      />
      <p class="name">Seth Matthews</p>
      <p class="role">co-founder | Sales & Marketing</p>
      <p class="email">
        <a href="mailto:seth@vrww.app">
          seth@vr<span class="text-red">ww</span>.app
        </a>
      </p>
    </div>

    <div class="contact">
      <img
        class="headshot"
        width="100%"
        src="/images/rick-headshot.webp"
        alt=""
      />
      <p class="name">Rick DuRapau</p>
      <p class="role">co-founder | CVO</p>
      <p class="email">
        <a href="mailto:rick@vrww.app">
          rick@vr<span class="text-red">ww</span>.app
        </a>
      </p>
    </div>

    <img
      class="dubdub-logo"
      width="100%"
      src="/images/dubdub-logo.webp"
      alt="dubdub-logo"
    />
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
.contact {
  margin-top: 100px;

  img {
    width: 175px;
    display: block;
    margin: auto;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
    border-radius: 50%;
    border: 2px solid rgba(255, 255, 255, 1);
    background-color: rgba(255, 255, 255, 1);
    overflow: hidden;
  }

  p {
    text-align: center;
    margin-top: 0px;
    margin-bottom: 0px;

    &.name {
      font-size: 24px;
      margin-top: 10px;
      font-weight: 700;
    }

    &.role {
      font-size: 24px;
      margin-top: 10px;
    }

    &.email {
      font-size: 24px;
      margin-top: 5px;

      a {
        color: inherit;
        text-decoration: none;
      }
    }
  }
}

.dubdub-logo {
  width: 70%;
  display: block;
  margin: 150px auto;
}
</style>
