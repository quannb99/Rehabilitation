<template>
  <div>
    <Navigation :title="'Diễn đàn'" :page="'/forum'" />
    <div class="row col-lg-10 m-auto pt-5">
      <div class="col-lg-8">
        <b-list-group>
          <b-list-group-item v-for="(item, index) in items" :key="index">
            <h4>{{ item.title }}</h4>
            <div>
              <i v-if="item.user_role == 1" class="theme-icon-20 fa fa-user" aria-hidden="true"></i>
              <i v-if="item.user_role == 2" class="theme-icon-20 fa fa-user-md" aria-hidden="true"></i>
              <strong class="mr-2" style="font-size: 14px;"><span v-if="item.user_role == 2">Bs. </span> {{ item.user_name }}</strong>
              <i class="theme-icon fa fa-calendar" aria-hidden="true"></i>
              <span style="font-size: 14px;">{{ moment(item.created_at).fromNow() }}</span>
            </div>
          </b-list-group-item>
        </b-list-group>
        <div class="mt-5"></div>
        <b-pagination
          v-model="paging.current_page"
          :total-rows="paging.total"
          :per-page="paging.per_page"
          align="center"
          @input="changePage"
        ></b-pagination>
      </div>

      <div class="col-lg-4">
        <b-button
          variant="primary"
          class="new-post-btn"
          @click="navigateTo('new-post')"
          ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Đăng bài
          mới</b-button
        >
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
    };
  },
  mounted() {
    console.log(moment())
  },
});
</script>

<style lang="scss" scoped>
.post-form {
  width: 60%;
}
.new-post-btn {
  width: 90%;
  height: 70px;
  font-size: 20px;
}
.theme-icon-20 {
  color: #3f97da;
  font-size: 20px;
}
.theme-icon {
  color: #3f97da;
}
</style>
