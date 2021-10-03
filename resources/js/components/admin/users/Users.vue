<template>
  <div class="users">
    <div class="page-title-box">
			<div class="row">
        <template v-if="showErrorMessage || showSuccessMessage">
            <div class="alert" :class="showErrorMessage ? 'alert-danger' : 'alert-success'" role="alert" v-html="message"></div>
        </template>
				<div class="col">
					<h4 class="page-title">User List</h4>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
						<li class="breadcrumb-item"><a href="javascript:void(0);">Users</a></li>
						<li class="breadcrumb-item active">List</li>
					</ol>
				</div><!--end col-->
				<div class="col-auto align-self-center">
					<button class="btn btn-default" @click="createUser">Create</button>
				</div><!--end col-->  
			</div><!--end row-->                                                              
		</div>
		<div class="card">
			<div class="card-header">
				<h2>Users </h2>
			</div>
			<div class="card-body table-responsive">
				<table class="table table-striped table-responsive">
					<thead>
					  <tr>
						<!-- <th scope="col">ID</th> -->
						<th scope="col">Name</th>
						<th scope="col">Email</th>
						<th scope="col">Mobile</th>
						<th scope="col">Address</th>
						<th scope="col">Avatar</th>
						<th scope="col">User Type</th>
						<th scope="col">Action</th>
					  </tr>
					</thead>
					<tbody>
					  <tr v-for="item in items" :key="item.id">
              <!-- <th scope="row">{{item.id }}</th> -->
              <td>{{ item.first_name+(item.middle_name !=null ? ' '+item.middle_name : '')+' '+(item.last_name !=null ? ' '+item.last_name : '') }}</td>
              <td>{{ item.email }}</td>
              <td>{{ item.mobile }}</td>
              <td>{{ item.address }}</td>
              <td><img v-if="item.avatar != '' && item.avatar != null" :src="(item.provider != null) ? item.avatar : rootUrl+'/storage/'+item.avatar" alt="" style="width: 100px;" /></td>
              <td>{{ item.user_type | capitalize }}</td>
              <td>
                <button class="btn btn-sm btn-secondary" @click="showUser( item.id )"><i class="far fa-eye"></i> View</button>
                <button class="btn btn-sm btn-warning" @click="editUser( item.id )"><i class="far fa-edit"></i> Edit</button>
                <button class="btn btn-sm btn-danger" @click="deleteUser( item.id )"><i class="fas fa-trash"></i> Delete</button>
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
  name: 'Users',
  beforeRouteEnter (to, from, next) {
    document.title = 'Users';
    $('meta[name="description"]').attr("content", 'Rayzen');
    $('meta[property="og:title"]').attr("content", 'New Title');
    next()
  },
  data: () => {
    return {
      rootUrl: process.env.MIX_APP_URL,
      showErrorMessage: false,
      showSuccessMessage: false,
      items: [],
      message: '',
    }
  },
  computed: {
  },
  methods: {
    createUser () {
      this.$router.push({path: 'users/create'});
    },
    userLink (id) {
      return `users/${id.toString()}`
    },
    editUserLink (id) {
      return `users/${id.toString()}/edit`
    },
    showUser ( id ) {
      const userLink = this.userLink( id );
      this.$router.push({path: userLink}).catch(error => { console.log });
    },
    editUser ( id ) {
      const editUser = this.editUserLink( id );
      this.$router.push({path: editUser}).catch(error => { console.log });
      // this.$router.push({path: 'users/38/edit'}).catch(error => { console.log });
    },
    deleteUser ( id ) {
      let self = this;

      Swal.fire({
        title: 'Are you sure you want to delete user?',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        showCancelButton: true,
        confirmButtonText: 'Okay',
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          axios.post(process.env.MIX_APP_URL+'/api/users/'+id, { _method: 'DELETE' }, {
            headers: {
              'Authorization': 'Bearer '+localStorage.getItem("api_token") 
            }
          })
          .then(function (response) {
            if(response.data) {
              Swal.fire({
                title: 'Success',
                text: 'User deleted successfully',
                confirmButtonText: 'Okay'
              })
              self.getUsers();
            }
          }).catch(function (error) {
            self.$router.push({ path: '/admin/login' });
          });
        }
      })
    },
    
    getUsers (){
      let self = this;
      axios.get(process.env.MIX_APP_URL+'/api/users', {
				headers: {
					'Authorization': 'Bearer '+localStorage.getItem("api_token") 
				}
			})
      .then(function (response) {
        self.items = response.data.all_users;
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
    this.getUsers();
  },
  metaInfo: {
    // Children can override the title.
    title: 'All Users',
    // Define meta tags here.
    meta: [
      {name: 'description', content: 'Manage All Users.'}
    ]
  }
}
</script>

<style scoped>
.card-body >>> table > tbody > tr > td {
  cursor: pointer;
}
</style>
