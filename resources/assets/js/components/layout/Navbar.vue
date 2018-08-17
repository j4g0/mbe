<template>
  <nav class="navbar navbar dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">MBE Helfer</a>
    <ul class="navbar-nav px-3" v-if="loggedIn">
      <li class="nav-item text-nowrap">
        <router-link :to="{ name: 'Logout' }" class="nav-link">
          <i class="fas fa-sign-out-alt"></i>
          Ausloggen
        </router-link>
      </li>
    </ul>
  </nav>
</template>

<script>
import store from '../../store/index.js'

export default{
  name: 'Navbar',
  data(){
    return{

    }
  },
  computed: {
    loggedIn(){
      return store.state.isLoggedIn
    }
  }
}
</script>

<style scoped>
.navbar-brand {
  padding-top: .75rem;
  padding-bottom: .75rem;
  font-size: 1rem;
  background-color: rgba(0, 0, 0, .25);
  box-shadow: inset -1px 0 0 rgba(0, 0, 0, .25);
}
</style>

