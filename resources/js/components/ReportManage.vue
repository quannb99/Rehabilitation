<template>
  <div>
    <Navigation :title="'Quản lý báo cáo'" :page="null" />
    <div class="row col-lg-10 m-auto pt-5">
      <div class="col-lg-8">
        <b-list-group>
          <div class="mb-3" v-if="this.items[0]">
            <h4 style="display: inline-block" v-if="this.fieldFilter.type">
              Các bài viết theo thể loại {{ this.fieldFilter.type }}:
            </h4>
            <h4
              style="display: inline-block"
              v-if="this.fieldFilter.titleQuery"
            >
              Kết quả tìm kiếm bài viết theo từ khóa: "{{
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
              Không có kết quả nào khi tìm kiếm bài viết theo từ khóa: "{{
                fieldFilter.titleQuery
              }}"
            </h4>
          </div>

          <b-list-group-item
            style="cursor: pointer"
            @click.prevent="handleShowReport(item.type, item.data)"
            v-for="(item, index) in reports"
            :key="index"
          >
            <div>
              <b-media>
                <template #aside>
                  <b-img
                    :src="item.data.avatar"
                    width="50"
                    alt="avatar"
                    rounded="circle"
                  ></b-img>
                </template>
                <div>
                  <p class="ellipsis-text-310">
                    <b>{{ item.data.user_name }}</b> đã báo cáo 1
                    <span v-if="item.type == 'App\\Notifications\\ReportPost'">bài viết <span>của {{ item.data.post_user_name }}</span></span>
                    <span v-if="item.type == 'App\\Notifications\\ReportComment'">bình luận <span>của {{ item.data.comment_user_name }}</span></span>
                    <br />
                    {{ moment(item.created_at).fromNow() }}
                  </p>
                </div>
              </b-media>
            </div>
          </b-list-group-item>
        </b-list-group>
        <div class="mt-5"></div>
        <b-pagination
          pills
          v-if="reports_paging.last_page > 1"
          v-model="reports_paging.current_page"
          :total-rows="reports_paging.total"
          :per-page="reports_paging.per_page"
          align="center"
          @input="changePage"
        ></b-pagination>
      </div>

      <div class="col-lg-4">
        <b-button
          variant="theme"
          class="new-post-btn"
          @click="navigateTo('new-post')"
          ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Đăng bài
          mới</b-button
        >
        <b-card class="mt-3">
          <b-nav-form id="search-form">
            <b-form-input
              v-model="titleQuery"
              size="md"
              class="mr-3"
              placeholder="Tìm kiếm theo tiêu đề"
              style="width: 80%"
              @input="getPostsByTitle()"
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
        <b-list-group id="specialists-list" class="mt-3">
          <b-list-group-item
            ><h5><strong>Phân loại</strong></h5></b-list-group-item
          >
          <b-list-group-item v-for="(item, index) in types" :key="index">
            <a href="#" @click.prevent="getPostsByType(item)">{{ item }}</a>
          </b-list-group-item>
        </b-list-group>
      </div>
    </div>
    <b-modal
      ref="report-comment-modal"
      :title="'Thông tin bình luận'"
      :hide-footer="true"
      :no-close-on-backdrop="true"
      centered
      no-fade
      size="lg"
    >
      <div class="d-block text-center">
        <div class="modal-body d-block text-center">
          <b-media
            tag="li"
            class="mb-3"
          >
            <template #aside>
              <b-img
                :src="comment.comment_user_avatar"
                width="48"
                alt="avatar"
                rounded="circle"
              ></b-img>
            </template>

            <div>

              <h6 class="mt-0 mb-1">
                <strong style="cursor: pointer" @click="navigateTo('otherUserInfo', comment.user_id)">
                  {{ comment.comment_user_name }}
                </strong>
              </h6>
              <p class="mb-1 content-wrap">
                {{ comment.content }}
              </p>
            </div>
          </b-media>
        </div>
        <div class="text-center">
          <b-button variant="danger" @click="deleteComment()">Xoá</b-button>
          <b-button variant="primary" @click="hideModal()">Xác nhận</b-button>
        </div>
      </div>
    </b-modal>
  </div>
</template>

<script>
import { postModel, getModel, updateModel, deleteModel } from "../service";
import BaseComponent from "../base-component";
export default BaseComponent.extend({
  data() {
    return {
      model: "posts",
      types: ["Chung", "Hỏi đáp", "Chia sẻ", "Thảo luận", "Tin tức"],
      titleQuery: "",
      reports: "",
      reports_paging: "",
      comment: "",
    };
  },
  methods: {
    hideModal() {
      this.$refs["report-comment-modal"].hide();
    },
    clearFilter() {
      this.fieldFilter.type = null;
      this.getItems();
    },
    async deleteComment() {
      try {
        await deleteModel('comments', this.comment.comment_id)
        this.$refs["report-comment-modal"].hide();
        this.makeToast('Xoá bình luận thành công')
      } catch (error) {
        this.handleErr(error)
      }

    },
    async getPostsByTitle() {
      this.fieldFilter.titleQuery = this.titleQuery;
      await this.getItems();
    },

    async getPostsByType(type) {
      this.fieldFilter.type = type;
      await this.getItems();
    },

    async getNotifications() {
      let res = await postModel("getNotifications", { paginate: 10 });
      this.reports_paging = res.data.data;
      this.reports = res.data.data.data;
    },

    async handleShowReport(type, data) {
      if (type == "App\\Notifications\\ReportPost") {
        this.navigateTo("show-post", data.post_id);
      }
      if (type == "App\\Notifications\\ReportComment") {
        this.comment = data;
        this.$refs["report-comment-modal"].show();
      }
    },
  },
  async mounted() {
    this.checkAdmin();
    this.getItems();
    await this.getNotifications();
  },
});
</script>

<style lang="scss" scoped>
.post-form {
  width: 60%;
}
</style>
