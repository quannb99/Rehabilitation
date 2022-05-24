<template>
  <div>
    <b-modal
      ref="cf-modal"
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
          <b-button variant="primary" @click="confirm()"
            >Xác nhận</b-button
          >
          <b-button variant="light" @click="hideModal()"
            >Hủy</b-button
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
      title: "Xác nhận",
    };
  },
  methods: {
    confirm() {
      this.$emit('confirm')
      this.$refs["cf-modal"].hide();
    },

    handleShowMess(mess = "", title = "") {
      this.title = title != "" ? title : 'Xác nhận';
      this.message = mess;
      this.$refs["cf-modal"].show();
    },

    hideModal() {
      this.$refs["cf-modal"].hide();
    },
  },
};
</script>

<style lang="scss">
.modal-backdrop {
  opacity: 0.5;
}
</style>
