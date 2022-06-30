<template>
  <div>
    <Navigation :title="'Tạo hồ sơ bệnh án'" :page="null" />
    <div class="row col-lg-10 m-auto pt-5">
      <div class="col-lg-8">
        <b-card>
          <b-form class="post-form" @submit.prevent="createMedicalRecord()">
            <h2 class="text-center"><b>BỆNH ÁN PHỤC HỒI CHỨC NĂNG</b></h2>
            <b-form-group
              id="input-group-1"
              label="Chọn người dùng:"
              label-for="input-1"
            >
              <b-form-input
                id="input-1"
                type="text"
                placeholder="Nhập tên người dùng"
                required
                @focus="isInput = true"
                @blur="onInputBlur()"
                @input="getUsersByName()"
                v-model="userNameQuery"
              ></b-form-input>
              <b-list-group v-show="isInput" class="user-select">
                <b-list-group-item
                  button
                  v-for="(item, index) in usersList"
                  :key="index"
                  @click="userSelect(item.id, item.name)"
                  ><b-img
                    style="width: 40px; height: 40px"
                    left
                    :src="item.avatar"
                    rounded="circle"
                    class="mr-2"
                  ></b-img>
                  {{ item.name }}</b-list-group-item
                >
              </b-list-group>
            </b-form-group>

            <div v-if="currentUser">
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
                <!-- <div>
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
              </div> -->
              </div>
              <h5 class="mt-2 mb-3"><b>II. THÔNG TIN BỆNH LÝ</b></h5>
              <b-form-group
                id="input-group-1"
                label="Tình trạng bệnh nhân:"
                label-for="input-1"
              >
                <b-form-textarea
                  id="textarea"
                  v-model="form.status"
                  placeholder="Nhập tình trạng bệnh nhân..."
                  rows="3"
                  max-rows="6"
                  required
                ></b-form-textarea>
              </b-form-group>
              <b-form-group
                id="input-group-2"
                label="Chẩn đoán:"
                label-for="input-2"
              >
                <b-form-textarea
                  id="textarea"
                  v-model="form.diagnose"
                  placeholder="Nhập chẩn đoán..."
                  rows="3"
                  max-rows="6"
                  required
                ></b-form-textarea>
              </b-form-group>
              <b-form-group
                id="input-group-3"
                label="Phương pháp điều trị:"
                label-for="input-3"
              >
                <b-form-textarea
                  id="textarea"
                  v-model="form.method"
                  placeholder="Nhập phương pháp điều trị..."
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
              <!-- <b-form-group id="input-group-3" label="Nội dung:" label-for="input-3">
              <vue-editor v-model="form.content" required/>
            </b-form-group> -->
              <b-button
                size="lg"
                class="float-right"
                type="submit"
                variant="theme"
                ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Tạo hồ
                sơ</b-button
              >
            </div>
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
              class="new-post-btn my-2 my-sm-0"
              @click.prevent="navigateTo('medicalRecordList')"
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
      model: "posts",
      userIdSelected: "",
      usersList: [],
      isInput: false,
      userNameQuery: "",
      currentUser: "",
      authUser: User,
      form: {
        status: "",
        diagnose: "",
        method: "",
        note: "",
      },
    };
  },
  methods: {
    async createMedicalRecord() {
      const form = {
        user_id: this.userIdSelected,
        doctor_id: User.id,
        status: this.form.status,
        diagnose: this.form.diagnose,
        method: this.form.method,
        note: this.form.note,
      };
      try {
        let res = await postModel("medicalRecords", form);
        let id = res.data.data
        this.makeToast("Tạo hồ sơ bệnh án thành công");
        this.navigateTo('showMedicalRecord', id)
      } catch (error) {
        this.handleErr(error);
      }
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

    onInputBlur() {
      setTimeout(() => {
        this.isInput = false;
      }, 100);
    },
    async userSelect(id, name) {
      this.isInput = false;
      this.userIdSelected = id;
      const params = {
        id: id,
      };
      let res = await getModel("users", params);
      this.currentUser = res.data.data.data[0];
      this.userNameQuery = name;
      this.getUsersByName();
    },
    async getUsersByName() {
      const params = {
        role: 1,
        user_name: this.userNameQuery,
      };
      let res = await getModel("users", params);
      this.usersList = res.data.data.data;
    },
    upperCase(value) {
      if (!value) return;
      return value.toUpperCase();
    },
  },
  async mounted() {
    const params = {
      role: 1,
    };
    let res = await getModel("users", params);
    this.usersList = res.data.data.data;
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
