<template>
  <div>
    <Navigation :title="'Tạo hồ sơ bệnh án'" :page="null" />
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
                <p>Họ và tên: {{ upperCase(currentUser.name) }}</p>
                <p v-if="currentUser.birthyear">
                  Năm sinh: {{ currentUser.birthyear }}
                </p>
                <p v-if="currentUser.birthyear">
                  Tuổi: {{ moment().diff(currentUser.birthyear, "years") }}
                </p>
                <p v-if="currentUser.gender">
                  Giới tính: {{ getGender(currentUser.gender) }}
                </p>
                <p v-if="currentUser.phone">
                  Số điện thoại: {{ currentUser.phone }}
                </p>
                <p>Email: {{ currentUser.email }}</p>
              </div>
              <div>
                <p>
                  Thời điểm tạo hồ sơ:
                  {{
                    moment(medicalRecord.created_at).format("HH:mm DD-MM-YYYY")
                  }}
                </p>
                <p>
                  Cập nhật lần cuối:
                  {{
                    moment(medicalRecord.updated_at).format("HH:mm DD-MM-YYYY")
                  }}
                </p>
              </div>
            </div>
            <h5 class="mt-2 mb-3"><b>II. THÔNG TIN KHÁM CHỮA BỆNH</b></h5>
            <h6>Tình trạng bệnh nhân:</h6>
            <p>{{ medicalRecord.status }}</p>
            <h6>Chẩn đoán bệnh:</h6>
            <p>{{ medicalRecord.diagnose }}</p>
            <h6>Phương pháp điều trị bệnh:</h6>
            <p>{{ medicalRecord.method }}</p>
            <div v-if="medicalRecord.note">
              <h6>Ghi chú:</h6>
              <p>{{ medicalRecord.note }}</p>
            </div>
            <b-button
              size="lg"
              class="float-right"
              type="submit"
              variant="theme"
              ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Cập nhật</b-button
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
import { VueEditor } from "vue2-editor/dist/vue2-editor.core.js";
export default BaseComponent.extend({
  components: { VueEditor },
  data() {
    return {
      model: "posts",
      userIdSelected: "",
      usersList: [],
      isInput: false,
      userNameQuery: "",
      medicalRecord: "",
      currentUser: "",
      authUser: User,
      form: {
        status: "",
        diagnose: "",
        method: "",
      },
    };
  },
  methods: {
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
  },
});
</script>

<style lang="scss" scoped>
@import "~vue2-editor/dist/vue2-editor.css";

/* Import the Quill styles you want */
@import "~quill/dist/quill.core.css";
@import "~quill/dist/quill.bubble.css";
@import "~quill/dist/quill.snow.css";

.user-select {
  overflow-y: auto;
  height: 197px;
  position: absolute;
  width: 50%;
  z-index: 1000;
}
</style>
