<template>
  <div>
    <b-modal
      ref="msg-modal"
      :title="title"
      :hide-footer="true"
      :no-close-on-backdrop="true"
      centered
      no-fade
      size="md"
    >
      <div class="d-block text-center">
        <div class="modal-body d-block text-center">
          <p>{{ message }}</p>
        </div>
        <div class="text-center">
          <b-button variant="primary" @click="hideModal()"
            >Xác nhận</b-button
          >
        </div>
      </div>
    </b-modal>
  </div>
</template>

<script>
export default {
  data() {
    return {
      message: "",
      title: "",
    };
  },
  methods: {
    handleShowMess(mess = "", title = "") {
      this.title = title != "" ? title : mess;
      this.message = mess;
      this.$refs["msg-modal"].show();
    },

    hideModal() {
      this.$refs["msg-modal"].hide();
    },
  },
};
</script>

<style lang="scss">
.modal-backdrop {
  opacity: 0.5;
}
</style>
