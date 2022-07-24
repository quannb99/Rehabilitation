<template>
  <div>
    <Navigation :title="'Chi tiết hoạt động điều trị'" :page="null" />
    <confirm-modal @confirm="handleConfirm" ref="cf-modal"></confirm-modal>
    <message-modal ref="msg-modal"></message-modal>
    <div class="row col-lg-10 m-auto pt-5">
      <div class="col-lg-8">
        <b-card>
          <b-form class="post-form" @submit.prevent="">
           <b-dropdown
              id="ellipsis-dd"
              style="float: right"
              size="lg"
              variant="link"
              toggle-class="text-decoration-none"
              no-caret
              v-if="authUser.id == item.user_id"
            >
              <template #button-content>
                <i
                  style="font-size: 26px"
                  class="fa fa-ellipsis-h"
                  aria-hidden="true"
                ></i>
              </template>
              <b-dropdown-item
                @click.prevent="navigateTo('editTreatment', item.id)"
                v-if="item.user_id == authUser.id"
                href="#"
                >Chỉnh sửa</b-dropdown-item
              >
              <b-dropdown-item
                @click.prevent="
                  showCfModal('Bạn có muốn xóa hoạt động điều trị này?', '', {
                    type: 'delete-treatment',
                  })
                "
                v-if="item.user_id == authUser.id"
                href="#"
                >Xóa</b-dropdown-item
              >
            </b-dropdown>
            <h2 class="text-center" ><b>{{ item.title }}</b></h2>
            <div>
              <p><b>Chế độ:</b> {{ item.privacy == 1 ? 'Công khai' : 'Riêng tư' }}</p>
              <p><b>Độ khó:</b> {{ item.difficulty }}</p>
              <p><b>Mục tiêu:</b> {{ item.objective }}</p>
              <p><b>Phương pháp điều trị:</b><p v-html="item.method"></p></p>
              <p><b>Kết quả mong muốn:</b> {{ item.outcome }}</p>
              <p><b>Ghi chú:</b> {{ item.note }}</p>
            </div>
            <!-- <b-button
              size="lg"
              class="float-right mt-3"
              variant="theme"
              v-if="getRole() == 2 && !isEdit"
              @click="toggleEditMode()"
              ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Chỉnh sửa</b-button
            > -->
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
import { postModel, getModel, updateModel, deleteModel } from "../service";
export default BaseComponent.extend({
  data() {
    return {
      model: "treatments",
      userIdSelected: "",
      usersList: [],
      userNameQuery: "",
      medicalRecord: "",
      currentUser: "",
      authUser: User,
      form: {
        progress: "",
        note: "",
      },
      isEdit: false,
      item: '',
    };
  },
  methods: {
    async handleConfirm(params) {
      if (params.type == 'delete-treatment') {
        try {
          await deleteModel(this.model, this.$route.params.id);
          this.makeToast('Xóa hoạt động điều trị thành công')
          this.navigateTo("treatmentList");
        } catch (error) {
          this.handleErr(error);
        }
      }
    },
    async createProgress() {
      const form = {
        record_id: this.medicalRecord.id,
        progress: this.form.progress,
        note: this.form.note,
      };
      let res = await postModel("progress", form);
      this.medicalRecord.updated_at = res.data.data.created_at;
      this.makeToast("Cập nhật tiến độ thành công");
      this.fieldFilter.record_id = form.record_id;
      this.getItems();
      this.isEdit = false;
    },
    toggleEditMode() {
      this.isEdit = !this.isEdit;
    },
    async getUserById(id) {
      const params = {
        id: id,
      };
      let res = await getModel("users", params);
      this.currentUser = res.data.data.data[0];
    },

    getRole() {
      if (User.id == this.medicalRecord.user_id) return 1;
      if (User.id == this.medicalRecord.doctor_id) return 2;
      return 0;
    },

    getGender(gender) {
      if (gender == 1) {
        return "Nam";
      }
      if (gender == 2) {
        return "Nữ";
      }
      if (!gender) {
        return "Chưa xác định";
      }
    },

    upperCase(value) {
      if (!value) return;
      return value.toUpperCase();
    },
  },
  async mounted() {
    this.fieldFilter.id = this.$route.params.id;
    await this.getItems();
    this.item = this.items[0]
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
</style>
