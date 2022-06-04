<template>
  <div>
    <Navigation :title="'Danh sách bác sĩ'" :page="'doctors'" />
    <div class="row col-lg-10 m-auto pt-5">
      <div class="col-lg-8">
        <b-list-group>
          <div class="mb-3" v-if="this.items[0]">
            <h4 style="display: inline-block" v-if="this.fieldFilter.specialist_id">
              Các bác sĩ chuyên khoa {{ items[0].specialist_name }}:
            </h4>
            <h4 style="display: inline-block" v-if="this.fieldFilter.doctor_name">
              Kết quả tìm kiếm bác sĩ theo từ khóa: "{{ fieldFilter.doctor_name }}":
            </h4>
            <b-button
              v-if="this.fieldFilter.specialist_id"
              @click.prevent="clearFilter()"
              class="float-right"
              variant="theme"
              >Tắt bộ lọc</b-button
            >
          </div>
          <div class="mb-3" v-if="!this.items[0]">
            <h4 style="display: inline-block" v-if="this.fieldFilter.specialist_id">
              Hiện không có bác sĩ nào thuộc chuyên khoa {{ specialist_name }}
            </h4>
            <h4 style="display: inline-block" v-if="this.fieldFilter.doctor_name">
              Không có kết quả nào khi tìm kiếm bác sĩ theo từ khóa: "{{ fieldFilter.doctor_name }}"
            </h4>
          </div>

          <b-list-group-item v-for="(item, index) in items" :key="index">
            <div id="doctors-wrap">
              <ul class="list-unstyled mt-3">
                <b-media tag="li" class="mb-3" :key="index">
                  <template #aside>
                    <b-img :src="item.avatar" width="120" alt="avatar"></b-img>
                  </template>
                  <div>
                    <h5>Bác sĩ {{ item.name }}</h5>
                    <h6>
                      Chuyên khoa:
                      <a
                        href="#"
                        @click.prevent="
                          getDoctorsBySpecialist(item.specialist_id)
                        "
                        >{{ item.specialist_name }}</a
                      >
                    </h6>
                  </div>
                </b-media>
              </ul>
            </div>
          </b-list-group-item>
        </b-list-group>
        <div class="mt-5"></div>
        <b-pagination
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
              placeholder="Tìm kiếm bác sĩ theo tên"
              style="width: 80%"
              v-model="doctor_name"
              @input="getDoctorsByName()"
            ></b-form-input>
            <b-button
              @click.prevent="getDoctorsByName()"
              style="width: 15%"
              size="md"
              variant="theme"
              class="my-2 my-sm-0"
              type="submit"
              ><i class="fa fa-search" aria-hidden="true"></i
            ></b-button>
          </b-nav-form>
        </b-card>
        <b-list-group id="specialists-list" class="mt-3">
          <b-list-group-item
            ><h5><strong>Chuyên Khoa</strong></h5></b-list-group-item
          >
          <b-list-group-item v-for="(item, index) in specialists" :key="index">
            <a href="#" @click.prevent="getDoctorsBySpecialist(item.id)">{{
              item.name
            }}</a>
          </b-list-group-item>
        </b-list-group>
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
      model: "users",
      specialists: [],
      specialist_name: '',
      doctor_name: '',
    };
  },
  methods: {
    getDoctorsByName() {
      this.fieldFilter.doctor_name = this.doctor_name;
      this.getItems();
    },

    getDoctorsBySpecialist(id) {
      this.fieldFilter.specialist_id = id;
      this.getItems();
      this.getSpecialistName(id);
    },

    clearFilter() {
      this.fieldFilter.specialist_id = null;
      this.getItems();
    },

    async getSpecialistName(id) {
      const res = await getModel("specialists", {id: id});
      this.specialist_name = res.data.data[0].name;
    }
  },
  async mounted() {
    this.fieldFilter.role = 2;
    this.getItems();
    const res = await getModel("specialists");
    this.specialists = res.data.data;
  },
});
</script>

<style lang="scss" scoped></style>
