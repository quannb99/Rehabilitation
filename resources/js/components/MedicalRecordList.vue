<template>
  <div>
    <Navigation :title="'Tạo hồ sơ bệnh án'" :page="null" />
    <div class="row col-lg-10 m-auto pt-5">
      <div class="col-lg-8">
        <b-list-group>
          <b-list-group-item
            style="cursor: pointer"
            @click.prevent="navigateTo('showMedicalRecord', item.id)"
            v-for="(item, index) in listRecords"
            :key="index"
          >
            <h4>Hồ sơ bệnh án của bệnh nhân {{ item.user_name }}</h4>
            <i class="fa fa-user-md" aria-hidden="true"></i> Bác sĩ {{ item.doctor_name }} · <i class="fa fa-refresh" aria-hidden="true"></i> Cập nhật lúc {{ moment(item.updated_at).format("HH:mm DD-MM-YYYY") }}
          </b-list-group-item>
        </b-list-group>
        <div class="mt-5"></div>
        <b-pagination
          pills
          v-if="paging.last_page > 1"
          v-model="paging.current_page"
          :total-rows="paging.total"
          :per-page="paging.per_page"
          align="center"
          @input="changePage"
        ></b-pagination>
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
      medicalRecord: "",
      currentUser: "",
      authUser: User,
      form: {
        status: "",
        diagnose: "",
        method: "",
      },
      listRecords: "",
      recordsPaging: "",
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
    if (User.role == 1) {
      const params = {
        user_id: User.id,
      };
      let res = await getModel("medicalRecords", params);
      this.recordsPaging = res.data.data;
      this.listRecords = res.data.data.data;
    }
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
.user-select {
  overflow-y: auto;
  height: 197px;
  position: absolute;
  width: 50%;
  z-index: 1000;
}
</style>
