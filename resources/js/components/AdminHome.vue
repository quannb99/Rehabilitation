<template>
  <div>
    <h3>Admin Dashboard</h3>
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

  mounted() {},
});
</script>

<style lang="scss" scoped></style>
