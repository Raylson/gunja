<template>
    <div class="header">
		<header>
			<div class="row">
				<div class="col-6 d-flex align-items-center">
					<a href="#">
						<div class="burger">
							<span class="line"></span>
							<span class="line"></span>
							<span class="line"></span>
						</div>
					</a>
					<!-- <div class="input-group">
						<span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
						<input type="text" class="form-control" placeholder="Search">
					</div>
					<div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
						<label class="form-check-label" for="flexSwitchCheckDefault">Dark Mode</label>
					</div> -->
				</div>
				<div class="col-6 d-flex align-items-center justify-content-end">
					<ul>
						<li><a @click="toggleFullScreen"><i class="fas fa-expand"></i></a></li>
						<!-- <li><a href="#"><i class="far fa-bell"></i></a><span class="badge">10</span></li> -->
						<li class="h-user-info d-flex align-items-center">
							<a href="#"><img :src="rootUrl+'/storage/'+user.avatar" class="img-fluid rounded-circle border" width="50px" alt=""></a>
							<a href="#"><p> Hey, {{ user.first_name+(user.middle_name !=null ? ' '+user.middle_name : '')+(user.last_name !=null ? ' '+user.last_name : '') }}</p>
								<!-- <span>Business Profile</span> -->
							</a>
						</li>
						<li @click="logout"><i class="fas fa-sign-out-alt"></i></li>
						<!-- <li><a href="#"><i class="fas fa-th-large"></i></a></li> -->
					</ul>
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
    name: "Header",
    data() {
        return {
			rootUrl: process.env.MIX_APP_URL,
			user: JSON.parse(localStorage.getItem("user_detail")),
        };
    },
    mounted() {
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
					self.$router.push({
						path: '/admin/login'
					});
				}
			})
			.catch(error => {
				console.log(error.response.data.message);
			});
		},

		toggleFullScreen() {
			if ((document.fullScreenElement && document.fullScreenElement !== null) ||    
			(!document.mozFullScreen && !document.webkitIsFullScreen)) {
				if (document.documentElement.requestFullScreen) {  
				document.documentElement.requestFullScreen();  
				} else if (document.documentElement.mozRequestFullScreen) {  
				document.documentElement.mozRequestFullScreen();  
				} else if (document.documentElement.webkitRequestFullScreen) {  
				document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);  
				}  
			} else {  
				if (document.cancelFullScreen) {  
				document.cancelFullScreen();  
				} else if (document.mozCancelFullScreen) {  
				document.mozCancelFullScreen();  
				} else if (document.webkitCancelFullScreen) {  
				document.webkitCancelFullScreen();  
				}  
			}  
		}
	}
}
</script>

<style scoped>
.header {
    
}
.fa-sign-out-alt:hover, .fa-expand:hover { cursor: pointer; color: #0a58ca; }
</style>
