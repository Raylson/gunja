<template>
  <div class="examiners">
		<div class="row p-4 mdisplay">
			<div class="col-12 mb-3" style="margin:0;">
        <div class="col-auto float-start p-0">
					<input type="number" id="search-field" v-model="searchKeyword" placeholder="Search by Submission Id">
          <button type="button" class="btn btn-default" @click="search">Search</button>
          <button type="button" class="btn btn-default" @click="getExaminer(1)">Clear</button>
          <p class="text-danger search-error" v-if="searchError != ''" v-html="searchError"></p>
				</div><!--end col-->  
			</div>
			<div class="col-12 text-center">
        <div class="table-responsive fixed-table-body">
          <table class="table table-striped bg-white" id="search-table">
            <thead class="table-dark">
              <tr>
              <th scope="col">S.N</th>
              <th scope="col">Email</th>
              <!-- <th scope="col">Unique Key</th> -->
              <th scope="col">Submission Id</th>
              <th scope="col">Submitted Date</th>
              <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(item, index) in items.data" :key="item.id">
                <th scope="row">{{ index + 1 }}</th>
                <td>{{ item.email }}</td>
                <!-- <td><a :href="`${rootUrl}/examiners/${item.id}`">{{ item.unique_key }}</a></td> -->
                <td>{{ item.submission_id }}</td>
                <td>{{ item.submission_id != '' ? item.submitted_date : '' }}</td>
                <td>
                  <button class="btn btn-sm btn-success" @click="detail( item.id )"><i class="fas fa-eye"></i> Detail</button>
                </td>
              </tr>
            </tbody>
          </table>
          <pagination :data="items" @pagination-change-page="getExaminer"></pagination>
        </div>
			</div>
		</div>	
  </div>
</template>

<script>
import axios from 'axios'
import Swal from 'sweetalert2'
const qs = require('querystring');
const pagination = require('laravel-vue-pagination');

export default {
  name: 'ExaminerList',
  data: () => {
    return {
      rootUrl: process.env.MIX_APP_URL,
      showErrorMessage: false,
      showSuccessMessage: false,
      searchKeyword: '',
      searchError: '',
      items: {
        data: []
      },
      message: '',
    }
  },
  computed: {
  },
  methods: {
    detail ( id ) {
      let self = this;
      self.$router.push({path: '/examiners/'+id});
    },
    
    getExaminer (page){
      let self = this;
      self.searchKeyword = '';
      if (typeof page === 'undefined') {
          page = 1;
      }

      axios.get(process.env.MIX_APP_URL+'/api/examiners?page='+page, {
				headers: {
					'Authorization': 'Bearer '+localStorage.getItem("api_token") 
				}
			})
      .then(function (response) {
        self.items = response.data.all_examiners;
      }).catch(function (error) {
        self.$router.push({ path: '/admin/login' });
      });
    },

    timerMessageHide() {
      setTimeout(() => {
          this.message = '';
          this.showSuccessMessage = false;
          this.showErrorMessage = false;
      }, 2000);
    },

    search() {
      let self = this;
      self.searchError = '';
      if(self.searchKeyword == '')
      {
        self.searchError = 'Enter Submission Id to search.';
        return false;
      }
      // Submit the form to edit category
      var formData = new FormData();
      formData.append('keyword', self.searchKeyword);

      axios.post(process.env.MIX_APP_URL+'/api/examiners/search', formData, {
        headers: {
          'Authorization': 'Bearer '+localStorage.getItem("api_token")
        }
      })
      .then(function (response) {
        if(response.data.status && response.data.status == 'success')
        {
          self.items.data = response.data.all_examiners;
        }
      }).catch(function (error) {
        console.log(error);
      });

    }
  },
  mounted: function(){
    this.getExaminer();
  },
  components: {
	  pagination: pagination,
  },
  metaInfo: {
    // Children can override the title.
    title: 'All Examiner',
    // Define meta tags here.
    meta: [
      {name: 'description', content: 'Manage All Examiner.'}
    ]
  }
}
</script>

<style scoped>
.card-body >>> table > tbody > tr > td {
  cursor: pointer;
}
</style>
