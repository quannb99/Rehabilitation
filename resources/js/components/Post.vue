<template>
  <div>
    <Navigation :title="'Diễn đàn'" :page="'forum'" />
    <message-modal ref="msg-modal"></message-modal>
    <div class="row col-lg-10 m-auto pt-5">
      <div class="col-lg-8">
        <b-list-group>
          <b-list-group-item v-if="items[0]">
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
            </div>
          </b-list-group-item>
          <b-list-group-item v-if="items[0]" v-html="items[0].content">
          </b-list-group-item>
        </b-list-group>
      </div>

      <div class="col-lg-4">
        <b-button
            variant="primary"
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
              variant="primary"
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
    };
  },

  methods: {},
  mounted() {
    this.fieldFilter.id = this.$route.params.id;
    this.getItems();
  },
});
</script>

<style lang="scss" scoped></style>
