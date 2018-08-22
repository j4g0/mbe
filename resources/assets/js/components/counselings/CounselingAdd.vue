<template>
  <div class="counseling-single container mt-3">
    <div class="row">
      <div class="col-md-10">
        <h1>
          <i class="fas fa-calendar-alt"></i>
          Termin hinzufügen
        </h1>
      </div>
      <div class="col-md-2">
        <button class="btn btn-light btn-block mt-2" @click="$router.go(-1)">&laquo; Zurück</button>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-md-12">
        <form>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="fall_nr">
                  <i class="fas fa-folder-open"></i>
                  FallNr.
                </label>
                <input type="number" disabled name="fall_nr" class="form-control" :value="client.id">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="date">
                  <i class="fas fa-clock"></i>
                  Datum
                </label>
                <input type="date" id="date" name="date" class="form-control" v-model:value="date">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="name">
                  <i class="fas fa-user"></i>
                  Name
                </label>
                <input type="text" name="name" class="form-control" disabled :value="client.name">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="description">
              <i class="fas fa-book-open"></i>
              Notizen
            </label>
            <textarea id="description" name="description" class="form-control" rows="5" v-model:value="description"></textarea>
          </div>
          <div class="row">
            <div class="col-md-6 offset-6">
              <button class="btn btn-dark btn-block" @click.prevent="saveCounseling">
                <i class="fas fa-save"></i>
                Speichern
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default{
  name: 'CounselingSingle',
  props: ['client', 'counseling_id'],
  data(){
    return{
      date: null,
      description: null
    }
  },
  methods: {
    saveCounseling(){
      if(this.counseling_id){
        this.editCounseling()
      }else{
        this.storeCounseling()
      }
    },
    storeCounseling(){
      axios({
        method: 'post',
        url: '/api/counselings',
        headers: {
          Authorization: 'Bearer ' + localStorage.getItem('token')
        },
        data: {
          client_id: this.client.id,
          description: this.description,
          date: this.date
        }
      })
        //.then(this.$router.push({ name: 'ClientIndex' }))
        .then(this.$router.go(-1))
        .catch(error => console.log(error))
    },
    editCounseling(){
      axios({
        method: 'put',
        url: '/api/counselings/' + this.counseling_id,
        headers: {
          Authorization: 'Bearer ' + localStorage.getItem('token')
        },
        data: {
          client_id: this.client.id,
          description: this.description,
          date: this.date
        }
      })
        //.then(this.$router.push({ name: 'ClientIndex' }))
        .then(this.$router.go(-1))
        .catch(error => console.log(error))
    }
  },
  mounted(){
    if(this.counseling_id){
      axios.get('/api/counselings/' + this.counseling_id, {
        headers: {
          Authorization: 'Bearer ' + localStorage.getItem('token')
        }
      })
        .then(response => {
          this.date = response.data.data.date
          this.description = response.data.data.description
        })
        .catch(error => console.log(error))
    }
  }
}
</script>

<style>

</style>
