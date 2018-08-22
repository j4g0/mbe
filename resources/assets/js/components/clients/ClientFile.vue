<template>
  <div class="client-file container mt-3">
    <div class="row">
      <div class="col-md-10">
        <h1>
          <i class="fas fa-user"></i>
          {{ client.last_name }}, {{ client.first_name }}
        </h1>
      </div>
      <div class="col-md-2">
        <button class="btn btn-light btn-block mt-2" @click="$router.push({ name: 'ClientIndex' })">&laquo; Zurück</button>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-md-8">
        <div class="card">

          <form class="card-body">
            <div class="row">
              <div class="col-md-6">
                <h3 class="card-title mt-2 ml-2">
                  <i class="fas fa-folder-open"></i>
                  Klientendaten
                </h3>
              </div>
              <div class="col-md-6">
                <button class="btn btn-dark btn-block mt-1" @click.prevent="saveClientFile">Speichern</button>
              </div>
            </div>
            <hr>
            
            <div class="form-group">
              <label for="fall_nr">FallNr.</label>
              <input type="number" class="form-control" disabled name="fall_nr" v-model="client.id">
            </div>
            <div class="form-group">
              <label for="first_name">Vorname</label>
              <input type="text" class="form-control" name="first_name" v-model="client.first_name">
            </div>
            <div class="form-group">
              <label for="last_name">Nachname</label>
              <input type="text" class="form-control" name="last_name" v-model="client.last_name">
            </div>
          </form><!-- end of form -->

        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-body">
          <div class="row">
            <div class="col-md-8">
              <h3 class="card-title mt-2 ml-2">
                <i class="fas fa-calendar-alt"></i>
                Termine
              </h3>
            </div>
            <div class="col-md-4">
              <button class="btn btn-dark btn-block" @click="goToCounselingAdd">
                <i class="fas fa-plus"></i>
              </button>
            </div>
          </div>
          <hr>

          <table class="table-borderless table-hover ml-2">
            <tbody>
              <tr v-for="counseling in sortedCounselings" :key="counseling.id" @click="goToCounselingAdd(counseling.id)">
                <td>{{ counseling.date | formatDate }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default{
  name: 'ClientFile',
  data(){
    return{
      client: {},
      counselings: {}
    }
  },
  filters: {
    formatDate(date) {
      let options = { weekday: 'short', year: 'numeric', month: '2-digit', day: '2-digit'}
      let outputDate = new Date(date)
      return outputDate.toLocaleDateString("de-DE", options)
    }
  },
  computed: {
    clientProp(){
      let cProp = {}
      cProp.id = this.client.id
      cProp.name = this.client.last_name + ', ' + this.client.first_name
      return cProp
    },
    sortedCounselings() {
      // build an array to sort 
      let counselingsArray = []

      for(let counseling in this.counselings) {
        counselingsArray.push(this.counselings[counseling])
      }

      counselingsArray = this.sortCounselingsByDate( counselingsArray )

      return counselingsArray
    }
  },
  methods:{
    fetchClient(client_id){
      axios.get(`/api/clients/${client_id}`, {
        headers: {
          Authorization: 'Bearer ' + localStorage.getItem('token')
        }
      })
        .then(response => {
          this.client = response.data.data
          this.counselings = this.client.counselings
        })
        .catch(error => console.log(error))
    },
    saveClientFile(){
      axios({
        method: 'put',
        url: '/api/clients/' + this.client.id,
        headers: {
          Authorization: 'Bearer ' + localStorage.getItem('token')
        },
        data: {
          first_name: this.client.first_name,
          last_name: this.client.last_name
        }
      }).then(response => {
        this.$router.push({ name: 'ClientIndex' })
      }).catch(error => console.log(error))
    },
    goToCounselingAdd(counseling_id){
      if(Number.isInteger(counseling_id)){
        this.$router.push({ name: 'CounselingAdd', params: { client: this.clientProp, counseling_id: counseling_id } })
      }else{
        this.$router.push({ name: 'CounselingAdd', params: { client: this.clientProp } })
      }
    },
    sortCounselingsByDate(counselingsArray) {
      counselingsArray.sort((a, b) => {
        a = new Date(a.date)
        b = new Date(b.date)
        return a>b ? -1 : a<b ? 1 : 0
      })
      return counselingsArray
    }
  },
  created(){
    this.fetchClient(this.$route.params.id)
  }
}
</script>

<style scoped>
tbody tr{
  cursor: pointer;
}
hr{
  margin-top: 0;
}
</style>
