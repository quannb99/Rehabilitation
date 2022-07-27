<template>
  <div>
    <Navigation :title="'Diễn đàn'" :page="'forum'" />
    <div class="row col-lg-10 m-auto pt-5">
      <div class="col-lg-8">
        <b-list-group id="posts-container">
          <div class="mb-3" v-if="this.items[0]">
            <h4 style="display: inline-block" v-if="this.fieldFilter.type">
              Các bài viết theo thể loại {{ this.fieldFilter.type }}:
            </h4>
            <h4
              style="display: inline-block"
              v-if="this.fieldFilter.titleQuery"
            >
              Kết quả tìm kiếm bài viết theo từ khóa: "{{
                fieldFilter.titleQuery
              }}":
            </h4>
            <b-button
              v-if="this.fieldFilter.type"
              @click.prevent="clearFilter()"
              class="float-right"
              variant="theme"
              >Tắt bộ lọc</b-button
            >
          </div>
          <div class="mb-3" v-if="!this.items[0]">
            <h4
              style="display: inline-block"
              v-if="this.fieldFilter.titleQuery"
            >
              Không có kết quả nào khi tìm kiếm bài viết theo từ khóa: "{{
                fieldFilter.titleQuery
              }}"
            </h4>
          </div>

          <b-list-group-item
            style="cursor: pointer"
            @click.prevent="navigateTo('show-post', item.id)"
            v-for="(item, index) in items"
            :key="index"
          >
            <h4>{{ item.title }}</h4>
            <div class="d-flex">
              <img style="height: 120px" :src="item.image ? item.image : previewImages[index]" alt="">
              <div class="preview" v-html="item.content"></div>
            </div>
            <div class="mt-2">
              <b-img
                :src="item.user_avatar"
                width="20"
                alt="avatar"
                rounded="circle"
              ></b-img>
              <!-- <i
                v-if="item.user_role == 2"
                class="theme-icon-20 fa fa-user-md"
                aria-hidden="true"
              ></i> -->
              <strong class="mr-2" style="font-size: 14px"
                ><span v-if="item.user_role == 2">Bs. </span>
                {{ item.user_name }}</strong
              >
              <i class="ml-1 theme-icon fa fa-clock-o" aria-hidden="true"></i>
              <span style="font-size: 14px"
                ><b>{{ moment(item.created_at).fromNow() }}</b>
              </span>
              <i class="ml-3 theme-icon fa fa-tag" aria-hidden="true"></i>
              <span style="font-size: 14px"
                ><b>{{ item.type }}</b>
              </span>
            </div>
          </b-list-group-item>
        </b-list-group>
        <div class="mt-5"></div>
        <b-pagination
          pills
          v-if="paging.last_page > 1"
          v-model="paging.current_page"
          :total-rows="paging.total"
          :per-page="paging.per_page"
          align="center"
          @input="changePageAndShuffle"
        ></b-pagination>
      </div>

      <div class="col-lg-4">
        <b-button
          variant="theme"
          class="new-post-btn mt-3"
          @click="navigateTo('new-post')"
          style="font-size: 18px"
          ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Đăng bài
          mới</b-button
        >
        <b-card class="mt-3">
          <b-nav-form id="search-form">
            <b-form-input
              size="md"
              class="mr-3"
              placeholder="Tìm kiếm theo tiêu đề"
              style="width: 80%"
              v-model="titleQuery"
              @input="getPostsByTitle()"
            ></b-form-input>
            <b-button
              style="width: 15%"
              size="md"
              variant="theme"
              class="my-2 my-sm-0"
              type="submit"
              ><i class="fa fa-search" aria-hidden="true"></i
            ></b-button>
          </b-nav-form>
        </b-card>
        <b-list-group id="specialists-list" class="mt-3">
          <b-list-group-item
            ><h5><strong>Phân loại</strong></h5></b-list-group-item
          >
          <b-list-group-item v-for="(item, index) in types" :key="index">
            <a href="#" @click.prevent="getPostsByType(item)">{{ item }}</a>
            <i
              v-if="fieldFilter.type == item"
              class="success fa fa-check-square-o"
              aria-hidden="true"
            ></i>
          </b-list-group-item>
        </b-list-group>
      </div>
    </div>
  </div>
</template>

<script>
import BaseComponent from "../base-component";
export default BaseComponent.extend({
  data() {
    return {
      model: "posts",
      types: ["Chung", "Hỏi đáp", "Chia sẻ", "Thảo luận", "Tin tức"],
      titleQuery: "",
      previewImages: [
        '../../images/preview/1.jpg',
        '../../images/preview/2.jpg',
        '../../images/preview/3.jpg',
        '../../images/preview/4.jpg',
        '../../images/preview/5.jpg',
        '../../images/preview/6.jpg',
        '../../images/preview/7.jpg',
        '../../images/preview/8.jpg',
        '../../images/preview/9.jpg',
        '../../images/preview/10.jpg',
      ]
    };
  },
  methods: {
    changePageAndShuffle(page) {
      this.shuffleImages();
      this.getItems(this.model, page);
    },
    shuffleImages() {
      this.previewImages = _.shuffle(this.previewImages)
    },
    clearFilter() {
      this.fieldFilter.type = null;
      this.shuffleImages();
      this.getItems();
    },
    async getPostsByTitle() {
      this.fieldFilter.titleQuery = this.titleQuery;
      this.shuffleImages();
      await this.getItems();
    },

    async getPostsByType(type) {
      this.fieldFilter.type = type;
      this.shuffleImages();
      await this.getItems();
    },
  },
  mounted() {
    this.shuffleImages();
    this.getItems();
  },
});
</script>

<style lang="scss" scoped>
.preview {
  overflow-y: hidden;
  height: 116px;
  font-weight: 300;
  padding-left: 20px;
}
.post-form {
  width: 60%;
}

#posts-container .list-group-item {
  margin-bottom: 10px;
  border-radius: 15px;
  border-top-width: 1px !important;
}
</style>

<style>
.preview h1 {
  display: none !important;
}
.preview h2 {
  display: none !important;
}
.preview h3 {
  display: none !important;
}
.preview h4 {
  display: none !important;
}
.preview h5 {
  display: none !important;
}
.preview h6 {
  display: none !important;
}
</style>
