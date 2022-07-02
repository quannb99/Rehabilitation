<template>
  <div>
    <Navigation :title="'Tạo hoạt động điều trị'" :page="null" />
    <div class="row col-lg-10 m-auto pt-5">
      <div class="col-lg-8">
        <b-card>
          <b-form class="post-form" @submit.prevent="updateTreatment()">
            <h2 class="text-center"><b>HOẠT ĐỘNG ĐIỀU TRỊ</b></h2>
            <div>
              <b-form-group
                id="input-group-1"
                label="Tiêu đề:"
                label-for="input-1"
              >
                <b-form-textarea
                  id="textarea"
                  v-model="form.title"
                  placeholder="Nhập tiêu đề cho hoạt động điều trị..."
                  rows="1"
                  max-rows="3"
                  required
                ></b-form-textarea>
              </b-form-group>
              <b-form-group
                id="input-group-2"
                label="Chế độ:"
                label-for="input-2"
              >
                <b-form-select
                  id="input-2"
                  v-model="form.privacy"
                  :options="privacies"
                  required
                ></b-form-select>
              </b-form-group>
              <b-form-group
                id="input-group-2"
                label="Độ khó:"
                label-for="input-2"
              >
                <b-form-select
                  id="input-2"
                  v-model="form.difficulty"
                  :options="difficulties"
                  required
                ></b-form-select>
              </b-form-group>
              <b-form-group
                id="input-group-2"
                label="Mục tiêu:"
                label-for="input-2"
              >
                <b-form-textarea
                  id="textarea"
                  v-model="form.objective"
                  placeholder="Nhập mục tiêu..."
                  rows="1"
                  max-rows="3"
                  required
                ></b-form-textarea>
              </b-form-group>
              <b-form-group
                id="input-group-3"
                label="Phương pháp điều trị:"
                label-for="input-3"
              >
                <vue-editor v-model="form.method" required />
              </b-form-group>

              <b-form-group
                id="input-group-2"
                label="Kết quả mong muốn:"
                label-for="input-2"
              >
                <b-form-textarea
                  id="textarea"
                  v-model="form.outcome"
                  placeholder="Nhập kết quả đầu ra mong muốn..."
                  rows="1"
                  max-rows="3"
                  required
                ></b-form-textarea>
              </b-form-group>
              <b-form-group
                id="input-group-4"
                label="Ghi chú:"
                label-for="input-4"
              >
                <b-form-textarea
                  id="textarea"
                  v-model="form.note"
                  placeholder="Nhập ghi chú..."
                  rows="1"
                  max-rows="3"
                ></b-form-textarea>
              </b-form-group>
              <b-button
                size="lg"
                class="float-right"
                type="submit"
                variant="theme"
                ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Lưu
                hoạt động</b-button
              >
            </div>
          </b-form>
        </b-card>
      </div>

      <div class="col-lg-4">
        <b-button
          variant="theme"
          class="new-post-btn mb-3"
          @click="navigateTo('treatmentList')"
          style="font-size: 18px"
          ><i class="fa fa-history" aria-hidden="true"></i> Hoạt động điều trị đã tạo</b-button
        >
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
      model: "treatments",
      userIdSelected: "",
      usersList: [],
      isInput: false,
      userNameQuery: "",
      currentUser: "",
      authUser: User,
      difficulties: [
        '1',
        '2',
        '3',
        '4',
        '5',
      ],
      privacies: [
        {text: 'Công khai', value: '1'},
        {text: 'Riêng tư', value: '2'},
      ],

      form: {
        title: "",
        objective: "",
        method: "",
        note: "",
        difficulty: '3',
        privacy: '1',
        outcome: '',
      },
    };
  },
  methods: {
    upperCase(value) {
      if (!value) return;
      return value.toUpperCase();
    },
    async updateTreatment() {
      try {
        let id = this.fieldFilter.id
        let res = await updateModel(this.model, this.form, id)
        this.makeToast('Sửa hoạt động điều trị thành công')
        this.navigateTo('showTreatment', id)
      } catch (error) {
        this.handleErr(error)
      }
    }
  },
  async mounted() {
    this.fieldFilter.id = this.$route.params.id;
    this.getItems().then(() => {
      const res = this.items[0]
      this.form.title = res.title
      this.form.objective = res.objective
      this.form.method = res.method
      this.form.note = res.note
      this.form.difficulty = res.difficulty
      this.form.privacy = res.privacy
      this.form.outcome = res.outcome
    })
  },
});
</script>

<style lang="scss" scoped>
@import "~vue2-editor/dist/vue2-editor.css";

.user-select {
  overflow-y: auto;
  height: 197px;
  position: absolute;
  width: 50%;
  z-index: 1000;
}
</style>
