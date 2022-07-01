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
    <div class="row">
      <div style="margin: auto" class="text-center col-lg-6">
        <b-button variant="theme" v-show="!isJoined" @click="onJoin">
          <i class="fa fa-sign-in" aria-hidden="true"></i>
          Tham gia
        </b-button>
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
        <b-button variant="danger" @click="onLeave">
          <i class="fa fa-times-circle" aria-hidden="true"></i>
          Rời khỏi
        </b-button>
      </div>
    </div>
    <div v-if="authUser.role == 2" class="col-lg-6 mt-5" style="margin: auto">
      <b-form-group
        style="display: inline-block; width: 90%"
        id="input-group-1"
        label="Chọn hoạt động điều trị:"
        label-for="input-1"
        v-if="authUser.role == 2"
      >
        <b-form-input
          id="input-1"
          type="text"
          placeholder="Thêm hoạt động điều trị"
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
            @click="onSelect(item.id, item.title)"
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
    <div v-if="authUser.role == 1 && treatmentChoosed" class="col-lg-6 mt-5 text-center" style="margin: auto">
      <h5>Hoạt động điều trị đã được bác sĩ chọn:</h5>
      <b-button
        size="md"
        class="mr-3 mb-3"
        variant="theme"
        @click="openInNewTab('/show-treatment/'+ treatmentChoosed.id)"
      >
        {{ treatmentChoosed.title }}
      </b-button>
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
      treatmentsList: [],
      titleQuery: "",
      treatmentChoosed: "",
    };
  },
  methods: {
    async chooseTreatment() {
      const form = {
        treatment_id: this.treatmentIdSelected,
        user_id: this.opponentUser.id,
      };
      await postModel("chooseTreatment", form);
      this.titleQuery = "";
      this.getTreatmentByTitle();
    },
    onInputBlur() {
      setTimeout(() => {
        this.isInput = false;
      }, 100);
    },

    async onSelect(id, title) {
      this.isInput = false;
      this.treatmentIdSelected = id;
      // const params = {
      //   id: id,
      // };
      // let res = await getModel("users", params);
      // this.currentUser = res.data.data.data[0];
      this.titleQuery = title;
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
        let res = await getModel("treatments", { id: e.response.treatment_id });
        this.treatmentChoosed = res.data.data.data[0];
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
