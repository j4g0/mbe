import Vue from 'vue'
import VueRouter from 'vue-router'
import ClientIndex from '../components/ClientIndex'
import CounselingIndex from '../components/CounselingIndex'
import ClientFile from '../components/ClientFile'
import CounselingAdd from '../components/CounselingAdd'

Vue.use(VueRouter)

const routes = [
  { path: '/', name: 'ClientIndex', component: ClientIndex },
  { path: '/counselings', name: 'CounselingIndex', component: CounselingIndex },
  { path: '/clients/:id', name: 'ClientFile', component: ClientFile },
  { path: '/counseling', name: 'CounselingAdd', component: CounselingAdd, props: true }
]

const router = new VueRouter({
  routes
})

export default router
