<template>
  <div>
    <Navigation :title="'Diễn đàn'" :page="'forum'" />
    <message-modal ref="msg-modal"></message-modal>
    <confirm-modal @confirm="deletePost(items[0].id)" ref="cf-modal"></confirm-modal>
    <div class="row col-lg-10 m-auto pt-5">
      <div class="col-lg-8">
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
                @click.prevent="showCfModal('Bạn có muốn xóa bài viết này?')"
                v-if="items[0].user_id == User.id"
                href="#"
                >Xóa bài viết</b-dropdown-item
              >
              <b-dropdown-item v-if="items[0].user_id != User.id" href="#"
                >Báo cáo bài viết</b-dropdown-item
              >
            </b-dropdown>
            <h2>
              <strong>{{ items[0].title }}</strong>
            </h2>
            <div>
              <i
                v-if="items[0].user_role == 1"
                class="theme-icon-20 fa fa-user"
                aria-hidden="true"
              ></i>
              <i
                v-if="items[0].user_role == 2"
                class="theme-icon-20 fa fa-user-md"
                aria-hidden="true"
              ></i>
              <strong class="mr-2" style="font-size: 14px"
                ><span v-if="items[0].user_role == 2">Bs. </span>
                {{ items[0].user_name }}</strong
              >
              <i class="theme-icon fa fa-calendar" aria-hidden="true"></i>
              <span style="font-size: 14px">{{
                moment(items[0].created_at).format("L")
              }}</span>
              <b-badge style="font-size: 82%; cursor: pointer;" variant="theme">{{
                items[0].type
              }}</b-badge>
            </div>
          </b-list-group-item>
          <b-list-group-item v-if="items[0]" v-html="items[0].content">
          </b-list-group-item>
        </b-list-group>
        <b-list-group class="mt-4">
          <b-list-group-item> Comments </b-list-group-item>
        </b-list-group>
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
    };
  },

  methods: {
    async deletePost(id) {
      try {
        await deleteModel(this.model, id)
        this.navigateTo('forum')
      } catch (error) {
        this.handleErr(error)
      }
    },
  },
  mounted() {
    this.fieldFilter.id = this.$route.params.id;
    this.getItems();
  },
});
</script>

<style lang="scss">
@import "../../../node_modules/bootstrap/scss/bootstrap";
@import "../../../node_modules/bootstrap-vue/src/index.scss";

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
</style>
