<template>
    <section class="welcome-message">
        <div class="ww-container">
            <img src="/images/ww-logo.webp">
        </div>

        <h1>
            Finally, <br>
            an easy way to find <br>
            Vacation Rentals <br>
            <span>W</span>ith <span>W</span>ebsites
        </h1>

        <div class="dubdub-container">
            <img src="/images/dubdub-logo.webp">
        </div>
    </section>
</template>

<script>
export default {
    components: {}
};
</script>

<style lang="scss">
.ww-container {
    height: 33%;
    width: 100%;
    img {
        width: 150px;
        display: block;
        margin: 20px auto 0;
    }
}

.welcome-message h1 {
    margin-top: 70px;
    font-weight: 700;
    color: #29304c;
    text-align: center;
    font-size: 38px;
    line-height: 1.2;
    span {
        color: #f00;
    }
}

.dubdub-container {
    height: 33%;
    width: 100%;
    img {
        width: 50%;
        display: block;
        margin: 130px auto 0;
    }
}
</style>