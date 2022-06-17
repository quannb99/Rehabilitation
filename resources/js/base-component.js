import Vue from "vue";
import { postModel, getModel, deleteModel, updateModel } from "./service";
const BaseComponent = Vue.extend({
  data() {
    return {
      routeName: "",
      model: "",
      fieldFilter: {},
      paging: {},
      isLoading: true,
      items: [],
    };
  },

  mounted() {},

  methods: {
    navigateTo(destination, id) {
      if (destination == null) return;
      this.$router
        .push({
          name: destination,
          params: { id: id },
        })
        .catch(() => {});
    },

    async getItems(model = this.model, page = 1) {
      this.isLoading = true;
      let params = { ...this.fieldFilter, page };
      try {
        const res = await getModel(model, params);
        const data = res.data.data;
        this.setPagingInformation(data);
        if (!_.isEmpty(data)) {
          this.items = data.data.map((item, index) => {
            return { ...item, index: this.getIndexOfItemInPage(index) }
          });
        }
      } catch (error) {
        this.handleErr(error)
      }
    },

    changePage(current_page) {
      this.getItems(this.model, current_page);
    },

    getIndexOfItemInPage(index) {
      if (this.paging.current_page == 1) return index + 1;
      return (this.paging.current_page - 1) * this.paging.per_page + (index + 1)
    },

    setPagingInformation(data) {
      const { current_page, from, last_page, last_page_url, next_page_url, per_page, to, total } = data;
      this.paging = { ...this.paging, current_page, from, last_page, last_page_url, next_page_url, per_page, to, total, }
    },

    handleErr(error) {
        if (error.response.status === 401) window.location = '/'
        const mess = error.response.data.message;
        const title = error.response.data.title;
        this.$refs["msg-modal"].handleShowMess(mess, title)
        console.error(error)
    },

    showCfModal(msg, title, params) {
      this.$refs["cf-modal"].handleShowMess(msg, title, params)
    },

    makeToast(msg) {
      this.$bvToast.toast(msg, {
        title: "Thông báo",
        autoHideDelay: 5000,
        toaster: 'b-toaster-bottom-right',
      });
    },
  },

  computed: {},
});

export default BaseComponent;
