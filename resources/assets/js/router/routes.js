import Vue from 'vue'
import VueRouter from 'vue-router'
import ClientIndex from '../components/clients/ClientIndex'
import ClientFile from '../components/clients/ClientFile'
import CounselingIndex from '../components/counselings/CounselingIndex'
import CounselingAdd from '../components/counselings/CounselingAdd'
import CounselingPrintView from '../components/counselings/CounselingPrintView'
import Login from '../components/auth/Login.vue'
import Logout from '../components/auth/Logout.vue'
import store from '../store/index.js'

Vue.use(VueRouter)

const routes = [
  //{ path: '/', name: 'ClientIndex', component: ClientIndex },
  { path: '/', redirect: { name: 'Login' }},
  { path: '/clients', name: 'ClientIndex', component: ClientIndex, meta: { requiresAuth: true }},
  // { path: '/counselings', name: 'CounselingIndex', component: CounselingIndex, meta: { requiresAuth: true } },
  { path: '/clients/:id', name: 'ClientFile', component: ClientFile , meta: { requiresAuth: true }},
  { path: '/counseling', name: 'CounselingAdd', component: CounselingAdd, props: true , meta: { requiresAuth: true }},
  { path: '/counselings', name: 'CounselingPrintView', component: CounselingPrintView, meta: { requiresAuth: true }},
  { path: '/login', name: 'Login', component: Login },
  { path: '/logout', name: 'Logout', component: Logout , meta: { requiresAuth: true }}
]

const router = new VueRouter({
  routes
})

router.beforeEach((to, from, next) => {

    // check if the route requires authentication and user is not logged in
    if (to.matched.some(route => route.meta.requiresAuth) && !store.state.isLoggedIn) {
        // redirect to login page
        next({ name: 'Login' })
        return
    }

    // if logged in redirect to dashboard
    if(to.path === '/login' && store.state.isLoggedIn) {
        next({ name: 'ClientIndex' })
        return
    }

    next()
})

export default router
