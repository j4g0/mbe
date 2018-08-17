<template>
  <div class="counselings">
    <div class="container mt-3">
      <h1>
        <i class="far fa-calendar-alt"></i>
        Termine
      </h1>
      <hr>
      <div class="row">
        <div class="col-md-12 mb-3">
          <nav aria-label="Page navigation">
						<ul class="pagination">
              <li class="page-item" v-bind:class="[{ disabled: !pagination.prevPageUrl }]">
                <a @click.prevent="getCounselings(pagination.prevPageUrl)" class="page-link" href="#">Zurück</a>
              </li>
              <li class="page-item disabled">
                <a class="page-link text-dark" href="#">Seite {{ pagination.currentPage }} von {{ pagination.lastPage }}</a>
              </li>
              <li class="page-item" v-bind:class="[{ disabled: !pagination.nextPageUrl }]">
                <a @click.prevent="getCounselings(pagination.nextPageUrl)" class="page-link" href="#">Vor</a>
              </li>
						</ul>
					</nav>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <table class="table-borderless table-hover table-striped">
            <thead>
              <tr>
                <th>
                  <i class="fas fa-calendar-alt"></i>
                  Datum
                </th>
                <th>
                  <i class="fas fa-folder-open"></i>
                  FallNr.
                </th>
                <th>
                  <i class="fas fa-user"></i>
                  Name
                </th>
                <th>
                  <i class="fas fa-comment-alt"></i>
                  Notiz
                </th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="counseling in counselings" :key="counseling.id" @click="openCounselingMenuModal(counseling.id)">
                <td>{{ counseling.date | formatDate}}</td>
                <td>{{ counseling.client_id }}</td>
                <td>{{ counseling.client_name }}</td>
                <td>{{ counseling.description | shortenDescription }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <CounselingMenuModal 
      v-if="showModal == true" 
      v-bind:counseling="counselingModalProp"
      @closeModal="closeCounselingMenuModal"
    ></CounselingMenuModal>
  </div>
</template>

<script>
import CounselingMenuModal from './CounselingMenuModal'

export default{
  name: 'CounselingIndex',
  components: {
    CounselingMenuModal
  },
  data(){
    return{
      counselings: [],
      pagination: {},
      showModal: false,
      counselingModalProp:{
        id: null,
        date: null,
        client_name: null
      }
    }
  },
  filters: {
    shortenDescription(desc){
      if (!desc) return ''
      desc = desc.toString()
      return desc.substring(0,40)
    },
    formatDate(date){
      let options = { weekday: 'short', year: 'numeric', month: '2-digit', day: '2-digit'}
      let outputDate = new Date(date)
      return outputDate.toLocaleDateString("de-DE", options)
    }
  },
  methods: {
    getCounselings(pageUrl){
      let vm = this;
      pageUrl = pageUrl || '/api/counselings'

      axios.get(pageUrl, {
        headers: {
          Authorization: 'Bearer ' + localStorage.getItem('token')
        }
      }).then(response => {
        let responseObject = response.data
        this.counselings = responseObject.data
        vm.makePagination(responseObject.meta, responseObject.links)
      }).catch(error => {
        console.log(error)
      })
    },
    makePagination(meta, links){
      let pagination = {
        currentPage : meta.current_page,
        lastPage    : meta.last_page,
        nextPageUrl : links.next,
        prevPageUrl : links.prev
      }

      this.pagination = pagination
    },
    openCounselingMenuModal(counseling_id){
      this.setCounselingModalProp(counseling_id, event)
      this.showModal = true
    },
    closeCounselingMenuModal(){
      this.showModal = false
      this.getCounselings()
    },
    setCounselingModalProp(counseling_id, event){
      let parentNode = event.target.parentNode
      let date = parentNode.children[0].innerText
      let client_name = parentNode.children[2].innerText

      this.counselingModalProp.id = counseling_id
      this.counselingModalProp.date = date
      this.counselingModalProp.client_name = client_name
    }
  },
  created(){
    this.getCounselings()
  }
}
</script>

<style scoped>
table{
  width: 100%;
}
tbody tr:hover{
  cursor: pointer;
}
</style>
