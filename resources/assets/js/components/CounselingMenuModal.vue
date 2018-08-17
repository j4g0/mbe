<template>
  <div class="modal-mask">
    <div class="modal-wrapper">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header clearfix">
            <h4 class="modal-title">
              <i class="far fa-calendar-alt"></i>
              {{ counseling.date }} - {{ counseling.client_name }}
            </h4>
            <button class="close" type="button" @click="$emit('closeModal')">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <button class="btn btn-dark btn-block" @click="editCounseling">
                  <i class="far fa-edit"></i>
                  Termin bearbeiten
                </button>
              </div>
              <div class="col-md-12 mt-2">
                <button class="btn btn-danger btn-block" @click="deleteCounseling">
                  <i class="far fa-calendar-times"></i>
                  Termin löschen
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
  name: 'CounselingMenuModal',
  props: ['counseling'],
  data(){
    return{
      cProp: {
        id: null,
        name: null
      }
    }
  },
  methods: {
    editCounseling(){
      this.$router.push({ name: 'CounselingAdd', params: { client: this.cProp, counseling_id: this.counseling.id } })
    },
    deleteCounseling(){
      axios.delete('/api/counselings/' + this.counseling.id)
        .then(this.$emit('closeModal'))
        .catch(error => console.log(error))
    }
  },
  created(){
    axios.get('/api/counselings/' + this.counseling.id)
      .then(response => {
        this.cProp.id = response.data.data.id
        this.cProp.name = response.data.data.client_name
      })
      .catch(error => console.log(error))
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
