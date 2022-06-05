<template>
  <div>
    <Navigation :title="'Danh sách bác sĩ'" :page="'doctors'" />
    <b-modal
      ref="booking-modal"
      :title="'Đặt lịch hẹn với bác sĩ ' + doctor_booking"
      :hide-footer="true"
      :no-close-on-backdrop="true"
      centered
      no-fade
      size="md"
    >
      <div class="d-block text-center">
        <div class="modal-body d-block text-center">
          <b-form class="post-form" @submit.prevent="addPost()">
            <b-form-group
              id="input-group-1"
              label="Chọn ngày:"
              label-for="input-1"
            >
              <date-picker
                v-model="date_booking"
                type="date"
                :format="'DD-MM-YYYY'"
                :disabled-date="disableDate"
                :input-error="'Kiểm tra lại'"
              ></date-picker>
            </b-form-group>
          </b-form>
        </div>
        <div class="text-center">
          <b-button variant="primary" @click="confirmBooking()"
            >Xác nhận</b-button
          >
          <b-button variant="light" @click="hideModal()">Hủy</b-button>
        </div>
      </div>
    </b-modal>
    <div class="row col-lg-10 m-auto pt-5">
      <div class="col-lg-8">
        <b-list-group>
          <div class="mb-3" v-if="this.items[0]">
            <h4
              style="display: inline-block"
              v-if="this.fieldFilter.specialist_id"
            >
              Các bác sĩ chuyên khoa {{ items[0].specialist_name }}:
            </h4>
            <h4
              style="display: inline-block"
              v-if="this.fieldFilter.doctor_name"
            >
              Kết quả tìm kiếm bác sĩ theo từ khóa: "{{
                fieldFilter.doctor_name
              }}":
            </h4>
            <b-button
              v-if="this.fieldFilter.specialist_id"
              @click.prevent="clearFilter()"
              class="float-right"
              variant="theme"
              >Tắt bộ lọc</b-button
            >
          </div>
          <div class="mb-3" v-if="!this.items[0]">
            <h4
              style="display: inline-block"
              v-if="this.fieldFilter.specialist_id"
            >
              Hiện không có bác sĩ nào thuộc chuyên khoa {{ specialist_name }}
            </h4>
            <h4
              style="display: inline-block"
              v-if="this.fieldFilter.doctor_name"
            >
              Không có kết quả nào khi tìm kiếm bác sĩ theo từ khóa: "{{
                fieldFilter.doctor_name
              }}"
            </h4>
          </div>

          <b-list-group-item v-for="(item, index) in items" :key="index">
            <div id="doctors-wrap">
              <ul class="list-unstyled mt-3">
                <b-media tag="li" class="mb-3" :key="index">
                  <template #aside>
                    <b-img :src="item.avatar" width="120" alt="avatar"></b-img>
                  </template>
                  <div>
                    <h5>Bác sĩ {{ item.name }}</h5>
                    <h6>
                      Chuyên khoa:
                      <a
                        href="#"
                        @click.prevent="
                          getDoctorsBySpecialist(item.specialist_id)
                        "
                        >{{ item.specialist_name }}</a
                      >
                    </h6>
                    <h6>
                      Lịch hẹn:
                      <br />
                      <div
                        class="mr-2 mt-3"
                        style="display: inline-block"
                        v-for="(schedule, i) in item.schedules"
                        :key="i"
                      >
                        <b-button
                          class="uppercase-first-letter"
                          variant="theme"
                          @click.prevent="
                            openBookingPopup(
                              item.name,
                              item.id,
                              schedule.start_at,
                              schedule.end_at
                            )
                          "
                        >
                          {{ moment(schedule.start_at).format("dddd: HH:mm") }}
                          -
                          {{ moment(schedule.end_at).format("HH:mm") }}
                        </b-button>
                      </div>
                    </h6>
                  </div>
                </b-media>
              </ul>
            </div>
          </b-list-group-item>
        </b-list-group>
        <div class="mt-5"></div>
        <b-pagination
          v-if="paging.last_page > 1"
          v-model="paging.current_page"
          :total-rows="paging.total"
          :per-page="paging.per_page"
          align="center"
          @input="changePage"
        ></b-pagination>
      </div>

      <div class="col-lg-4">
        <b-card class="mt-3">
          <b-nav-form id="search-form">
            <b-form-input
              size="md"
              class="mr-3"
              placeholder="Tìm kiếm bác sĩ theo tên"
              style="width: 80%"
              v-model="doctor_name"
              @input="getDoctorsByName()"
            ></b-form-input>
            <b-button
              @click.prevent="getDoctorsByName()"
              style="width: 15%"
              size="md"
              variant="theme"
              class="my-2 my-sm-0"
              type="submit"
              ><i class="fa fa-search" aria-hidden="true"></i
            ></b-button>
          </b-nav-form>
        </b-card>
        <b-list-group id="specialists-list" class="mt-3">
          <b-list-group-item
            ><h5><strong>Chuyên Khoa</strong></h5></b-list-group-item
          >
          <b-list-group-item v-for="(item, index) in specialists" :key="index">
            <a href="#" @click.prevent="getDoctorsBySpecialist(item.id)">{{
              item.name
            }}</a>
          </b-list-group-item>
        </b-list-group>
      </div>
    </div>
  </div>
</template>

<script>
import BaseComponent from "../base-component";
import { postModel, getModel, updateModel, deleteModel } from "../service";
import DatePicker from "vue2-datepicker";
import "vue2-datepicker/index.css";
import "vue2-datepicker/locale/vi";
import moment from "moment";
export default BaseComponent.extend({
  components: { DatePicker },
  data() {
    return {
      model: "users",
      specialists: [],
      specialist_name: "",
      doctor_name: "",
      date_booking: "",
      current_week_date: "",
      doctor_booking: "",
      form: {
        doctor_id: "",
        start_at: "",
        end_at: "",
      },
    };
  },
  methods: {
    disableDate(date) {
      if (moment(date).isoWeekday() != this.current_week_date) return true;
      if (moment(date) < moment(new Date())) return true;
      else return false;
    },
    openBookingPopup(doctor_booking, doctor_id, start_at, end_at) {
      this.current_week_date = moment(start_at).isoWeekday();
      const dayINeed = moment(start_at).isoWeekday();
      const today = moment().isoWeekday();
      if (today <= dayINeed) {
        this.date_booking = moment().isoWeekday(dayINeed)._d;
      } else {
        this.date_booking = moment().add(1, "weeks").isoWeekday(dayINeed)._d;
      }
      this.doctor_booking = doctor_booking;
      this.form.doctor_id = doctor_id;
      this.form.start_at = moment(start_at).format("HH:mm");
      this.form.end_at = moment(end_at).format("HH:mm");
      this.$refs["booking-modal"].show();
    },

    async confirmBooking() {
      const date_booking = moment(this.date_booking).format("DD-MM-YYYY");
      this.form.start_at = moment(
        date_booking + " " + this.form.start_at,
        "DD-MM-YYYY HH:mm"
      ).toISOString();
      this.form.end_at = moment(
        date_booking + " " + this.form.end_at,
        "DD-MM-YYYY HH:mm"
      ).toISOString();
      this.form.user_id = User.id;
      try {
        await postModel('appointments', this.form)
        this.makeToast('Đặt lịch hẹn thành công')
      } catch (error) {
        this.handleErr(error);
      }

      this.$refs["booking-modal"].hide();
    },

    hideModal() {
      this.$refs["booking-modal"].hide();
    },

    getDoctorsByName() {
      this.fieldFilter.doctor_name = this.doctor_name;
      this.getItems();
    },

    getDoctorsBySpecialist(id) {
      this.fieldFilter.specialist_id = id;
      this.getItems();
      this.getSpecialistName(id);
    },

    clearFilter() {
      this.fieldFilter.specialist_id = null;
      this.getItems();
    },

    async getSpecialistName(id) {
      const res = await getModel("specialists", { id: id });
      this.specialist_name = res.data.data[0].name;
    },
  },
  async mounted() {
    this.fieldFilter.role = 2;
    this.getItems();
    const res = await getModel("specialists");
    this.specialists = res.data.data;
  },
});
</script>

<style lang="scss" scoped>
.uppercase-first-letter:first-letter {
  text-transform: uppercase;
}
</style>
