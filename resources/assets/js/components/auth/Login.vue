<template>
  <div class="container mt-3">
    <h1>Login</h1>
    <hr>
    
    <div class="row mt-5">
      <div class="col-md-4 offset-3">
        <form @submit.prevent="submitLogin">
          <div class="form-group">
            <label class="sr-only" for="email">Email</label>
            <input type="email" class="form-control" name="email" v-model="email" placeholder="Email Adresse" required autofocus>
          </div>
          <div class="form-group">
            <label class="sr-only" for="password">Passwort</label>
            <input type="password" class="form-control" name="password" v-model="password" placeholder="Passwort" required>
          </div>
          <button class="btn btn-dark btn-block" type="submit">Anmelden</button>
        </form>
      </div>
    </div><!-- end of .row -->
  </div><!-- end of .container -->
</template>

<script>
import store from '../../store/index.js'

export default{
  name: 'Login',
  data(){
    return{
      email: null,
      password: null,
      loginError: false
    }
  },
  methods: {
    submitLogin(){
      this.loginError = false
      axios.post('/api/auth/login', {
        email: this.email,
        password: this.password
      }).then(response => {
        store.commit('loginUser')
        localStorage.setItem('token', response.data.access_token)
        this.$router.push({ name: 'ClientIndex' })
      }).catch(error => {
        this.loginError = true
      })
    }
  }
}
</script>

<style>

</style>

