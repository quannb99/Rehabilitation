<template>
  <div>
    <Navigation :title="'Tạo hồ sơ bệnh án'" :page="null" />
    <div class="row col-lg-10 m-auto pt-5">
      <div class="col-lg-8">
        <b-card>
          <b-form class="post-form" @submit.prevent="createMedicalRecord()">
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
      model: "posts",
      userIdSelected: "",
      usersList: [],
      isInput: false,
      userNameQuery: "",
    };
  },
  methods: {
    async createMedicalRecord() {
      const form = {
        user_id: this.userIdSelected,
        doctor_id: User.id,
      };
      try {
        await postModel("medicalRecords", form);
        this.makeToast("Tạo hồ sơ bệnh án thành công");
      } catch (error) {
        this.handleErr(error);
      }
    },

    onInputBlur() {
      setTimeout(() => {
        this.isInput = false;
      }, 100);
    },
    userSelect(id, name) {
      this.isInput = false;
      this.userIdSelected = id;
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
