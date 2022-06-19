<template>
  <div>
    <Navigation :title="'Tạo hồ sơ bệnh án'" :page="null" />
    <message-modal ref="msg-modal"></message-modal>
    <div class="row col-lg-10 m-auto pt-5">
      <div class="col-lg-8">
        <b-card>
          <b-form class="post-form" v-show="currentUser" @submit.prevent="">
            <!-- <b-form-group id="input-group-3" label="Nội dung:" label-for="input-3">
              <vue-editor v-model="form.content" required/>
            </b-form-group> -->
            <h2 class="text-center"><b>BỆNH ÁN PHỤC HỒI CHỨC NĂNG</b></h2>
            <h5 class="mt-5 mb-3"><b>I. THÔNG TIN BỆNH NHÂN</b></h5>
            <div class="d-flex">
              <div style="width: 50%">
                <p><b>Họ và tên:</b> {{ upperCase(currentUser.name) }}</p>
                <p v-if="currentUser.birthyear">
                  <b>Năm sinh:</b> {{ currentUser.birthyear }}
                </p>
                <p v-if="currentUser.birthyear">
                  <b>Tuổi:</b>
                  {{ moment().diff(currentUser.birthyear, "years") }}
                </p>
                <p v-if="currentUser.gender">
                  <b>Giới tính:</b> {{ getGender(currentUser.gender) }}
                </p>
                <p v-if="currentUser.phone">
                  <b>Số điện thoại:</b> {{ currentUser.phone }}
                </p>
                <p><b>Email:</b> {{ currentUser.email }}</p>
              </div>
              <div>
                <p>
                  <b>Thời điểm tạo hồ sơ:</b>
                  {{
                    moment(medicalRecord.created_at).format("HH:mm DD-MM-YYYY")
                  }}
                </p>
                <p>
                  <b>Cập nhật lần cuối:</b>
                  {{
                    moment(medicalRecord.updated_at).format("HH:mm DD-MM-YYYY")
                  }}
                </p>
              </div>
            </div>
            <h5 class="mt-2 mb-3"><b>II. THÔNG TIN BỆNH LÝ</b></h5>
            <div>
              <h6><b>Tình trạng bệnh nhân:</b></h6>
              <p>{{ medicalRecord.status }}</p>
              <h6><b>Chẩn đoán bệnh:</b></h6>
              <p>{{ medicalRecord.diagnose }}</p>
              <h6><b>Phương pháp điều trị bệnh:</b></h6>
              <p>{{ medicalRecord.method }}</p>
              <div v-if="medicalRecord.note">
                <h6><b>Ghi chú:</b></h6>
                <p>{{ medicalRecord.note }}</p>
              </div>
            </div>
            <div v-if="isEdit">
              <h5 class="mt-2 mb-3"><b>III. TIẾN ĐỘ HỒI PHỤC</b></h5>
              <b-form @submit.prevent="createProgress()">
                <b-form-group
                  id="input-group-4"
                  label="Tiến độ:"
                  label-for="input-4"
                >
                  <b-form-textarea
                    id="textarea"
                    v-model="form.progress"
                    placeholder="Nhập tiến độ..."
                    rows="3"
                    max-rows="6"
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
                    rows="3"
                    max-rows="6"
                  ></b-form-textarea>
                </b-form-group>
                <b-button
                  size="lg"
                  class="float-right"
                  type="submit"
                  variant="theme"
                  v-if="getRole() == 2 && isEdit"
                  ><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                  Lưu</b-button
                >
              </b-form>
            </div>
            <div v-if="!isEdit">
              <h5 class="mt-2 mb-3"><b>III. TIẾN ĐỘ HỒI PHỤC</b></h5>
              <b-list-group>
                <b-list-group-item v-for="(item, index) in items" :key="index">
                  <h6 class="d-inline-block"><b>Tiến độ phục hồi:</b></h6>
                  <span class="float-right"
                    ><i class="theme-icon fa fa-clock-o" aria-hidden="true"></i>
                    {{
                      moment(item.created_at).format("HH:mm DD-MM-YYYY")
                    }}</span
                  >
                  <p>{{ item.progress }}</p>
                  <div v-if="item.note">
                    <h6><b>Ghi chú:</b></h6>
                    <p>{{ item.note }}</p>
                  </div>
                </b-list-group-item>
              </b-list-group>
              <b-pagination
              class="mt-3"
                pills
                v-if="paging.last_page > 1"
                v-model="paging.current_page"
                :total-rows="paging.total"
                :per-page="paging.per_page"
                align="center"
                @input="changePage"
              ></b-pagination>
            </div>
            <b-button
              size="lg"
              class="float-right mt-3"
              variant="theme"
              v-if="getRole() == 2 && !isEdit"
              @click="toggleEditMode()"
              ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Cập
              nhật</b-button
            >
          </b-form>
        </b-card>
      </div>

      <div class="col-lg-4">
        <b-card>
          <b-nav-form id="search-form">
            <b-button
              style="width: 100%"
              size="lg"
              variant="theme"
              class="my-2 my-sm-0"
              ><i class="fa fa-history" aria-hidden="true"></i>
              Hồ sơ đã tạo
            </b-button>
          </b-nav-form>
        </b-card>
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
      model: "progress",
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
    };
  },
  methods: {
    async createProgress() {
      const form = {
        record_id: this.medicalRecord.id,
        progress: this.form.progress,
        note: this.form.note,
      };
      let res = await postModel("progress", form);
      console.log(res);
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
    const params = {
      id: this.$route.params.id,
    };
    let res = await getModel("medicalRecords", params);
    this.medicalRecord = res.data.data.data[0];
    if (this.getRole() == 0) {
      this.navigateTo("home");
    }
    await this.getUserById(this.medicalRecord.user_id);
    this.fieldFilter.record_id = this.$route.params.id;
    this.getItems();
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
