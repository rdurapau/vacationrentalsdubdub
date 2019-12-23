<template>
  <div
    class="vrww-calendar"
    ref="vrwwCalendar"
  >
    <full-calendar
      :events="events"
      :config="config"
    />
  </div>
</template>

<script>
import { mapGetters } from "vuex";
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

  mounted() {
    // this.width = this.$refs.vrwwCalendar.clientWidth + "px";
  },

  computed: {
    ...mapGetters(["activeSpot"]),

    photos() {
      return this.activeSpot.photos.slice(0, 9);
    },

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
  },

  methods: {
    dayClick(item, event) {
      //   console.log(this.$refs.cal);
      //   this.$refs.cal.currDate = new Date(2019, 11, 17);
    }
  }
};
</script>

<style lang="scss">
.vrww-calendar {
  .datepicker {
    width: 100%;
  }

  #calendar {
    .fc-head {
      background: #e8ddde;
    }

    .fc-toolbar {
      background: #e8ddde;
      margin-bottom: 0px;

      .fc-left,
      .fc-right {
        margin-top: 5px;
      }

      .fc-center h2 {
        font-size: 18px;
        margin-top: 6px;
        font-weight: 400;
      }

      .fc-state-default {
        background-color: transparent;
        background-image: none;
        border: none;
      }
    }

    .fc-content-skeleton thead tr td span {
      float: left;
      margin-left: 5px;
    }

    .fc-content-skeleton tbody {
      transform: translateY(-22px);

      .fc-title {
        float: right;
        font-weight: 600;
      }
    }

    .fc-event,
    .fc-event-dot {
      background-color: transparent;
      border: none;
    }
  }
}

.fc-basic-view .fc-body .fc-row {
  min-height: 0;
  background: #e8ddde;
  height: 30px !important;
}

.fc-unthemed th,
.fc-unthemed td,
.fc-unthemed thead,
.fc-unthemed tbody,
.fc-unthemed .fc-divider,
.fc-unthemed .fc-row,
.fc-unthemed .fc-content,
.fc-unthemed .fc-popover,
.fc-unthemed .fc-list-view,
.fc-unthemed .fc-list-heading td {
  border-color: #fff !important;
}
</style>
