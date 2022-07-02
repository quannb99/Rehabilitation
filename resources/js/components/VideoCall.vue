<template>
  <div>
    <div v-show="!isJoined" class="user-container">
      <div style="width: 150px; margin: auto">
        <b-img
          style="position: absolute; top: 250px; width: 150px; height: 150px"
          center
          :src="authUser.avatar"
          rounded="circle"
          class="mb-2"
        ></b-img>
      </div>
    </div>
    <div class="mt-3"></div>
    <vue-webrtc
      ref="webrtc"
      width="100%"
      :cameraHeight="authUser.role != 3 ? 550 : 450"
      :roomId="roomId"
    >
    </vue-webrtc>
    <div class="row mt-3">
      <div style="margin: auto" class="text-center col-lg-6">
        <b-button
          variant="theme"
          @click="
            setChatParticipant({
              name: opponentUser.name,
              id: opponentUser.id,
              profilePicture: opponentUser.avatar,
            })
          "
        >
          <i class="fa fa-comments" aria-hidden="true"></i>
          Nhắn tin
        </b-button>
        <!-- <button type="button" class="btn btn-primary" @click="onCapture">
          Capture Photo
        </button> -->
        <b-button variant="theme" @click="onShareScreen">
          <i class="fa fa-share-square" aria-hidden="true"></i>
          Chia sẻ màn hình
        </b-button>
        <b-button variant="theme" v-show="!isJoined" @click="onJoin">
          <i class="fa fa-sign-in" aria-hidden="true"></i>
          Bật Camera
        </b-button>
        <b-button v-show="isJoined" variant="danger" @click="onLeave">
          <i class="fa fa-times-circle" aria-hidden="true"></i>
          Tắt Camera
        </b-button>
      </div>
    </div>
    <div
      v-if="authUser.role == 2 && !afterChoose"
      class="col-lg-4 my-3"
      style="margin: auto"
    >
      <b-form-group
        style="display: inline-block; width: 80%"
        id="input-group-1"
        v-if="authUser.role == 2"
      >
        <label for="input-1" class="d-block"
          >Chọn hoạt động điều trị cho {{ opponentUser.name }}</label
        >
        <b-form-input
          id="input-1"
          type="text"
          placeholder="Nhập tiêu đề hoạt động điều trị"
          required
          @focus="isInput = true"
          @blur="onInputBlur()"
          @input="getTreatmentByTitle()"
          v-model="titleQuery"
        ></b-form-input>
        <b-list-group v-show="isInput" class="user-select">
          <b-list-group-item
            button
            v-for="(item, index) in treatmentsList"
            :key="index"
            @click="onSelect(item)"
          >
            <b>{{ item.title }}</b>
            <br />
            <span style="font-size: 14px"
              ><i class="theme-icon fa fa-user-md" aria-hidden="true"></i>
              {{ item.user_name }}</span
            >
          </b-list-group-item>
        </b-list-group>
      </b-form-group>
      <b-button
        style="margin-top: 31px"
        size="md"
        class="float-right"
        variant="success"
        v-if="authUser.role == 2"
        @click="chooseTreatment()"
      >
        Chọn
      </b-button>
    </div>
    <div
      v-if="authUser.role == 2 && afterChoose"
      class="col-lg-6 mt-5 text-center"
      style="margin: auto"
    >
      <h4 class="mb-3">
        <b>Đánh giá hoạt động của {{ opponentUser.name }}</b>
      </h4>
      <b-card
        class="text-left"
        style="width: 65%; margin: auto; border-radius: 12px"
      >
        <h4 class="text-center">{{ treatmentSelected.title }}</h4>
        <h6 class="my-4"><b>Mục tiêu:</b> {{ treatmentSelected.objective }}</h6>
        <h6 class="my-4"><b>Độ khó:</b> {{ treatmentSelected.difficulty }}</h6>
        <b-form-group
          style="display: inline-block; width: 80%"
          id="input-group-1"
        >
          <label for="input-1" class="d-block"
            ><b>Đánh giá mức độ hoàn thành:</b>
            <span>{{ form.rate }}%</span></label
          >
          <b-form-input
            id="input-1"
            type="range"
            max="100"
            min="0"
            placeholder="Nhập đánh giá"
            required
            v-model="form.rate"
          ></b-form-input>
        </b-form-group>
        <b-form-group
          style="display: inline-block; width: 90%"
          id="input-group-1"
        >
          <label for="input-1" class="d-block"><b>Ghi chú:</b></label>
          <b-form-input
            id="input-2"
            type="text"
            placeholder="Nhập ghi chú"
            required
            v-model="form.note"
          ></b-form-input>
        </b-form-group>
        <b-button
          size="md"
          class="float-right"
          variant="success"
          v-if="authUser.role == 2"
          @click="sendRate()"
        >
          <i class="fa fa-paper-plane" aria-hidden="true"></i>
          Gửi đánh giá
        </b-button>
      </b-card>
    </div>
    <div
      v-if="authUser.role == 1 && treatmentChoosed"
      class="col-lg-6 mt-5 text-center"
      style="margin: auto"
    >
      <h5>Hoạt động điều trị đã được bác sĩ chọn:</h5>
      <b-button
        size="md"
        class="mr-3 mb-3"
        variant="theme"
        @click="openInNewTab('/show-treatment/' + treatmentChoosed.id)"
      >
        {{ treatmentChoosed.title }}
      </b-button>
    </div>
    <div
      v-if="authUser.role == 1 && rate"
      class="col-lg-6 mt-5 text-center"
      style="margin: auto"
    >
      <h5>Hoạt động điều trị đã được bác sĩ đánh giá:</h5>
      <b-card
        class="text-left"
        style="width: 65%; margin: auto; border-radius: 12px"
      >
        <h4 style="cursor: pointer" @click="openInNewTab('/show-treatment/' + rate.treatment_id)" class="text-center">{{ rate.title }}</h4>
        <h6 class="my-4"><b>Mục tiêu:</b> {{ rate.objective }}</h6>
        <h6 class="my-4"><b>Độ khó:</b> {{ rate.difficulty }}</h6>
        <h6 class="my-4"><b>Mức độ hoàn thành:</b> {{ rate.rate }}%</h6>
        <h6 class="my-4"><b>Ghi chú:</b> {{ rate.note }}</h6>
      </b-card>
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
      roomId: this.$route.params.id,
      isJoined: false,
      authUser: User,
      opponentId: "",
      opponentUser: "",
      isInput: false,
      treatmentIdSelected: "",
      treatmentsList: '',
      titleQuery: "",
      treatmentChoosed: "",
      treatmentSelected: "",
      afterChoose: "",
      form: {
        rate: 50,
        note: "",
      },
      rate: '',
    };
  },
  methods: {
    resetForm() {
      this.form.rate = 50;
      this.form.note = "";
    },
    async sendRate() {
      const form = {
        ...this.form,
        user_id: this.opponentUser.id,
        doctor_id: window.User.id,
        treatment_id: this.treatmentSelected.id,
      };
      try {
        let res = await postModel("rates", form);
        let id = res.data.data;
        await postModel("sendRate", { id: id, user_id: this.opponentUser.id });
        this.afterChoose = 0;
        this.resetForm();
        this.makeToast("Gửi đánh giá thành công");
      } catch (error) {
        this.handleErr(error);
      }
    },
    async chooseTreatment() {
      if (!this.treatmentIdSelected) return;
      this.titleQuery = "";
      this.getTreatmentByTitle();
      this.afterChoose = 1;
      const form = {
        treatment_id: this.treatmentIdSelected,
        user_id: this.opponentUser.id,
      };
      await postModel("chooseTreatment", form);
    },
    onInputBlur() {
      setTimeout(() => {
        this.isInput = false;
      }, 100);
    },

    async onSelect(item) {
      this.isInput = false;
      this.treatmentIdSelected = item.id;
      this.titleQuery = item.title;
      this.treatmentSelected = item;
      this.getTreatmentByTitle();
    },

    async getTreatmentByTitle() {
      const params = {
        user_id: window.User.id,
        titleQuery: this.titleQuery,
        includeShared: 1,
      };
      let res = await getModel("treatments", params);
      this.treatmentsList = res.data.data.data;
    },
    setChatParticipant(param) {
      this.$emit("setChatParticipant", param);
    },
    onCapture() {
      this.img = this.$refs.webrtc.capture();
    },
    onJoin() {
      this.isJoined = true;
      this.$refs.webrtc.join();
    },
    onLeave() {
      this.$refs.webrtc.leave();
      this.isJoined = false;
    },
    onShareScreen() {
      this.img = this.$refs.webrtc.shareScreen();
    },
    onError(error, stream) {
      console.log("On Error Event", error, stream);
    },
    logEvent(event) {
      console.log("Event : ", event);
    },
  },
  created() {
    window.Echo.private("call-response").listen("CallResponse", async (e) => {
      console.log(e);
      if (this.authUser.id == e.response.user_id) {
        if (e.response.type == "choose") {
          let res = await getModel("treatments", {
            id: e.response.treatment_id,
          });
          this.treatmentChoosed = res.data.data.data[0];
          this.rate = 0;
        }

        if (e.response.type == "rate") {
          let res = await getModel("rates", { id: e.response.id });
          this.rate = res.data.data.data[0];
          this.treatmentChoosed = 0;
        }
      }
    });
  },
  async mounted() {
    if (!this.isJoined) {
      this.isJoined = true;
      this.$refs.webrtc.join();
    }
    let ids = this.roomId.split("");
    ids.splice(ids.indexOf(User.id + ""), 1);
    let id = ids.join("");
    let res = await getModel("users", { id: id });
    this.opponentUser = res.data.data.data[0];
    this.getTreatmentByTitle();
  },
});
</script>

<style lang="scss" scoped>
.user-container {
  width: 100%;
  height: 550px;
  background-color: #262524;
  transition: all 0.5s;
}
</style>
