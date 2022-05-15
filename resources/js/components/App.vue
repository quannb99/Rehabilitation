<template>
  <div>
    <nav-bar :user="user" />
    <div class="divider"></div>
    <router-view />
    <!-- <example-component :title="title" :content="user" /> -->
    <Footer />
  </div>
</template>

<script>
import BaseComponent from '../base-component'
export default BaseComponent.extend({
  data() {
    return {
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

</style>
