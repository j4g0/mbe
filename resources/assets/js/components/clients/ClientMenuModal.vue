<template>
  <div class="modal-mask">
    <div class="modal-wrapper">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header clearfix">
            <h4 class="modal-title">
              <i class="fas fa-user"></i>
              {{ client.name }}
            </h4>
            <button class="close" type="button" @click="$emit('closeMenuModal')">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                <router-link class="btn btn-block btn-dark" :to="{ name: 'ClientFile', params: { id: client.id } }">
                  <i class="far fa-address-book"></i>
                  Klientenakte
                </router-link>
              </div>
              <div class="col-md-6">
                <router-link class="btn btn-dark btn-block" :to="{ name: 'CounselingAdd', params: { client: client } }">
                  <i class="far fa-calendar-alt"></i>
                  Termin hinzufügen
                </router-link>
              </div>
            </div>
            <hr>
            <div class="row mt-3">
              <div class="col-md-6 offset-3">
                <button class="btn btn-danger btn-block" @click.prevent="deleteClient">
                  <i class="fas fa-user-minus"></i>
                  Klienten löschen
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default{
  name: 'ClientMenuModal',
  props: [ 'client' ],
  data(){
    return{

    }
  },
  methods: {
    deleteClient(){
      axios.delete(`/api/clients/${this.client.id}`, {
        headers: {
          Authorization: 'Bearer ' + localStorage.getItem('token')
        }
      })
        .then(response => this.$emit('closeMenuModal'))
        .catch(error => console.log(error))
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
