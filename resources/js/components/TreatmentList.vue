<template>
  <div>
    <Navigation :title="'Danh sách hoạt động điều trị'" :page="null" />
    <message-modal ref="msg-modal"></message-modal>
    <div class="row col-lg-10 m-auto pt-5">
      <div class="col-lg-8">
        <b-list-group id="posts-container">
          <div class="mb-3" v-if="this.items[0]">
            <h4 style="display: inline-block" v-if="this.fieldFilter.type">
              Các hoạt động điều trị theo thể loại {{ this.fieldFilter.type }}:
            </h4>
            <h4
              style="display: inline-block"
              v-if="this.fieldFilter.titleQuery"
            >
              Kết quả tìm kiếm hoạt động điều trị theo từ khóa: "{{
                fieldFilter.titleQuery
              }}":
            </h4>
            <b-button
              v-if="this.fieldFilter.type"
              @click.prevent="clearFilter()"
              class="float-right"
              variant="theme"
              >Tắt bộ lọc</b-button
            >
          </div>
          <div class="mb-3" v-if="!this.items[0]">
            <h4
              style="display: inline-block"
              v-if="this.fieldFilter.titleQuery"
            >
              Không có kết quả nào khi tìm kiếm hoạt động điều trị theo từ khóa: "{{
                fieldFilter.titleQuery
              }}"
            </h4>
          </div>

          <b-list-group-item
            style="cursor: pointer"
            @click.prevent="navigateTo('showTreatment', item.id)"
            v-for="(item, index) in items"
            :key="index"
          >
            <h4>{{ item.title }}</h4>
            <a
              class="mr-2"
              @click.stop
              target="_blank"
              :href="'/user-info/' + item.user_id"
              ><i class="theme-icon-20 fa fa-user-md" aria-hidden="true"></i>
              Bác sĩ {{ item.user_name }}</a
            >
            <span style="font-size: 14px" v-if="item.privacy == 1"><i  class="theme-icon fa fa-globe" aria-hidden="true"></i> Công khai</span>
            <span style="font-size: 14px" v-if="item.privacy == 2"><i class="theme-icon fa fa-lock" aria-hidden="true"></i> Riêng tư</span>
            <span style="font-size: 14px"
              class="ml-2"
              ><i class="theme-icon fa fa-clock-o" aria-hidden="true"></i>
              {{ moment(item.created_at).format("HH:mm DD-MM-YYYY") }}</span
            >
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
        <b-button
          variant="theme"
          class="new-post-btn mb-3"
          @click="navigateTo('createTreatment')"
          style="font-size: 18px"
          ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Tạo hoạt động điều trị mới</b-button
        >
        <b-card>
          <b-nav-form id="search-form">
            <b-form-input
              size="md"
              class="mr-3"
              placeholder="Tìm kiếm theo tiêu đề"
              style="width: 80%"
              v-model="titleQuery"
              @input="getItemsByTitle()"
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
  </div>
</template>

<script>
import BaseComponent from "../base-component";
import { postModel, getModel, updateModel, deleteModel } from "../service";
export default BaseComponent.extend({
  data() {
    return {
      model: "treatments",
      userIdSelected: "",
      usersList: [],
      isInput: false,
      userNameQuery: "",
      medicalRecord: "",
      currentUser: "",
      titleQuery: "",
      authUser: User,
      form: {
        status: "",
        diagnose: "",
        method: "",
      },
      listRecords: "",
      recordsPaging: "",
    };
  },
  methods: {
    clearFilter() {
      this.fieldFilter.type = null;
      this.getItems();
    },

    async getItemsByTitle() {
      this.fieldFilter.titleQuery = this.titleQuery;
      await this.getItems();
    },

    upperCase(value) {
      if (!value) return;
      return value.toUpperCase();
    },
  },
  async mounted() {
    if (User.role == 2) {
      this.fieldFilter.user_id = User.id
      this.fieldFilter.includeShared = 1
      await this.getItems();
    }
  },
});
</script>

<style lang="scss" scoped>
.user-select {
  overflow-y: auto;
  height: 197px;
  position: absolute;
  width: 50%;
  z-index: 1000;
}

#posts-container .list-group-item {
  margin-bottom: 10px;
  border-radius: 15px;
  border-top-width: 1px !important;
}
</style>
