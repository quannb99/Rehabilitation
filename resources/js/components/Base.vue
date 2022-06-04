<template>
  <div></div>
</template>

<script>
import BaseComponent from "../base-component";
import { postModel, getModel, updateModel, deleteModel } from "../service";
export default BaseComponent.extend({
  data() {
    return {
      model: "posts",
    };
  },
  mounted() {
  },
});
</script>

<style lang="scss" scoped></style>
