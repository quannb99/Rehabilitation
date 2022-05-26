<template>
  <div>
    <Navigation :title="'Lịch làm việc'" :page="'schedule'" />
    <div class="row col-lg-11 m-auto pt-5">
      <ejs-schedule
        id="schedule"
        height="550px"
        :rowAutoHeight="true"
        :locale="'vi'"
        :selectedDate="selectedDate"
        :eventSettings="eventSettings"
        :quickInfoOnSelectionEnd="true"
        :timeScale="timeScale"
        :popupOpen="onPopupOpen"
      >
        <e-views>
          <e-view option="Day"></e-view>
          <e-view option="Week"></e-view>
          <e-view option="Month"></e-view>
          <e-view option="Agenda"></e-view>
        </e-views>
      </ejs-schedule>
    </div>
  </div>
</template>

<script>
import BaseComponent from "../base-component";
import {
  Day,
  Week,
  WorkWeek,
  Month,
  Agenda,
  DragAndDrop,
  Resize,
} from "@syncfusion/ej2-vue-schedule";
import { L10n, loadCldr, setCulture } from "@syncfusion/ej2-base";
import * as localeText from "../locale.json";

L10n.load(localeText.default);
loadCldr(
  require("cldr-data/supplemental/numberingSystems.json"),
  require("cldr-data/main/vi/ca-gregorian.json"),
  require("cldr-data/main/vi/numbers.json"),
  require("cldr-data/main/vi/timeZoneNames.json")
);
setCulture("vi");
let scheduleData = [
  {
    Id: 1,
    Subject: "Explosion of Betelgeuse Star",
    StartTime: new Date(2018, 1, 15, 9, 30),
    EndTime: new Date(2018, 1, 15, 11, 0),
  },
  {
    Id: 2,
    Subject: "Thule Air Crash Report",
    StartTime: new Date(2018, 1, 12, 12, 0),
    EndTime: new Date(2018, 1, 12, 14, 0),
  },
  {
    Id: 3,
    Subject: "Blue Moon Eclipse",
    StartTime: new Date(2018, 1, 13, 9, 30),
    EndTime: new Date(2018, 1, 13, 11, 0),
  },
  {
    Id: 4,
    Subject: "Meteor Showers in 2018",
    StartTime: new Date(2018, 1, 14, 13, 0),
    EndTime: new Date(2018, 1, 14, 14, 30),
  },
];

export default BaseComponent.extend({
  data() {
    return {
      model: "schedules",
      dateFormat: "dd/MM/yyyy",
      selectedDate: new Date(2018, 1, 12),
      timeScale: {
        slotCount: 2,
      },
      minDate: moment(new Date()).subtract(1, "days"),
      maxDate: moment(new Date()).add(1, "months"),
      eventSettings: {
        dataSource: scheduleData,
        enableTooltip: true,
      },
    };
  },
  methods: {
    onPopupOpen(arg) {
      if (arg.type == "Editor") {
        // arg.cancel = true;
      }
    },
  },
  provide: {
    schedule: [Day, Week, WorkWeek, Month, Agenda, DragAndDrop, Resize],
  },
  mounted() {},
});
</script>

<style lang="scss" scoped>
@import "../../../node_modules/@syncfusion/ej2-base/styles/material.css";
@import "../../../node_modules/@syncfusion/ej2-buttons/styles/material.css";
@import "../../../node_modules/@syncfusion/ej2-calendars/styles/material.css";
@import "../../../node_modules/@syncfusion/ej2-dropdowns/styles/material.css";
@import "../../../node_modules/@syncfusion/ej2-inputs/styles/material.css";
@import "../../../node_modules/@syncfusion/ej2-navigations/styles/material.css";
@import "../../../node_modules/@syncfusion/ej2-popups/styles/material.css";
@import "../../../node_modules/@syncfusion/ej2-vue-schedule/styles/material.css";
</style>

<style lang="scss">
div.e-all-day-time-zone-row {
  display: none !important;
}
.e-control.e-recurrenceeditor.e-lib {
  display: none !important;
}
.e-description-row {
  display: none !important;
}
.e-location-container {
  display: none !important;
}
.e-subject-container {
  width: 100% !important;
}
#schedule_dialog_wrapper {
  min-height: 240px !important;
}
</style>
