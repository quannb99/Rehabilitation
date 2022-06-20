<template>
  <div>
    <template v-if="user.role != 3">
      <nav-bar :user="user" @setChatParticipant="setChatParticipant" />
      <message-modal ref="msg-modal"></message-modal>
      <div class="divider"></div>
      <router-view @setChatParticipant="setChatParticipant" />
      <Footer />
    </template>
    <template v-if="user.role == 3">
      <nav-bar :user="user" @setChatParticipant="setChatParticipant" />
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
            <b-nav class="mt-4 mb-3" tabs vertical>
              <b-nav-item
                :active="getActiveNav() == 1"
                @click="navigateTo('userManage')"
                >Quản lý người dùng</b-nav-item
              >
              <b-nav-item
                :active="getActiveNav() == 2"
                @click="navigateTo('postManage')"
                >Quản lý bài viết</b-nav-item
              >
              <b-nav-item :active="getActiveNav() == 3"
                @click="navigateTo('reportManage')">Quản lý báo cáo</b-nav-item>
            </b-nav>
          </div>
        </template>
      </b-sidebar>
      <message-modal ref="msg-modal"></message-modal>
      <div class="divider"></div>
      <div class="row">
        <div class="col-lg-2"></div>
        <router-view
          @setChatParticipant="setChatParticipant"
          class="col-lg-10"
        />
      </div>
      <div class="shadow admin-footer"></div>
    </template>
    <b-button
      v-if="!chatVisible && participants[0].id != user.id"
      @click="toggleChat()"
      class="btn-chat btn-theme"
      ><i class="fa fa-comments" aria-hidden="true"></i>
      <div class="new-msg" v-if="isNewMessage"></div>
    </b-button>
    <Chat
      :class="{ 'd-none': !chatVisible }"
      :participants="participants"
      :myself="myself"
      :messages="messages"
      :chat-title="chatTitle()"
      :placeholder="placeholder"
      :colors="colors"
      :border-style="borderStyle"
      :hide-close-button="hideCloseButton"
      :close-button-icon-size="closeButtonIconSize"
      :submit-icon-size="submitIconSize"
      :load-more-messages="
        this.paging.current_page + 1 <= this.paging.last_page && !isMsgLoading
          ? loadMoreMessages
          : null
      "
      :async-mode="asyncMode"
      :scroll-bottom="scrollBottom"
      :display-header="true"
      :send-images="false"
      :profile-picture-config="profilePictureConfig"
      :timestamp-config="timestampConfig"
      :link-options="linkOptions"
      :accept-image-types="'.png, .jpeg'"
      @onImageClicked="onImageClicked"
      @onImageSelected="onImageSelected"
      @onMessageSubmit="onMessageSubmit"
      @onType="onType"
      @onClose="onClose"
    >
      <template v-slot:header>
        <div class="header-title">
          <p
            class="header-title-text d-inline-block"
            style="color: rgb(255, 255, 255); cursor: pointer"
            @click.prevent="navigateTo('otherUserInfo', participants[0].id)"
          >
            {{ participants[0].name }}
          </p>
          <i
            @click.prevent="videoCall(participants[0].id)"
            style="
              color: #fff;
              font-size: 20px;
              cursor: pointer;
              margin-top: 5px;
            "
            class="fa fa-video-camera float-right mr-3"
            aria-hidden="true"
          ></i>
        </div>
        <div class="header-exit">
          <a
            @click.prevent="onClose()"
            href="#"
            class="header-exit-button"
            style="font-size: 20px"
            >✕</a
          >
        </div>
      </template>
    </Chat>
    <b-modal
      ref="calling-modal"
      :title="'Cuộc gọi đi'"
      :hide-footer="true"
      :no-close-on-backdrop="true"
      centered
      no-fade
      size="md"
    >
      <div class="d-block text-center">
        <div class="modal-body d-block text-center">
          <template v-if="participants[0]">
            <b-img
              style="margin-top: -20px; width: 80px; height: 80px"
              center
              :src="participants[0].profilePicture"
              rounded="circle"
              class="mb-2"
            ></b-img>
            <h4>Đang gọi cho {{ participants[0].name }}</h4>
          </template>
        </div>
        <div class="text-center">
          <b-button variant="primary" @click="abortCall()">Kết thúc</b-button>
        </div>
      </div>
    </b-modal>
    <b-modal
      ref="response-modal"
      :title="'Cuộc gọi đã kết thúc'"
      :hide-footer="true"
      :no-close-on-backdrop="true"
      centered
      no-fade
      size="md"
    >
      <div class="d-block text-center">
        <div class="modal-body d-block text-center">
          <template v-if="participants[0]">
            <b-img
              style="margin-top: -20px; width: 80px; height: 80px"
              center
              :src="participants[0].profilePicture"
              rounded="circle"
              class="mb-2"
            ></b-img>
            <h4 v-if="responseType == 'decline'">
              {{ participants[0].name }} đã từ chối cuộc gọi
            </h4>
            <h4 v-if="responseType == 'timeout'">
              {{ participants[0].name }} không nghe máy
            </h4>
          </template>
        </div>
        <div class="text-center">
          <b-button variant="primary" @click="endCall()">Đóng</b-button>
        </div>
      </div>
    </b-modal>
    <b-modal
      ref="response-modal-2"
      :title="'Cuộc gọi đã kết thúc'"
      :hide-footer="true"
      :no-close-on-backdrop="true"
      centered
      no-fade
      size="md"
    >
      <div class="d-block text-center">
        <div class="modal-body d-block text-center">
          <template v-if="callingUser && responseType == 'abort'">
            <b-img
              style="margin-top: -20px; width: 80px; height: 80px"
              center
              :src="callingUser.avatar"
              rounded="circle"
              class="mb-2"
            ></b-img>
            <h4>Bạn đã bỏ lỡ cuộc gọi từ {{ callingUser.name }}</h4>
          </template>
        </div>
        <div class="text-center">
          <b-button variant="primary" @click="endCall()">Đóng</b-button>
        </div>
      </div>
    </b-modal>
    <b-modal
      ref="call-modal"
      :title="'Cuộc gọi đến'"
      :hide-footer="true"
      :no-close-on-backdrop="true"
      centered
      no-fade
      size="md"
    >
      <div class="d-block text-center">
        <div class="modal-body d-block text-center">
          <template v-if="callingUser">
            <b-img
              style="margin-top: -20px; width: 80px; height: 80px"
              center
              :src="callingUser.avatar"
              rounded="circle"
              class="mb-2"
            ></b-img>
            <h4>{{ callingUser.name }} đang gọi cho bạn</h4>
          </template>
        </div>
        <div class="text-center">
          <b-button variant="primary" @click="accept()">Chấp nhận</b-button>
          <b-button variant="light" @click="decline()">Từ chối</b-button>
        </div>
      </div>
    </b-modal>
    <b-modal
      ref="deactive-modal"
      :title="'Thông báo'"
      :hide-footer="true"
      :no-close-on-backdrop="true"
      centered
      no-fade
      size="lg"
    >
      <div class="d-block text-center">
        <div class="modal-body d-block text-center">
          <p>Tài khoản của bạn đã bị vô hiệu hóa</p>
        </div>
        <div class="text-center">
          <b-button variant="primary" @click="hideModal()">Xác nhận</b-button>
        </div>
      </div>
    </b-modal>
  </div>
</template>

<script>
import BaseComponent from "../base-component";
import { postModel, getModel, updateModel, deleteModel } from "../service";
import { Chat } from "vue-quick-chat";
import "vue-quick-chat/dist/vue-quick-chat.css";

export default BaseComponent.extend({
  components: {
    Chat,
  },
  data() {
    return {
      receiveUser: "",
      otherUser: "",
      callingUser: "",
      isNewMessage: false,
      isMsgLoading: false,
      user: User,
      chatVisible: false,
      participants: [
        {
          name: User.name,
          id: User.id,
          profilePicture: User.avatar,
        },
      ],
      myself: {
        name: User.name,
        id: User.id,
        profilePicture: User.avatar,
      },
      messages: [],
      placeholder: "Nhập tin nhắn...",
      colors: {
        header: {
          bg: "#2f7fe0",
          text: "#fff",
        },
        message: {
          myself: {
            bg: "#fff",
            text: "#000",
          },
          others: {
            // bg: '#2f7fe0',
            // text: '#fff'
            bg: "#fff",
            text: "#000",
          },
          messagesDisplay: {
            bg: "#f7f3f3",
          },
        },
        submitIcon: "#2f7fe0",
        submitImageIcon: "#2f7fe0",
      },
      borderStyle: {
        topLeft: "10px",
        topRight: "10px",
        bottomLeft: "10px",
        bottomRight: "10px",
      },
      hideCloseButton: false,
      submitIconSize: 25,
      closeButtonIconSize: "20px",
      asyncMode: false,
      toLoad: [],
      scrollBottom: {
        messageSent: true,
        messageReceived: true,
      },
      displayHeader: true,
      profilePictureConfig: {
        others: true,
        myself: true,
        styles: {
          width: "30px",
          height: "30px",
          borderRadius: "50%",
        },
      },
      timestampConfig: {
        format: "HH:mm dd-MM-yyyy",
        relative: false,
      },
      linkOptions: {
        myself: {
          className: "myLinkClass",
          events: {
            click: function (e) {
              console.log("Link clicked!");
            },
            mouseover: function (e) {
              console.log("Link hovered!");
            },
          },
          format: function (value, type) {
            if (type === "url" && value.length > 50) {
              value = value.slice(0, 50) + "…";
            }
            return value;
          },
        },
        others: {
          className: "othersLinkClass",
          events: {
            click: function (e) {
              alert("Link clicked!");
            },
            mouseover: function (e) {
              alert("Link hovered!");
            },
          },
          format: function (value, type) {
            if (type === "url" && value.length > 50) {
              value = value.slice(0, 50) + "…";
            }
            return value;
          },
        },
      },
      audio: new Audio("../../audio/skype_short.mp3"),
      responseType: "",
      callStatus: "",
      notiAudio: new Audio("../../audio/FB.mp3"),
    };
  },
  methods: {
    async abortCall() {
      this.$refs["calling-modal"].hide();
      await postModel("callResponse", { response: "abort", userId: User.id });
    },
    endCall() {
      this.$refs["calling-modal"].hide();
      this.$refs["response-modal"].hide();
      this.$refs["response-modal-2"].hide();
    },
    async accept() {
      this.$refs["call-modal"].hide();
      let ids = [User.id, this.callingUser.id];
      ids.sort();
      let roomId = ids.join("");
      this.audio.pause();
      window.open(window.location.origin + "/call/" + roomId);
      await postModel("callResponse", { response: "accept" });
    },
    async decline() {
      this.$refs["call-modal"].hide();
      this.audio.pause();
      await postModel("callResponse", { response: "decline" });
      const form = {
        user_a_id: this.otherUser.id,
        user_b_id: User.id,
        content: "📞 Bạn đã bỏ lỡ cuộc gọi từ " + this.otherUser.name,
      };
      await postModel("messages", form);
    },
    async videoCall(id) {
      this.$refs["calling-modal"].show();
      this.chatVisible = false;
      await postModel("call", { id: id });
    },

    async toggleChat() {
      this.chatVisible = !this.chatVisible;
      await this.getMessages();
      this.setScrollToBottom();
    },
    onType: function (event) {
      //
    },
    async getMessagesNextPage() {
      if (this.paging.current_page + 1 <= this.paging.last_page) {
        await this.getItems("messages", this.paging.current_page + 1);
        let res = this.items
          .map((item) => {
            item.participantId = item.user_a_id;
            item.timestamp = moment(item.created_at).toISOString();
            return item;
          })
          .reverse();
        this.toLoad = res;
      }
    },

    async loadMoreMessages(resolve) {
      this.isMsgLoading = true;
      {
        await this.getItems("messages", this.paging.current_page + 1);
        let res = this.items
          .map((item) => {
            item.participantId = item.user_a_id;
            item.timestamp = moment(item.created_at).toISOString();
            return item;
          })
          .reverse();
        this.toLoad = res;
        resolve(this.toLoad);
        this.messages.unshift(...this.toLoad);
        this.toLoad = [];
      }
      this.isMsgLoading = false;
    },

    async getMessages() {
      this.fieldFilter.user_b_id = this.participants[0].id;
      await this.getItems("messages");
      this.messages = this.items
        .map((item) => {
          item.participantId = item.user_a_id;
          item.timestamp = moment(item.created_at).toISOString();
          return item;
        })
        .reverse();
    },
    async onMessageSubmit(message) {
      /*
       * example simulating an upload callback.
       * It's important to notice that even when your message wasn't send
       * yet to the server you have to add the message into the array
       */
      this.messages.push(message);
      const form = {
        user_a_id: message.participantId,
        user_b_id: this.participants[0].id,
        content: message.content,
      };
      await postModel("messages", form);

      /*
       * you can update message state after the server response
       */
      // timeout simulating the request
      await this.getMessages();
      message.uploaded = true;
    },
    onClose() {
      this.isNewMessage = false;
      this.chatVisible = false;
    },
    onImageSelected(files, message) {
      let src =
        "https://upload.wikimedia.org/wikipedia/en/thumb/a/a1/NafSadh_Profile.jpg/768px-NafSadh_Profile.jpg";
      this.messages.push(message);
      /**
       * This timeout simulates a requisition that uploads the image file to the server.
       * It's up to you implement the request and deal with the response in order to
       * update the message status and the message URL
       */
      setTimeout(
        (res) => {
          message.uploaded = true;
          message.src = res.src;
        },
        3000,
        { src }
      );
    },
    onImageClicked(message) {
      /**
       * This is the callback function that is going to be executed when some image is clicked.
       * You can add your code here to do whatever you need with the image clicked. A common situation is to display the image clicked in full screen.
       */
      console.log("Image clicked", message.src);
    },
    setScrollToBottom() {
      let obj = document.getElementsByClassName("container-message-display")[0];
      setTimeout(() => {
        obj.scrollTop = obj.scrollHeight;
      }, 200);
    },

    async setChatParticipant(param, chatVisible = true) {
      this.participants[0] = param;
      await this.getMessages();
      this.chatVisible = chatVisible;
      this.setScrollToBottom();
    },

    chatTitle() {
      return this.participants[0].name;
    },
    getActiveNav() {
      if (window.location.pathname.indexOf("userManage") != -1) return 1;
      if (window.location.pathname.indexOf("postManage") != -1) return 2;
      if (window.location.pathname.indexOf("reportManage") != -1) return 3;
      return 0;
    },
  },

  computed: {},

  async mounted() {
    await this.getMessages();
    if (User.deactive == 1) {
      this.$refs["deactive-modal"].show();
      setTimeout(() => {
        document.getElementById("logout-form").submit();
      }, 2000);
    }
  },

  created() {
    this.audio.loop = false;
    window.Echo.private("App.Models.User." + User.id).notification((data) => {
      if (data.type == `App\\Notifications\\ReportPost`) {
        this.notiAudio.play();
        this.makeLinkToast(
          data.user_name + " đã báo cáo 1 bài viết",
          window.location.origin + "/posts/" + data.post_id
        );
      }
      if (data.type == `App\\Notifications\\ReportComment`) {
        this.notiAudio.play();
        this.makeLinkToast(
          data.user_name + " đã báo cáo 1 bình luận",
          window.location.origin + "/posts/" + data.post_id
        );
      }
    });
    window.Echo.private("call-response").listen("CallResponse", async (e) => {
      console.log(e);
      if (e.user.id == this.participants[0].id) {
        if (e.response == "accept") {
          this.$refs["calling-modal"].hide();
          let ids = [User.id, e.user.id];
          ids.sort();
          let roomId = ids.join("");
          window.open(window.location.origin + "/call/" + roomId);
        }

        if (e.response == "decline") {
          this.responseType = "decline";
          this.$refs["calling-modal"].hide();
          this.$refs["response-modal"].show();
        }

        if (e.response == "abort") {
          this.responseType = "abort";
          this.audio.pause();
          this.$refs["call-modal"].hide();
          this.$refs["response-modal-2"].show();
        }

        if (e.response == "timeout") {
          this.responseType = "timeout";
          this.$refs["calling-modal"].hide();
          this.$refs["response-modal"].show();
        }
      }
    });

    window.Echo.private("call").listen("IncomingCall", async (e) => {
      console.log(e);
      if (e.otherUser.id == User.id) {
        this.participants[0] = {
          id: e.user.id,
          name: e.user.name,
          profilePicture: e.user.avatar,
        };
        this.otherUser = e.user;
        setTimeout(() => {
          this.chatVisible = false;
          this.audio.play();
          this.callingUser = e.user;
          this.$refs["call-modal"].show();
        }, 1000);
        let self = this;
        this.audio.onended = async function () {
          await postModel("callResponse", { response: "timeout" });
          const form = {
            user_a_id: e.user.id,
            user_b_id: User.id,
            content: "Bạn đã bỏ lỡ cuộc gọi từ " + e.user.name,
          };
          await postModel("messages", form);
          self.responseType = "abort";
          self.$refs["call-modal"].hide();
          self.$refs["response-modal-2"].show();
          console.log("The audio has ended");
        };
      }
    });
    window.Echo.private("chat").listen("MessageSent", async (e) => {
      if (this.participants[0].id == User.id) {
        const param = {
          id: e.user.id,
          name: e.user.name,
          profilePicture: e.user.avatar,
        };
        await this.setChatParticipant(param, false);
        this.isNewMessage = true;
        return;
      }
      if (
        this.participants[0].id == e.message.user_a_id &&
        User.id == e.message.user_b_id
      ) {
        e.message.participantId = e.message.user_a_id;
        e.message.timestamp = moment(e.message.created_at).toISOString();
        this.messages.push(e.message);
        this.isNewMessage = true;
        this.setScrollToBottom();
      }
    });
  },
});
</script>

<style lang="scss">
.btn-chat {
  position: fixed;
  top: 90vh;
  right: 10px;
  z-index: 1050;
  width: 60px;
  border-radius: 50%;
  font-size: 30px;
}
.quick-chat-container {
  position: fixed;
  z-index: 1050;
  width: 450px;
  height: 80vh;
  top: 15vh;
  right: 10px;
  border-bottom: 1px solid #d0d0d0;
  border-left: 1px solid #d0d0d0;
  border-right: 1px solid #d0d0d0;
}
.header-paticipants-text {
  display: none;
}
.header-title-text {
  font-size: 20px;
}
.new-msg {
  width: 20px;
  height: 20px;
  background-color: #dc3545;
  border-radius: 50%;
  position: absolute;
  top: -4px;
  left: 38px;
}
#sidebar-no-header .nav-tabs {
  border-bottom: 0 !important;
}

#sidebar-no-header .nav-link {
  height: 60px !important;
  padding-top: 15px !important;
}
</style>
