import { createRouter, createWebHistory } from "vue-router";
import TaskList from "@/views/TaskList.vue";
import EditTask from "@/views/EditTask.vue";

const routes = [
  {
    path: "/",
    name: "TaskList",
    component: TaskList,
  },
  {
    path: "/tasks/:id/edit",
    name: "EditTask",
    component: EditTask,
    props: true,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
