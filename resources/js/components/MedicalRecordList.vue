<template>
  <div>
    <Navigation :title="'Danh sách hồ sơ bệnh án'" :page="null" />
    <message-modal ref="msg-modal"></message-modal>
    <div class="row col-lg-10 m-auto pt-5">
      <div class="col-lg-8">
        <b-list-group>
          <b-list-group-item
            style="cursor: pointer"
            @click.prevent="navigateTo('showMedicalRecord', item.id)"
            v-for="(item, index) in items"
            :key="index"
          >
            <h4>Hồ sơ bệnh án của bệnh nhân {{ item.user_name }}</h4>
            <p>
              <i class="theme-icon fa fa-stethoscope" aria-hidden="true"></i>
              Chẩn đoán: {{ item.diagnose }}
            </p>
            <a
              @click.stop
              target="_blank"
              :href="'/user-info/' + item.doctor_id"
              ><i class="theme-icon-20 fa fa-user-md" aria-hidden="true"></i>
              Bác sĩ {{ item.doctor_name }}</a
            >
            <span class="float-right"
              ><i class="theme-icon fa fa-refresh" aria-hidden="true"></i> Cập
              nhật lúc
              {{ moment(item.updated_at).format("HH:mm DD-MM-YYYY") }}</span
            >
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
            <b-form-input
              size="md"
              class="mr-3"
              placeholder="Tìm kiếm"
              style="width: 80%"
            ></b-form-input>
            <b-button
              style="width: 15%"
              size="md"
              variant="theme"
              class="my-2 my-sm-0"
              type="submit"
              ><i class="fa fa-search" aria-hidden="true"></i
            ></b-button>
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
      model: "medicalRecords",
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
      this.fieldFilter.user_id = User.id
      await this.getItems();
    }
    if (User.role == 2) {
      this.fieldFilter.doctor_id = User.id
      await this.getItems();
    }

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
