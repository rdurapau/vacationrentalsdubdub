<template>
    <div>

        <div class="row">
            <div class="col-md-6">
                <div class="logo"></div>
            </div>
            <div class="col-md-6">
                <button
                    class="btn btn-seconary float-right"
                    v-if="isAuth"
                    @click="onClickLogout"
                >Logout</button>
            </div>
        </div>

        <p
            class="font_8"
            style="font-size:18px;"
        >
            <span style="font-family:montserrat,sans-serif;">
                <span style="font-size:18px;">
                    <span style="font-weight:bold;">
                        <span style="color:#FF0000;">A preface from the founder:</span>
                    </span>

                    <br>

                    I'm an unlikely founder of a tech company. By trade, I am an inventor and designer of consumer and industrial products. Since 2000, I’ve also been a <span style="text-decoration:underline;"><a
                            href="http://www.famousfloathouse.com"
                            target="_top"
                            data-content="http://www.famousfloathouse.com"
                            data-type="external"
                            rel="noopener noreferrer"
                        >Vacation Rental Owner</a></span> on VRBO. I’ve seen the good, the bad and the now the really ugly. I want to go back to the good. I could write volumes on this topic, but will try hard to keep it short. </span></span></p>
        <p
            class="font_8"
            style="font-size:18px;"
        ><span style="font-family:montserrat,sans-serif;"><span style="font-size:18px;"><span style="color:rgb(255, 0, 0);"><span style="font-weight:bold;">The why of dub·dub:</span></span><br> A lot of Vacation&nbsp;Owners are mad and looking for an alternative. Many of us have&nbsp;taken&nbsp;the advice of industry&nbsp;experts and have&nbsp;created&nbsp;or own Websites. A lot of Vacation Rental Renters are mad too, and are looking for ways to book direct with Owners. The problem is that Vacation Rental Websites are nearly impossible to find. We want to change that.</span></span></p>

        <p
            class="font_8"
            style="font-size:18px;"
        ><span style="font-family:montserrat,sans-serif;"><span style="font-size:18px;">We want to go back to the way VRBO used to be, unique renters looking for unique places to GO for a vacation, but with new methods and new technology. We call it 'Back To the Future'.</span></span></p>
        <p
            class="font_8"
            style="font-size:18px;"
        ><span style="font-family:montserrat,sans-serif;"><span style="font-size:18px;"><span style="color:#FF0000;"><span style="font-weight:bold;">The how of&nbsp;dub·dub:</span></span><br> Everything about us is different. The most important feature is that we are <span style="text-decoration:underline;">the</span> place for&nbsp;Vacation Rental Websites. We charge only a simple fee just VRBO used to.&nbsp;That means no hidden fees, and direct talking between Owner and Renter. But the fee is not the same flat fee for everyone. Our fee is based on a daily rate. That only seems fair.</span></span></p>
        <p
            class="font_8"
            style="font-size:18px;"
        ><span style="font-family:montserrat,sans-serif;"><span style="font-size:18px;">We also have a revolutionary new way to search. We are entirely&nbsp;map based. There is no list&nbsp;to tediously click and scroll&nbsp;through. It's all about zooming, panning, hovering and with limited clicking and a lot about pictures. For Owners,&nbsp; no list means no hated rankings.</span></span></p>
        <p
            class="font_8"
            style="font-size:18px;"
        ><span style="font-family:montserrat,sans-serif;"><span style="font-size:18px;">That's what we mean by 'better search - better find'.</span></span></p>
        <p
            class="font_8"
            style="font-size:18px;"
        ><span style="font-family:montserrat,sans-serif;"><span style="font-size:18px;">There's so much more about dub·dub. This 8 minute&nbsp;<span style="text-decoration:underline;"><a
                            href="https://www.youtube.com/watch?v=sOZ1WEAb8xQ"
                            target="_top"
                            data-content="https://www.youtube.com/watch?v=sOZ1WEAb8xQ"
                            data-type="external"
                            rel="noopener noreferrer"
                        >video</a></span> to Owners explains a lot.</span></span></p>
        <p
            class="font_8"
            style="font-size:18px;"
        ><span style="font-family:montserrat,sans-serif;"><span style="font-size:18px;">We hope you agree.&nbsp;If you have any thoughts, comments or questions, please contact us.</span></span></p>
        <p
            class="font_8"
            style="font-size:18px;"
        ><span style="font-family:montserrat,sans-serif;"><span style="font-size:18px;">Rick DuRapau | co founder -&nbsp;CVO | rick@ vrww.app | 512.796.6191</span></span></p>
        <p
            class="font_8"
            style="font-size:18px;"
        >
            <span style="font-family:montserrat,sans-serif;"><span style="font-size:18px;">Seth Matthews | co founder - Sales | <object height="0"><a
                            class="auto-generated-link"
                            data-auto-recognition="true"
                            data-content="seth@vrww.app"
                            href="mailto:seth@vrww.app"
                            data-type="mail"
                        >seth@vrww.app</a></object> | 469.835.5512</span></span>
        </p>
    </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
    mounted() {},

    computed: {
        ...mapGetters(["isAuth"])
    },

    methods: {
        onClickLogout() {
            this.$emit("close");
            this.$router.push("/logout");
        }
    }
};
</script>

<style lang="scss">
.logo {
    display: block;
    height: 55px;
    width: 250px;
    background: url("./../../../img/logo.png") no-repeat;
    background-size: contain;
    margin-bottom: 20px;
}
</style>