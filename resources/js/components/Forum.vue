<template>
  <div>
    <Navigation :title="'Diễn đàn'" :link="'/forum'" />
    <b-button @click="navigateTo('new-post')">Đăng bài mới</b-button>
  </div>
</template>

<script>
import BaseComponent from "../base-component";
export default BaseComponent.extend({
  data() {
    return {
      model: 'posts',
    };
  },
});
</script>

<style lang="scss" scoped>
.post-form {
  width: 60%;
}
</style>
