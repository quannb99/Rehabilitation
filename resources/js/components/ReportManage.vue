<template>
  <div>
    <Navigation :title="'Quản lý báo cáo'" :page="null" />
    <message-modal ref="msg-modal"></message-modal>
    <div class="row col-lg-10 m-auto pt-5">
      <div class="col-lg-8">
        <b-list-group>
          <div class="mb-3" v-if="this.items[0]">
            <h4
              style="display: inline-block"
              v-if="this.fieldFilter.type != null || this.fieldFilter.reportType != null"
            >
              Các báo cáo
              <span v-if="this.fieldFilter.reportType != null">
              {{
                  this.fieldFilter.reportType == 'Post'
                  ? "bài viết"
                  : "bình luận"
              }}
              </span>
              <span v-if="this.fieldFilter.type != null">
              {{
                  this.fieldFilter.type == 1
                  ? "đã giải quyết"
                  : "chưa giải quyết"
              }}
              </span>
            </h4>
            <!-- <h4
              style="display: inline-block"
              v-if="this.fieldFilter.titleQuery"
            >
              Kết quả tìm kiếm bài viết theo từ khóa: "{{
                fieldFilter.titleQuery
              }}":
            </h4> -->
            <b-button
              v-if="this.fieldFilter.type != null || this.fieldFilter.reportType != null"
              @click.prevent="clearFilter()"
              class="float-right"
              variant="theme"
              >Tắt bộ lọc</b-button
            >
          </div>
          <div class="mb-3" v-if="!this.items[0]">
            <h4 style="display: inline-block" v-if="this.fieldFilter.type != null">
              Không có báo cáo nào thỏa mãn bộ lọc
            </h4>
            <b-button
              v-if="this.fieldFilter.type != null || this.fieldFilter.reportType != null"
              @click.prevent="clearFilter()"
              class="float-right"
              variant="theme"
              >Tắt bộ lọc</b-button
            >
            <!-- <h4
              style="display: inline-block"
              v-if="this.fieldFilter.titleQuery"
            >
              Không có kết quả nào khi tìm kiếm bài viết theo từ khóa: "{{
                fieldFilter.titleQuery
              }}"
            </h4> -->
          </div>

          <b-list-group-item
            style="cursor: pointer"
            @click.prevent="handleShowReport(item)"
            v-for="(item, index) in items"
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
                    <span v-if="item.type == 'App\\Notifications\\ReportPost'"
                      >bài viết
                      <span>của {{ item.data.post_user_name }}</span></span
                    >
                    <span
                      v-if="item.type == 'App\\Notifications\\ReportComment'"
                      >bình luận
                      <span>của {{ item.data.comment_user_name }}</span></span
                    >
                    <br />
                    {{ moment(item.created_at).format("HH:mm DD-MM-YYYY") }}
                  </p>
                </div>
              </b-media>
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
        <!-- <b-card class="mt-3">
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
        </b-card> -->
        <b-list-group id="specialists-list" class="mt-3">
          <b-list-group-item
            ><h5><strong>Phân loại</strong></h5></b-list-group-item
          >
          <b-list-group-item v-for="(item, index) in types" :key="index">
            <a href="#" @click.prevent="getReportsByType(item)">{{
              item.text
            }}</a>
            <i v-if="fieldFilter.type == item.value" class="success fa fa-check-square-o" aria-hidden="true"></i>
          </b-list-group-item>
          <b-list-group-item v-for="(item, index) in reportTypes" :key="index + 2">
            <a href="#" @click.prevent="getReportsByReportType(item)">{{
              item.text
            }}</a>
            <i v-if="fieldFilter.reportType == item.value" class="success fa fa-check-square-o" aria-hidden="true"></i>
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
      size="md"
    >
      <div class="d-block text-center">
        <div class="modal-body d-block text-center">
          <div style="width: 100%">
            <b-media tag="li" class="mb-3">
              <!-- <template #aside>
                <b-img
                  :src="comment.comment_user_avatar"
                  width="48"
                  alt="avatar"
                  rounded="circle"
                ></b-img>
              </template> -->

              <div>
                <h6 class="mt-0 mb-1">
                  <strong
                    style="cursor: pointer"
                    @click="navigateTo('otherUserInfo', comment.user_id)"
                  >
                    <b-img
                      :src="comment.comment_user_avatar"
                      width="22"
                      alt="avatar"
                      rounded="circle"
                    ></b-img>
                    {{ comment.comment_user_name }}</strong
                  >
                  đã bình luận vào
                  <a
                    href="#"
                    style="cursor: pointer"
                    @click.prevent="openInNewTab('/posts/' + comment.post_id)"
                    >bài viết</a
                  >
                  với nội dung:<br />
                </h6>
                <p class="mb-1 content-wrap">
                  “<i>{{ comment.content }}</i> ”
                </p>
              </div>
            </b-media>
          </div>
        </div>
        <div class="text-center">
          <b-button
            v-if="isSolved == 0"
            variant="success"
            @click="changeNotiStatus(1)"
            >Đánh dấu đã giải quyết</b-button
          >
          <b-button
            v-if="isSolved == 1"
            variant="success"
            @click="changeNotiStatus(0)"
            >Đánh dấu chưa giải quyết</b-button
          >
          <b-button class="mr-3" variant="danger" @click="openModalConfirm()"
            >Xoá</b-button
          >
        </div>
      </div>
    </b-modal>
    <b-modal
      ref="report-post-modal"
      :title="'Thông tin bài viết'"
      :hide-footer="true"
      :no-close-on-backdrop="true"
      centered
      no-fade
      size="md"
    >
      <div class="d-block text-center">
        <div class="modal-body d-block text-center">
          <div style="width: 100%">
            <b-media tag="li" class="mb-3">
              <!-- <template #aside>
                <b-img
                  :src="comment.comment_user_avatar"
                  width="48"
                  alt="avatar"
                  rounded="circle"
                ></b-img>
              </template> -->

              <div>
                <h6 class="mt-0 mb-1">
                  <strong
                    style="cursor: pointer"
                    @click="navigateTo('otherUserInfo', post.user_id)"
                  >
                    <b-img
                      :src="post.post_user_avatar"
                      width="22"
                      alt="avatar"
                      rounded="circle"
                    ></b-img>
                    {{ post.post_user_name }}</strong
                  >
                  đã tạo
                  <a
                    href="#"
                    style="cursor: pointer"
                    @click.prevent="openInNewTab('/posts/' + post.post_id)"
                    >bài viết</a
                  >
                  với tiêu đề:<br />
                </h6>
                <p class="mb-1 content-wrap">
                  “<i>{{ post.title }}</i> ”
                </p>
              </div>
            </b-media>
          </div>
        </div>
        <div class="text-center">
          <b-button
            v-if="isSolved == 0"
            variant="success"
            @click="changeNotiStatus(1)"
            >Đánh dấu đã giải quyết</b-button
          >
          <b-button
            v-if="isSolved == 1"
            variant="success"
            @click="changeNotiStatus(0)"
            >Đánh dấu chưa giải quyết</b-button
          >
          <b-button
            class="mr-3"
            variant="theme"
            @click="openInNewTab('/posts/' + post.post_id)"
            >Xem bài viết</b-button
          >
        </div>
      </div>
    </b-modal>
    <b-modal
      ref="cf-modal"
      :title="'Xác nhận'"
      :hide-footer="true"
      :no-close-on-backdrop="true"
      centered
      no-fade
      size="md"
    >
      <div class="d-block text-center">
        <div class="modal-body d-block text-center">
          <p>Bạn có muốn xóa bình luận này?</p>
        </div>
        <div class="text-center">
          <b-button variant="primary" @click="deleteComment()"
            >Xác nhận</b-button
          >
          <b-button variant="light" @click="hideModalCf()">Hủy</b-button>
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
      model: "getNotifications",
      types: [
        { text: "Chưa giải quyết", value: 0 },
        { text: "Đã giải quyết", value: 1 },
      ],
      reportTypes: [
        { text: "Báo cáo bài viết", value: 'Post' },
        { text: "Báo cáo bình luận", value: 'Comment' },
      ],
      titleQuery: "",
      reports: "",
      reports_paging: "",
      comment: "",
      commentCreated: "",
      notificationId: "",
      post: "",
      isSolved: "",
    };
  },
  methods: {
    async changeNotiStatus(flag) {
      let form = {
        solved: flag,
        id: this.notificationId,
      };
      await postModel("markNoti", form);
      this.hideModal();
      await this.getItems();
      if (flag == 1) {
        this.makeToast("Đánh dấu đã giải quyết thành công");
      } else {
        this.makeToast("Đánh dấu chưa giải quyết thành công");
      }

    },
    hideModal() {
      this.$refs["report-comment-modal"].hide();
      this.$refs["report-post-modal"].hide();
    },
    hideModalCf() {
      this.$refs["cf-modal"].hide();
    },
    clearFilter() {
      this.fieldFilter.type = null;
      this.fieldFilter.reportType = null;
      this.getItems();
    },
    openModalConfirm() {
      this.$refs["cf-modal"].show();
    },
    async deleteComment() {
      try {
        await deleteModel("comments", this.comment.comment_id);
        // this.$refs["report-comment-modal"].hide();
        this.hideModalCf();
        this.makeToast("Xoá bình luận thành công");
      } catch (error) {
        this.handleErr(error);
      }
    },
    async getPostsByTitle() {
      this.fieldFilter.titleQuery = this.titleQuery;
      await this.getItems();
    },

    async getReportsByType(item) {
      this.fieldFilter.type = item.value;
      await this.getItems();
    },

    async getReportsByReportType(item) {
      this.fieldFilter.reportType = item.value;
      await this.getItems();
    },

    async handleShowReport(item) {
      if (item.type == "App\\Notifications\\ReportPost") {
        // this.navigateTo("show-post", item.data.post_id);
        this.post = item.data;
        this.notificationId = item.id;
        this.isSolved = item.solved;
        this.$refs["report-post-modal"].show();
      }
      if (item.type == "App\\Notifications\\ReportComment") {
        this.comment = item.data;
        this.notificationId = item.id;
        this.isSolved = item.solved;
        this.$refs["report-comment-modal"].show();
      }
    },
  },
  async mounted() {
    await this.checkAdmin();
    this.fieldFilter.type = 0;
    await this.getItems();
  },
});
</script>

<style lang="scss" scoped>
.post-form {
  width: 60%;
}

.success {
  color: #218838;
}
</style>
