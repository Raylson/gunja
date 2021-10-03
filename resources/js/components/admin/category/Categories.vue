<template>
  <div class="categories">
    <div class="page-title-box">
			<div class="row">
        <template v-if="showErrorMessage || showSuccessMessage">
            <div class="alert" :class="showErrorMessage ? 'alert-danger' : 'alert-success'" role="alert" v-html="message"></div>
        </template>
				<div class="col">
					<h4 class="page-title">Category</h4>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
						<li class="breadcrumb-item"><a href="javascript:void(0);">Categories</a></li>
						<li class="breadcrumb-item active">List</li>
					</ol>
				</div><!--end col-->
				<div class="col-auto align-self-center">
					<button class="btn btn-default" @click="createCategory">Create</button>
				</div><!--end col-->  
			</div><!--end row-->                                                              
		</div>
		<div class="card">
			<div class="card-header row" style="margin:0;">
        <div class="col-auto float-end p-0">
					<input type="text" id="search-field" @keyup="search" placeholder="Search Category by Title">
				</div><!--end col-->  
			</div>
			<div class="card-body">
				<table class="table table-striped" id="search-table">
					<thead>
					  <tr>
						<th scope="col">S.N</th>
						<th scope="col">Title</th>
						<th scope="col">Action</th>
					  </tr>
					</thead>
					<tbody>
					  <tr v-for="(item, index) in items.data" :key="item.id">
              <th scope="row">{{ index + 1 }}</th>
              <td>{{ item.title }}</td>
              <td>
                <button class="btn btn-sm btn-warning" @click="editCategory( item.id )"><i class="far fa-edit"></i> Edit</button>
                <button class="btn btn-sm btn-danger" @click="deleteCategory( item.id )"><i class="fas fa-trash"></i> Delete</button>
              </td>
					  </tr>
					</tbody>
				</table>
        <pagination :data="items" @pagination-change-page="getCategories"></pagination>
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
  name: 'Categories',
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
    createCategory () {
      this.$router.push({path: 'categories/create'});
    },
    editCategoryLink (id) {
      return `categories/${id.toString()}/edit`
    },
    editCategory ( id ) {
      const editCategory = this.editCategoryLink( id );
      this.$router.push({path: editCategory}).catch(error => { console.log });
      // this.$router.push({path: 'categories/38/edit'}).catch(error => { console.log });
    },
    deleteCategory ( id ) {
      let self = this;

      Swal.fire({
        title: 'Are you sure you want to delete category?',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        showCancelButton: true,
        confirmButtonText: 'Okay',
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          axios.post(process.env.MIX_APP_URL+'/api/categories/'+id, { _method: 'DELETE' }, {
            headers: {
              'Authorization': 'Bearer '+localStorage.getItem("api_token") 
            }
          })
          .then(function (response) {
            if(response.data) {
              Swal.fire({
                title: 'Success',
                text: 'Category deleted successfully',
                confirmButtonText: 'Okay'
              })
              self.getCategories();
            }
          }).catch(function (error) {
            self.$router.push({ path: '/admin/login' });
          });
        }
      })
    },
    
    getCategories (page){
      let self = this;
      if (typeof page === 'undefined') {
          page = 1;
      }

      axios.get(process.env.MIX_APP_URL+'/api/categories?page='+page, {
				headers: {
					'Authorization': 'Bearer '+localStorage.getItem("api_token") 
				}
			})
      .then(function (response) {
        self.items = response.data.all_categories;
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
    this.getCategories();
  },
  components: {
	  pagination: pagination,
  },
  metaInfo: {
    // Children can override the title.
    title: 'All Categories',
    // Define meta tags here.
    meta: [
      {name: 'description', content: 'Manage All Category.'}
    ]
  }
}
</script>

<style scoped>
.card-body >>> table > tbody > tr > td {
  cursor: pointer;
}
</style>
