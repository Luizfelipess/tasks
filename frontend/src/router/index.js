import { createRouter, createWebHistory } from 'vue-router'
import TasksPage from '@/views/TasksPage.vue'

const routes = [
  { path: '/', redirect: '/tasks' },
  { path: '/tasks', component: TasksPage },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})
export default router
