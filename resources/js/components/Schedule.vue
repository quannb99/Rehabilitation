<template>
  <div>
    <Navigation :title="'Lịch làm việc'" :page="'schedule'" />
    <b-modal
      ref="appointment-modal"
      :title="'Danh sách lịch hẹn'"
      :hide-footer="true"
      :no-close-on-backdrop="true"
      centered
      no-fade
      size="lg"
    >
      <div class="d-block text-center">
        <div class="modal-body d-block text-center">
          <div v-if="!appointments[0]">Hiện chưa có lịch hẹn nào được tạo</div>
          <div v-if="appointments[0]" >
            <b-list-group class="mb-3">
              <b-list-group-item style="text-align: left;" v-for="(item, index) in appointments" :key="index">
                <span>{{ item.user_name }}</span> đã đặt lịch hẹn lúc {{  moment(item.created_at).format('HH:mm DD-MM-YYYY')  }}
              </b-list-group-item>
            </b-list-group>
            <b-pagination
              v-if="appointments_paging.last_page > 1"
              v-model="appointments_paging.current_page"
              :total-rows="appointments_paging.total"
              :per-page="appointments_paging.per_page"
              align="center"
              @input="changeAppointmentPage"
            ></b-pagination>
          </div>
        </div>
      </div>
    </b-modal>
    <div class="row col-lg-11 m-auto pt-5">
      <ejs-schedule
        ref="scheduleObj"
        id="schedule"
        height="550px"
        cssClass="custom-class"
        :rowAutoHeight="true"
        :locale="'vi'"
        :selectedDate="selectedDate"
        :eventSettings="eventSettings"
        :quickInfoOnSelectionEnd="true"
        :timeScale="timeScale"
        :workHours="workHours"
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
import { postModel, getModel, updateModel, deleteModel } from "../service";
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
import { DataManager, UrlAdaptor } from "@syncfusion/ej2-data";
import * as localeText from "../locale.json";

L10n.load(localeText.default);
loadCldr(
  require("cldr-data/supplemental/numberingSystems.json"),
  require("cldr-data/main/vi/ca-gregorian.json"),
  require("cldr-data/main/vi/numbers.json"),
  require("cldr-data/main/vi/timeZoneNames.json")
);
setCulture("vi");
let dataManager = new DataManager({
  url: "getSchedule",
  crudUrl: "schedules",
  adaptor: new UrlAdaptor(),
});

export default BaseComponent.extend({
  data() {
    return {
      model: "schedules",
      dateFormat: "dd/MM/yyyy",
      selectedDate: new Date(),
      timeScale: {
        slotCount: 2,
      },
      minDate: moment(new Date()).subtract(1, "days"),
      maxDate: moment(new Date()).add(1, "months"),
      workHours: {
        highlight: true,
        start: "8:00",
        end: "18:00",
      },
      eventSettings: {
        dataSource: dataManager,
        enableTooltip: true,
      },
      appointments: {},
      appointments_paging: {},
      start_at: '',
      end_at: '',
    };
  },
  methods: {
    async changeAppointmentPage(page) {
      const params = {
          start_at: this.start_at,
          end_at: this.end_at,
          doctor_id: User.id,
          page: page
        }
        const res = await getModel("appointments", params)
        this.appointments_paging = res.data.data
        this.appointments = res.data.data.data
    },
    async onPopupOpen(arg) {
      if (arg.type == 'QuickInfo') {
        arg.cancel = true;
        this.start_at = moment(arg.data.StartTime).toISOString()
        this.end_at = moment(arg.data.EndTime).toISOString()
        const params = {
          start_at: this.start_at,
          end_at: this.end_at,
          doctor_id: User.id
        }
        const res = await getModel("appointments", params)
        this.appointments_paging = res.data.data
        this.appointments = res.data.data.data
        this.$refs["appointment-modal"].show();
      }
      if (arg.type == "RecurrenceAlert") {

        document.getElementById("scheduleQuickDialog_title").innerHTML =
          "Xác nhận";
      }

      if (arg.type == "RecurrenceValidationAlert") {
        document.querySelector(
          ".e-control.e-btn.e-lib.e-quick-alertcancel.e-flat"
        ).style.display = "none";
        document.querySelector(
          ".e-control.e-btn.e-lib.e-quick-alertok.e-flat.e-primary.e-quick-dialog-alert-btn"
        ).innerHTML = "OK";
      }
    },
  },
  provide: {
    schedule: [Day, Week, WorkWeek, Month, Agenda],
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
// .custom-class.e-schedule
//   .e-vertical-view
//   .e-all-day-appointment-wrapper
//   .e-appointment,
// .custom-class.e-schedule .e-vertical-view .e-day-wrapper .e-appointment,
// .custom-class.e-schedule .e-month-view .e-appointment {
//   background: #3f97da;
// }

.custom-class.e-schedule
  .e-vertical-view
  .e-day-wrapper
  .e-appointment
  .e-subject {
  font-size: 18px;
}
.custom-class.e-schedule
  .e-vertical-view
  .e-day-wrapper
  .e-appointment
  .e-time {
  margin-top: 5px;
  font-size: 13px;
}
div.e-all-day-time-zone-row {
  display: none !important;
}
// .e-control.e-recurrenceeditor.e-lib {
//   display: none !important;
// }
// .e-description-row {
//   display: none !important;
// }
.e-input-wrapper-side.e-days.e-form-left {
  display: none !important;
}
.e-input-wrapper.e-interval.e-form-right {
  display: none !important;
}
.e-input-wrapper-side.e-non-week.e-form-left {
  display: none !important;
}
.e-input-wrapper-side.e-end-on {
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
