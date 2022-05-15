import Vue from "vue";
const BaseComponent = Vue.extend({
  data() {
    return {
      routeName: "",
      model: "",
    };
  },

  mounted() {},

  methods: {
    navigateTo(destination) {
      this.$router
        .push({
          name: destination,
        })
        .catch(() => {});
    },

    handleErr(error) {
      if (error.response.status === 401) window.location = '/'
      const mess = error.response.data.message;
      const title = error.response.data.title;
      this.$refs["msg-modal"].handleShowMess(mess, title)
      console.error(error)
    },
  },

  computed: {},
});

export default BaseComponent;
