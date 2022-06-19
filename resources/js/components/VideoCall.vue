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
    <vue-webrtc ref="webrtc" width="100%" :cameraHeight="authUser.role != 3 ? 550 : 450" :roomId="roomId">
    </vue-webrtc>
    <div class="row">
      <div style="margin: auto" class="text-center col-lg-6 my-4">
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
      opponentUser: '',
    };
  },
  methods: {
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
  async mounted() {
    if (!this.isJoined) {
      this.isJoined = true;
      this.$refs.webrtc.join();
    }
    let ids = this.roomId.split("");
    ids.splice(ids.indexOf(User.id + ""), 1);
    let id = ids.join("");
    let res = await getModel("users", { id: id });
    this.opponentUser = res.data.data.data[0]
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
