<template>
  <div>
    <Navigation :title="'Diễn đàn'" :page="'forum'" :title2="'Đăng bài mới'" :page2="'new-post'" />
    <message-modal ref="msg-modal"></message-modal>
    <div class="row col-lg-10 m-auto pt-5">
      <div class="col-lg-8">
        <b-card>
          <b-form class="post-form" @submit.prevent="addPost()">
            <b-form-group
              id="input-group-1"
              label="Tiêu đề:"
              label-for="input-1"
            >
              <b-form-input
                id="input-1"
                v-model="form.title"
                type="text"
                placeholder="Nhập tiêu đề"
                required
              ></b-form-input>
            </b-form-group>
            <b-form-group id="input-group-2" label="Loại:" label-for="input-2">
              <b-form-select
                id="input-2"
                v-model="form.type"
                :options="types"
                required
              ></b-form-select>
            </b-form-group>
            <b-form-group id="input-group-3" label="Nội dung:" label-for="input-3">
              <vue-editor v-model="form.content" required/>
            </b-form-group>
            <b-button size="lg" class="float-right" type="submit" variant="primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Đăng bài</b-button>
          </b-form>
        </b-card>
      </div>

      <div class="col-lg-4">
        <b-card>
          <b-nav-form id="search-form">
            <b-form-input
              size="md"
              class="mr-3"
              placeholder="Tìm kiếm bài viết"
              style="width: 80%;"
            ></b-form-input>
            <b-button  style="width: 15%;" size="md" variant="primary" class="my-2 my-sm-0" type="submit"
              ><i class="fa fa-search" aria-hidden="true"></i></b-button
            >
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
      form: {
        user_id: User.id,
        title: "",
        content: "",
        type: "Chung",
      },
      types: [
        { text: "Chung", value: "Chung" },
        "Hỏi đáp",
        "Chia sẻ",
        "Thảo luận",
        "Tin tức",
      ],
    };
  },

  methods: {
    async addPost() {
      try {
        await postModel(this.model, this.form)
        console.log('ok')
      } catch (error) {
        this.handleErr(error)
      }
    }
  },
});
</script>

<style lang="scss" scoped>
@import "~vue2-editor/dist/vue2-editor.css";

/* Import the Quill styles you want */
@import '~quill/dist/quill.core.css';
@import '~quill/dist/quill.bubble.css';
@import '~quill/dist/quill.snow.css';
.post-form {
  // width: 60%;
}

#search-form {
  flex-flow: row !important;
  width: 100%;
}

.mt-30 {
  margin-top: 30px;
}
</style>
