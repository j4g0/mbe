<template>

</template>

<script>
import store from '../../store/index.js'

export default{
  name: 'Logout',
  data(){
    return{

    }
  },
  mounted(){
    localStorage.removeItem('token')
    store.commit('logoutUser')
    this.$router.push({ name: 'Login' })
  }
}
</script>

<style>

</style>

