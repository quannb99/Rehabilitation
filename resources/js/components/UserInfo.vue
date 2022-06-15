<template>
  <div>
    <Navigation :title="'Thông tin cá nhân'" :page="'userInfo'" />
    <message-modal ref="msg-modal"></message-modal>
    <div class="row col-lg-10 m-auto pt-5">
      <div class="col-lg-4">
        <b-card class="text-center" v-if="!isEditMode">
          <b-img
            style="width: 200px; height: 200px"
            center
            :src="user.avatar"
            rounded="circle"
            onerror="this.src = '../../images/user-default-ava.jpg'; this.onerror='';"
          ></b-img>
          <br />
          <h5>Ảnh đại diện</h5>
        </b-card>
        <b-card class="text-center" v-if="isEditMode">
          <b-img
            center
            :src="previewImage ? previewImage : user.avatar"
            style="width: 200px; height: 200px; border-radius: 50%"
          ></b-img>
          <b-form-file
            class="mt-3 mb-3"
            v-model="file"
            :state="Boolean(file)"
            accept=".jpg, .png, .gif, .jpeg"
            placeholder="Chọn ảnh đại diện"
            plain
            @change="uploadImage"
          ></b-form-file>
          <br />
        </b-card>
      </div>

      <div class="col-lg-8">
        <b-card class="text-left" v-if="!isEditMode">
          <h2 class="mb-4" style="display: inline-block">
            Thông tin tài khoản
          </h2>
          <b-button
            variant="theme"
            class="float-right"
            @click="toggleEditMode()"
            ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Chỉnh
            sửa</b-button
          >
          <h6 class="mb-3"><strong>Họ tên: </strong>{{ user.name }}</h6>
          <h6 class="mb-3"><strong>Email: </strong>{{ user.email }}</h6>
          <h6 class="mb-3">
            <strong>Số điện thoại: </strong
            >{{ user.phone ? user.phone : "Chưa xác định" }}
          </h6>
          <h6 class="mb-3">
            <strong>Vai trò: </strong>{{ getRole(user.role) }}
          </h6>
          <h6 class="mb-3">
            <strong>Giới tính: </strong>{{ getGender(user.gender) }}
          </h6>
          <h6 class="mb-3">
            <strong>Năm sinh: </strong
            >{{ user.birthyear ? user.birthyear : "Chưa xác định" }}
          </h6>
          <h6 class="mb-3" v-if="user.specialist_id">
            <strong>Chuyên khoa: </strong>{{ specialist_name }}
          </h6>
        </b-card>
        <b-card class="text-left" v-if="isEditMode">
          <h2 class="mb-4" style="display: inline-block">
            Chỉnh sửa thông tin tài khoản
          </h2>
          <b-button
            variant="theme"
            type="submit"
            class="float-right"
            @click.prevent="saveInfo()"
            ><i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu
          </b-button>
          <b-form class="post-form">
            <b-form-group
              id="input-group-1"
              label="Họ tên:"
              label-for="input-1"
            >
              <b-form-input
                id="input-1"
                v-model="user.name"
                type="text"
                placeholder="Nhập họ tên"
                required
              ></b-form-input>
            </b-form-group>
            <b-form-group
              id="input-group-4"
              label="Số điện thoại:"
              label-for="input-4"
            >
              <b-form-input
                id="input-4"
                v-model="user.phone"
                type="text"
                placeholder="Nhập số điện thoại"
                :state="phoneState"
                required
              ></b-form-input>
              <b-form-invalid-feedback id="input-4">
                Nhập đúng số điện thoại
              </b-form-invalid-feedback>
            </b-form-group>
            <b-form-group
              id="input-group-2"
              label="Giới tính:"
              label-for="input-2"
            >
              <b-form-select
                id="input-2"
                v-model="user.gender"
                :options="genders"
                required
              ></b-form-select>
            </b-form-group>
            <b-form-group
              id="input-group-3"
              label="Năm sinh:"
              label-for="input-3"
            >
              <date-picker
                v-model="user.birthyear"
                :default-value="user.birthyear + ''"
                type="year"
                valueType="YYYY"
              ></date-picker>
            </b-form-group>
          </b-form>
        </b-card>
      </div>
    </div>
  </div>
</template>

<script>
import BaseComponent from "../base-component";
import { postModel, getModel, updateModel, deleteModel } from "../service";
import DatePicker from "vue2-datepicker";
import "vue2-datepicker/index.css";
import "vue2-datepicker/locale/vi";
export default BaseComponent.extend({
  components: { DatePicker },
  data() {
    return {
      model: "posts",
      user: _.cloneDeep(User),
      isEditMode: false,
      genders: {
        1: "Nam",
        2: "Nữ",
      },
      file: [],
      previewImage: null,

      specialist_name: "",
    };
  },
  computed: {
    phoneState() {
      let regex =
        /^(0?)(3[2-9]|5[6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])[0-9]{7}$/;
      return regex.test(this.user.phone) ? null : false;
    },
  },
  methods: {
    async getSpecialistName(id) {
      let res = await getModel("specialists", { id: id });
      this.specialist_name = res.data.data[0].name;
    },
    uploadImage(e) {
      const image = e.target.files[0];
      const reader = new FileReader();
      reader.readAsDataURL(image);
      reader.onload = (e) => {
        this.previewImage = e.target.result;
        this.user.avatar = this.previewImage;
      };
    },
    async saveInfo() {
      if (this.phoneState == false) return;
      try {
        let formData = new FormData();
        for (var key in this.user) {
          formData.append(key, this.user[key]);
        }
        formData.append("image", this.file);
        formData.append("_method", "PUT");
        await axios.post(`/users/${this.user.id}`, formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        });
        // await updateModel("users", this.user, this.user.id);
        this.makeToast("Cập nhật thông tin thành công");
        this.toggleEditMode();
      } catch (e) {
        this.handleErr(e);
      }
    },

    toggleEditMode() {
      this.isEditMode = !this.isEditMode;
      this.previewImage = null;
    },

    getRole(role) {
      if (role == 1) {
        return "Người dùng";
      }
      if (role == 2) {
        return "Bác sĩ";
      }
      if (role == 3) {
        return "Quản trị viên";
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
  },

  async created() {},

  async mounted() {
    await this.getSpecialistName(this.user.specialist_id);
  },
});
</script>

<style lang="scss" scoped></style>
