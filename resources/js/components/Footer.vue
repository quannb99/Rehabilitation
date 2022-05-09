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
                        style="width:40px;"
                      />
                      <h3 style="display: inline" class="widget-title uni-uppercase">REHAB</h3>
                    </a>
                  </div>
                  <div class="widget-content">
                    <p>
                      Pellentesque habitant morbi tristique senectus et netus et
                      malesuada fame ac turpis egestas. Vestibulum tortor quam,
                      feugiat vitae, ultricies eget.
                    </p>
                    <div class="uni-info-contact">
                      <ul>
                        <li>
                          <i class="fa fa-map-marker" aria-hidden="true"></i> 45
                          Queen's Park Rd, Brighton, UK
                        </li>
                        <li>
                          <i class="fa fa-phone" aria-hidden="true"></i> (094)
                          123 4567 - (094) 123 4568
                        </li>
                        <li>
                          <i class="fa fa-envelope-o" aria-hidden="true"></i>
                          medicareplus@domain.com
                        </li>
                      </ul>
                    </div>
                  </div>
                </aside>
              </div>
              <div class="footer-main-content-element col-md-3 col-sm-6">
                <aside class="widget">
                  <h3 class="widget-title uni-uppercase">QUICK LINKS</h3>
                  <div class="widget-content">
                    <div class="uni-quick-link">
                      <ul>
                        <li>
                          <a href="#"><span>+</span> Home</a>
                        </li>
                        <li>
                          <a href="#"><span>+</span> about</a>
                        </li>
                        <li>
                          <a href="#"><span>+</span> services</a>
                        </li>
                        <li>
                          <a href="#"><span>+</span> timetable</a>
                        </li>
                        <li>
                          <a href="#"><span>+</span> blog</a>
                        </li>
                        <li>
                          <a href="#"><span>+</span> contact</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </aside>
              </div>
              <div class="footer-main-content-element col-md-3 col-sm-6">
                <aside class="widget">
                  <h3 class="widget-title uni-uppercase">LASTEST POSTS</h3>
                  <div class="widget-content">
                    <div class="uni-footer-latest-post">
                      <ul>
                        <li>
                          <h4>
                            <a href="#"
                              >Lorem ipsum dolor sit amet, consectetuer</a
                            >
                          </h4>
                          <span class="time">june 12, 2017</span>
                        </li>
                        <li>
                          <h4>
                            <a href="#"
                              >Aliquam tincidunt mauris eu risus amet</a
                            >
                          </h4>
                          <span class="time">june 12, 2017</span>
                        </li>
                        <li>
                          <h4>
                            <a href="#"
                              >Morbi in sem quis dui placerat ornare column</a
                            >
                          </h4>
                          <span class="time">june 12, 2017</span>
                        </li>
                      </ul>
                    </div>
                  </div>
                </aside>
              </div>
              <div class="footer-main-content-element col-md-3 col-sm-6">
                <aside class="widget">
                  <h3 class="widget-title uni-uppercase">
                    NEWSLETTER
                  </h3>
                  <div class="widget-content">
                    <div class="uni-footer-newletter">
                      <div class="input-group">
                        <input
                          type="email"
                          class="form-control"
                          placeholder="Enter your email"
                        />
                        <button class="btn btn-sub" type="submit">
                          SUBCRIBE
                        </button>
                      </div>
                      <div class="uni-social">
                        <h4>Follow us</h4>
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
export default {};
</script>

<style lang="scss" scoped>
.footer-default {
  position: relative;
  padding-top: 3rem !important;
}
.footer-default .footer-main-content {
  background-color: #2d3840;
  padding: 80px 0;
}
@media screen and (max-width: 991px) {
  .footer-default .footer-main-content .footer-main-content-element {
    margin-bottom: 40px;
  }
}
.footer-default .footer-main-content p {
  //font-family: "Poppins";
  font-size: 16px;
  font-weight: normal;
  font-style: normal;
  font-stretch: normal;
  line-height: 1.71;
  letter-spacing: normal;
  text-align: left;
  color: #ffffff;
}
.footer-default .footer-main-content .uni-info-contact ul li {
  //font-family: "Poppins";
  font-size: 16px;
  font-weight: normal;
  font-style: normal;
  font-stretch: normal;
  line-height: 2.14;
  letter-spacing: normal;
  text-align: left;
  color: #3f97da;
}
.footer-default .footer-main-content .uni-info-contact ul li i {
  font-family: FontAwesome;
  font-size: 16px;
  font-weight: normal;
  font-style: normal;
  font-stretch: normal;
  line-height: 2.14;
  letter-spacing: normal;
  text-align: left;
  color: #ffffff;
  margin-right: 10px;
}
.footer-default .footer-main-content .widget-title {
  //font-family: "Poppins";
  font-size: 24px;
  font-weight: 600;
  font-style: normal;
  font-stretch: normal;
  line-height: 1.25;
  letter-spacing: normal;
  text-align: left;
  color: #3f97da;
  margin: 0;
  padding-bottom: 30px;
}
.footer-default .footer-main-content .uni-quick-link ul li {
  border-bottom: 1px solid #44515a;
}
.footer-default .footer-main-content .uni-quick-link ul li a {
  display: block;
  //font-family: "Poppins";
  font-size: 16px;
  font-weight: normal;
  font-style: normal;
  font-stretch: normal;
  line-height: 3;
  letter-spacing: normal;
  text-align: left;
  color: #ffffff;
  text-transform: capitalize;
  -webkit-transition: all 0.5s;
  -o-transition: all 0.5s;
  transition: all 0.5s;
}
.footer-default .footer-main-content .uni-quick-link ul li a:hover {
  color: #3f97da;
}
.footer-default .footer-main-content .uni-quick-link ul li a span {
  color: #3f97da;
  margin-right: 5px;
}
.footer-default .footer-main-content .uni-footer-latest-post ul li {
  padding-bottom: 20px;
}
.footer-default .footer-main-content .uni-footer-latest-post ul li h4 {
  margin-bottom: 0;
}
.footer-default .footer-main-content .uni-footer-latest-post ul li h4 a {
  display: block;
  //font-family: "Poppins";
  font-size: 16px;
  font-weight: 600;
  font-style: normal;
  font-stretch: normal;
  line-height: 1.29;
  letter-spacing: normal;
  text-align: left;
  color: #ffffff;
  text-transform: uppercase;
  -webkit-transition: all 0.5s;
  -o-transition: all 0.5s;
  transition: all 0.5s;
}
.footer-default .footer-main-content .uni-footer-latest-post ul li h4 a:hover {
  color: #3f97da;
}
.footer-default .footer-main-content .uni-footer-latest-post ul li .time {
  //font-family: "Poppins";
  font-size: 12px;
  font-weight: 600;
  line-height: 2;
  color: #3f97da;
  text-transform: uppercase;
}
.footer-default
  .footer-main-content
  .uni-footer-newletter
  .input-group
  .form-control {
  display: block;
  border: solid 1px #666666;
  min-height: 50px;
  background: transparent;
  border-radius: 0;
  //font-family: "Poppins";
  font-size: 16px;
  font-weight: normal;
  font-style: normal;
  font-stretch: normal;
  line-height: 2.14;
  letter-spacing: normal;
  text-align: left;
  color: #adbcc6;
  margin-bottom: 10px;
}
.footer-default
  .footer-main-content
  .uni-footer-newletter
  .input-group
  .btn-sub {
  display: block;
  width: 100%;
  //font-family: "Poppins";
  font-size: 16px;
  font-weight: 600;
  font-style: normal;
  font-stretch: normal;
  line-height: 2.14;
  letter-spacing: normal;
  text-align: center;
  color: #ffffff;
  height: 50px;
  background-color: #3f97da;
  border: 1px solid #3f97da;
  border-radius: 0;
  text-transform: uppercase;
  -webkit-transition: all 0.5s;
  -o-transition: all 0.5s;
  transition: all 0.5s;
}
.footer-default
  .footer-main-content
  .uni-footer-newletter
  .input-group
  .btn-sub:hover {
  background: transparent;
  color: #3f97da;
}
.footer-default .footer-main-content .uni-footer-newletter .uni-social {
  padding-top: 20px;
}
.footer-default .footer-main-content .uni-footer-newletter .uni-social h4 {
  //font-family: "Poppins";
  font-size: 16px;
  font-weight: 600;
  font-style: normal;
  font-stretch: normal;
  line-height: 2.14;
  letter-spacing: normal;
  text-align: left;
  color: #ffffff;
  text-transform: uppercase;
}
.footer-default .footer-main-content .uni-footer-newletter .uni-social ul {
  display: inline-block;
}
.footer-default .footer-main-content .uni-footer-newletter .uni-social ul li {
  float: left;
  margin-right: 10px;
}
@media screen and (max-width: 1199px) and (min-width: 992px) {
  .footer-default .footer-main-content .uni-footer-newletter .uni-social ul li {
    margin-right: 5px;
  }
}
.footer-default .footer-main-content .uni-footer-newletter .uni-social ul li a {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center;
  -webkit-box-pack: center;
  -ms-flex-pack: center;
  justify-content: center;
  width: 40px;
  height: 40px;
  border: solid 1px #3f97da;
  font-family: FontAwesome;
  font-size: 16px;
  font-weight: normal;
  font-style: normal;
  font-stretch: normal;
  line-height: 1.86;
  letter-spacing: normal;
  text-align: center;
  color: #fff;
  -webkit-transition: all 0.5s;
  -o-transition: all 0.5s;
  transition: all 0.5s;
}
@media screen and (max-width: 1199px) and (min-width: 992px) {
  .footer-default
    .footer-main-content
    .uni-footer-newletter
    .uni-social
    ul
    li
    a {
    width: 35px;
    height: 35px;
  }
}
.footer-default
  .footer-main-content
  .uni-footer-newletter
  .uni-social
  ul
  li
  a:hover {
  color: #fff;
  background: #3f97da;
}
.footer-default .copyright-area {
  background-image: -webkit-gradient(
      linear,
      left top,
      right top,
      from(#3f97da),
      color-stop(50%, #ffffff),
      to(#3f97da)
    ),
    -webkit-gradient(linear, left top, left bottom, from(#3f97da), to(#3f97da));
  background-image: -webkit-linear-gradient(left, #3f97da, #ffffff 50%, #3f97da),
    -webkit-linear-gradient(#3f97da, #3f97da);
  background-image: -o-linear-gradient(left, #3f97da, #ffffff 50%, #3f97da),
    -o-linear-gradient(#3f97da, #3f97da);
  background-image: linear-gradient(to right, #3f97da, #ffffff 50%, #3f97da),
    linear-gradient(#3f97da, #3f97da);
  background-blend-mode: multiply, normal;
}
.footer-default .copyright-area p {
  //font-family: "Poppins";
  font-size: 16px;
  font-weight: normal;
  font-style: normal;
  font-stretch: normal;
  line-height: 1.86;
  letter-spacing: normal;
  text-align: left;
  color: #fff;
  margin-bottom: 0;
  padding: 26px 0;
}
.footer-default .copyright-area p a {
  color: #fff;
}
.footer-default .copyright-area .copyright-menu {
  text-align: right;
}
@media screen and (max-width: 767px) {
  .footer-default .copyright-area .copyright-menu {
    text-align: left;
  }
}
.footer-default .copyright-area .copyright-menu li {
  display: inline-block;
}
.footer-default .copyright-area .copyright-menu li a {
  padding: 25px 10px;
  display: block;
  //font-family: "Poppins";
  font-size: 16px;
  font-weight: normal;
  font-style: normal;
  font-stretch: normal;
  line-height: 2.14;
  letter-spacing: normal;
  text-align: right;
  color: #ffffff;
  -webkit-transition: all 0.5s;
  -o-transition: all 0.5s;
  transition: all 0.5s;
}
@media screen and (max-width: 767px) {
  .footer-default .copyright-area .copyright-menu li a {
    padding: 0px 5px 26px 5px;
  }
}
@media screen and (max-width: 1199px) and (min-width: 992px) {
  .footer-default .copyright-area .copyright-menu li a {
    padding: 25px 5px;
  }
}
.footer-default .copyright-area .copyright-menu li a:hover {
  color: #333;
}
</style>
