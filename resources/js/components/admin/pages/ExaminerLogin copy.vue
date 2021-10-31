<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
				<div class="row login-wrap p-4 bg-transparent">
					<!-- <div class="col-md-12">
						<div class="lwrap text-center p-4">
							<img :src="logo" style="height: 60px;" class="img-fluid" alt="">
						</div>
					</div> -->
					<div class="col-md-6 bg-dark text-center">
						<h1 class="p-4" style="color:#fff; font-size: 1.5rem;">Welcome to FNCCI</h1>
					</div>
					<div class="col-md-6 border bg-white">
						<div class="lwrap p-4">
							<template v-if="showMessage == true">
								<p class="alert alert-danger alert-dismissible fade show" role="alert">
									{{ message }}
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</p>
							</template>
							<h2>Please Register for Assessment.<br>
							</h2>
							<form class="rd-form-icon" @submit.prevent="login">
								<div class="mb-3">
								<label for="email" class="form-label mb-1">Email address</label>
								<div class="input-group mb-3">
									<div class="f-icon">
										<i class="fas fa-envelope"></i>
									</div>
									<input type="email" v-model="email" name="email" required autocomplete="email" autofocus class="form-control form-control-lg" aria-label="Email" id="email">
								</div>
								</div>
								<div class="mb-3">
									<label for="password" class="form-label mb-1">Password</label>
									<div class="input-group mb-3">
										<div class="f-icon">
											<i class="fas fa-lock"></i>
										</div>
										<input type="password" class="form-control form-control-lg" id="password" v-model="password" name="password" required autocomplete="current-password">
										<div class="s-icon" @click="showHidePassword">
											<i class="fas" :class="showPassword ? 'fa-eye fw-bolder' : 'fa-eye-slash' "></i>
										</div>
									</div>
								</div>
								<div class="row mb-3">
									<div class="col-7">
										<div class="form-check">
											<input type="checkbox" class="form-check-input"  v-model="remember" name="remember" id="remember" :checked="remember">
											<label class="form-check-label" for="remember">Remember my password</label>
										</div>
									</div>
									<div class="col-5 text-end">
										<a href="/password/reset" class="form-check-label">Forget Password?</a>
									</div>
								</div>
								<div class="row">
									<div class="col-5">
										<button type="submit" class="btn btn-lg btn-default w-100 btn-submit"><i class="fas fa-key"></i> Sign In</button>
									</div>
									<div class="col-7">
										<a href="/register" type="button" class="btn btn-lg btn-success w-100"><i class="fas fa-user"></i> Register Now</a>
									</div>
								</div>																	
							</form>
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: 'ExaminerLoginOld',
    data() {
        return {
			logo: '',
			rootUrl: process.env.MIX_APP_URL,
            email: '',
            password: '',
            remember: false,
            showMessage: false,
            message: '',
			socialError: this.$route.query.socialError ? true : false,
			showPassword: false
        }
    },
    methods: {
        login() {
            let self = this;

			$('.btn-submit').attr('disabled', 'disabled');
			$('.btn-submit').html('<i class="fas fa-key"></i> Sign In...');

            axios.post(process.env.MIX_APP_URL+'/api/login', {
                email: self.email,
                password: self.password,
                // remember: self.remember,
            }).then(function (response) {
				if(response.data.status == 'success')
                {
                    self.email = '';
                    self.password = '';
                    localStorage.setItem("api_token", response.data.access_token);
					// self.$store.commit('SET_USER_DATA', response.data.user);
					localStorage.setItem("user_detail", JSON.stringify(response.data.user));
					console.log(response.data.user.user_type)
					if(response.data.user.user_type == 'superadmin')
					{
						self.$router.push({
							path: '/admin/dashboard'
						});
					}
					else if(response.data.user.user_type == 'examiner')
					{
						window.location.href = '/exam/enroll';
					}
					else
						window.location.href = '/examiners/list';
						
                }
				$('.btn-submit').removeAttr('disabled');
				$('.btn-submit').html('<i class="fas fa-key"></i> Sign In');
            })
            .catch(error => {
				$('.btn-submit').removeAttr('disabled');
				$('.btn-submit').html('<i class="fas fa-key"></i> Sign In');

                self.message = error.response.data.message;
                self.showMessage = true;
            });
        },

		showHidePassword() {
			var x = document.getElementById("password");
			if (x.type === "password") {
				x.type = "text";
				this.showPassword = true;

			} else {
				x.type = "password";
				this.showPassword = false;
			}
		}
    },
	mounted() {
		this.logo = this.rootUrl+'/storage/'+window.Laravel.website_logo;
		if(this.socialError)
		{
			setTimeout(() => {
                this.socialError = false;
            }, 2000);
		}
	}
}
</script>

<style scoped>
.login-wrap .lwrap { padding: 0; }
.form-control {
    opacity: 1 !important;
}
svg#freepik_stories-online-shopping:not(.animated) .animable {opacity: 0;}svg#freepik_stories-online-shopping.animated #freepik--background-complete--inject-13 {animation: 0.5s 1 forwards cubic-bezier(.36,-0.01,.5,1.38) slideDown;animation-delay: 0s;}svg#freepik_stories-online-shopping.animated #elnc64i9vhzc {animation: 1s 1 forwards linear slideLeft;animation-delay: 0s;}svg#freepik_stories-online-shopping.animated #elqashfcsnce {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.03571428571428571s;opacity: 0}svg#freepik_stories-online-shopping.animated #el3epyznzmgwt {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.07142857142857142s;opacity: 0}svg#freepik_stories-online-shopping.animated #elre0vdjh8azg {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.10714285714285714s;opacity: 0}svg#freepik_stories-online-shopping.animated #eljlduy0tiz8s {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.14285714285714285s;opacity: 0}svg#freepik_stories-online-shopping.animated #el93vxw0o6sj6 {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.17857142857142855s;opacity: 0}svg#freepik_stories-online-shopping.animated #elnqtizqcb2k {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.21428571428571427s;opacity: 0}svg#freepik_stories-online-shopping.animated #elb6ag645plyv {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.25s;opacity: 0}svg#freepik_stories-online-shopping.animated #elvnsmoce0ix {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.2857142857142857s;opacity: 0}svg#freepik_stories-online-shopping.animated #elf58hvzaypg {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.3214285714285714s;opacity: 0}svg#freepik_stories-online-shopping.animated #el94vtij6h9pk {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.3571428571428571s;opacity: 0}svg#freepik_stories-online-shopping.animated #el5362jz2ye7h {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.39285714285714285s;opacity: 0}svg#freepik_stories-online-shopping.animated #elkx2tl0dxqtf {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.42857142857142855s;opacity: 0}svg#freepik_stories-online-shopping.animated #el0jqes9guhwgu {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.46428571428571425s;opacity: 0}svg#freepik_stories-online-shopping.animated #elz9tem2qwru {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.5s;opacity: 0}svg#freepik_stories-online-shopping.animated #elgjlsbme1hnf {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.5357142857142857s;opacity: 0}svg#freepik_stories-online-shopping.animated #elx8hw147rc79 {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.5714285714285714s;opacity: 0}svg#freepik_stories-online-shopping.animated #elatw6321o4bg {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.6071428571428571s;opacity: 0}svg#freepik_stories-online-shopping.animated #elivxxbksypvs {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.6428571428571428s;opacity: 0}svg#freepik_stories-online-shopping.animated #el74daxrja73c {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.6785714285714285s;opacity: 0}svg#freepik_stories-online-shopping.animated #elu0tv5ll16fc {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.7142857142857142s;opacity: 0}svg#freepik_stories-online-shopping.animated #elbqukfj5htkb {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.75s;opacity: 0}svg#freepik_stories-online-shopping.animated #elnaaksa2zm4p {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.7857142857142857s;opacity: 0}svg#freepik_stories-online-shopping.animated #elpky98fhdcke {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.8214285714285714s;opacity: 0}svg#freepik_stories-online-shopping.animated #elce2jovb452w {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.8571428571428571s;opacity: 0}svg#freepik_stories-online-shopping.animated #elh2ks273hjrn {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.8928571428571428s;opacity: 0}svg#freepik_stories-online-shopping.animated #el2qymhtms6ip {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.9285714285714285s;opacity: 0}svg#freepik_stories-online-shopping.animated #el3dqn1gl99af {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.9642857142857142s;opacity: 0}svg#freepik_stories-online-shopping.animated #freepik--Device--inject-13 {animation: 1s 1 forwards linear slideLeft,1.5s Infinite  linear floating;animation-delay: 0s,1s;}svg#freepik_stories-online-shopping.animated #freepik--Character--inject-13 {animation: 1s 1 forwards cubic-bezier(.36,-0.01,.5,1.38) slideLeft;animation-delay: 0s;}            @keyframes slideDown {                0% {                    opacity: 0;                    transform: translateY(-30px);                }                100% {                    opacity: 1;                    transform: translateY(0);                }            }                    @keyframes slideLeft {                0% {                    opacity: 0;                    transform: translateX(-30px);                }                100% {                    opacity: 1;                    transform: translateX(0);                }            }                    @keyframes floating {                0% {                    opacity: 1;                    transform: translateY(0px);                }                50% {                    transform: translateY(-10px);                }                100% {                    opacity: 1;                    transform: translateY(0px);                }            }        
</style>
