<template>
  <div>
    <vue-webrtc ref="webrtc" width="100%" :roomId="roomId"> </vue-webrtc>
    <div class="row">
      <div class="col-md-12 my-3">
        <button type="button" class="btn btn-primary" @click="onJoin">
          Tham gia
        </button>
        <button type="button" class="btn btn-primary" @click="onLeave">
          Rời khỏi
        </button>
        <button type="button" class="btn btn-primary" @click="onCapture">
          Capture Photo
        </button>
        <button type="button" class="btn btn-primary" @click="onShareScreen">
          Chia sẻ màn hình
        </button>
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
      roomId: this.$route.params.id
    };
  },
  methods: {
      onCapture() {
        this.img = this.$refs.webrtc.capture();
      },
      onJoin() {
        this.$refs.webrtc.join();
      },
      onLeave() {
        this.$refs.webrtc.leave();
      },
      onShareScreen() {
        this.img = this.$refs.webrtc.shareScreen();
      },
      onError(error, stream) {
        console.log('On Error Event', error, stream);
      },
      logEvent(event) {
        console.log('Event : ', event);
      },
    },
  mounted() {},
});
</script>

<style lang="scss" scoped></style>
