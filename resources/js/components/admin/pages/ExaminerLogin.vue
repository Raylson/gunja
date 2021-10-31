<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
				<div class="row login-wrap p-4 bg-transparent">
					<div class="col-md-12 text-center p-3">
						<img :src="logo" style="max-height:5rem;" class="img-fluid" alt="">
					</div>
					<div class="col-md-6 bg-dark justify-content-center text-center p-3">
						<h1 class="p-4" :class="showSuccessMessage ? 'mg-top-0' : 'mg-top-10'" style="color:#fff; font-size: 1.5rem;">
							WELCOME TO ILO ENCOMPASS SYSTEM.<br><span style="font-size:1.2rem">Competitiveness and Resilience Assessment Tool</span>
						</h1>
						<h2 style="font-size:1.2rem; color: #fff;">प्रतिस्पर्धात्मकता एवं लचकता मूल्यांकन प्रणाली</h2>
					</div>
					<div class="col-md-6 border bg-white">
						<div class="lwrap p-4">
							<template v-if="showMessage == true">
								<p class="alert alert-danger alert-dismissible fade show" role="alert">
									{{ message }}
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</p>
							</template>
							<!-- <template v-if="showSuccessMessage == true">
								<p class="alert alert-success alert-dismissible fade show" role="alert">
									{{ successMessage }}
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</p>
							</template> -->
							<div class="alert-success p-3" v-if="showSuccessMessage">
								<h3 style="font-size: 1.3rem;">Thank you for registration.<br/><span class="mt-2" style="display:block;">Please check your email to start ILO Encompass Assessment.</span></h3>
								<h4 class="pt-3">(Note: You can close this window now.)</h4>
							</div>
							<div v-else>
								<h2>PLEASE REGISTER FOR ILO ENCOMPASS ASSESSMENT TOOL.<br>
								</h2>
								<form class="rd-form-icon" @submit.prevent="enroll">
									<div class="mb-3">
									<label for="email" class="form-label mb-1">Email address</label>
									<div class="input-group mb-3">
										<div class="f-icon">
											<i class="fas fa-envelope"></i>
										</div>
										<input type="email" v-model="email" name="email" required autocomplete="email" autofocus class="form-control form-control-lg" aria-label="Email" id="email">
									</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<button type="submit" class="btn btn-lg btn-default w-100 btn-submit"><i class="fas fa-key"></i> Register</button>
										</div>
									</div>																	
								</form>
							</div>
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
    name: 'ExaminerLogin',
    data() {
        return {
			logo: '',
			rootUrl: process.env.MIX_APP_URL,
            email: '',
            showMessage: false,
            message: '',
			showSuccessMessage: false,
			successMessage: '',
        }
    },
    methods: {
        enroll() {
            let self = this;

			$('.btn-submit').attr('disabled', 'disabled');
			$('.btn-submit').html('<i class="fas fa-key"></i> Registering ...');

			self.showSuccessMessage = false;
			self.successMessage = '';

            axios.post(process.env.MIX_APP_URL+'/api/examiners/enroll', {
				'email': self.email
			}).then(function (response) {
				if(response.data.status == 'success')
                {
					self.showSuccessMessage = true;
					self.successMessage = response.data.message;
					self.email = '';
                }
				$('.btn-submit').removeAttr('disabled');
				$('.btn-submit').html('<i class="fas fa-key"></i> Register');
            })
            .catch(error => {
				$('.btn-submit').removeAttr('disabled');
				$('.btn-submit').html('<i class="fas fa-key"></i> Register');

                self.message = error.response.data.message;
                self.showMessage = true;
            });
        },
    },
	mounted() {
		this.logo = this.rootUrl+'/storage/'+window.Laravel.website_logo;
	}
}
</script>

<style scoped>
.login-wrap { position: initial; transform: initial; margin: 0 auto; }
.login-wrap .lwrap { padding: 0; }
.form-control {
    opacity: 1 !important;
}
.mg-top-10 { margin-top: 10%; }
.mg-top-0 { margin-top: 0; }
</style>
