<template>
  <div>
    <nav-bar :user="user" />
    <div class="divider"></div>
    <router-view />
    <example-component :title="title" :content="user" />
    <Footer />
  </div>
</template>

<script>
import BaseComponent from '../base-component'
export default BaseComponent.extend({
  data() {
    return {
      title: "Example title",
      user: User,
    };
  },

  methods: {

  },

  mounted() {

  },

  created() {

  },
});
</script>

<style lang="scss">
.divider {
  margin-top: 70px;
}
</style>
