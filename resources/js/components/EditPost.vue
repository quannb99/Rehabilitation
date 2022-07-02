<template>
  <div>
    <Navigation :title="'Diễn đàn'" :page="'forum'"/>
    <message-modal ref="msg-modal"></message-modal>
    <div class="row col-lg-10 m-auto pt-5">
      <div class="col-lg-9">
        <b-card>
          <b-form class="post-form" @submit.prevent="updatePost()">
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
            <b-button size="lg" class="float-right" type="submit" variant="theme"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Lưu thay đổi </b-button>
          </b-form>
        </b-card>
      </div>

      <div class="col-lg-3">

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
    async updatePost() {
      try {
        let id = this.fieldFilter.id
        let res = await updateModel(this.model, this.form, id)
        this.makeToast('Sửa bài viết thành công')
        this.navigateTo('show-post', id)
      } catch (error) {
        this.handleErr(error)
      }
    }
  },
  mounted() {
    this.fieldFilter.id = this.$route.params.id;
    this.getItems().then(() => {
      const res = this.items[0]
      this.form.title = res.title
      this.form.content = res.content
      this.form.type = res.type
    })
  },
});
</script>

<style lang="scss" scoped>
@import "~vue2-editor/dist/vue2-editor.css";

/* Import the Quill styles you want */
@import '~quill/dist/quill.core.css';
@import '~quill/dist/quill.bubble.css';
@import '~quill/dist/quill.snow.css';

.mt-30 {
  margin-top: 30px;
}
</style>
