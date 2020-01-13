<template>
    <div class="sidebar-contact">
        <div class="row-3">
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
        </div>
        <div class="row-3">
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
        </div>
        <div class="row-3">

            <img
                class="dubdub-logo"
                width="100%"
                src="/images/dubdub-logo.webp"
                alt="dubdub-logo"
            />

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
.sidebar-contact {
    height: 100%;
    max-height: 100%;

    .row-3 {
        display: block;
        width: 100%;
        height: 33%;

        .contact {
            position: relative;
            top: 50%;
            transform: translateY(-50%);

            img {
                width: 130px;
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
                    font-size: 20px;
                    margin-top: 10px;
                    font-weight: 700;
                }

                &.role {
                    font-size: 20px;
                    margin-top: 10px;
                }

                &.email {
                    font-size: 20px;
                    margin-top: 5px;

                    a {
                        color: inherit;
                        text-decoration: none;
                    }
                }
            }
        }

        .dubdub-logo {
            width: 50%;
            display: block;
            margin: 50px auto;
        }
    }
}
</style>
