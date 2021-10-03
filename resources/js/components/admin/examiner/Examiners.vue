<template>
  <div class="examiners">
    <div class="page-title-box">
			<div class="row">
        <template v-if="showErrorMessage || showSuccessMessage">
            <div class="alert" :class="showErrorMessage ? 'alert-danger' : 'alert-success'" role="alert" v-html="message"></div>
        </template>
				<div class="col">
					<h4 class="page-title">Examiner</h4>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
						<li class="breadcrumb-item"><a href="javascript:void(0);">Examiner</a></li>
						<li class="breadcrumb-item active">List</li>
					</ol>
				</div><!--end col-->
			</div><!--end row-->                                                              
		</div>
		<div class="card">
			<div class="card-header row" style="margin:0;">
        <div class="col-auto float-end p-0">
					<input type="number" id="search-field" v-model="searchKeyword" placeholder="Search by Submission Id">
          <button type="button" class="btn btn-default" @click="search">Search</button>
          <button type="button" class="btn btn-default" @click="getExaminer(1)">Clear</button>
          <span class="text-danger search-error" v-if="searchError != ''" v-html="searchError"></span>
				</div><!--end col-->  
			</div>
			<div class="card-body">
				<table class="table table-striped" id="search-table">
					<thead>
					  <tr>
						<th scope="col">S.N</th>
						<th scope="col">Email</th>
						<!-- <th scope="col">Unique Key</th> -->
						<th scope="col">Submission Id</th>
						<th scope="col">Submitted Date</th>
						<!-- <th scope="col">Action</th> -->
					  </tr>
					</thead>
					<tbody>
					  <tr v-for="(item, index) in items.data" :key="item.id">
              <th scope="row">{{ index + 1 }}</th>
              <td><a :href="`${rootUrl}/admin/examiners/${item.id}`">{{ item.email }}</a></td>
              <!-- <td><a :href="`${rootUrl}/admin/examiners/${item.id}`">{{ item.unique_key }}</a></td> -->
              <td><a :href="`${rootUrl}/admin/examiners/${item.id}`">{{ item.submission_id }}</a></td>
              <td><a :href="`${rootUrl}/admin/examiners/${item.id}`">{{ item.submission_id != '' ? item.updated_at : '' }}</a></td>
              <!-- <td>
                <button class="btn btn-sm btn-danger" @click="deleteExaminer( item.id )"><i class="fas fa-trash"></i> Delete</button>
              </td> -->
					  </tr>
					</tbody>
				</table>
        <pagination :data="items" @pagination-change-page="getExaminer"></pagination>
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
  name: 'Examiner',
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
    createExaminer () {
      this.$router.push({path: 'examiners/create'});
    },
    deleteExaminer ( id ) {
      let self = this;

      Swal.fire({
        title: 'Are you sure you want to delete examiner?',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        showCancelButton: true,
        confirmButtonText: 'Okay',
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          axios.post(process.env.MIX_APP_URL+'/api/examiners/'+id, { _method: 'DELETE' }, {
            headers: {
              'Authorization': 'Bearer '+localStorage.getItem("api_token") 
            }
          })
          .then(function (response) {
            if(response.data) {
              Swal.fire({
                title: 'Success',
                text: 'Examiner deleted successfully',
                confirmButtonText: 'Okay'
              })
              self.getExaminer();
            }
          }).catch(function (error) {
            self.$router.push({ path: '/admin/login' });
          });
        }
      })
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
