<template>
  <div class="container">
    <div class="row justify-content-center">
			<div class="col-12">
				<div class="row p-4 bg-transparent">
					<div class="col-md-12">
						<div class="lwrap text-center p-4">
							<img :src="logo" style="height: 60px;" class="img-fluid" alt="">
						</div>
					</div>
					<!-- <div class="col-md-6 bg-dark text-center">
						<h1 class="p-4" style="color:#fff; font-size: 1.5rem;">Welcome to FNCCI</h1>
					</div> -->
					<div class="col-md-6 border bg-white login-wrap" style="margin: 0 auto;">
						<template v-if="showFailedMessage == true">
							<div class="lwrap p-4">
								<p class="alert alert-danger alert-dismissible fade show" role="alert">
									{{ failedMessage }}
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</p>
							</div>
						</template>
						<template v-if="showSuccessMessage == true">
							<div class="lwrap p-4">
								<p class="alert alert-success alert-dismissible fade show" role="alert">
									{{ successMessage }}
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</p>
								<h1 class="text-center pb-3" style="font-size:1.5rem"><a href="/">Login Now!</a></h1>
							</div>
						</template>
						<div class="lwrap p-4" v-else>
							<h1 class="text-center pb-3" style="font-size:1.5rem">Register Now!</h1>
							<form id="register-user" @submit.prevent="register">
								<div class="mb-3">
									<label for="first_name" class="form-label mb-1">First Name <span class="text-danger">*</span></label>
									<div class="input-group mb-3">
										<input id="first_name" v-model="first_name" type="text" class="form-control form-control-lg" :class="(errors.length && errors.first_name.length) ? 'is-invalid' : ''" name="first_name" required autocomplete="first_name" autofocus aria-label="Firstname" >
										<span class="invalid-feedback" v-if="Object.keys(errors).length" role="alert">
											<strong>{{ errors.first_name }}</strong>
										</span>
									</div>
								</div>
								<div class="mb-3">
									<div class="row">
										<div class="col-6 rd-form-icon">
											<label for="email" class="form-label mb-1">Email address <span class="text-danger">*</span></label>
											<div class="input-group mb-3">
												<div class="f-icon">
													<i class="fas fa-envelope"></i>
												</div>
												<input id="email" v-model="email" type="email" class="form-control form-control-lg" :class="(errors.length && errors.email.length) ? 'is-invalid' : ''" name="email" required autocomplete="email" aria-label="Email">
												<span class="invalid-feedback" v-if="Object.keys(errors).length" role="alert">
													<strong>{{ errors.email }}</strong>
												</span>
											</div>
										</div>
										<div class="col-6 rd-form-icon">
											<label for="phone" class="form-label mb-1">Phone</label>
											<div class="input-group">
												<div class="f-icon">
													<i class="fas fa-phone"></i>
												</div>
												<input id="phone" v-model="phone" type="text" class="form-control form-control-lg" :class="(errors.length && errors.phone.length) ? 'is-invalid' : ''" name="phone" autocomplete="phone" autofocus aria-label="Phone" >
												<span class="invalid-feedback" v-if="Object.keys(errors).length" role="alert">
													<strong>{{ errors.phone }}</strong>
												</span>
											</div>
										</div>
									</div>
								</div>
								<div class="mb-3">
									<label for="company_name" class="form-label mb-1">Company Name <span class="text-danger">*</span></label>
									<div class="input-group mb-3">
										<input id="company_name" v-model="company_name" type="text" class="form-control form-control-lg" :class="(errors.length && errors.company_name.length) ? 'is-invalid' : ''" name="company_name" required autocomplete="company_name" aria-label="Email">
										<span class="invalid-feedback" v-if="Object.keys(errors).length" role="alert">
											<strong>{{ errors.company_name }}</strong>
										</span>
									</div>
								</div>
								<div class="mb-3 rd-form-icon">
									<label for="company_address" class="form-label mb-1">Company Address <span class="text-danger">*</span></label>
									<div class="input-group mb-3">
										<div class="f-icon">
											<i class="fas fa-envelope"></i>
										</div>
										<input id="company_address" v-model="company_address" type="text" class="form-control form-control-lg" :class="(errors.length && errors.company_address.length) ? 'is-invalid' : ''" name="company_address" required autocomplete="company_address" aria-label="company_address">
										<span class="invalid-feedback" v-if="Object.keys(errors).length" role="alert">
											<strong>{{ errors.company_address }}</strong>
										</span>
									</div>
								</div>
								<div class="mb-3">
									<label for="designation" class="form-label mb-1">Designation <span class="text-danger">*</span></label>
									<div class="input-group mb-3">
										<input id="designation" v-model="designation" type="text" class="form-control form-control-lg" :class="(errors.length && errors.designation.length) ? 'is-invalid' : ''" name="designation" required autocomplete="designation" aria-label="Email">
										<span class="invalid-feedback" v-if="Object.keys(errors).length" role="alert">
											<strong>{{ errors.designation }}</strong>
										</span>
									</div>
								</div>
								<div class="mb-3 rd-form-icon">
									<label for="password" class="form-label mb-1">Password <span class="text-danger">*</span></label>
									<div class="input-group mb-3">
										<div class="f-icon">
											<i class="fas fa-lock"></i>
										</div>
										<input type="password" class="form-control form-control-lg" id="password" v-model="password" :class="(errors.length && errors.password.length) ? 'is-invalid' : ''" name="password" required autocomplete="new-password">
										<div class="s-icon" @click="showHidePassword">
											<i class="fas" :class="showPassword ? 'fa-eye fw-bolder' : 'fa-eye-slash' "></i>
										</div>
									</div>
								</div>
								<div class="mb-3 rd-form-icon">
									<label for="password-confirm" class="form-label mb-1">Confirm Password <span class="text-danger">*</span></label>
									<div class="input-group mb-3">
										<div class="f-icon">
											<i class="fas fa-lock"></i>
										</div>
										<input type="password" class="form-control form-control-lg" id="password-confirm" v-model="password_confirmation" name="password_confirmation" required autocomplete="new-password">
										<div class="s-icon" @click="showHideConfirmPassword">
											<i class="fas" :class="showConfirmPassword ? 'fa-eye fw-bolder' : 'fa-eye-slash' "></i>
										</div>
										<span class="invalid-feedback" v-if="Object.keys(errors).length" role="alert">
											<strong>{{ errors.password }}</strong>
										</span>
									</div>
								</div>
								<div class="row mb-3">
									<div class="col-12">
										<div class="form-check">
											<input type="checkbox" class="form-check-input" id="iAgree" v-model="iAgree">
											<label class="form-check-label" for="iAgree">I agree to all the <a href="#">Terms</a>, <a href="#">Privacy Policy</a> and <a href="#">Fees</a></label>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-12">
										<button type="submit" :class="iAgree ? '' : 'disabled'" class="btn btn-lg btn-default btn-submit w-100"><i class="fas fa-user"></i> Register Now</button>
									</div>
								</div>	
								<div class="mt-3">
									Already have an account? <a href="/" class="form-check-label" for="login">Log in</a>
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
    import axios from 'axios'

    export default {
      data() {
        return {
		  logo: '',
		  rootUrl: process.env.MIX_APP_URL,
          first_name: '',
          email: '',
          phone: '',
          company_name: '',
          company_address: '',
          designation: '',
          password: '',
          password_confirmation: '',
          errors: '',
		  showPassword: false,
		  showConfirmPassword: false,
          iAgree: false,
		  showFailedMessage: false,
		  failedMessage: '',
		  showSuccessMessage: false,
		  successMessage: '',
        }
      },    
      methods: {
        register() {
          var self = this;
          self.errors = '';
		  self.showFailedMessage = false;
		  self.failedMessage = '';
		  self.showSuccessMessage = false;
		  self.successMessage = '';

		  $('.btn-submit').attr('disabled', 'disabled');
		  $('.btn-submit').html('<i class="fas fa-user"></i> Registering ...');

          axios.post(process.env.MIX_APP_URL+ '/api/register/examiner', {
            first_name: self.first_name,
            email: self.email,
            phone: self.phone,
            company_name: self.company_name,
            company_address: self.company_address,
            designation: self.designation,
            password: self.password,
            password_confirmation: self.password_confirmation
          }).then(function (response) {
			
			$('.btn-submit').removeAttr('disabled');
			$('.btn-submit').html('<i class="fas fa-user"></i> Register Now');
			
            if(response.data.status == 'failed')
            {
            //   self.first_name = '',
            //   self.email = '';
            //   self.phone = '';
			//   self.company_name = '',
			//   self.company_address = '',
            //   self.designation = '';
            //   self.password = '';
            //   self.password_confirmation = '';
				self.showSuccessMessage = true;
			  	self.successMessage = response.data.message;
            }
            else
            {
            	//   self.$router.push({ path: '/' });
			  self.showSuccessMessage = true;
			  self.successMessage = response.data.message;
            }
          })
          .catch(function (error) {
			$('.btn-submit').removeAttr('disabled');
			$('.btn-submit').html('<i class="fas fa-user"></i> Register Now');
            self.errors = error.response.data.errors;
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
		},

		showHideConfirmPassword() {
			var x = document.getElementById("password-confirm");
			if (x.type === "password") {
				x.type = "text";
				this.showConfirmPassword = true;

			} else {
				x.type = "password";
				this.showConfirmPassword = false;
			}
		}
      },

	  mounted() {
			this.logo = this.rootUrl+'/storage/'+window.Laravel.website_logo;
		}
    }
  
  </script>

<style scoped>
.login-wrap { width: auto; transform: none; position: unset;}
.login-wrap .lwrap { padding: 0; }
.form-control {
    opacity: 1 !important;
}
.invalid-feedback { display: block; }

svg#freepik_stories-online-shopping:not(.animated) .animable {opacity: 0;}svg#freepik_stories-online-shopping.animated #freepik--background-complete--inject-13 {animation: 0.5s 1 forwards cubic-bezier(.36,-0.01,.5,1.38) slideDown;animation-delay: 0s;}svg#freepik_stories-online-shopping.animated #elnc64i9vhzc {animation: 1s 1 forwards linear slideLeft;animation-delay: 0s;}svg#freepik_stories-online-shopping.animated #elqashfcsnce {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.03571428571428571s;opacity: 0}svg#freepik_stories-online-shopping.animated #el3epyznzmgwt {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.07142857142857142s;opacity: 0}svg#freepik_stories-online-shopping.animated #elre0vdjh8azg {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.10714285714285714s;opacity: 0}svg#freepik_stories-online-shopping.animated #eljlduy0tiz8s {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.14285714285714285s;opacity: 0}svg#freepik_stories-online-shopping.animated #el93vxw0o6sj6 {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.17857142857142855s;opacity: 0}svg#freepik_stories-online-shopping.animated #elnqtizqcb2k {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.21428571428571427s;opacity: 0}svg#freepik_stories-online-shopping.animated #elb6ag645plyv {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.25s;opacity: 0}svg#freepik_stories-online-shopping.animated #elvnsmoce0ix {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.2857142857142857s;opacity: 0}svg#freepik_stories-online-shopping.animated #elf58hvzaypg {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.3214285714285714s;opacity: 0}svg#freepik_stories-online-shopping.animated #el94vtij6h9pk {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.3571428571428571s;opacity: 0}svg#freepik_stories-online-shopping.animated #el5362jz2ye7h {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.39285714285714285s;opacity: 0}svg#freepik_stories-online-shopping.animated #elkx2tl0dxqtf {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.42857142857142855s;opacity: 0}svg#freepik_stories-online-shopping.animated #el0jqes9guhwgu {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.46428571428571425s;opacity: 0}svg#freepik_stories-online-shopping.animated #elz9tem2qwru {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.5s;opacity: 0}svg#freepik_stories-online-shopping.animated #elgjlsbme1hnf {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.5357142857142857s;opacity: 0}svg#freepik_stories-online-shopping.animated #elx8hw147rc79 {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.5714285714285714s;opacity: 0}svg#freepik_stories-online-shopping.animated #elatw6321o4bg {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.6071428571428571s;opacity: 0}svg#freepik_stories-online-shopping.animated #elivxxbksypvs {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.6428571428571428s;opacity: 0}svg#freepik_stories-online-shopping.animated #el74daxrja73c {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.6785714285714285s;opacity: 0}svg#freepik_stories-online-shopping.animated #elu0tv5ll16fc {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.7142857142857142s;opacity: 0}svg#freepik_stories-online-shopping.animated #elbqukfj5htkb {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.75s;opacity: 0}svg#freepik_stories-online-shopping.animated #elnaaksa2zm4p {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.7857142857142857s;opacity: 0}svg#freepik_stories-online-shopping.animated #elpky98fhdcke {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.8214285714285714s;opacity: 0}svg#freepik_stories-online-shopping.animated #elce2jovb452w {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.8571428571428571s;opacity: 0}svg#freepik_stories-online-shopping.animated #elh2ks273hjrn {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.8928571428571428s;opacity: 0}svg#freepik_stories-online-shopping.animated #el2qymhtms6ip {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.9285714285714285s;opacity: 0}svg#freepik_stories-online-shopping.animated #el3dqn1gl99af {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.9642857142857142s;opacity: 0}svg#freepik_stories-online-shopping.animated #freepik--Device--inject-13 {animation: 1s 1 forwards linear slideLeft,1.5s Infinite  linear floating;animation-delay: 0s,1s;}svg#freepik_stories-online-shopping.animated #freepik--Character--inject-13 {animation: 1s 1 forwards cubic-bezier(.36,-0.01,.5,1.38) slideLeft;animation-delay: 0s;}            @keyframes slideDown {                0% {                    opacity: 0;                    transform: translateY(-30px);                }                100% {                    opacity: 1;                    transform: translateY(0);                }            }                    @keyframes slideLeft {                0% {                    opacity: 0;                    transform: translateX(-30px);                }                100% {                    opacity: 1;                    transform: translateX(0);                }            }                    @keyframes floating {                0% {                    opacity: 1;                    transform: translateY(0px);                }                50% {                    transform: translateY(-10px);                }                100% {                    opacity: 1;                    transform: translateY(0px);                }            }        

</style>
