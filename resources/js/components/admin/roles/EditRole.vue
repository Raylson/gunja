<template>
  <div class="role-detail">
    <div class="page-title-box">
			<div class="row">
				<div class="col">
					<h4 class="page-title">Edit Role</h4>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
						<li class="breadcrumb-item"><a href="javascript:void(0);">Role</a></li>
						<li class="breadcrumb-item active">Edit</li>
					</ol>
				</div><!--end col-->	
			</div><!--end row-->                                                              
		</div>
		<div class="row create">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
            <form class="edit-role" @submit.prevent="editRole">
              <div class="row mb-3 align-items-center">
                <div class="col-2">
                  <label for="role_name" class="form-label">Role Name </label>
                </div>
                <div class="col-10">
                  <input type="text" class="form-control" id="role_name" name="role_name" v-model="role_name" required>
                  <span class="invalid-feedback" v-if="Object.keys(errors).length" role="alert">
                      <strong>{{ errors.name }}</strong>
                  </span>
                </div>
              </div>
              <div class="row mb-3 align-items-center">
                <div class="col-2">
                  <label for="display_name" class="form-label">Display Name </label>
                </div>
                <div class="col-10">
                  <input type="text" class="form-control" id="display_name" name="display_name" v-model="display_name" required>
                  <span class="invalid-feedback" v-if="Object.keys(errors).length" role="alert">
                      <strong>{{ errors.display_name }}</strong>
                  </span>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-2">
                  <label class="form-label">Permissions <span class="text-danger form-text">*</span></label>
                </div>
                <div class="col-10">
                  <div class="mb-3">
                    <button class="btn btn-success btn-sm" type="button" @click="selectAll">Select All</button>
                    <button class="btn btn-danger btn-sm" type="button" @click="deselectAll">Deselect All</button>
                    <span class="invalid-feedback" v-if="Object.keys(errors).length" role="alert">
                        <strong>{{ errors.permissions }}</strong>
                    </span>
                  </div>
                  <div class="row">
                    <template v-for="(pgroup, index) in permission_groups">
                      <div class="col-3" :key="index">
                        <ul class="nested">
                            <li>
                              <div class="form-check form-check-inline">
                                  <input class="form-check-input permission-group" type="checkbox">
                                  <label for="srole"><strong>{{ pgroup | capitalize }}</strong></label>
                              </div>
                              <ul> 
                                  <template v-for="permission in permissions">
                                    <li :key="permission.id" v-if="pgroup == permission.permission_group">
                                        <div class="form-check form-check-inline">
                                          <input class="form-check-input permissions" type="checkbox" v-model="selected_permissions" :id="'permission-'+permission.id" :name="'permissions['+permission.id+']'" :value="permission.id">
                                          <label for="b1">{{ permission.name | splitAndCapitalize }}</label>
                                        </div>
                                    </li>
                                  </template>
                              </ul>		
                            </li>
                        </ul>	
                      </div>
                    </template>
                  </div>
                </div>
              </div>
              <div class="row">
                <hr>
                <div class="col-9 offset-2">
                  <button class="btn btn-primary" type="submit">Edit</button>
                  <button class="btn btn-default" type="button" @click="goBack">Back</button>
                </div>
              </div>
            </form>
					</div>
				</div>		
			</div>
		</div>
  </div>
</template>

<script>
import axios from 'axios'
import Swal from 'sweetalert2'
export default {
  name: 'EditRole',
  props: {
  },
  data: () => {
    return {
      role_perms: [],
      role_name: '',
      display_name: '',
      permissions: [],
      permission_groups: [],
      selected_permissions: [],
      errors: []
    }
  },
  methods: {
    goBack() {
      // this.$router.go(-1)
      this.$router.replace({path: '/admin/roles'})
    },

    selectAll() {
      $('.permission-group').prop('checked', true);
      $('ul.nested li ul').find("input[type='checkbox']").prop('checked', true);
      this.selected_permissions = [];
      this.setSelectedPermissions();
    },

    deselectAll() {
      $('.permission-group').prop('checked', false);
      $('ul.nested li ul').find("input[type='checkbox']").prop('checked', false);
      this.selected_permissions = [];
    },

    setSelectedPermissions() {
      let self = this;
      this.selected_permissions = [];
      $('ul.nested li ul input[type=checkbox]:checked').each(function() {
        if(!self.selected_permissions.includes(parseInt($(this).val())))
          self.selected_permissions.push(parseInt($(this).val()));
      });
    },

    editRole() {
      let self = this;
      // Submit the form to create new role
      axios.post(process.env.MIX_APP_URL+'/api/roles/'+self.$route.params.id, {
        _method: 'PUT',
        name: this.role_name,
        display_name: this.display_name,
        guard_name: 'web',
        permissions: this.selected_permissions
      }, {
        headers: {
          'Authorization': 'Bearer '+localStorage.getItem("api_token") 
        }
      })
      .then(function (response) {
        if(response.data.status && response.data.status == 'success')
        {
          Swal.fire({
            title: 'Success',
            text: 'Role updated successfully',
            confirmButtonText: 'Okay'
          });

          self.$router.push({ path: '/admin/roles' });
        }
        
        if(response.data.errors)
            self.errors = response.data.errors;

      }).catch(function (error) {
        if(error.response)
        {
          if(error.response.data.errors)
          {
            self.errors = error.response.data.errors;
          }
        }
      });
    },

    syncParentCheck() {
      $('.permission-group').each(function(){
        console.log('hi')
          var allChecked = true;
          $(this).parent().siblings('ul').find("input[type='checkbox']").each(function(){
              if(!this.checked) allChecked = false;
          });
          $(this).prop('checked', allChecked);
      });
    },

    clearForm() {
      this.deselectAll();
    }
  },
  mounted: function(){
    let self = this;

    // Get role detail
    axios.get(process.env.MIX_APP_URL+'/api/roles/' + self.$route.params.id, {
      headers: {
        'Authorization': 'Bearer '+localStorage.getItem("api_token") 
      }
    })
    .then(function (response) {
      self.role_name = response.data.role.name;
      self.display_name = response.data.role.display_name;
    }).catch(function (error) {
      self.$router.push({ path: '/admin/login' });
    });

    // Get list of all available permissions
    axios.get(process.env.MIX_APP_URL+'/api/permissions', {
      headers: {
        'Authorization': 'Bearer '+localStorage.getItem("api_token") 
      }
    })
    .then(function (response) {
      if(response.data.all_permissions.length)
      {
        self.permissions = response.data.all_permissions;
        self.permission_groups = response.data.groups;
      }
    }).catch(function (error) {
      self.$router.push({ path: '/admin/login' });
    });

    // Get list of permissions for this role
    axios.get(process.env.MIX_APP_URL+'/api/get-role-permissions?role=' + self.$route.params.id, {
      headers: {
        'Authorization': 'Bearer '+localStorage.getItem("api_token") 
      }
    })
    .then(function (response) {
      self.role_perms = response.data.role_perms;
      self.selected_permissions = response.data.role_perms;      
    }).catch(function (error) {
      self.$router.push({ path: '/admin/login' });
    });

    $(document).on("change", ".permission-group" , function() {
      $(this).parent().siblings('ul').find("input[type='checkbox']").prop('checked', this.checked);
      self.setSelectedPermissions();
    });

    $(document).on("change", ".permissions" , function() {
      self.syncParentCheck();
    });

    setTimeout(() => {
      self.syncParentCheck();
    }, 1000);
  },
}


</script>
