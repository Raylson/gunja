<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
				<div class="login-wrap bg-transparent">
					<div class="">
						<div class="col-md-6 border bg-white" style="margin: 0 auto;">
							<div class="lwrap">
								<a href="/"><img :src="logo" style="height: 60px;" class="img-fluid mb-4" alt=""></a>
								<template v-if="showMessage == true">
									<p class="alert alert-danger alert-dismissible fade show" role="alert">
										{{ message }}
										<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
									</p>
			                    </template>
								<template v-if="showSuccessMessage == true">
									<p class="alert alert-success alert-dismissible fade show" role="alert">
										{{ successMessage }}
										<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
									</p>
			                    </template>
								<h2>Enroll for Exam.</h2>
								<template v-if="loadComplete">
									<form v-if="!examiner" class="rd-form-icon" @submit.prevent="enroll">
										<!-- <div class="mb-3">
											<label for="email" class="form-label mb-1">Email address</label>
											<div class="input-group mb-3">
												<div class="f-icon">
													<i class="fas fa-envelope"></i>
												</div>
												<input type="email" v-model="email" name="email" required autocomplete="email" autofocus class="form-control form-control-lg" aria-label="Email" id="email">
											</div>
										</div> -->
										<div class="row">
											<div class="col-auto">
												<button type="submit" class="btn btn-lg btn-default w-100 btn-submit">Enroll Now</button>
											</div>
										</div>																	
									</form>
									<div v-else>
										<h3><a :href="`/exam-now/${examiner.unique_key}`">Click Here: {{ rootUrl+'/exam-now/'+examiner.unique_key }}</a></h3>
									</div>
								</template>
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
    name: 'ExaminerEnroll',
    data() {
        return {
			logo: '',
			showMessage: false,
			message: '',
			showSuccessMessage: false,
			successMessage: '',
			rootUrl: process.env.MIX_APP_URL,
            email: '',
			loadComplete: false,
			examiner: [],
        }
    },
    methods: {
        enroll() {
            let self = this;

			$('.btn-submit').attr('disabled', 'disabled');
			$('.btn-submit').html('Enrolling...');

			self.showSuccessMessage = false;
			self.successMessage = '';

            axios.post(process.env.MIX_APP_URL+'/api/examiners/enroll', {}).then(function (response) {
				if(response.data.status == 'success')
                {
					self.showSuccessMessage = true;
					self.successMessage = response.data.message;
					self.email = '';

					self.checkEnroll();
                }
				$('.btn-submit').removeAttr('disabled');
				$('.btn-submit').html('Enroll Now');
            })
            .catch(error => {
				$('.btn-submit').removeAttr('disabled');
				$('.btn-submit').html('Enroll Now');

                self.message = error.response.data.message;
                self.showMessage = true;
            });
        },
		
		checkEnroll()
		{
			var self = this;
			axios.get(process.env.MIX_APP_URL+'/api/checkExam', {
				headers: {
					'Authorization': 'Bearer '+localStorage.getItem("api_token") 
				}
			})
			.then(function (response) {
				self.loadComplete = true;
				self.examiner = response.data.examiner;
			}).catch(function (error) {
				self.$router.push({ path: '/' });
			});
		}
    },
	mounted() {
		this.checkEnroll();
		this.logo = this.rootUrl+'/storage/'+window.Laravel.website_logo;
	}
}
</script>

<style scoped>
.form-control {
    opacity: 1 !important;
}
</style>
