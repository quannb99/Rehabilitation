<template>
  <div>
    <nav-bar :user="user" />
    <b-sidebar
      id="sidebar-no-header"
      aria-labelledby="sidebar-no-header-title"
      no-header
      shadow
      :aria-expanded="true"
      visible
      noCloseOnRouteChange
    >
      <template>
        <div class="p-2">
          <b-navbar-brand id="logo-admin" @click="navigateTo('adminHome')">
            <img
              src="../../images/hospital.png"
              class="d-inline-block align-middle logo"
              alt="logo"
            />
            Rehab
          </b-navbar-brand>
          <nav class="mt-2 mb-3">
            <b-nav tabs vertical>
              <b-nav-item>Active</b-nav-item>
              <b-nav-item href="#link-1">Link</b-nav-item>
              <b-nav-item href="#link-2">Another Link</b-nav-item>
            </b-nav>
          </nav>
        </div>
      </template>
    </b-sidebar>
    <message-modal ref="msg-modal"></message-modal>
    <div class="divider"></div>
    <div class="row">
      <div class="col-lg-2"></div>
      <router-view class="col-lg-10" />
    </div>
    <div class="shadow admin-footer"></div>
    <!-- <Footer /> -->
  </div>
</template>

<script>
import BaseComponent from "../base-component";
import { postModel, getModel, updateModel, deleteModel } from "../service";
export default BaseComponent.extend({
  data() {
    return {
      model: "posts",
      user: User,
    };
  },
  mounted() {},
});
</script>

<style lang="scss" scoped></style>
<style lang="scss">
#sidebar-no-header {
  width: 260px;
}
#logo-admin {
  cursor: pointer;
  margin-left: 42px;
}
.admin-footer {
  margin-top: 200px;
  width: 100%;
  height: 80px;
  background-color: #343a40;
}
</style>
