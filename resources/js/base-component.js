import Vue from "vue";
const BaseComponent = Vue.extend({
  data() {
    return {
      routeName: "",
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
  },

  computed: {},
});

export default BaseComponent;
