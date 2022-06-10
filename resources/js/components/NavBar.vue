<template>
  <div>
    <b-navbar
      id="navbar"
      class="navbar"
      fixed="top"
      toggleable="lg"
      type="dark"
      variant="dark"
    >
      <b-navbar-brand style="cursor: pointer" @click="navigateTo('home')">
        <img
          src="../../images/hospital.png"
          class="d-inline-block align-middle logo"
          alt="logo"
        />
        Rehab
      </b-navbar-brand>

      <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

      <b-collapse id="nav-collapse" is-nav>
        <b-navbar-nav class="nav-container">
          <b-nav-item @click="navigateTo('forum')">Diễn đàn</b-nav-item>
          <b-nav-item v-if="user.role == 2" @click="navigateTo('schedule')"
            >Lịch làm việc</b-nav-item
          >
          <b-nav-item @click="navigateTo('doctors')"
            >Danh sách bác sĩ</b-nav-item
          >
          <!-- <b-nav-item href="#" disabled>Disabled</b-nav-item> -->
        </b-navbar-nav>

        <!-- Right aligned nav items -->
        <b-navbar-nav class="ml-auto">
          <!-- <b-nav-form  v-if="user != null">
            <b-form-input
              size="sm"
              class="mr-sm-2"
              placeholder="Search"
            ></b-form-input>
            <b-button size="sm" class="my-2 my-sm-0" type="submit"
              >Search</b-button
            >
          </b-nav-form> -->

          <b-button
            @click="navigateToPage('login')"
            style="margin-right: 1rem"
            v-if="user == null"
            size="md"
            class="my-2 my-sm-0"
            >Đăng nhập</b-button
          >
          <b-button
            @click="navigateToPage('register')"
            v-if="user == null"
            size="md"
            class="my-2 my-sm-0"
            >Đăng ký</b-button
          >

          <b-nav-item-dropdown size="md" right no-caret class="msg-history">
            <template #button-content>
              <b-button pill
                ><i
                  style="font-size: 20px"
                  class="fa fa-comments"
                  aria-hidden="true"
                ></i
              ></b-button>
            </template>
            <b-dropdown-item
              v-for="(item, index) in messagesHistory"
              :key="index"
              href="#"
              @click.prevent="
                setChatParticipant({
                  name: item.user_name,
                  id: item.user_id,
                  profilePicture: item.avatar,
                })
              "
            >
              <div>
                <b-media>
                  <template #aside>
                    <b-img
                      :src="item.avatar"
                      width="48"
                      alt="avatar"
                      rounded="circle"
                    ></b-img>
                  </template>

                  <h5>{{ item.user_name }}</h5>
                  <div class="d-flex">
                    <p class="ellipsis-text">
                      {{ item.content }}
                    </p>
                    <span>{{ moment(item.created_at).fromNow() }}</span>
                  </div>
                </b-media>
              </div>
            </b-dropdown-item>
          </b-nav-item-dropdown>
          <b-nav-item-dropdown
            right
            v-if="user != null"
            style="margin-top: 6px"
          >
            <!-- Using 'button-content' slot -->
            <template #button-content>
              {{ user ? user.name : "" }}
            </template>
            <b-dropdown-item href="#">Profile</b-dropdown-item>
            <b-dropdown-item @click="logOut()">Đăng xuất</b-dropdown-item>
          </b-nav-item-dropdown>
        </b-navbar-nav>
      </b-collapse>
    </b-navbar>
  </div>
</template>

<script>
import BaseComponent from "../base-component";
import { postModel, getModel, updateModel, deleteModel } from "../service";
export default BaseComponent.extend({
  props: {
    user: {
      default: null,
    },
  },

  data() {
    return {
      messagesHistory: [],
    };
  },

  methods: {
    logOut() {
      document.getElementById("logout-form").submit();
    },
    navigateToPage(des) {
      window.location.href = window.location.origin + `/${des}`;
    },
    setChatParticipant(param) {
      this.$emit("setChatParticipant", param);
    },
  },

  async mounted() {
    let res = await getModel("messagesHistory");
    this.messagesHistory = res.data.data;
  },
});
</script>
<style>
.msg-history ul.dropdown-menu {
  width: 500px !important;
  max-height: 500px;
  overflow: auto;
}
</style>
<style lang="scss" scoped>
.ellipsis-text {
  white-space: nowrap;
  width: 285px;
  overflow: hidden;
  text-overflow: ellipsis;
  display: inline-block;
}
</style>
