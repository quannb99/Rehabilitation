import Vue from "vue"
import VueRouter from "vue-router"
import Forum from "./components/Forum.vue"
import NewPost from "./components/NewPost.vue"
import Post from "./components/Post.vue"
import EditPost from "./components/EditPost.vue"
import Schedule from "./components/Schedule.vue"

Vue.use(VueRouter)

const routes = [
  // {
  //   path: "/",
  //   name: "home",
  //   component: App
  // },
  {
    path: "/forum",
    name: "forum",
    component: Forum
  },
  {
    path: "/schedule",
    name: "schedule",
    component: Schedule
  },
  {
    path: "/posts/new",
    name: "new-post",
    component: NewPost
  },
  {
    path: "/posts/:id",
    name: "show-post",
    component: Post
  },
  {
    path: "/posts/:id/edit",
    name: "edit-post",
    component: EditPost
  },
//   {
//     path: "/event/:id",
//     name: "event-show",
//     component: EventShow,
//     props: true
//   },
]

const router = new VueRouter({
  mode: "history",
  routes
})

export default router
