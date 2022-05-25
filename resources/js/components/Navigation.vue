<template>
  <div>
    <div class="uni-banner-default uni-background-1">
      <div class="container">
        <!-- Page title -->
        <div class="page-title">
          <div class="page-title-inner">
            <h1>{{ title }}</h1>
          </div>
        </div>
        <!-- End page title -->

        <!-- Breadcrumbs -->
        <ul class="breadcrumbs">
          <li><a href="#" @click.prevent="navigateTo('home')">Trang chủ</a></li>
          <li v-if="page"><a href="#" @click.prevent="navigateTo(page)">{{ title }}</a></li>
          <li v-if="page2"><a href="#" @click.prevent="navigateTo(page2)">{{ title2 }}</a></li>
        </ul>
        <!-- End breadcrumbs -->
      </div>
    </div>
  </div>
</template>

<script>
import BaseComponent from '../base-component'
export default BaseComponent.extend({
  props: [
    "title",
    "page",
    "title2",
    "page2",
  ],
});
</script>

<style lang="scss" scoped>
.uni-banner-default {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center;
  -webkit-box-pack: center;
  -ms-flex-pack: center;
  justify-content: center;
  width: 100%;
  height: 160px;
  background-position: center center;
  background-size: cover;
}
.uni-banner-default .page-title {
  float: left;
}
@media screen and (max-width: 767px) {
  .uni-banner-default .page-title {
    float: none;
  }
}
.uni-banner-default .page-title h1 {
  //font-family: "Poppins";
  font-size: 36px;
  font-weight: 600;
  font-style: normal;
  font-stretch: normal;
  line-height: 1.44;
  letter-spacing: normal;
  text-align: left;
  color: #ffffff;
  text-transform: uppercase;
}
.uni-banner-default .breadcrumbs {
  float: right;
  line-height: 51px;
}
@media screen and (max-width: 767px) {
  .uni-banner-default .breadcrumbs {
    float: none;
  }
}
.uni-banner-default .breadcrumbs li {
  display: inline-block;
  text-transform: capitalize;
}
.uni-banner-default .breadcrumbs li a {
  //font-family: "Poppins";
  font-size: 20px;
  font-weight: normal;
  font-style: normal;
  font-stretch: normal;
  letter-spacing: normal;
  text-align: right;
  color: #ffffff;
}
.uni-banner-default .breadcrumbs li:first-child:before {
  content: "";
}
.uni-banner-default .breadcrumbs li:before {
  content: "\f105";
  font-family: FontAwesome;
  font-size: 20px;
  color: #fff;
  padding: 0 10px;
}
.uni-background-1 {
  background: url("../../images/background1.png"); }
</style>
