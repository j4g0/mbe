<template>
  <div>
    <Navbar></Navbar>
    <div class="row">
      <Sidebar></Sidebar>
      <div class="col-md-10 offset-2 mt-5">
        <router-view></router-view>
      </div>
    </div>
  </div>
</template>

<script>
import Navbar from './components/layout/Navbar'
import Sidebar from './components/layout/Sidebar'

export default{
  name: 'App',
  components: {
    Navbar,
    Sidebar
  },
  data(){
    return{

    }
  },
  beforeDestroy() {
    console.log('delete token on closing the app')
  }
}
</script>

<style>

</style>

