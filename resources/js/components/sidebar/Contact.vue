<template>
    <section class="contact-page">
        <div class="row-3">
            <div class="contact">
                <img
                    class="headshot"
                    width="100%"
                    src="/images/seth-headshot.webp"
                    alt="Seth Matthews"
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
                    alt="Rick DuRapau"
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
    </section>
</template>

<script>
export default {};
</script>

<style lang="scss">
.contact-page {
    height: 100%;
}
.row-3 {
    height: 33.3333%;
}
.contact-page .contact img {
    width: 150px;
    display: block;
    margin: auto;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
    border-radius: 50%;
    border: 2px solid white;
    background-color: white;
    overflow: hidden;
}
.contact-page .contact p {
    text-align: center;
    margin-top: 0px;
    margin-bottom: 0px;
}
.contact-page .contact p.name {
    font-size: 20px;
    margin-top: 10px;
    font-weight: 700;
}
.contact-page .contact p.role {
    font-size: 18px;
    margin-top: 10px;
}
.contact-page .contact p.email {
    font-size: 18px;
    margin-top: 5px;
}
.contact-page .contact p.email a {
    color: inherit;
    text-decoration: none;
}
.contact-page .dubdub-logo {
    width: 50%;
    display: block;
    margin: 20px auto;
}
</style>