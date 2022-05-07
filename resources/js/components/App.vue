<template>
  <div>
    <nav-bar :user="user" />
    <div class="py-5"></div>
    <example-component :title="title" :content="user" />
    <Footer />
  </div>
</template>

<script>
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

<style lang="scss"></style>
