<template>
  <div>
    <Navigation :title="'Lịch hẹn đã đặt'" :page="null" />
    <div class="row col-lg-10 m-auto pt-5">
      <div class="col-lg-8">
        <h3 v-if="!this.items[0] && !this.fieldFilter.doctorNameQuery">Bạn chưa đặt lịch hẹn nào</h3>
        <b-list-group id="posts-container">
          <div class="mb-3" v-if="this.items[0]">
            <h4
              style="display: inline-block"
              v-if="this.fieldFilter.doctorNameQuery"
            >
              Kết quả tìm kiếm theo từ khóa: "{{ fieldFilter.doctorNameQuery }}":
            </h4>
          </div>
          <div class="mb-3" v-if="!this.items[0]">
            <h4
              style="display: inline-block"
              v-if="this.fieldFilter.doctorNameQuery"
            >
              Không có kết quả nào khi tìm kiếm theo từ khóa: "{{
                fieldFilter.doctorNameQuery
              }}"
            </h4>
          </div>

          <b-list-group-item
            style="cursor: pointer"
            @click.prevent="chooseItem(item)"
            v-for="(item, index) in items"
            :key="index"
          >
            <h4>Lịch hẹn với bác sĩ {{ item.doctor_name }}</h4>
            <div>
              <i class="theme-icon fa fa-calendar" aria-hidden="true"></i>
              <span style="font-size: 14px"
                ><b>{{ moment(item.start_at).format('DD-MM-YYYY') }}</b>
              </span>
              <i class="ml-2 theme-icon fa fa-clock-o" aria-hidden="true"></i>
              <span style="font-size: 14px"
                ><b>{{ moment(item.start_at).format('HH:mm') }} - {{ moment(item.end_at).format('HH:mm') }}</b>
              </span>
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
              placeholder="Tìm kiếm theo tên bác sĩ"
              style="width: 80%"
              v-model="doctorNameQuery"
              @input="getItemsByDoctorName()"
            ></b-form-input>
            <b-button
              style="width: 15%"
              size="md"
              variant="theme"
              class="my-2 my-sm-0"
              type="submit"
              ><i class="fa fa-search" aria-hidden="true"></i
            ></b-button>
          </b-nav-form>
        </b-card>
      </div>
    </div>
    <b-modal
      ref="info-modal"
      :title="'Thông tin lịch hẹn'"
      :hide-footer="true"
      :no-close-on-backdrop="true"
      centered
      no-fade
      size="md"
    >
      <div class="d-block text-center">
        <div class="modal-body d-block text-center">
          <b-card
            class="text-left"
            style="width: 100%; margin: auto; border-radius: 12px"
          >
            <h6 class="my-4"><b>Bác sĩ: </b> <a href="#" @click="openInNewTab('/user-info/' + selectedItem.doctor_id)">{{ selectedItem.doctor_name }}</a></h6>
            <h6 class="my-4" v-if="selectedItem.note"><b>Ghi chú:</b> {{ selectedItem.note }}</h6>
            <h6 class="my-4"><b>Đặt lúc:</b> {{ moment(selectedItem.created_at).format('HH:mm DD-MM-YYYY') }}</h6>
          </b-card>
        </div>
        <div class="text-center">
          <b-button class="mr-3" variant="theme" @click="hideModal()"
            >Đóng</b-button
          >
        </div>
      </div>
    </b-modal>
  </div>
</template>

<script>
import BaseComponent from "../base-component";
export default BaseComponent.extend({
  data() {
    return {
      model: "appointments",
      types: ["Chung", "Hỏi đáp", "Chia sẻ", "Thảo luận", "Tin tức"],
      titleQuery: "",
      doctorNameQuery: "",
      selectedItem: "",
    };
  },
  methods: {
    chooseItem(item) {
      this.selectedItem = item;
      this.$refs['info-modal'].show();
    },
    hideModal() {
      this.$refs['info-modal'].hide();
    },
    clearFilter() {
      this.fieldFilter.type = null;
      this.getItems();
    },
    async getItemsByTitle() {
      this.fieldFilter.titleQuery = this.titleQuery;
      await this.getItems();
    },
    async getItemsByDoctorName() {
      this.fieldFilter.doctorNameQuery = this.doctorNameQuery;
      await this.getItems();
    },
  },
  mounted() {
    this.fieldFilter.userId = User.id
    this.getItems();
  },
});
</script>

<style lang="scss" scoped>
.post-form {
  width: 60%;
}

#posts-container .list-group-item {
  margin-bottom: 10px;
  border-radius: 15px;
  border-top-width: 1px !important;
}
</style>
