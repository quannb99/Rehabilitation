<template>
  <div>
    <Navigation :title="'Dashboard'" :hideHome="true" :page="null" />
    <div class="row pt-5 col-lg-10 m-auto">
      <div class="col-lg-4">
        <b-card class="text-center" style="border-radius: 25px">
          <i
            style="font-size: 60px"
            class="theme-icon fa fa-book"
            aria-hidden="true"
          ></i>
          <p class="mt-2" style="font-size: 30px">
            <b id="count">{{ countInfo.post }}</b>
          </p>
          <p style="font-size: 20px">Bài viết</p>
        </b-card>
      </div>
      <div class="col-lg-4">
        <b-card class="text-center" style="border-radius: 25px">
          <i
            style="font-size: 60px"
            class="theme-icon fa fa-user"
            aria-hidden="true"
          ></i>
          <p class="mt-2" style="font-size: 30px">
            <b>{{ countInfo.user }}</b>
          </p>
          <p style="font-size: 20px">Người dùng</p>
        </b-card>
      </div>
      <div class="col-lg-4">
        <b-card class="text-center" style="border-radius: 25px">
          <i
            style="font-size: 60px"
            class="theme-icon fa fa-user-md"
            aria-hidden="true"
          ></i>
          <p class="mt-2" style="font-size: 30px">
            <b>{{ countInfo.doctor }}</b>
          </p>
          <p style="font-size: 20px">Bác sĩ</p>
        </b-card>
      </div>
      <div class="col-lg-4 mt-5">
        <b-card class="text-center" style="border-radius: 25px">
          <i
            style="font-size: 60px"
            class="theme-icon fa fa-address-book"
            aria-hidden="true"
          ></i>
          <p class="mt-2" style="font-size: 30px">
            <b>{{ countInfo.appointment }}</b>
          </p>
          <p style="font-size: 20px">Lịch hẹn đã đặt</p>
        </b-card>
      </div>
      <div class="col-lg-4 mt-5">
        <b-card class="text-center" style="border-radius: 25px">
          <i
            style="font-size: 60px"
            class="theme-icon fa fa-file-text"
            aria-hidden="true"
          ></i>
          <p class="mt-2" style="font-size: 30px">
            <b>{{ countInfo.record }}</b>
          </p>
          <p style="font-size: 20px">Hồ sơ bệnh án</p>
        </b-card>
      </div>
      <div class="col-lg-4 mt-5">
        <b-card class="text-center" style="border-radius: 25px">
          <i
            style="font-size: 60px"
            class="theme-icon fa fa-flag"
            aria-hidden="true"
          ></i>
          <p class="mt-2" style="font-size: 30px">
            <b>{{ countInfo.report }}</b>
          </p>
          <p style="font-size: 20px">Báo cáo</p>
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
      slide: 0,
      sliding: null,
      countInfo: "",
    };
  },

  methods: {
    onSlideStart(slide) {
      this.sliding = true;
    },
    onSlideEnd(slide) {
      this.sliding = false;
    },
  },

  async mounted() {
    this.checkAdmin();
    let res = await getModel("getDashboard");
    this.countInfo = res.data.data;
  },
});
</script>

<style lang="scss" scoped></style>
