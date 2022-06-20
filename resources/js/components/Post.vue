<template>
  <div>
    <Navigation :title="'Diễn đàn'" :page="'forum'" />
    <confirm-modal @confirm="handleConfirm" ref="cf-modal"></confirm-modal>
    <div class="row col-lg-10 m-auto pt-5">
      <div class="col-lg-8">
        <h3 v-if="items.length == 0">Không tồn tại bài viết này</h3>
        <b-list-group>
          <b-list-group-item v-if="items[0]">
            <b-dropdown
              id="ellipsis-dd"
              style="float: right"
              size="lg"
              variant="link"
              toggle-class="text-decoration-none"
              no-caret
            >
              <template #button-content>
                <i
                  style="font-size: 26px"
                  class="fa fa-ellipsis-h"
                  aria-hidden="true"
                ></i>
              </template>
              <b-dropdown-item
                @click.prevent="navigateTo('edit-post', items[0].id)"
                v-if="items[0].user_id == User.id"
                href="#"
                >Sửa bài viết</b-dropdown-item
              >
              <b-dropdown-item
                @click.prevent="
                  showCfModal('Bạn có muốn xóa bài viết này?', '', {
                    type: 'delete-post',
                  })
                "
                v-if="items[0].user_id == User.id || User.role == 3"
                href="#"
                >Xóa bài viết</b-dropdown-item
              >
              <b-dropdown-item
                @click="reportPost()"
                v-if="items[0].user_id != User.id && User.role != 3"
                href="#"
                >Báo cáo bài viết</b-dropdown-item
              >
            </b-dropdown>
            <h2>
              <strong>{{ items[0].title }}</strong>
            </h2>
            <div>
              <b-img
                :src="items[0].user_avatar"
                width="20"
                alt="avatar"
                rounded="circle"
              ></b-img>
              <strong class="mr-2" style="font-size: 14px"
                ><span v-if="items[0].user_role == 2">Bs. </span>
                {{ items[0].user_name }}</strong
              >
              <i class="theme-icon fa fa-calendar" aria-hidden="true"></i>
              <span style="font-size: 14px">{{
                moment(items[0].created_at).format("L")
              }}</span>

              <b-badge
                class="ml-2 float-right"
                style="font-size: 100%; cursor: pointer"
                variant="theme"
              >
                <i class="fa fa-tag" aria-hidden="true"></i>
                {{ items[0].type }}</b-badge
              >
            </div>
          </b-list-group-item>
          <b-list-group-item v-if="items[0]" v-html="items[0].content">
          </b-list-group-item>
        </b-list-group>
        <b-list-group v-if="items[0]" class="mt-4">
          <b-list-group-item>
            <h4>
              Bình luận
              <span v-if="commentPaging.total"
                >({{ commentPaging.total }})</span
              >
            </h4>
          </b-list-group-item>
          <b-list-group-item>
            <b-form-textarea
              @keydown.enter="handleEnter"
              id="textarea-state"
              v-model="content"
              placeholder="Viết bình luận..."
              rows="3"
              max-rows="5"
              no-resize
            ></b-form-textarea>
            <div id="comments-wrap">
              <ul class="list-unstyled mt-3">
                <b-media
                  tag="li"
                  class="mb-3"
                  v-for="(comment, index) in comments"
                  :key="index"
                >
                  <template #aside>
                    <b-img
                      :src="comment.user_avatar"
                      width="48"
                      alt="avatar"
                      rounded="circle"
                    ></b-img>
                  </template>
                  <div :id="'textarea-' + index" style="display: none">
                    <b-form-textarea
                      @keydown.enter="handleEditComment($event, index)"
                      v-model="comments[index].content"
                      placeholder="Viết bình luận... (Bấm Ctrl+Enter để gửi)"
                      rows="3"
                      max-rows="5"
                      no-resize
                    ></b-form-textarea>
                  </div>

                  <div :id="'comment-' + index">
                    <b-dropdown
                      id="ellipsis-dd"
                      style="float: right"
                      size="lg"
                      variant="link"
                      toggle-class="text-decoration-none"
                      no-caret
                    >
                      <template #button-content>
                        <i
                          style="font-size: 14px"
                          class="fa fa-caret-down"
                          aria-hidden="true"
                        ></i>
                      </template>
                      <b-dropdown-item
                        @click.prevent="editComment(index)"
                        v-if="comment.user_id == User.id"
                        href="#"
                        >Sửa bình luận</b-dropdown-item
                      >
                      <b-dropdown-item
                        @click.prevent="
                          showCfModal('Bạn có muốn xóa bình luận này?', '', {
                            type: 'delete-comment',
                            id: comment.id,
                          })
                        "
                        v-if="comment.user_id == User.id || User.role == 3"
                        href="#"
                        >Xóa bình luận</b-dropdown-item
                      >
                      <b-dropdown-item
                      @click="reportComment(comment.id)"
                        v-if="comment.user_id != User.id && User.role != 3"
                        href="#"
                        >Báo cáo bình luận</b-dropdown-item
                      >
                    </b-dropdown>

                    <h6 class="mt-0 mb-1">
                      <strong>
                        <span v-if="comment.user_role == 2">Bs. </span
                        >{{ comment.user_name }}
                      </strong>
                    </h6>

                    <p class="mb-1 content-wrap">
                      {{ comment.content }}
                    </p>
                    <p class="mb-0" style="font-size: 15px">
                      <a
                        v-if="!comment.liked"
                        href="#"
                        @click.prevent="handleLike(index)"
                        class="liked"
                      >
                        <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                      </a>
                      <a
                        v-if="comment.liked"
                        href="#"
                        @click.prevent="handleLike(index)"
                        class="not-liked"
                      >
                        <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                      </a>
                      {{ comment.likes_count }} &nbsp;·&nbsp;
                      <!-- <i style="color: #898f96;" class="fa fa-clock-o" aria-hidden="true"></i> -->
                      <span style="font-size: 14px">{{
                        moment(comment.created_at).fromNow()
                      }}</span>
                    </p>
                  </div>
                </b-media>
              </ul>
              <b-pagination
                pills
                v-if="commentPaging.last_page > 1"
                v-model="commentPaging.current_page"
                :total-rows="commentPaging.total"
                :per-page="commentPaging.per_page"
                align="center"
                @input="changeCommentPage"
              ></b-pagination>
            </div>
          </b-list-group-item>
        </b-list-group>
      </div>

      <div class="col-lg-4">
        <b-button
          variant="theme"
          class="new-post-btn"
          @click="navigateTo('new-post')"
          ><i
            style="font-size: 20px"
            class="fa fa-pencil-square-o"
            aria-hidden="true"
          ></i>
          <span style="font-size: 20px">Đăng bài mới</span>
        </b-button>
        <b-card class="mt-3">
          <b-nav-form id="search-form">
            <b-form-input
              size="md"
              class="mr-3"
              placeholder="Tìm kiếm bài viết"
              style="width: 80%"
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
import { VueEditor } from "vue2-editor/dist/vue2-editor.core.js";
import { postModel, getModel, updateModel, deleteModel } from "../service";
export default BaseComponent.extend({
  components: { VueEditor },
  data() {
    return {
      model: "posts",
      User: User,
      content: "",
      comments: {},
      commentPaging: {},
    };
  },

  methods: {
    async reportPost() {
      await postModel("reportPost", {
        id: this.fieldFilter.id,
        user_id: User.id,
      });
      this.makeToast("Báo cáo bài viết thành công");
    },
    async reportComment(id) {
      await postModel("reportComment", {
        id: id,
        user_id: User.id,
      });
      this.makeToast("Báo cáo bình luận thành công");
    },
    async handleLike(index) {
      if (!this.comments[index].liked) {
        try {
          const form = {
            user_id: User.id,
            comment_id: this.comments[index].id,
          };
          await postModel("likes", form);
          await this.getComments();
        } catch (error) {
          this.handleErr(error);
        }
      } else {
        try {
          await deleteModel("likes", this.comments[index].liked.id);
          await this.getComments();
        } catch (error) {
          this.handleErr(error);
        }
      }
    },
    editComment(index) {
      document.getElementById("comment-" + index).style.display = "none";
      document.getElementById("textarea-" + index).style.display = "block";
    },
    changeCommentPage(page) {
      this.getComments(page);
    },
    async getComments(page = 1) {
      const params = {
        post_id: this.$route.params.id,
        page: page,
      };
      let res = await getModel("comments", params);
      this.commentPaging = res.data.data;
      this.comments = this.commentPaging.data;
    },
    async handleEnter(e) {
      if (e.ctrlKey) {
        try {
          const form = {
            user_id: User.id,
            post_id: this.$route.params.id,
            content: this.content,
          };
          this.content = "";
          await postModel("comments", form);
          await this.getComments();
        } catch (error) {
          this.handleErr(error);
        }
      }
    },
    async handleEditComment(e, index) {
      if (e.ctrlKey) {
        try {
          const form = {
            user_id: User.id,
            post_id: this.$route.params.id,
            content: this.comments[index].content,
          };
          await updateModel("comments", form, this.comments[index].id);
          document.getElementById("comment-" + index).style.display = "block";
          document.getElementById("textarea-" + index).style.display = "none";
          this.makeToast("Sửa bình luận thành công");
        } catch (error) {
          this.handleErr(error);
        }
      }
    },
    async handleConfirm(params) {
      if (params.type == "delete-post") {
        try {
          await deleteModel(this.model, this.$route.params.id);
          // this.makeToast('Xóa bài viết thành công')
          this.navigateTo("forum");
        } catch (error) {
          this.handleErr(error);
        }
      }

      if (params.type == "delete-comment") {
        try {
          await deleteModel("comments", params.id);
          this.makeToast("Xóa bình luận thành công");
          await this.getComments();
        } catch (error) {
          this.handleErr(error);
        }
      }
    },
  },
  async mounted() {
    this.fieldFilter.id = this.$route.params.id;
    await this.getItems();
    this.getComments();
  },
});
</script>

<style lang="scss">
@import "../../../node_modules/bootstrap/scss/bootstrap";
@import "../../../node_modules/bootstrap-vue/src/index.scss";

.content-wrap {
  font-size: 18px;
  word-break: break-word;
  max-height: 160px;
  overflow: auto;
}

#ellipsis-dd button.dropdown-toggle {
  padding: 0;
  width: 30px;
  height: 30px;
  border-radius: 50%;
  color: #95a5a6;
}
#ellipsis-dd button.dropdown-toggle:hover {
  color: #7f8c8d;
}
#comments-wrap div.media-body {
  background: #e6e6e6;
  padding: 10px;
  border-radius: 10px;
}
.liked {
  color: #898f96;
  transition: all 0.5s;
}
.liked:hover {
  color: #3f97da;
}

.not-liked {
  color: #3f97da;
  transition: all 0.5s;
}
.not-liked:hover {
  color: #898f96;
}
</style>
