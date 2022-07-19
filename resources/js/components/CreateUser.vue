<template>
  <div>
    <Navigation :title="'Tạo người dùng mới'" :page="null" />
    <message-modal ref="msg-modal"></message-modal>
    <div class="row col-lg-10 m-auto pt-5">
      <div class="col-lg-4">
        <b-card class="text-center">
          <b-img
            v-if="user.avatar"
            center
            :src="previewImage ? previewImage : user.avatar"
            style="width: 200px; height: 200px; border-radius: 50%"
            onerror="this.src = '../../images/user-default-ava.jpg'; this.onerror='';"
          ></b-img>
          <b-img
            v-if="!previewImage"
            center
            :src="'../../images/user-default-ava.jpg'"
            style="width: 200px; height: 200px; border-radius: 50%"
            onerror="this.src = '../../images/user-default-ava.jpg'; this.onerror='';"
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
        <b-card class="text-left">
          <h2 class="mb-4" style="display: inline-block">
            Tạo tài khoản mới
          </h2>
          <b-form class="post-form" @submit.prevent="saveInfo()">
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
            <b-form-group id="input-group-1" label="Email:" label-for="input-1">
              <b-form-input
                id="input-1"
                v-model="user.email"
                type="email"
                placeholder="Nhập email"
                required
              ></b-form-input>
            </b-form-group>

            <b-form-group
              id="input-group-2"
              label="Vai trò:"
              label-for="input-2"
            >
              <b-form-select
                id="input-2"
                v-model="user.role"
                :options="roles"
                required
              ></b-form-select>
            </b-form-group>
            <b-form-group
              v-if="user.role == 2"
              id="input-group-2"
              label="Chuyên khoa:"
              label-for="input-2"
            >
              <b-form-select
                id="input-2"
                v-model="user.specialist_id"
                :options="specialists"
                required
              ></b-form-select>
            </b-form-group>

            <b-form-group
              id="input-group-5"
              label="Mật khẩu:"
              label-for="input-5"
            >
              <b-form-input
                id="input-5"
                v-model="user.password"
                type="password"
                placeholder="Nhập mật khẩu"
                required
              ></b-form-input>
              <!-- <b-form-invalid-feedback id="input-4">
                Nhập đúng số điện thoại
              </b-form-invalid-feedback> -->
            </b-form-group>
            <b-button
              variant="theme"
              type="submit"
              class="float-right"
              ><i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu
            </b-button>
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
var md5 = require("md5");
export default BaseComponent.extend({
  components: { DatePicker },
  data() {
    return {
      model: "posts",
      user: {},
      authUser: User,
      isEditMode: false,
      genders: {
        1: "Nam",
        2: "Nữ",
      },
      roles: {
        1: "Nguời dùng",
        2: "Bác sĩ",
      },
      file: [],
      previewImage: null,
      specialist_name: "",
      specialists: [],
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
    async deactive() {
      let form = {
        deactive: 1,
      };
      this.user.deactive = 1;
      await updateModel("users", form, this.user.id);
      this.makeToast("Vô hiệu hóa tài khoản thành công");
    },
    async active() {
      let form = {
        active: 1,
      };
      this.user.deactive = 0;
      await updateModel("users", form, this.user.id);
      this.makeToast("Kích hoạt tài khoản thành công");
    },
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
      if (this.phoneState == false) {
        this.user.phone = "";
      }
      if (this.user.role == 1) {
        this.user.specialist_id = ''
      }
      try {
        let formData = new FormData();
        for (var key in this.user) {
          if (this.user[key]) {
            formData.append(key, this.user[key]);
          }
        }
        formData.append("image", this.file);
        await axios.post(`/users`, formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        });
        // await updateModel("users", this.user, this.user.id);
        this.makeToast("Tạo người dùng mới thành công");
        this.user.password = "";
        this.navigateTo('userManage')
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

  async mounted() {
    this.checkAdmin()
    let temp = await getModel("specialists");
      this.specialists = temp.data.data.map((item) => {
        let temp = {}
        temp.value = item.id
        temp.text = item.name
        return temp
      })
  },
});
</script>

<style lang="scss" scoped></style>
