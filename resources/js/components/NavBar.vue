<template>
  <div>
    <!-- <b-button class="toggle-btn" v-b-toggle.sidebar-no-header
      ><i class="fa fa-bars" aria-hidden="true"></i
    ></b-button> -->

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
        <b-navbar-nav v-if="user != null && user.role == 3">
          <b-button class="toggle-btn" v-b-toggle.sidebar-no-header
            ><i class="fa fa-bars" aria-hidden="true"></i
          ></b-button>
        </b-navbar-nav>
        <b-navbar-nav
          v-if="user != null && user.role != 3"
          class="nav-container"
        >
          <b-nav-item v-if="user != null" @click="navigateTo('forum')"
            >Diễn đàn</b-nav-item
          >
          <b-nav-item
            v-if="user && user.role == 2"
            @click="navigateTo('schedule')"
            >Lịch làm việc</b-nav-item
          >
          <b-nav-item v-if="user != null" @click="navigateTo('doctors')"
            >Danh sách bác sĩ</b-nav-item
          >
          <b-nav-item
            v-if="(user && user.role == 2) || user.role == 1"
            @click="navigateTo('medicalRecordList')"
            >Hồ sơ bệnh án</b-nav-item
          >

          <b-nav-item
            v-if="user && user.role == 1"
            @click="navigateTo('rateHistory')"
            >Lịch sử đánh giá hoạt động</b-nav-item
          >

          <b-nav-item
            v-if="user && user.role == 2"
            @click="navigateTo('treatmentList')"
            >Hoạt động điều trị</b-nav-item
          >
          <!-- <b-nav-item href="#" disabled>Disabled</b-nav-item> -->
        </b-navbar-nav>

        <!-- Right aligned nav items -->
        <b-navbar-nav class="ml-auto">
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

          <b-nav-item-dropdown
            v-if="user != null"
            size="md"
            right
            no-caret
            class="msg-history"
          >
            <template #button-content>
              <b-button pill @click="getMsgHistory()"
                ><i
                  style="font-size: 20px"
                  class="fa fa-comments"
                  aria-hidden="true"
                ></i
              ></b-button>
            </template>
            <b-dropdown-item
              :disabled="true"
              v-if="messagesHistory.length == 0"
            >
              <p style="color: #000 !important; margin-top: 12px">
                Không có lịch sử trò chuyện
              </p>
            </b-dropdown-item>
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
                      <span v-if="user.id == item.user_a_id">Bạn: </span>
                      {{ item.content }}
                    </p>
                    <span class="ml-1">{{
                      moment(item.created_at).fromNow()
                    }}</span>
                  </div>
                </b-media>
              </div>
            </b-dropdown-item>
          </b-nav-item-dropdown>

          <b-nav-item-dropdown
            v-if="user != null"
            size="md"
            right
            no-caret
            class="noti-list"
          >
            <template #button-content>
              <b-button pill @click="getNotifications()"
                ><i class="fa fa-bell" aria-hidden="true"></i
              ></b-button>
            </template>
            <b-dropdown-item :disabled="true" v-if="notifications.length == 0">
              <p style="color: #000 !important; margin-top: 12px">
                Không có thông báo nào
              </p>
            </b-dropdown-item>
            <b-dropdown-item
              v-for="(item, index) in notifications"
              :key="index"
              href="#"
              @click.prevent="handleClickNoti(item)"
            >
              <div>
                <b-media>
                  <template #aside>
                    <b-img
                      :src="item.data.avatar"
                      width="50"
                      alt="avatar"
                      rounded="circle"
                    ></b-img>
                  </template>
                  <div>
                    <p class="ellipsis-text-330">
                      <b>{{ item.data.user_name }}</b>
                      <span
                        v-if="item.type == 'App\\Notifications\\ReportComment'"
                        >đã báo cáo 1 bình luận</span
                      >
                      <span v-if="item.type == 'App\\Notifications\\ReportPost'"
                        >đã báo cáo 1 bài viết</span
                      >
                      <span v-if="item.type == 'App\\Notifications\\BookAppointment'"
                        >đã đặt 1 lịch hẹn ngày {{ moment(item.data.start_at).format('DD-MM-YYYY') }}</span
                      >
                      <span v-if="item.type == 'App\\Notifications\\UpdateRecord'"
                        >đã cập nhật hồ sơ bệnh án của bạn</span
                      >
                      <br />
                      {{ moment(item.created_at).fromNow() }}
                    </p>
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
            <template v-if="user" #button-content>
              <b-img
                style="width: 30px; height: 30px"
                left
                :src="user.avatar"
                rounded="circle"
                class="mr-2"
                onerror="this.src = '../../images/user-default-ava.jpg'; this.onerror='';"
              ></b-img>
              {{ user.name }}
            </template>
            <b-dropdown-item @click.prevent="navigateTo('userInfo')" href="#"
              >Thông tin cá nhân</b-dropdown-item
            >
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
      notifications: "",
      messagesHistory: [],
    };
  },

  methods: {
    handleClickNoti(item) {
      if (item.type == 'App\\Notifications\\ReportComment' || item.type == 'App\\Notifications\\ReportPost') {
        // this.navigateToPage('posts/' + item.data.post_id)
        this.navigateTo('show-post', item.data.post_id)
      }
      if (item.type == 'App\\Notifications\\BookAppointment') {
        this.navigateToPage("schedule?openDate=" + this.moment(item.data.start_at).format('YYYY-MM-DD'))
        // this.navigateTo("scheduleDate", this.moment(item.data.start_at).format('YYYY-MM-DD'))
      }
      if (item.type == 'App\\Notifications\\UpdateRecord') {
        this.navigateTo('showMedicalRecord', item.data.record_id)
      }
    },
    logOut() {
      document.getElementById("logout-form").submit();
    },
    navigateToPage(des) {
      window.location.href = window.location.origin + `/${des}`;
    },
    setChatParticipant(param) {
      this.$emit("setChatParticipant", param);
    },
    async getMsgHistory() {
      let res = await getModel("messagesHistory");
      this.messagesHistory = res.data.data;
    },

    async getNotifications() {
      let $res = await getModel("getNotifications");
      this.notifications = $res.data.data.data;
    },
  },

  async mounted() {
    if (this.user != null) {
      await this.getMsgHistory();
      await this.getNotifications();
    }
  },
});
</script>
<style>
.msg-history ul.dropdown-menu {
  width: max-content !important;
  max-height: 410px;
  overflow: auto;
}

.noti-list ul.dropdown-menu {
  width: max-content !important;
  max-height: 428px;
  overflow: auto;
}

#nav-collapse.show {
  background-color: #343a40 !important;
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
.ellipsis-text-330 {
  white-space: nowrap;
  // width: 330px;
  overflow: hidden;
  text-overflow: ellipsis;
  display: inline-block;
}

.navbar-nav .nav-item {
  margin-right: 20px;
}
.toggle-btn {
  display: none;
}
@media screen and (max-width: 991px) {
  .toggle-btn {
    display: block !important;
  }
}
</style>
