<template>
<div class="modal-mask">
  <div class="modal-wrapper">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header clearfix">
          <h4 class="modal-title">
            <i class="fas fa-user"></i>
            Neue Klientenakte anlegen
          </h4>
          <button class="close" type="button" @click="$emit('closeAddModal')">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form @click.prevent>
            <div class="form-group">
              <label for="first_name" class="sr-only">Vorname</label>
              <input class="form-control" type="text" name="first_name" v-model="firstName" placeholder="Vorname" autofocus>
            </div>
            <div class="form-group">
              <label for="last_name" class="sr-only">Nachname</label>
              <input class="form-control" type="text" name="last_name" v-model="lastName" placeholder="Nachname">
            </div>
            <div class="row">
              <div class="col-md-12">
                <button class="btn btn-dark btn-block" @click.prevent="addClientAndViewFile">
                  <i class="fas fa-user"></i>
                  Speichern &amp; zur Akte
                </button>
              </div>
              <!-- <div class="col-md-6"> -->
              <!--   <button class="btn btn-dark btn-block" @click.prevent="addClientAndAddCounseling"> -->
              <!--     <i class="fas fa-calendar-alt"></i> -->
              <!--     Speichern &amp; Termin anlegen -->
              <!--   </button> -->
              <!-- </div> -->
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</template>

<script>
export default{
  name: 'ClientAddModal',
  props: ['clientName'],
  data(){
    return{
      firstName: '',
      lastName: this.clientName
    }
  },
  methods: {
    addClientAndViewFile(){
      axios.post('/api/clients', {
        first_name: this.firstName,
        last_name: this.lastName
      })
        .then(response => {
          console.log(response.data.data.id)
          this.$router.push({ name: 'ClientFile', params: { id: response.data.data.id } })
        })
        .catch(error => {
          console.log(error)
        })
    }
  }
}
</script>

<style>
.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, .5);
  display: table;
  transition: opacity .3s ease;
}

.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}
</style>
