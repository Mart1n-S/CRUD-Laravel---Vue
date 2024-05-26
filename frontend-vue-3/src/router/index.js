import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import ListStudents from "@/views/Students/ListStudents.vue";
import CreateStudent from "@/views/Students/CreateStudent.vue";
import EditStudent from "@/views/Students/EditStudent.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "home",
      component: HomeView,
    },
    {
      path: "/about",
      name: "about",
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import("../views/AboutView.vue"),
    },
    {
      path: "/students",
      name: "students",
      component: ListStudents,
    },
    {
      path: "/students/create",
      name: "createStudent",
      component: CreateStudent,
    },
    {
      path: "/students/:id/edit",
      name: "editStuent",
      component: EditStudent,
    },
  ],
});

export default router;
