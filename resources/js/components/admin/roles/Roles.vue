<template>
  <div class="roles">
    <div class="page-title-box">
			<div class="row">
        <template v-if="showErrorMessage || showSuccessMessage">
            <div class="alert" :class="showErrorMessage ? 'alert-danger' : 'alert-success'" role="alert" v-html="message"></div>
        </template>
				<div class="col">
					<h4 class="page-title">Role List</h4>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
						<li class="breadcrumb-item"><a href="javascript:void(0);">Roles</a></li>
						<li class="breadcrumb-item active">List</li>
					</ol>
				</div><!--end col-->
				<div class="col-auto align-self-center">
					<button class="btn btn-sm btn-primary" @click="createRole">Create</button>
				</div><!--end col-->  
			</div><!--end row-->                                                              
		</div>
		<div class="card">
			<div class="card-header">
				<h2>Roles </h2>
			</div>
			<div class="card-body">
				<table class="table table-striped">
					<thead>
					  <tr>
						<!-- <th scope="col">ID</th> -->
						<th scope="col">Name</th>
						<th scope="col">Display Name</th>
						<th scope="col">Action</th>
					  </tr>
					</thead>
					<tbody>
					  <tr v-for="item in items" :key="item.id">
              <!-- <th scope="row">{{item.id }}</th> -->
              <td>{{ item.name }}</td>
              <td>{{ item.display_name }}</td>
              <td>
                <button class="btn btn-sm btn-warning" @click="showRole( item.id )"><i class="far fa-eye"></i> View</button>
                <button class="btn btn-sm btn-default" @click="editRole( item.id )"><i class="far fa-edit"></i> Edit</button>
                <button class="btn btn-sm btn-danger" @click="deleteRole( item.id )"><i class="fas fa-trash"></i> Delete</button>
              </td>
					  </tr>
					</tbody>
				</table>
			</div>
		</div>	
  </div>
</template>

<script>
import axios from 'axios'
import Swal from 'sweetalert2'
const qs = require('querystring');

export default {
  name: 'Roles',
  beforeRouteEnter (to, from, next) {
    document.title = 'Roles';
    $('meta[name="description"]').attr("content", 'Rayzen');
    $('meta[property="og:title"]').attr("content", 'New Title');
    next()
  },
  data: () => {
    return {
      showErrorMessage: false,
      showSuccessMessage: false,
      message: '',
      items: [],
      currentPage: 1,
      perPage: 5,
      totalRows: 0,
      message: '',
      showMessage: false,
      dismissSecs: 7,
      dismissCountDown: 0,
      showDismissibleAlert: false
    }
  },
  computed: {
  },
  methods: {
    createRole () {
      this.$router.push({path: 'roles/create'});
    },
    roleLink (id) {
      return `roles/${id.toString()}`
    },
    editLink (id) {
      return `roles/${id.toString()}/edit`
    },
    showRole ( id ) {
      const roleLink = this.roleLink( id );
      this.$router.push({path: roleLink}).catch(error => { console.log });
    },
    editRole ( id ) {
      const editLink = this.editLink( id );
      this.$router.push({path: editLink});
    },
    deleteRole ( id ) {
      let self = this;

      Swal.fire({
        title: 'Are you sure you want to delete role?',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        showCancelButton: true,
        confirmButtonText: 'Okay',
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          axios.post(process.env.MIX_APP_URL+'/api/roles/'+id, { _method: 'DELETE' }, {
            headers: {
              'Authorization': 'Bearer '+localStorage.getItem("api_token") 
            }
          })
          .then(function (response) {
            if(response.data) {
              Swal.fire({
                title: 'Success',
                text: 'Role deleted successfully',
                confirmButtonText: 'Okay'
              })
              self.getRoles();
            }
          }).catch(function (error) {
            self.$router.push({ path: '/admin/login' });
          });
        }
      })
    },
    showAlert () {
      this.dismissCountDown = this.dismissSecs
    },
    getRoles (){
      let self = this;
      axios.get(process.env.MIX_APP_URL+'/api/roles', {
				headers: {
					'Authorization': 'Bearer '+localStorage.getItem("api_token") 
				}
			})
      .then(function (response) {
        self.items = response.data.all_roles;
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
    }
  },
  mounted: function(){
    this.getRoles();
  },
  metaInfo: {
    // Children can override the title.
    title: 'All Roles',
    // Define meta tags here.
    meta: [
      {name: 'description', content: 'Manage All Roles.'}
    ]
  }
}
</script>

<style scoped>
.card-body >>> table > tbody > tr > td {
  cursor: pointer;
}
</style>
