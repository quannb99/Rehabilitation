<template>
  <div>
    <Navigation :title="'Diễn đàn'" :page="'forum'" />
    <div class="row col-lg-10 m-auto pt-5">
      <div class="col-lg-8">
        <b-list-group id="posts-container">
          <h3 v-if="items[0]">Bài viết của bạn</h3>
          <b-list-group-item
            style="cursor: pointer"
            @click.prevent="navigateTo('show-post', item.id)"
            v-for="(item, index) in items"
            :key="index"
          >
            <h4>{{ item.title }}</h4>
            <div class="d-flex">
              <img
                style="height: 120px"
                :src="item.image ? item.image : previewImages[index]"
                alt=""
              />
              <div class="preview" v-html="item.content"></div>
            </div>
            <div>
              <b-img
                :src="item.user_avatar"
                width="20"
                alt="avatar"
                rounded="circle"
              ></b-img>
              <!-- <i
                v-if="item.user_role == 2"
                class="theme-icon-20 fa fa-user-md"
                aria-hidden="true"
              ></i> -->
              <strong class="mr-2" style="font-size: 14px"
                ><span v-if="item.user_role == 2">Bs. </span>
                {{ item.user_name }}</strong
              >
              <i class="ml-1 theme-icon fa fa-clock-o" aria-hidden="true"></i>
              <span style="font-size: 14px"
                ><b>{{ moment(item.created_at).fromNow() }}</b>
              </span>
              <i class="ml-3 theme-icon fa fa-tag" aria-hidden="true"></i>
              <span style="font-size: 14px"
                ><b>{{ item.type }}</b>
              </span>
            </div>
          </b-list-group-item>
          <hr class="mt-5" />
        </b-list-group>
        <b-list-group class="mt-2">
          <h3 v-if="items[0] && User.role == 1">Hồ sơ bệnh án của bạn</h3>
          <h3 v-if="items[0] && User.role == 2">Hồ sơ bệnh án bạn đã tạo</h3>

          <b-list-group-item
            style="cursor: pointer"
            @click.prevent="navigateTo('showMedicalRecord', item.id)"
            v-for="(item, index) in medicalRecords"
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
          <hr class="mt-5" />
        </b-list-group>
        <b-list-group class="mt-2" v-if="User.role == 1">
          <h3 v-if="items[0]">Lịch sử đánh giá hoạt động của bạn</h3>
          <b-list-group-item
            style="cursor: pointer"
            @click.prevent="chooseItem(item)"
            v-for="(item, index) in evaluations"
            :key="index"
          >
            <h4>{{ item.title }}</h4>
            <b-progress :max="100">
              <b-progress-bar
                :value="item.rate"
                :label="`${item.rate}%`"
                variant="theme"
              ></b-progress-bar>
            </b-progress>
            <div class="mt-2">
              <!-- <b-img
                :src="item.user_avatar"
                width="20"
                alt="avatar"
                rounded="circle"
              ></b-img> -->
              <i class="theme-icon-20 fa fa-user-md" aria-hidden="true"></i>
              <strong class="mr-2" style="font-size: 14px"
                ><span>Bs. </span> {{ item.doctor_name }}</strong
              >
              <!-- <i class="ml-1 theme-icon fa fa-star" aria-hidden="true"></i>
              <span style="font-size: 14px"
                ><b>{{ item.rate }}%</b>
              </span> -->
              <i class="ml-2 theme-icon fa fa-clock-o" aria-hidden="true"></i>
              <span style="font-size: 14px"
                ><b>{{ moment(item.created_at).fromNow() }}</b>
              </span>
            </div>
          </b-list-group-item>
          <hr class="mt-5" />
        </b-list-group>
        <b-list-group class="mt-2" v-if="User.role == 2">
          <h3 v-if="items[0] && User.role == 2">
            Hoạt động điều trị bạn đã tạo
          </h3>
          <b-list-group-item
            style="cursor: pointer"
            @click.prevent="navigateTo('showTreatment', item.id)"
            v-for="(item, index) in treatments"
            :key="index"
          >
            <h4>{{ item.title }}</h4>
            <a
              class="mr-2"
              @click.stop
              target="_blank"
              :href="'/user-info/' + item.user_id"
              ><i class="theme-icon-20 fa fa-user-md" aria-hidden="true"></i>
              Bác sĩ {{ item.user_name }}</a
            >
            <span style="font-size: 14px" v-if="item.privacy == 1"
              ><i class="theme-icon fa fa-globe" aria-hidden="true"></i> Công
              khai</span
            >
            <span style="font-size: 14px" v-if="item.privacy == 2"
              ><i class="theme-icon fa fa-lock" aria-hidden="true"></i> Riêng
              tư</span
            >
            <span style="font-size: 14px" class="ml-2"
              ><i class="theme-icon fa fa-clock-o" aria-hidden="true"></i>
              {{ moment(item.created_at).format("HH:mm DD-MM-YYYY") }}</span
            >
          </b-list-group-item>
          <hr class="mt-5" />
        </b-list-group>
        <div class="mt-5"></div>
        <!-- <b-pagination
          pills
          v-if="paging.last_page > 1"
          v-model="paging.current_page"
          :total-rows="paging.total"
          :per-page="paging.per_page"
          align="center"
          @input="changePage"
        ></b-pagination> -->
      </div>

      <!-- <div class="col-lg-4">
        <b-button
          variant="theme"
          class="new-post-btn mt-3"
          @click="navigateTo('new-post')"
          style="font-size: 18px"
          ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Đăng bài
          mới</b-button
        >
        <b-card class="mt-3">
          <b-nav-form id="search-form">
            <b-form-input
              size="md"
              class="mr-3"
              placeholder="Tìm kiếm theo tiêu đề"
              style="width: 80%"
              v-model="titleQuery"
              @input="getPostsByTitle()"
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
        <b-list-group id="specialists-list" class="mt-3">
          <b-list-group-item
            ><h5><strong>Phân loại</strong></h5></b-list-group-item
          >
          <b-list-group-item v-for="(item, index) in types" :key="index">
            <a href="#" @click.prevent="getPostsByType(item)">{{ item }}</a>
            <i
              v-if="fieldFilter.type == item"
              class="success fa fa-check-square-o"
              aria-hidden="true"
            ></i>
          </b-list-group-item>
        </b-list-group>
      </div> -->
    </div>
    <b-modal
      ref="info-modal"
      :title="'Thông tin đánh giá'"
      :hide-footer="true"
      :no-close-on-backdrop="true"
      centered
      no-fade
      size="lg"
    >
      <div class="d-block text-center">
        <div class="modal-body d-block text-center">
          <b-card
            class="text-left"
            style="width: 100%; margin: auto; border-radius: 12px"
          >
            <h4
              style="cursor: pointer"
              @click="
                openInNewTab('/show-treatment/' + selectedItem.treatment_id)
              "
              class="text-center"
            >
              {{ selectedItem.title }}
            </h4>
            <h6 class="my-4"><b>Mục tiêu:</b> {{ selectedItem.objective }}</h6>
            <h6 class="my-4"><b>Độ khó:</b> {{ selectedItem.difficulty }}</h6>
            <h6 class="my-4">
              <b>Mức độ hoàn thành:</b> {{ selectedItem.rate }}%
            </h6>
            <h6 class="my-4"><b>Ghi chú:</b> {{ selectedItem.note }}</h6>
          </b-card>
        </div>
        <div class="text-center">
          <b-button class="mr-3" variant="theme" @click="hideModal()"
            >Đóng</b-button
          >
        </div>
      </div>
    </b-modal>
  </div>
</template>

<script>
import BaseComponent from "../base-component";
import { postModel, getModel, updateModel, deleteModel } from "../service";

export default BaseComponent.extend({
  data() {
    return {
      model: "posts",
      types: ["Chung", "Hỏi đáp", "Chia sẻ", "Thảo luận", "Tin tức"],
      titleQuery: "",
      selectedItem: "",
      previewImages: [
        "../../images/preview/1.jpg",
        "../../images/preview/2.jpg",
        "../../images/preview/3.jpg",
        "../../images/preview/4.jpg",
        "../../images/preview/5.jpg",
        "../../images/preview/6.jpg",
        "../../images/preview/7.jpg",
        "../../images/preview/8.jpg",
        "../../images/preview/9.jpg",
        "../../images/preview/10.jpg",
      ],
      medicalRecords: [],
      evaluations: [],
      treatments: [],
      User: User,
    };
  },
  methods: {
    shuffleImages() {
      this.previewImages = _.shuffle(this.previewImages);
    },
    chooseItem(item) {
      this.selectedItem = item;
      this.$refs["info-modal"].show();
    },
    hideModal() {
      this.$refs["info-modal"].hide();
    },
    clearFilter() {
      this.fieldFilter.type = null;
      this.shuffleImages();
      this.getItems();
    },
    async getPostsByTitle() {
      this.fieldFilter.titleQuery = this.titleQuery;
      this.shuffleImages();
      await this.getItems();
    },

    async getPostsByType(type) {
      this.fieldFilter.type = type;
      this.shuffleImages();
      await this.getItems();
    },
  },
  async mounted() {
    this.shuffleImages();
    this.fieldFilter.user_id = window.User.id;
    await this.getItems();
    if (User.role == 1) {
      const form = {
        user_id: window.User.id,
      };
      let res = await getModel("medicalRecords", form);
      this.medicalRecords = res.data.data.data;

      res = await getModel("rates", form);
      this.evaluations = res.data.data.data;
    }

    if (User.role == 2) {
      const form = {
        doctor_id: window.User.id,
      };
      let res = await getModel("medicalRecords", form);
      this.medicalRecords = res.data.data.data;

      res = await getModel("treatments", {
        user_id: window.User.id,
      });
      this.treatments = res.data.data.data;
    }

  },
});
</script>

<style lang="scss" scoped>
.preview {
  overflow-y: hidden;
  height: 116px;
  font-weight: 300;
  padding-left: 20px;
}
.post-form {
  width: 60%;
}

#posts-container .list-group-item {
  margin-bottom: 10px;
  border-radius: 15px;
  border-top-width: 1px !important;
}
</style>

<style>
.preview h1 {
  display: none !important;
}
.preview h2 {
  display: none !important;
}
.preview h3 {
  display: none !important;
}
.preview h4 {
  display: none !important;
}
.preview h5 {
  display: none !important;
}
.preview h6 {
  display: none !important;
}
</style>
