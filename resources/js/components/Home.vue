<template>
  <div>
    <b-carousel
      id="carousel-1"
      v-model="slide"
      :interval="4000"
      fade
      controls
      indicators
      background="#ababab"
      img-width="1024"
      img-height="480"
      style="text-shadow: 1px 1px 2px #333"
      @sliding-start="onSlideStart"
      @sliding-end="onSlideEnd"
    >
      <!-- Text slides with image -->
      <b-carousel-slide img-src="../../images/banner/background2.jpg">
        <div style="background-color: #000; opacity: 0.7; padding: 30px">
          <h1>Sức khỏe là vốn quý nhất của con người</h1>
        </div>
      </b-carousel-slide>
      <b-carousel-slide img-src="../../images/banner/background.jpg">
        <div style="background-color: #000; opacity: 0.7; padding: 30px">
          <h1>Hãy để chúng tôi chăm sóc sức khỏe của bạn</h1>
        </div>
      </b-carousel-slide>
      <b-carousel-slide img-src="../../images/banner/background1.jpg">
        <!-- <div style="background-color: #000; opacity: 0.7; padding: 30px">
        <h1>Giúp việc khám chữa bệnh trở nên dễ dàng</h1>
      </div> -->
      </b-carousel-slide>
    </b-carousel>

    <div class="uni-hơm-1-department">
      <div class="container">
        <div class="uni-home-title">
          <h3>Các chuyên khoa chính</h3>
          <div class="uni-underline"></div>
        </div>
        <div class="uni-shortcode-icon-box-1">
          <div class="row">
            <div class="col-md-4 col-sm-6">
              <div class="uni-shortcode-icon-box-1-default">
                <div class="item-icons">
                  <img
                    src="images/icons_box/icon_1/icon.png"
                    alt=""
                    class="img-responsive"
                  />
                </div>
                <div class="item-caption">
                  <h4>Hô hấp</h4>
                  <!-- <p>Lorem</p> -->
                </div>
              </div>
            </div>

            <div class="col-md-4 col-sm-6">
              <div class="uni-shortcode-icon-box-1-default">
                <div class="item-icons">
                  <img
                    src="images/icons_box/icon_1/icon-5.png"
                    alt=""
                    class="img-responsive"
                  />
                </div>
                <div class="item-caption">
                  <h4>Tim mạch</h4>
                  <!-- <p>Lorem</p> -->
                </div>
              </div>
            </div>

            <div class="col-md-4 col-sm-6">
              <div class="uni-shortcode-icon-box-1-default">
                <div class="item-icons">
                  <img
                    src="images/icons_box/icon_1/icon-4.png"
                    alt=""
                    class="img-responsive"
                  />
                </div>
                <div class="item-caption">
                  <h4>Thần kinh</h4>
                  <!-- <p>Lorem</p> -->
                </div>
              </div>
            </div>

            <div class="col-md-4 col-sm-6">
              <div class="uni-shortcode-icon-box-1-default">
                <div class="item-icons">
                  <img
                    src="images/icons_box/icon_1/icon-3.png"
                    alt=""
                    class="img-responsive"
                  />
                </div>
                <div class="item-caption">
                  <h4>Cơ xương khớp</h4>
                  <!-- <p>Lorem</p> -->
                </div>
              </div>
            </div>

            <div class="col-md-4 col-sm-6">
              <div class="uni-shortcode-icon-box-1-default">
                <div class="item-icons">
                  <img
                    src="images/icons_box/icon_1/icon-1.png"
                    alt=""
                    class="img-responsive"
                  />
                </div>
                <div class="item-caption">
                  <h4>Nhãn khoa</h4>
                  <!-- <p>Lorem</p> -->
                </div>
              </div>
            </div>

            <div class="col-md-4 col-sm-6">
              <div class="uni-shortcode-icon-box-1-default">
                <div class="item-icons">
                  <img
                    src="images/icons_box/icon_1/icon-2.png"
                    alt=""
                    class="img-responsive"
                  />
                </div>
                <div class="item-caption">
                  <h4>Ung bướu</h4>
                  <!-- <p>Lorem</p> -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="uni-home-2-counter">
      <div class="uni-shortcode-counter-2 uni-background-3">
        <div class="container">
          <div class="row">
            <div class="col-md-4 col-sm-4">
              <div class="uni-shortcode-counter-default">
                <ul>
                  <li class="counter-icons">
                    <i class="fa fa-user-md" aria-hidden="true"></i>
                  </li>
                  <li class="counter-number counter">
                    {{ countInfo.doctor + 100 }}
                  </li>
                  <li class="counter-text">Bác sĩ</li>
                </ul>
              </div>
            </div>
            <div class="col-md-4 col-sm-4">
              <div class="uni-shortcode-counter-default">
                <ul>
                  <li class="counter-icons">
                    <i class="fa fa-smile-o" aria-hidden="true"></i>
                  </li>
                  <li class="counter-number counter">
                    {{ countInfo.user + 500 }}
                  </li>
                  <li class="counter-text">Khách hàng hài lòng</li>
                </ul>
              </div>
            </div>
            <div class="col-md-4 col-sm-4">
              <div class="uni-shortcode-counter-default">
                <ul>
                  <li class="counter-icons">
                    <i class="fa fa-lightbulb-o" aria-hidden="true"></i>
                  </li>
                  <li class="counter-number counter">10</li>
                  <li class="counter-text">năm kinh nghiệm</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--HOME 2 LATEST POST-->
    <div class="uni-home-2-latest-post">
      <div class="container">
        <div class="uni-home-title">
          <h3>Bài viết nổi bật</h3>
          <div class="uni-underline"></div>
        </div>
        <div class="row">
          <div
            v-for="(item, index) in featurePosts"
            :key="index"
            class="col-md-4"
          >
            <div class="blog-grid-item">
              <article class="post type-post">
                <div class="content-inner">
                  <div class="uni-entry-top">
                    <div class="thumbnail-img">
                      <a href="#" title="">
                        <img
                          :src="'../../images/posts/' + (index + 1) + '.jpg'"
                          alt=""
                          title=""
                          class="img-responsive"
                        />
                      </a>
                    </div>
                  </div>

                  <div class="uni-entry-body">
                    <div class="uni-entry-content">
                      <header class="uni-entry-header">
                        <h2 class="uni-entry-title">
                          <a
                            href="#"
                            @click="navigateTo('show-post', item.id)"
                            >{{ item.title }}</a
                          >
                        </h2>
                      </header>

                      <div class="uni-entry-meta">
                        <span class="uni-author">
                          <i class="fa fa-calendar" aria-hidden="true"></i>
                          {{ moment(item.created_at).format("L") }}
                        </span>
                        <span class="uni-comment-total">
                          <i class="fa fa-user" aria-hidden="true"></i>
                          {{ item.user_name }}
                        </span>
                      </div>
                      <div class="uni-entry-summary">
                        <p class="post-ellipsis" v-if="index == 0">
                          Chế độ dinh dưỡng khoa học, đầy đủ kết hợp với phác đồ
                          điều trị phù hợp vừa hỗ trợ ngăn ngừa và khắc phục
                          tình trạng nhiễm virus, đặc biệt là ở những bệnh không
                          triệu chứng nhẹ hoặc không triệu chứng...
                        </p>
                        <p class="post-ellipsis" v-if="index == 1">
                          Dịch bệnh COVID-19 đã làm thay đổi sâu sắc đời sống
                          lao động. Để giảm thiểu sự tiếp xúc giữa các cá nhân
                          và ngăn ngừa sự lây nhiễm mới, nhiều công ty đã triển
                          khai “làm việc di động” hoặc “làm việc tại nhà” hoặc...
                        </p>
                        <p class="post-ellipsis" v-if="index == 2">
                          Trong giai đoạn đầu bị COVID-19 (giai đoạn cấp) thì
                          việc điều trị tập trung vào việc phát hiện và điều trị
                          các biến chứng cấp tính liên quan đến COVID-19. Trong
                          giai đoạn mãn (sau khi đã vượt qua giai đoạn...
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </article>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import BaseComponent from "../base-component";
import { postModel, getModel, updateModel, deleteModel } from "../service";
export default BaseComponent.extend({
  data() {
    return {
      model: "posts",
      slide: 0,
      sliding: null,
      countInfo: "",
      featurePosts: "",
    };
  },

  methods: {
    onSlideStart(slide) {
      this.sliding = true;
    },
    onSlideEnd(slide) {
      this.sliding = false;
    },
    async getFeaturePosts() {
      let res = await getModel("posts", { getFeaturePosts: 3 });
      this.featurePosts = res.data.data;
    },
  },

  async mounted() {
    let res = await getModel("dashboard");
    this.countInfo = res.data.data;
    this.getFeaturePosts();
  },
});
</script>

<style lang="scss" scoped>
@import "../../sass/home.css";

ul li {
  list-style-type: none;
}

ol,
ul {
  list-style: none;
}

.uni-shortcode-counter-2 .uni-shortcode-counter-default ul li.counter-icons {
  height: 60px;
}

.uni-shortcode-counter-2 .uni-shortcode-counter-default ul li.counter-number {
  height: 62px;
}

.blog-grid-item .uni-entry-top .thumbnail-img img {
  height: 222px;
}

.blog-grid-item .uni-entry-body .uni-entry-content .uni-entry-meta {
  padding: 0;
}
.post-ellipsis {
  width: 350px;
  overflow: hidden;
  text-overflow: ellipsis;
  display: inline-block;
}
.uni-shortcode-icon-box-1-default .item-caption {
    padding: 70px 40px 30px 30px;
}
</style>
