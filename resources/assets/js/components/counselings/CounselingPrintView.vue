<template>
  <div class="counselings-print">
    <div class="container mt-3">
      <div class="row">
        <div class="col-md-8">
          <h1>
            <i class="far fa-calendar-alt"></i>
            Termine
          </h1>
        </div>
        <div class="col-md-4 mt-2">
          <button class="btn btn-light btn-block" @click="$router.go(-1)">&laquo; Zurück</button>
        </div>
      </div>
      <hr>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <input class="form-control" type="date" v-model="firstDate" :blur="blur">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <input class="form-control" type="date" v-model="lastDate">
          </div>
        </div>
      </div>

      <p v-for="counseling in sortedCounselings" :key="counseling.id">
        {{ counseling.date }}
      </p>
      
    </div>
  </div>
</template>

<script>
export default{
  name: 'CounselingPrintView',
  data(){
    return{
      counselings: [],
      quarter: [ 'Erstes', 'Zweites', 'Drittes', 'Viertes'],
      year: '2018',
      firstDate: '',
      lastDate:  ''
    }
  },
  methods: {
    fetchCounselings() {
      axios.get('/api/counselings', {
        headers: {
          Authorization: 'Bearer ' + localStorage.getItem('token')
        }
      }).then(response => {
        this.counselings = response.data.data
      }).catch(error => console.log(error))
    },
    filterCounselingsByYear(counselingArray) {
      let filteredArray = counselingArray.filter( counseling => {
        counseling = new Date(counseling.date)
        let year = new Date(this.year)
        return counseling > year
      })
      return filteredArray
    },
    blur() {
      console.log('blurred')
    }
  },
  computed: {
    sortedCounselings() {
      let counselingArray = []

      for(let counseling in this.counselings) {
        counselingArray.push(this.counselings[counseling])
      }

      counselingArray = this.filterCounselingsByYear(counselingArray)

      return counselingArray
    }
  },
  mounted() {
    this.fetchCounselings()
  }
}
</script>

<style scoped>
hr{
  margin-top: 0;
}
</style>

