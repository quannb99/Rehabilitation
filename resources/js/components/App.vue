<template>
  <div>
    <nav-bar :user="user" />
    <div class="divider"></div>
    <Navigation :title="'Diễn đàn'"/>
    <example-component :title="title" :content="user" />
    <Footer />
  </div>
</template>

<script>
import Navigation from '../components/Navigation'
export default {
  data() {
    return {
      title: "Example title",
      user: User,
    };
  },

  methods: {

  },

  mounted() {
    console.log("App mounted.");
  },

  created() {
    console.log("App created.");
  },
};
</script>

<style lang="scss">
.divider {
  margin-top: 70px;
}
</style>
