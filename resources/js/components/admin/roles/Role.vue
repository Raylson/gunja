<template>
  <div class="role-detail">
    <div class="page-title-box">
			<div class="row">
				<div class="col">
					<h4 class="page-title">Role Detail</h4>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
						<li class="breadcrumb-item"><a href="javascript:void(0);">Role</a></li>
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
								<label for="fname" class="form-label">Role Name </label>
							</div>
							<div class="col-10">
								<p v-if="role"><strong>{{ role.display_name }}</strong></p>
							</div>
						</div>
            <div class="row mb-3 align-items-center">
							<div class="col-2">
								<label for="fname" class="form-label">Guard Name </label>
							</div>
							<div class="col-10">
								<p v-if="role"><strong>{{ role.guard_name }}</strong></p>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-2">
								<label class="form-label">Permissions </label>
							</div>
							<div class="col-10">
								<div class="row">
                  <template v-for="(pgroup, index) in permission_groups">
                    <div class="col-3" :key="index">
                      <ul class="nested">
                          <li>
                          <div class="form-check-inline">
                              <label for="srole"><strong>{{ pgroup | capitalize }}</strong></label>
                          </div>
                          <ul class="ms-0 mt-2"> 
                              <template v-for="(permission_new) in permissions">
                                <li :key="permission_new.id" v-if="pgroup == permission_new.permission_group">
                                    <div class="form-check form-check-inline">
                                      <input class="form-check-input" type="checkbox" onclick="return false;" :checked="role_perms.includes(permission_new.id)">
                                      <label for="b1">{{ permission_new.name | splitAndCapitalize }}</label>
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
  name: 'Role',
  props: {
  },
  data: () => {
    return {
      role: [],
      permissions: [],
      permission_groups: [],
      role_perms: []
    }
  },
  methods: {
    goBack() {
      // this.$router.go(-1)
      this.$router.replace({path: '/admin/roles'})
    },
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
      self.role = response.data.role;
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
    }).catch(function (error) {
      self.$router.push({ path: '/admin/login' });
    });
  }
}


</script>
