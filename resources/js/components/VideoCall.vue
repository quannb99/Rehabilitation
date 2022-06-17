<template>
  <div>
    <vue-webrtc ref="webrtc" width="100%" roomId="sample-room"> </vue-webrtc>
    <div class="row">
      <div class="col-md-12 my-3">
        <button type="button" class="btn btn-primary" @click="onJoin">
          Join
        </button>
        <button type="button" class="btn btn-primary" @click="onLeave">
          Leave
        </button>
        <button type="button" class="btn btn-primary" @click="onCapture">
          Capture Photo
        </button>
        <button type="button" class="btn btn-primary" @click="onShareScreen">
          Share Screen
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import BaseComponent from "../base-component";
import { postModel, getModel, updateModel, deleteModel } from "../service";
// import * as io from 'socket.io-client'
// window.io = io
export default BaseComponent.extend({
  data() {
    return {
      model: "posts",
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
