<template>
    <div class="about-modal">
        <h1>Hi there! We are SweetSpot. True Vacation Rentals!</h1>
        <div><strong>A preface from the founder:</strong><br>I'm an unlikely founder of a tech company. By trade, I am an inventor and designer of consumer and industrial products. I’m a lot closer to “Doc” (<em>Back To The Future</em>) than I am to “Zuck” (Facebook). Since 1999, I’ve also been a Vacation Rental Owner on <a href="https://www.vrbo.com/60070?arrival=2019-10-03&amp;departure=2019-10-06">VRBO</a>...er Vrbo. I’ve seen the good, the bad and the now the ugly. I want to go back to the good. I could&nbsp; write volumes on this topic, but will try hard to keep it short. If you have any thoughts, comments or questions, call me, or drop me a line.&nbsp; Rick DuRapau, &nbsp; 512.796.6191&nbsp; &nbsp;rick@sweetspotvacation.com<br><br><strong>The Why of SweetSpot:</strong><br>If you are reading this, it’s likely because you are one of the many hundreds of thousands of Owners who are unhappy with what has become of our beloved Vacation Rental Industry. You are more than angry that the big Online Travel Agencies (OTA is an oxymoron to Vacation Rental) have virtually destroyed the once splendid concept of “vacation rentals by owner” that began almost a quarter century ago with the founding of VRBO: “unique people renting unique places from the owner”. First and foremost, that’s the why. We want to go “back to the future”. That means we want to return to the good old days, but with new ideas, and new technology.<br><br>This is the industry today: The Big Four Sharks (Expedia, AirBnB, Booking, Trip Advisor) ham-handedly doing whatever they want, and a profusion of Xerox niche players all doing the exact same thing. Pretty picture and when/where do wanna go. If you can think it, there’s a niche for it: gay, dog, kids, architecture, location etc. Amazingly, the one niche that's completely under served is the progenitor of the business, you and me, what we call True Vacation Rentals. Unique places to GO, not just simply places to STAY. We believe that VRBO created Vacation Rentals, and AirBnB created Short Term Rentals, and that they are <strong>NOT</strong> the same thing. That is our niche, True Vacation Rentals.<br><strong><br>The How of SweetSpot:</strong><br>If you truly are angry, you have searched for an alternative to the OTAs. You probably also know that all of the leading experts in the "alt-VR" counsel that the solution is to create <a href="https://www.famousfloathouse.com/">your own website</a>, and then optimize the hell out of it. Blog, videos, links, constant updates, keywords, meta tags, title tags, etc. That bullshit (excuse me) piece of advice is actually what got me to thinking about this. No matter what you do you will never ever be before page 5, at very best. We know this to be true with a lot of research. It’s like taking a knife to a gunfight.<br><br>The solution to that huge problem is the founding principle of SweetSpot. We will be Union of Vacation Rental Owners With Websites. When we get mass, we can compete for placement. We will only have Owners with websites. And the cool thing is that they are: the most unique, the most desirable, the most senior, the most profitable, the cream of the crop and are usually Owner operated. (Don’t have a site? We’ll help you on that.) Our single minded goal is to drive people to your site.<br><br>But, that just for starters. Just about everything we do will be different. Not just to be different, but because it makes sense. <br><br>We will be membership fee based, but not one flat fee for all. That just makes no sense. Why should a one bedroom cabin in the woods pay the same amount as a 12 bedroom mansion on lakefront. Our fee will be based on one night’s average rental. We call it “give us one night”. There will be no preference packages. A level playing field for all. A Union. (We will be free to list until we reach 25,000 subscribers.)<br><br>We will not have a cockeyed list for the Renter to click and click and click thru and a clunky ass map like everybody else.&nbsp; Listing Sites are broken from the sheer mass of their success. We will be entirely map based. And you know what that also means? No Rankings! No “best match” algorithms. No pay for placement. Yea. And it will be so much faster for the Renter. They will love it.<br><br>We will have accurate spot location that the Owner controls. No more disingenuous spots. And they will be round spots - not those dumb over-sized icons everyone else uses.<br><br>We will not allow Short Term Rentals. There are plenty of places for them and they clutter the search. We will be True Vacation Rentals only. Sometimes it will be hard, but we will be the judge of that.<br><br>There’s so much more to SweetSpot, but I said I’d try to keep it short.<br><br>Contact me or co-founder Seth Matthews (my son in law) seth@sweetspotvacation.com if you want to talk.<br><br><em>Let the Revolution begin.</em><br><br><strong>Rick</strong></div>
    </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
    components: {},

    data: () => ({}),

    watch: {},

    mounted() {},

    methods: {}
};
</script>

<style lang="scss">
.about-modal {
    padding: 20px;
    height: 100%;

    .logo {
        width: 170px;
    }

    ul.progress-list {
        list-style-type: none;
        padding: 20px 0 0 20px;

        li {
            width: 100%;
            display: block;
            height: 50px;

            .icon {
                width: 100px;
                float: left;
            }

            .label {
                float: left;
            }
        }
    }

    .sections section {
        .section-hint {
            margin-top: 100px;

            h2 {
                font-size: 19px;
                font-style: normal;
                font-weight: 700;
                color: #29304c;
                padding-bottom: 10px;
            }
            p {
                font-size: 14px;
                color: #666;
                line-height: 20px;
            }
        }

        .mapboxgl-ctrl-geocoder {
            margin-bottom: 20px;
            width: 100%;

            #property-location-input {
                padding: 5px;
                width: 100%;
                border: none;
            }

            .geocoder-pin-right {
                display: none;
            }
        }

        #submit-property-map {
            position: relative;
            height: 350px;
            width: 100%;

            .marker {
                position: absolute;
                left: 50%;
                margin-left: -8px;
                top: 50%;
                margin-top: -22px;
                z-index: 20;
            }
        }

        .bottom-nav {
            .btn.btn-primary {
                color: #fff;
                float: right;
            }
            .btn.btn-outline {
                float: right;
            }
        }
    }
}
</style>
