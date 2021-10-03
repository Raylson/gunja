<template>
  <div class="user-detail">
    <div class="page-title-box">
			<div class="row">
				<div class="col">
					<h4 class="page-title">User Detail</h4>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
						<li class="breadcrumb-item"><a href="javascript:void(0);">User</a></li>
						<li class="breadcrumb-item active">Detail</li>
					</ol>
				</div><!--end col-->
        		<div class="col-auto align-self-center">
					<button class="btn btn-sm btn-default" @click="goBack">Back</button>
				</div><!--end col--> 
			</div><!--end row-->                                                              
		</div>
		<div class="row create">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<div class="row mb-3 align-items-center">
							<div class="col-2">
								<label class="form-label">First Name </label>
							</div>
							<div class="col-10">
								<p v-if="user"><strong>{{ user.first_name }}</strong></p>
							</div>
						</div>
						<div class="row mb-3 align-items-center">
							<div class="col-2">
								<label class="form-label">Middle Name </label>
							</div>
							<div class="col-10">
								<p v-if="user"><strong>{{ user.middle_name }}</strong></p>
							</div>
						</div>
						<div class="row mb-3 align-items-center">
							<div class="col-2">
								<label class="form-label">Last Name </label>
							</div>
							<div class="col-10">
								<p v-if="user"><strong>{{ user.last_name }}</strong></p>
							</div>
						</div>
            			<div class="row mb-3 align-items-center">
							<div class="col-2">
								<label class="form-label">Username </label>
							</div>
							<div class="col-10">
								<p v-if="user"><strong>{{ user.username }}</strong></p>
							</div>
						</div>
            			<div class="row mb-3 align-items-center">
							<div class="col-2">
								<label class="form-label">Email </label>
							</div>
							<div class="col-10">
								<p v-if="user"><strong>{{ user.email }}</strong></p>
							</div>
						</div>
						<div class="row mb-3 align-items-center">
							<div class="col-2">
								<label class="form-label">Mobile No. </label>
							</div>
							<div class="col-10">
								<p v-if="user"><strong>{{ user.mobile }}</strong></p>
							</div>
						</div>
						<div class="row mb-3 align-items-center">
							<div class="col-2">
								<label class="form-label">Address </label>
							</div>
							<div class="col-10">
								<p v-if="user"><strong>{{ user.address }}</strong></p>
							</div>
						</div>
						<div class="row mb-3 align-items-center">
							<div class="col-2">
								<label class="form-label">Website </label>
							</div>
							<div class="col-10">
								<p v-if="user"><strong>{{ user.website }}</strong></p>
							</div>
						</div>
						<div class="row mb-3 align-items-center">
							<div class="col-2">
								<label class="form-label">User Bio </label>
							</div>
							<div class="col-10">
								<p v-if="user"><strong>{{ user.bio }}</strong></p>
							</div>
						</div>
            			<div class="row mb-3 align-items-center">
							<div class="col-2">
								<label class="form-label">User Image </label>
							</div>
							<div class="col-10">
								<a v-if="user.avatar" :href="'/storage/'+user.avatar" target="_blank">
								<img :src="'/storage/'+user.avatar" class="product_images">
								</a>
							</div>
						</div>
						<div class="row">
							<hr>
							<div class="col-9 offset-2">
								<button class="btn btn-default" @click="goBack">Back</button>
							</div>
						</div>
					</div>
				</div>		
			</div>
		</div>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  name: 'User',
  props: {
  },
  data: () => {
    return {
	  role: '',
      user: []
    }
  },
  methods: {
    goBack() {
      // this.$router.go(-1)
      this.$router.replace({path: '/admin/users'})
    },
  },
  mounted: function(){
    let self = this;
    // Get user detail
    axios.get(process.env.MIX_APP_URL+'/api/users/' + self.$route.params.id, {
      headers: {
        'Authorization': 'Bearer '+localStorage.getItem("api_token") 
      }
    })
    .then(function (response) {
      self.user = response.data.user;
      self.role = response.data.role;
    }).catch(function (error) {
      self.$router.push({ path: '/admin/login' });
    });
  }
}


</script>
<style scoped>
	.product_images { width: 100px; display: inline-block; padding: 10px 10px 10px 0; }
</style>