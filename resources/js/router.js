import Vue from "vue"
import VueRouter from "vue-router"
import Forum from "./components/Forum.vue"
import NewPost from "./components/NewPost.vue"
import Post from "./components/Post.vue"
import EditPost from "./components/EditPost.vue"
import Schedule from "./components/Schedule.vue"
import Doctors from "./components/Doctors.vue"
import Home from "./components/Home.vue"
import Appointments from "./components/Appointments.vue"
import CreateMedicalRecord from "./components/CreateMedicalRecord.vue"
import ShowMedicalRecord from "./components/ShowMedicalRecord.vue"
import UserInfo from "./components/UserInfo.vue"
import OtherUserInfo from "./components/OtherUserInfo.vue"
import MedicalRecordList from "./components/MedicalRecordList.vue"
import VideoCall from "./components/VideoCall.vue"
import AdminHome from "./components/AdminHome.vue"
import UserManage from "./components/UserManage.vue"
import PostManage from "./components/PostManage.vue"
import ReportManage from "./components/ReportManage.vue"
import CreateUser from "./components/CreateUser.vue"

Vue.use(VueRouter)

const routes = [
  {
    path: "/",
    name: "home",
    component: Home
  },
  {
    path: "/admin",
    name: "adminHome",
    component: AdminHome,
  },
  {
    path: "/userManage",
    name: "userManage",
    component: UserManage,
  },
  {
    path: "/postManage",
    name: "postManage",
    component: PostManage,
  },
  {
    path: "/reportManage",
    name: "reportManage",
    component: ReportManage,
  },
  {
    path: "/createUser",
    name: "createUser",
    component: CreateUser,
  },
  {
    path: "/call/:id",
    name: "videoCall",
    component: VideoCall
  },
  {
    path: "/user-info",
    name: "userInfo",
    component: UserInfo
  },
  {
    path: "/user-info/:id",
    name: "otherUserInfo",
    component: OtherUserInfo
  },
  {
    path: "/forum",
    name: "forum",
    component: Forum
  },
  {
    path: "/create-medical-record",
    name: "createMedicalRecord",
    component: CreateMedicalRecord
  },
  {
    path: "/show-medical-record/:id",
    name: "showMedicalRecord",
    component: ShowMedicalRecord
  },
  {
    path: "/medical-record-list",
    name: "MedicalRecordList",
    component: MedicalRecordList
  },
  {
    path: "/appointments",
    name: "appointments",
    component: Appointments
  },
  {
    path: "/doctors",
    name: "doctors",
    component: Doctors
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

// router.beforeEach((to, from) => {
//   console.log(to);
//   console.log(from);
//   console.log(window.User);
//   return { name:'home'}
// })

export default router
