import { createRouter, createWebHashHistory } from 'vue-router';
import TaskList from '@/views/TaskList.vue';
import EditTask from '@/views/EditTask.vue';
import AddTask from '@/views/AddTask.vue';

const routes = [
  {
    name: 'AddTask',
    path: '/project/:projectId/add-task',
    component: AddTask,
  },
  {
    path: '/',
    name: 'TaskList',
    component: TaskList,
  },
  {
    path: '/tasks/:id/edit',
    name: 'EditTask',
    component: EditTask,
    props: true,
  },
];

const router = createRouter({
  history: createWebHashHistory(),
  routes,
});

export default router;
