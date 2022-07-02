<template>
  <div>
    <Navigation :title="'Lịch sử đánh giá hoạt động'" :page="null" />
    <div class="row col-lg-10 m-auto pt-5">
      <div class="col-lg-8">
        <b-list-group id="posts-container">
          <div class="mb-3" v-if="this.items[0]">
            <h4 style="display: inline-block" v-if="this.fieldFilter.type">
              Các bài viết theo thể loại {{ this.fieldFilter.type }}:
            </h4>
            <h4
              style="display: inline-block"
              v-if="this.fieldFilter.titleQuery"
            >
              Kết quả tìm kiếm theo từ khóa: "{{ fieldFilter.titleQuery }}":
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
              Không có kết quả nào khi tìm kiếm theo từ khóa: "{{
                fieldFilter.titleQuery
              }}"
            </h4>
          </div>

          <b-list-group-item
            style="cursor: pointer"
            @click.prevent="chooseItem(item)"
            v-for="(item, index) in items"
            :key="index"
          >
            <h4>{{ item.title }}</h4>
            <div>
              <!-- <b-img
                :src="item.user_avatar"
                width="20"
                alt="avatar"
                rounded="circle"
              ></b-img> -->
              <i class="theme-icon-20 fa fa-user-md" aria-hidden="true"></i>
              <strong class="mr-2" style="font-size: 14px"
                ><span>Bs. </span> {{ item.doctor_name }}</strong
              >
              <i class="ml-1 theme-icon fa fa-star" aria-hidden="true"></i>
              <span style="font-size: 14px"
                ><b>{{ item.rate }}%</b>
              </span>
              <i class="ml-2 theme-icon fa fa-clock-o" aria-hidden="true"></i>
              <span style="font-size: 14px"
                ><b>{{ moment(item.created_at).fromNow() }}</b>
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
    <b-modal
      ref="info-modal"
      :title="'Thông tin đánh giá'"
      :hide-footer="true"
      :no-close-on-backdrop="true"
      centered
      no-fade
      size="lg"
    >
      <div class="d-block text-center">
        <div class="modal-body d-block text-center">
          <b-card
            class="text-left"
            style="width: 100%; margin: auto; border-radius: 12px"
          >
            <h4
              style="cursor: pointer"
              @click="openInNewTab('/show-treatment/' + selectedItem.treatment_id)"
              class="text-center"
            >
              {{ selectedItem.title }}
            </h4>
            <h6 class="my-4"><b>Mục tiêu:</b> {{ selectedItem.objective }}</h6>
            <h6 class="my-4"><b>Độ khó:</b> {{ selectedItem.difficulty }}</h6>
            <h6 class="my-4"><b>Mức độ hoàn thành:</b> {{ selectedItem.rate }}%</h6>
            <h6 class="my-4"><b>Ghi chú:</b> {{ selectedItem.note }}</h6>
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
      model: "rates",
      types: ["Chung", "Hỏi đáp", "Chia sẻ", "Thảo luận", "Tin tức"],
      titleQuery: "",
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
  },
  mounted() {
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
