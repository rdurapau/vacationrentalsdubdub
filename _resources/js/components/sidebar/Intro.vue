<template>
    <section class="intro-sidebar">

        <div class="row-3">
            <div class="ww-logo">
                <img src="/images/ww-logo.webp">
            </div>
        </div>

        <div class="row-3">
            <h1>
                Finally, <br>
                an easy way to find <br>
                Vacation Rentals <br>
                <span>W</span>ith <span>W</span>ebsites
            </h1>
        </div>

        <div class="row-3">
            <div class="dubdub-logo">
                <img src="/images/dubdub-logo.webp">
            </div>
        </div>

    </section>
</template>

<script>
export default {};
</script>

<style lang="scss">
.intro-sidebar {
    height: 100%;

    .row-3 {
        height: 33.3333%;

        .ww-logo,
        h1,
        .dubdub-logo {
            position: relative;
            top: 50%;
            transform: translateY(-50%);
        }

        .ww-logo img {
            width: 150px;
            display: block;
            margin: auto;
        }

        h1 {
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

        .dubdub-logo img {
            width: 250px;
            display: block;
            margin: auto;
        }
    }
}
</style>