<template>
    <div>
        <full-calendar
            :events="events"
            :config="config"
        />

        <hr>
        <form>
            <div class="form-group">
                <label for="default-price">Default Price</label>
                <input
                    type="number"
                    class="form-control"
                    id="default-price"
                    aria-describedby="default-price-help"
                    placeholder="$450"
                >
                <small
                    id="default-price-help"
                    class="form-text text-muted"
                >We'll never share your email with anyone else.</small>
            </div>
            <button
                type="submit"
                class="btn btn-primary"
            >Submit</button>
        </form>
    </div>
</template>

<script>
import "fullcalendar/dist/fullcalendar.css";
import { FullCalendar } from "vue-full-calendar";
export default {
    components: { FullCalendar },

    data: () => ({
        config: {
            defaultView: "month",
            displayEventTime: false,
            header: {
                left: "prev",
                center: "title",
                right: "next"
            }
        }
    }),

    computed: {
        events() {
            var month = 11;
            var day = 1;
            var year = 2019;
            let minPrice = 295;
            let normalPrice = 450;
            let maxPrice = 715;
            let limit = 60;
            let events = [];

            for (let i = 0; i < limit; ++i) {
                let price = Math.floor(
                    minPrice + (maxPrice - minPrice) * Math.random()
                );

                let date = new Date(year, month, day);
                day++;

                if (day > 31) {
                    year += 1;
                    month = 0;
                    day = 1;
                }

                var _formatDate = (month, day, year) => {
                    if (month < 10) month = "0" + month;
                    if (day < 10) day = "0" + day;
                    return month + "/" + day + "/" + year;
                };

                events.push({
                    content: "$" + price,
                    title: "$" + price,
                    change: price - normalPrice,
                    id: Math.random()
                        .toString(36)
                        .substring(7),
                    date: _formatDate(
                        date.getMonth() + 1,
                        date.getDate(),
                        date.getFullYear()
                    )
                });
            }
            return events;
        }
    }
};
</script>

<style lang="scss">
</style>