<template>
  <div>
    <Navigation :title="'Danh sách người dùng'" :page="null" />
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
          <b-form class="text-left" @submit.prevent="addPost()">
            <b-form-group
              id="input-group-1"
              label="Chọn ngày:"
              label-for="input-1"
            >
            </b-form-group>
            <b-form-group
              id="input-group-2"
              label="Ghi chú:"
              label-for="input-2"
            >
              <!-- <b-form-textarea
                id="textarea"
                v-model="form.note"
                placeholder="Nhập ghi chú cho bác sĩ..."
                rows="3"
                max-rows="6"
                required
              ></b-form-textarea> -->
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
              v-if="this.fieldFilter.role == 1"
            >
              Danh sách người dùng:
            </h4>
            <h4
              style="display: inline-block"
              v-if="this.fieldFilter.role == 2"
            >
              Danh sách bác sĩ:
            </h4>
            <h4 style="display: inline-block" v-if="this.fieldFilter.user_name">
              Kết quả tìm kiếm người dùng theo từ khóa: "{{
                fieldFilter.user_name
              }}":
            </h4>
            <b-button
              v-if="this.fieldFilter.role"
              @click.prevent="clearFilter()"
              class="float-right"
              variant="theme"
              >Tắt bộ lọc</b-button
            >
          </div>
          <div class="mb-3" v-if="!this.items[0]">
            <!-- <h4
              style="display: inline-block"
              v-if="this.fieldFilter.specialist_id"
            >
              Hiện không có bác sĩ nào thuộc chuyên khoa {{ specialist_name }}
            </h4> -->
            <h4 style="display: inline-block" v-if="this.fieldFilter.user_name">
              Không có kết quả nào khi tìm kiếm người dùng theo từ khóa: "{{
                fieldFilter.user_name
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
                    <h5>{{ item.role == 2 ? 'Bác sĩ' : '' }} {{ item.name }} </h5>
                    <h6>
                      <b>Email:</b>
                      <span>{{ item.email }}</span>
                    </h6>
                    <h6>
                      <b>Vai trò:</b>
                      <span v-if="item.role == 1"> Người dùng </span>
                      <span v-if="item.role == 2"> Bác sĩ </span>
                    </h6>
                    <h6>
                      <b>Ngày tạo tài khoản:</b>
                      <span>{{ moment(item.created_at).format('DD-MM-yyyy') }}</span>
                    </h6>
                  </div>
                </b-media>
              </ul>
              <b-button
                variant="theme"
                @click.prevent="
                  setChatParticipant({
                    name: item.name,
                    id: item.id,
                    profilePicture: item.avatar,
                  })
                "
              >
                <i class="fa fa-comments" aria-hidden="true"></i>Nhắn tin
              </b-button>
              <b-button
              class="ml-3"
                variant="success"
                @click.prevent="navigateTo('otherUserInfo', item.id)"
              >
                <i class="fa fa-eye" aria-hidden="true"></i> Chi tiết
              </b-button>
            </div>
          </b-list-group-item>
        </b-list-group>
        <div class="mt-5"></div>
        <b-pagination
          pills
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
              placeholder="Tìm kiếm theo tên"
              style="width: 80%"
              v-model="user_name"
              @input="getUsersByName()"
            ></b-form-input>
            <b-button
              @click.prevent=""
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
            ><h5><strong>Phân loại</strong></h5></b-list-group-item
          >
          <b-list-group-item>
            <a href="#" @click.prevent="getUsers()">Người dùng</a>
          </b-list-group-item>
          <b-list-group-item>
            <a href="#" @click.prevent="getDoctors()">Bác sĩ</a>
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
      user_name: "",
      date_booking: "",
      current_week_date: "",
      doctor_booking: "",
      form: {
        doctor_id: "",
        start_at: "",
        end_at: "",
        note: "",
      },
    };
  },
  methods: {
    getUsersByName() {
      this.fieldFilter.user_name = this.user_name;
      this.getItems();
    },

    getUsers() {
      this.fieldFilter.role = 1;
      this.getItems();
    },

    getDoctors() {
      this.fieldFilter.role = 2;
      this.getItems();
    },

    clearFilter() {
      this.fieldFilter.role = null;
      this.getItems();
    },

    async getSpecialistName(id) {
      const res = await getModel("specialists", { id: id });
      this.specialist_name = res.data.data[0].name;
    },
    setChatParticipant(param) {
      this.$emit("setChatParticipant", param);
    },
  },
  async mounted() {
    // this.fieldFilter.role = 2;
    this.fieldFilter.nonAdmin = 1;
    this.getItems();
    // const res = await getModel("specialists");
    // this.specialists = res.data.data;
  },
});
</script>

<style lang="scss" scoped>
.uppercase-first-letter:first-letter {
  text-transform: uppercase;
}
</style>
