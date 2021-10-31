<template>
    <div class="header">
		<header>
			<div class="row">
				<div class="col-6 logo d-flex align-items-start justify-content-start ps-0">
					<a href="#"><img :src="logo" style="max-height: 4rem;" class="img-fluid" alt=""></a>
				</div>
				<div class="col-6 d-flex align-items-center justify-content-end pe-5">
					<a class="pe-2"><img :src="rootUrl+'/storage/'+user.avatar" class="img-fluid rounded-circle border" width="50px" alt=""></a>
					<a class="pe-3"><p> Welcome, {{ user.first_name+(user.middle_name !=null ? ' '+user.middle_name : '')+(user.last_name !=null ? ' '+user.last_name : '') }}</p></a>
					<div class="btn-group" v-if="userType=='admin'">
						<button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
							Settings
						</button>
						<ul class="dropdown-menu">
							<!-- <li><a class="dropdown-item" @click="logout"> Profile</a></li> -->
							<li><a class="dropdown-item" @click="logout"> Logout</a></li>
							<li v-if="userType == 'examiner'"><a class="dropdown-item" href="/exam/enroll"> Enroll</a></li>							
						</ul>
					</div>
					<a v-else class="btn btn-sm btn-default" @click="closeTab">Close</a>
				</div>
			</div>
		</header>

		<div class="position-fixed top-1 end-0 p-3 pt-1" style="z-index: 5; display:none;" id="toast-div">
			<div class="toast align-items-center text-white bg-danger border-0" id="toastDiv" role="alert" aria-live="assertive" aria-atomic="true">
				<div class="d-flex">
					<div class="toast-body">
						<p id="toastMessage"></p>
					</div>
					<button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
    name: "FrontendHeader",
    data() {
        return {
			logo: '',
			user: JSON.parse(localStorage.getItem("user_detail")),
			rootUrl: process.env.MIX_APP_URL,
			userType: JSON.parse(localStorage.getItem("user_detail")).user_type,
        };
    },
    mounted() {
		this.logo = this.rootUrl+'/storage/'+window.Laravel.website_logo;
        console.log('Component mounted.')
    },
	methods: {
		logout() {
			let self = this;
            axios.post(process.env.MIX_APP_URL+'/api/logout', {'from': 'admin'}, {
				headers: {
					'Authorization': 'Bearer '+localStorage.getItem("api_token") 
				}
			}).then(function (response) {
				if(response.data.logout)
				{
					localStorage.removeItem("api_token");
					localStorage.removeItem("user_detail");

					if(response.data.user_type == 'examiner')
						self.$router.push({path: '/'});
					else
						self.$router.push({path: '/admin/login'});
				}
			})
			.catch(error => {
				console.log(error.response.data.message);
			});
		},

		closeTab () {
			window.close();
		}
	}
}
</script>

<style scoped>
.header {
    
}
.dropdown-menu {min-width: 8rem;}
.dropdown-menu .dropdown-item { cursor: pointer; }
header ul li:last-child:before { display: none;}
header ul li{ padding: 0; }
header ul li:last-child { padding: 0; }
.fa-sign-out-alt:hover, .fa-expand:hover { cursor: pointer; color: #0a58ca; }
</style>
