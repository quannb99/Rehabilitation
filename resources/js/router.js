import Vue from "vue"
import VueRouter from "vue-router"
import Forum from "./components/Forum.vue"
import NewPost from "./components/NewPost.vue"
import App from "./components/App.vue"

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
    path: "/posts/new",
    name: "new-post",
    component: NewPost
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
