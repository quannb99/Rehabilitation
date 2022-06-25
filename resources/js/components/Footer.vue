<template>
  <div>
    <footer class="site-footer footer-default">
      <div class="footer-main-content">
        <div class="container">
          <div class="row">
            <div class="footer-main-content-elements d-flex">
              <div class="footer-main-content-element col-md-3 col-sm-6">
                <aside class="widget">
                  <div class="widget-title uni-uppercase">
                    <a href="#"
                      ><img
                        src="../../images/hospital.png"
                        alt=""
                        style="width: 40px"
                      />
                      <h3
                        style="display: inline"
                        class="widget-title uni-uppercase"
                      >
                        REHAB
                      </h3>
                    </a>
                  </div>
                  <div class="widget-content">
                    <p>
                      Luôn lấy người bệnh là trung tâm, Rehab cam kết mang lại
                      dịch vụ chăm sóc sức khỏe toàn diện và chất lượng cao cho
                      khách hàng.
                    </p>
                    <div class="uni-info-contact">
                      <ul>
                        <li>
                          <i class="fa fa-map-marker" aria-hidden="true"></i> Số
                          458, Minh Khai, Vĩnh Tuy, Hai Bà Trưng, Hà Nội
                        </li>
                        <li>
                          <i class="fa fa-phone" aria-hidden="true"></i> (094)
                          123 4567 - (094) 123 4568
                        </li>
                        <li>
                          <i class="fa fa-envelope-o" aria-hidden="true"></i>
                          contact@rehab.com
                        </li>
                      </ul>
                    </div>
                  </div>
                </aside>
              </div>
              <div class="footer-main-content-element col-md-3 col-sm-6">
                <aside class="widget">
                  <h3 class="widget-title uni-uppercase">ĐƯỜNG DẪN</h3>
                  <div class="widget-content">
                    <div class="uni-quick-link">
                      <ul>
                        <li>
                          <a href="#" @click="navigateTo('home')"
                            ><span>+</span> Trang chủ</a
                          >
                        </li>
                        <li>
                          <a href="#" @click="navigateTo('userInfo')"
                            ><span>+</span> Thông tin cá nhân</a
                          >
                        </li>
                        <li>
                          <a href="#" @click="navigateTo('forum')"
                            ><span>+</span> Diễn đàn</a
                          >
                        </li>
                        <li>
                          <a href="#" @click="navigateTo('doctors')"
                            ><span>+</span> Danh sách bác sĩ</a
                          >
                        </li>
                        <li>
                          <a
                            href="#"
                            @click.prevent="
                              setChatParticipant({
                                name: admins[0].name,
                                id: admins[0].id,
                                profilePicture: admins[0].avatar,
                              })
                            "
                            ><span>+</span> Liên hệ</a
                          >
                        </li>
                      </ul>
                    </div>
                  </div>
                </aside>
              </div>
              <div class="footer-main-content-element col-md-3 col-sm-6">
                <aside class="widget">
                  <h3 class="widget-title uni-uppercase">BÀI VIẾT MỚI</h3>
                  <div class="widget-content">
                    <div class="uni-footer-latest-post">
                      <ul>
                        <li v-for="(item, index) in newPosts" :key="index">
                          <h4>
                            <a href="#" @click.prevent="openInNewTab('/posts/' + item.id)"
                              >{{ item.title }}</a
                            >
                          </h4>
                          <span class="time">{{ moment(item.created_at).format('L') }}</span>
                        </li>
                      </ul>
                    </div>
                  </div>
                </aside>
              </div>
              <div class="footer-main-content-element col-md-3 col-sm-6">
                <aside class="widget">
                  <h3 class="widget-title uni-uppercase">NHẬN TIN MỚI</h3>
                  <div class="widget-content">
                    <div class="uni-footer-newletter">
                      <div class="input-group">
                        <input
                          type="email"
                          class="form-control"
                          placeholder="Nhập email của bạn"
                          v-model="email"
                        />
                        <button @click="subcribe()" class="btn btn-sub" type="submit">
                          Đăng ký
                        </button>
                      </div>
                      <div class="uni-social">
                        <h4>Theo dõi chúng tôi</h4>
                        <ul>
                          <li>
                            <a href="#"
                              ><i class="fa fa-facebook" aria-hidden="true"></i
                            ></a>
                          </li>
                          <li>
                            <a href="#"
                              ><i class="fa fa-twitter" aria-hidden="true"></i
                            ></a>
                          </li>
                          <li>
                            <a href="#"
                              ><i
                                class="fa fa-google-plus"
                                aria-hidden="true"
                              ></i
                            ></a>
                          </li>
                          <li>
                            <a href="#"
                              ><i
                                class="fa fa-youtube-play"
                                aria-hidden="true"
                              ></i
                            ></a>
                          </li>
                          <li>
                            <a href="#"
                              ><i class="fa fa-instagram" aria-hidden="true"></i
                            ></a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </aside>
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>

<script>
import BaseComponent from "../base-component";
import { postModel, getModel, updateModel, deleteModel } from "../service";
export default BaseComponent.extend({
  data() {
    return {
      User: window.User,
      admins: "",
      email: '',
      newPosts: ''
    };
  },
  methods: {
    setChatParticipant(param) {
      this.$emit("setChatParticipant", param);
    },

    async getAdmin() {
      let res = await getModel("users", { role: 3 });
      this.admins = res.data.data.data;
    },

    subcribe() {
      this.email = ''
      this.makeToast('Đăng ký nhận tin mới thành công')
    },

    async getNewPosts() {
      let res = await getModel("posts", { getNewPosts: 3 });
      this.newPosts = res.data.data;
    }
  },
  async mounted() {
    await this.getAdmin();
    await this.getNewPosts()
  },
});
</script>

<style lang="scss" scoped>
ul li {
  list-style-type: none;
}

ol,
ul {
  list-style: none;
}
</style>
