<template>
  <div class="container mt-3">

    <div class="row">
      <div class="col-md-6">
        <h1>
          <i class="fas fa-users"></i>
          Klienten
          <small class="badge badge-pill badge-dark">{{ clients.length }}</small>
        </h1>
      </div>
    </div>
    <hr>

    <div class="row">
      <div class="col-md-8">
        <table class="table-borderless table-hover">
          <thead>
            <tr>
              <th>
                <i class="fas fa-folder-open"></i>
                FallNr.
              </th>
              <th>
                <i class="fas fa-user"></i>
                Klient
              </th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="client in filteredClients" :key="client.id" @click="openClientMenuModal">
              <td>{{ client.id }}</td>
              <td>{{ client.first_name }} {{ client.last_name }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-md-4">
        <form>
          <input v-model="search" class="form-control" type="text" placeholder="Suche Nachnamen">
          <transition name="fade">
            <button v-if="filteredClients == ''" class="btn btn-block btn-dark mt-2" @click.prevent="openClientAddModal">
              <i class="fas fa-user-plus"></i>
              Klient hinzufügen
            </button>
          </transition>
        </form>
      </div>
    </div>
    <ClientMenuModal v-if="showClientMenuModal == true" @closeMenuModal="closeClientMenuModal" v-bind:client="clientMenuModalProp" ></ClientMenuModal>
    <ClientAddModal v-if="showClientAddModal == true" @closeAddModal="closeClientAddModal" v-bind:clientName="search"></ClientAddModal>
  </div>
</template>

<script>
import ClientMenuModal from './ClientMenuModal'
import ClientAddModal from './ClientAddModal'

export default{
  name: 'ClientIndex',
  components: {
    ClientMenuModal,
    ClientAddModal
  },
  data(){
    return{
      clients: [],
      search: '',
      showClientMenuModal: false,
      showClientAddModal: false,
      clientMenuModalProp: {
        id: null,
        name: null
      }
    }
  },
  methods: {
    getClients(){
      axios.get('http://localhost:8000/api/clients').then(response => {
        this.clients = response.data.data
      })
    },
    openClientMenuModal(){
      this.setModalPropClient(event)
      this.showClientMenuModal = true
    },
    closeClientMenuModal(){
      this.showClientMenuModal = false
      this.getClients()
    },
    setModalPropClient(event){
      let parentNode = event.target.parentNode
      let client_id = parentNode.children[0].innerText
      let client_name = parentNode.children[1].innerText

      this.clientMenuModalProp.id = client_id
      this.clientMenuModalProp.name = client_name
    },
    openClientAddModal(){
      this.showClientAddModal = true
    },
    closeClientAddModal(){
      this.showClientAddModal = false
      this.search = ''
      this.getClients()
    },
  },
  computed: {
    filteredClients(){
      return this.clients.filter(client => {
        return client.last_name.match(this.search)
      })
    }
  },
  created(){
    this.getClients()
  }
}
</script>

<style scoped>
hr{
  margin-top: 0;
}
h1{
  color: #333;
}
table{
  width: 100%;
}
tbody tr:hover{
  cursor: pointer;
}
.fade-enter-active, 
.fade-leave-active{
  transition: opacity .5s;
}
.fade-enter,
.fade-leave-to{
  opacity: 0;
}
</style>
