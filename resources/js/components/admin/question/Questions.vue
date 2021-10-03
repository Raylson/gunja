<template>
  <div class="questions">
    <div class="page-title-box">
			<div class="row">
        <template v-if="showErrorMessage || showSuccessMessage">
            <div class="alert" :class="showErrorMessage ? 'alert-danger' : 'alert-success'" role="alert" v-html="message"></div>
        </template>
				<div class="col">
					<h4 class="page-title">Question</h4>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
						<li class="breadcrumb-item"><a href="javascript:void(0);">Question</a></li>
						<li class="breadcrumb-item active">List</li>
					</ol>
				</div><!--end col-->
				<div class="col-auto align-self-center">
					<button class="btn btn-default" @click="createQuestion">Create</button>
				</div><!--end col-->  
			</div><!--end row-->                                                              
		</div>
		<div class="card">
			<div class="card-header row" style="margin:0;">
        <div class="col-auto float-end p-0">
					<input type="text" id="search-field" @keyup="search" placeholder="Search by Title">
				</div><!--end col-->  
			</div>
			<div class="card-body">
				<table class="table table-striped" id="search-table">
					<thead>
					  <tr>
						<th scope="col">S.N</th>
						<th scope="col">Title</th>
						<th scope="col">Score</th>
						<th scope="col">Sub Category</th>
						<th scope="col">Action</th>
					  </tr>
					</thead>
					<tbody>
					  <tr v-for="(item, index) in items.data" :key="item.id">
              <th scope="row">{{ index + 1 }}</th>
              <td>{{ item.question }}</td>
              <td>{{ item.score }}</td>
              <td>{{ item.sub_category.title }}</td>
              <td>
                <button class="btn btn-sm btn-warning" @click="editQuestion( item.id )"><i class="far fa-edit"></i> Edit</button>
                <button class="btn btn-sm btn-danger" @click="deleteQuestion( item.id )"><i class="fas fa-trash"></i> Delete</button>
              </td>
					  </tr>
					</tbody>
				</table>
        <pagination :data="items" @pagination-change-page="getQuestion"></pagination>
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
  name: 'Question',
  data: () => {
    return {
      showErrorMessage: false,
      showSuccessMessage: false,
      items: {
        data: []
      },
      message: '',
    }
  },
  computed: {
  },
  methods: {
    createQuestion () {
      this.$router.push({path: 'questions/create'});
    },
    editQuestionLink (id) {
      return `questions/${id.toString()}/edit`
    },
    editQuestion ( id ) {
      const editQuestion = this.editQuestionLink( id );
      this.$router.push({path: editQuestion}).catch(error => { console.log });
    },
    deleteQuestion ( id ) {
      let self = this;

      Swal.fire({
        title: 'Are you sure you want to delete question?',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        showCancelButton: true,
        confirmButtonText: 'Okay',
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          axios.post(process.env.MIX_APP_URL+'/api/questions/'+id, { _method: 'DELETE' }, {
            headers: {
              'Authorization': 'Bearer '+localStorage.getItem("api_token") 
            }
          })
          .then(function (response) {
            if(response.data) {
              Swal.fire({
                title: 'Success',
                text: 'Sub Question deleted successfully',
                confirmButtonText: 'Okay'
              })
              self.getQuestion();
            }
          }).catch(function (error) {
            self.$router.push({ path: '/admin/login' });
          });
        }
      })
    },
    
    getQuestion (page){
      let self = this;
      if (typeof page === 'undefined') {
          page = 1;
      }

      axios.get(process.env.MIX_APP_URL+'/api/questions?page='+page, {
				headers: {
					'Authorization': 'Bearer '+localStorage.getItem("api_token") 
				}
			})
      .then(function (response) {
        self.items = response.data.all_questions;
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
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("search-field");
      filter = input.value.toUpperCase();
      table = document.getElementById("search-table");
      tr = table.getElementsByTagName("tr");

      // Loop through all table rows, and hide those who don't match the search query
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }
  },
  mounted: function(){
    this.getQuestion();
  },
  components: {
	  pagination: pagination,
  },
  metaInfo: {
    // Children can override the title.
    title: 'All Sub Question',
    // Define meta tags here.
    meta: [
      {name: 'description', content: 'Manage All Sub Question.'}
    ]
  }
}
</script>

<style scoped>
.card-body >>> table > tbody > tr > td {
  cursor: pointer;
}
</style>
