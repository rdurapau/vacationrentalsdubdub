<template>
    <section class="welcome-background" v-show="visible">

        <section class="welcome-container">
          <a href="#" class="close-welcome" @click.prevent="close"></a>
          <div class="welcome-home"></div>

          <section class="welcome-message">

            <h1>Better search. Better find.</h1>

            <ul>
              <li>
                <h1>Zoom. Hover. Click. Go.</h1>
                <p>Searching has never been easier. Zoom, hover, and click. Easy, fast map-based search. No long-running lists.</p>
              </li>
              <li>
                <h1>Places to go, not just to stay.</h1>
                <p>Find yourself a True Vacation Rental - A place to go, not just to stay. Better places. Better owners. No hidden fees.</p>
              </li>
            </ul>

            <button class="btn btn-welcome" @click.prevent="close">Ok, let's get searching</button>

          </section>

      </section>

    </section>

</template>

<script>
    export default {
        data() {
            return {
                visible : true
            }
        },
        methods: {
            close() {
                this.visible = false;
            },
        },
    }
</script>

