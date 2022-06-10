<template>
  <div>
    <nav-bar :user="user" />
    <message-modal ref="msg-modal"></message-modal>
    <div class="divider"></div>
    <router-view @setChatParticipant="setChatParticipant" />
    <Footer />
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
    />
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
    };
  },
  methods: {
    toggleChat() {
      this.chatVisible = !this.chatVisible;
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
  },

  computed: {},

  mounted() {
    this.getMessages();
  },

  created() {
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
</style>
