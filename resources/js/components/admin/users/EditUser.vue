<template>
  <div class="user-detail">
    <div class="page-title-box">
			<div class="row">
				<div class="col">
					<h4 class="page-title">Edit User</h4>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
						<li class="breadcrumb-item"><a href="javascript:void(0);">User</a></li>
						<li class="breadcrumb-item active">Edit</li>
					</ol>
				</div><!--end col-->	
			</div><!--end row-->                                                              
		</div>
    <form id="register-user" @submit.prevent="register">
      <div class="row create">
        <div class="col-9">
          <div class="card">
            <div class="card-body">
              <div class="row mb-3 align-items-center">
                <div class="col-3">
                  <label for="first_name" class="form-label">First Name <span class="text-danger form-text">*</span></label>
                </div>
                <div class="col-9">
                  <input type="text" class="form-control" id="first_name" name="first_name" v-model="user.first_name" required>
                  <span class="invalid-feedback" v-if="Object.keys(errors).length" role="alert">
                      <strong>{{ errors.first_name }}</strong>
                  </span>
                </div>
              </div>
              <div class="row mb-3 align-items-center">
                <div class="col-3">
                  <label for="middle_name" class="form-label">Middle Name</label>
                </div>
                <div class="col-9">
                  <input type="text" class="form-control" id="middle_name" name="middle_name" v-model="user.middle_name">
                  <span class="invalid-feedback" v-if="Object.keys(errors).length" role="alert">
                      <strong>{{ errors.middle_name }}</strong>
                  </span>
                </div>
              </div>
              <div class="row mb-3 align-items-center">
                <div class="col-3">
                  <label for="last_name" class="form-label">Last Name <span class="text-danger form-text">*</span></label>
                </div>
                <div class="col-9">
                  <input type="text" class="form-control" id="last_name" name="last_name" v-model="user.last_name" required>
                  <span class="invalid-feedback" v-if="Object.keys(errors).length" role="alert">
                      <strong>{{ errors.last_name }}</strong>
                  </span>
                </div>
              </div>
              <div class="row mb-3 align-items-center">
                <div class="col-3">
                  <label for="username" class="form-label">Username <span class="text-danger form-text">*</span></label>
                </div>
                <div class="col-9">
                  <input type="text" class="form-control" id="username" name="username" v-model="user.username" required>
                  <span class="invalid-feedback" v-if="Object.keys(errors).length" role="alert">
                      <strong>{{ errors.username }}</strong>
                  </span>
                </div>
              </div>
              <div class="row mb-3 align-items-center">
                <div class="col-3">
                  <label for="gender" class="form-label">Gender <span class="text-danger form-text">*</span></label>
                </div>
                <div class="col-7">
                  <select class="form-select" aria-label="Select Gender" v-model="user.gender" required>
                    <option value="" selected>- Select Gender -</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                  </select>
                </div>
              </div>
              <div class="row mb-3 align-items-center">
                <div class="col-3">
                  <label for="email" class="form-label">Email <span class="text-danger form-text">*</span></label>
                </div>
                <div class="col-7">
                  <input type="email" class="form-control" id="email" name="email" v-model="user.email" required>
                  <span class="invalid-feedback" v-if="Object.keys(errors).length" role="alert">
                      <strong>{{ errors.email }}</strong>
                  </span>
                </div>
              </div>
              <div class="row mb-3 align-items-center">
                <div class="col-3">
                  <label for="mobile" class="form-label">Mobile No. <span class="text-danger form-text">*</span></label>
                </div>
                <div class="col-7">
                  <input type="number" class="form-control" id="mobile" name="mobile" v-model="user.mobile" required>
                  <span class="invalid-feedback" v-if="Object.keys(errors).length" role="alert">
                      <strong>{{ errors.mobile }}</strong>
                  </span>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-3">
                  <label for="address" class="form-label">Address <span class="text-danger form-text">*</span></label>
                </div>
                <div class="col-7">
                  <input type="text" class="form-control" id="address" name="address" v-model="user.address" required>
                  <span class="invalid-feedback" v-if="Object.keys(errors).length" role="alert">
                      <strong>{{ errors.address }}</strong>
                  </span>
                </div>
              </div>
              <div class="row mb-3 align-items-center">
                <div class="col-3">
                  <label for="website" class="form-label">Website</label>
                </div>
                <div class="col-9">
                  <input type="text" class="form-control" id="website" name="website" v-model="user.website">
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-3">
                  <label for="bio" class="form-label">User Bio</label>
                </div>
                <div class="col-9">
                  <textarea class="form-control" rows="6" id="bio" name="bio" v-model="user.bio"></textarea>
                </div>
              </div>
              <div class="row mb-3 align-items-center">
                <div class="col-3">
                  <label for="password" class="form-label">Password <span class="text-danger form-text">*</span></label>
                </div>
                <div class="col-9">
                  <input type="password" class="form-control" placeholder="********" autocomplete="off" id="password" name="password" v-model="user.password">
                  <span class="invalid-feedback" v-if="Object.keys(errors).length" role="alert">
                      <strong>{{ errors.password }}</strong>
                  </span>
                </div>
              </div>
              <div class="row mb-3 align-items-center">
                <div class="col-3">
                  <label for="password_confirmation" class="form-label">Confirm Password <span class="text-danger form-text">*</span></label>
                </div>
                <div class="col-9">
                  <input type="password" class="form-control" placeholder="********" autocomplete="off" id="password_confirmation" name="password_confirmation" v-model="user.password_confirmation">
                </div>
              </div>
              <div class="row mb-3 align-items-center">
                <div class="col-3">
                  <label for="role" class="form-label">User Type <span class="text-danger form-text">*</span></label>
                </div>
                <div class="col-9">
                  <select class="form-select" aria-label="Select User Type" v-model="user.user_type" required>
                    <option value="" selected>- Select User Type -</option>
                    <option value="user">Normal Admin</option>
                    <option value="admin">Admin</option>
                    <option value="superadmin">Super Admin</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-9 offset-3">
                  <button class="btn btn-primary btn-submit" type="submit">Submit</button>
                  <button class="btn btn-danger" type="button" @click="goBack">Back</button>
                </div>
              </div>
            </div>
          </div>		
        </div>
        <div class="col-3">
          <div class="card">
            <div class="card-header bg-default text-light">
              <h2>User Profile</h2>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-12">
                  <div class="avatar-upload">
                    <div class="avatar-edit">
                      <input type='file' id="imageUpload" name="avatar" accept="image/x-png, image/gif, image/jpeg" ref="avatar" @change="handleUserImageUpload" />
                      <label for="imageUpload"></label>
                    </div>
                    <div class="avatar-preview">
                      <div id="imagePreview" v-if="user.avatar" :style="`background-image: url('${rootUrl+'/storage/'+user.avatar}');`">
                      </div>
                    </div>
                  </div>
                </div>
              </div>				
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import axios from 'axios'
// import $ from 'jquery'
export default {
  name: 'EditUser',
  props: {
  },
  data: () => {
    return {
      rootUrl: process.env.MIX_APP_URL,
      errors: [],
      user: {
        name: '',
        email: '',
        phone: '',
        address: '',
        password: '',
        password_confirmation: '',
        role: '3',
        mobile: '',
        avatar: '',
        username: '',
        bio: '',
        website: '',
        user_type: 'admin'
      }
    }
  },
  methods: {
    goBack() {
      // this.$router.go(-1)
      this.$router.replace({path: '/admin/users'})
    },
        
    register() {
      let self = this;
      // Submit the form to create new user
      var formData = new FormData();
      for ( var key in self.user ) {
        if(key != 'avatar')
          formData.append(key, self.user[key]);
      }
      formData.append('avatar', self.user['avatar']);
      formData.append('_method', 'PUT');

      $('.btn-submit').attr('disabled', 'disabled');
			$('.btn-submit').html('Submitting...');

      axios.post(process.env.MIX_APP_URL+'/api/users/'+self.$route.params.id, formData, {
        headers: {
          'Authorization': 'Bearer '+localStorage.getItem("api_token"),
          "Content-Type": "multipart/form-data"
        }
      })
      .then(function (response) {
        $('.btn-submit').removeAttr('disabled');
				$('.btn-submit').html('Submit');

        if(response.data.errors)
            self.errors = response.data.errors;

        if(response.data.status && response.data.status == 'success')
        {
          self.$router.push({ path: '/admin/users' });
        }
      }).catch(function (error) {
        $('.btn-submit').removeAttr('disabled');
				$('.btn-submit').html('Submit');

        if(error.response)
        {
          if(error.response.data.errors)
          {
            self.errors = error.response.data.errors;
          }
        }
      });
    },
    
    handleUserImageUpload(event) {
      var self = this;
      self.user.avatar = event.target.files[0];

      var reader = new FileReader();
      reader.readAsDataURL(self.$refs.avatar.files[0]);
      reader.onload = function(e) {
        $('#imagePreview').css('background-image', 'url('+e.target.result +')');
        $('#imagePreview').hide();
        $('#imagePreview').fadeIn(650);
      }
    },
  },
  mounted: function(){
    let self = this;

    axios.get(process.env.MIX_APP_URL+'/api/users/'+self.$route.params.id, {
      headers: {
        'Authorization': 'Bearer '+localStorage.getItem("api_token") 
      }
    })
    .then(function (response) {
      if(response.data.user)
      {
        self.user = response.data.user;
        self.user.role = response.data.role;
        self.user.website = response.data.user.website != 'null' ? response.data.user.website : '';
        self.user.bio = response.data.user.bio != 'null' ? response.data.user.bio : '';
      }
    }).catch(function (error) {
      console.log(error.response)
      // self.$router.push({ path: '/admin/login' });
    });

  },
  watch: {
  }
}


</script>
<style scoped>
</style>