<template>
    <div class="sidenav">
		<div class="logo d-flex align-items-center justify-content-center">
			<a href="/admin/dashboard" class="brand-logo"><img :src="logo" class="img-fluid" alt=""></a>
		</div>
		<ul class="s-nav" v-if="userType == 'superadmin'">
			<li class="nav-label mt-3 mb-2">MAIN MENU</li>
			<!-- <li>
				<a href="#"><i class="fas fa-th-large"></i> Dashboard <span><i class="fas fa-angle-right"></i></span></a>
				<ul>
					<li><a href="#">Light</a></li>
					<li><a href="#">Dark</a></li>
				</ul>
			</li> -->
			<li :class="{'nav-active' : $route.name === 'Dashboard'}">
				<a href="/admin/dashboard"><i class="fas fa-th-large"></i> Dashboard </a>
			</li>
			<li :class="{'nav-active' : $route.name === 'SiteSetting'}">
				<a href="/admin/settings"><i class="fas fa-cog"></i> Site Settings </a>
			</li>
			<li class="nav-label p-3 pb-0">APPS</li>
			<li :class="{'nav-active' : ['Users', 'User', 'Create User', 'Edit User'].includes($route.name)}">
				<a href="/admin/users"><i class="fas fa-users"></i> Manage Users</a>
			</li>
			<li :class="{'nav-active' : ['Categories', 'Create Category', 'Edit Category'].includes($route.name)}">
				<a href="/admin/categories"><i class="fas fa-list-alt"></i> Manage Categories </a>
			</li>

			<li :class="{'nav-active' : ['SubCategories', 'Create SubCategory', 'Edit SubCategory'].includes($route.name)}">
				<a href="/admin/sub-categories"><i class="fas fa-list-alt"></i> Manage SubCategories </a>
			</li>

			<li :class="{'nav-active' : ['Questions', 'Create Question', 'Edit Question'].includes($route.name)}">
				<a href="/admin/questions"><i class="fas fa-question-circle"></i> Manage Questions </a>
			</li>
			<li>
				<a href="/examiners/verified/list" target="_blank"><i class="fas fa-comment-dots"></i> Assessments </a>
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
.sidenav, .sidenav .logo{
    background: #343a40 !important;
	font-size: 1.05rem;;
}

.sidenav .logo { border-bottom: 1px solid #4b545c;}
.brand-logo { 
    display: block;
    font-size: 1.25rem;
    line-height: 1.5;
    padding: .8125rem .5rem;
    transition: width .3s ease-in-out;
    white-space: nowrap;
}
.sidenav .nav-label { padding: 0 0.875rem; margin: 0;}

.sidenav ul li , .sidenav ul li a { color: #c2c7d0 !important; }
.nav-active { background: #0E4F91; }
.nav-active a, .nav-active a:hover { color: #fff !important;}
</style>
