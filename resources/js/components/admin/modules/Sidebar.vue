<template>
    <div class="sidenav">
		<div class="logo d-flex align-items-center justify-content-center">
			<a href="/admin/dashboard"><img :src="logo" class="img-fluid" alt=""></a>
		</div>
		<ul class="s-nav" v-if="userType == 'superadmin'">
			<li class="nav-label">MAIN MENU</li>
			<!-- <li>
				<a href="#"><i class="fas fa-th-large"></i> Dashboard <span><i class="fas fa-angle-right"></i></span></a>
				<ul>
					<li><a href="#">Light</a></li>
					<li><a href="#">Dark</a></li>
				</ul>
			</li> -->
			<li>
				<a href="/admin/dashboard"><i class="fas fa-th-large"></i> Dashboard </a>
			</li>
			<li :class="{'nav-active' : $route.name === 'SiteSetting'}">
				<a href="/admin/settings"><i class="fas fa-cog"></i> Site Settings </a>
			</li>
			<li class="nav-label">APPS</li>
			<li :class="{'nav-active' : ['Users', 'User', 'Create User', 'Edit User'].includes($route.name)}">
				<a href="/admin/users"><i class="fas fa-users"></i> Manage Users</a>
			</li>
			<li :class="{'nav-active' : ['Categories', 'Create Category', 'Edit Category'].includes($route.name)}">
				<a href="/admin/categories"><i class="fas fa-cog"></i> Manage Categories </a>
			</li>

			<li :class="{'nav-active' : ['SubCategories', 'Create SubCategory', 'Edit SubCategory'].includes($route.name)}">
				<a href="/admin/sub-categories"><i class="fas fa-cog"></i> Manage SubCategories </a>
			</li>

			<li :class="{'nav-active' : ['Questions', 'Create Question', 'Edit Question'].includes($route.name)}">
				<a href="/admin/questions"><i class="fas fa-cog"></i> Manage Questions </a>
			</li>

			<!-- <li :class="{'nav-active' : ['Examiners', 'Examiner Detail'].includes($route.name)}">
				<a href="/admin/examiners"><i class="fas fa-cog"></i> Manage Examiners </a>
			</li> -->

			<!-- <li :class="{'nav-active' : ['Assessments', 'Create Assessment', 'Edit Assessment'].includes($route.name)}">
				<a href="/admin/assessments"><i class="fas fa-cog"></i> Manage Assessments </a>
			</li> -->
		</ul>
	</div>
</template>

<script>
export default {
    name: "Sidebar",
    data() {
        return {
			logo: '',
			rootUrl: process.env.MIX_APP_URL,
			userType: JSON.parse(localStorage.getItem("user_detail")).user_type,
        };
    },
    mounted() {
		this.logo = this.rootUrl+'/storage/'+window.Laravel.website_logo;
        console.log('Component mounted.')
    }
}
</script>

<style scoped>
.sidenav {
    
}

.nav-active { background: #08ACDA; }
.nav-active a, .nav-active a:hover { color: #fff !important;}
</style>
