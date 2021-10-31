<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
				<div class="row login-wrap mt-4 bg-transparent">
					<div class="">
						<div class="col-md-12 border bg-white" style="margin: 0 auto;">
							<div class="lwrap">
								<img :src="logo" style="height: 60px; display: block; margin: 0 auto;" class="img-fluid mb-4 text-center" alt="">
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

								<template v-if="loadComplete">
									<h3 v-if="validURL == false">Sorry! The link is invalid or you have already submitted the exam.</h3>
									<!-- <h3 v-if="alreadySubmitted">Sorry! You have already submitted the exam.</h3> -->
									<form v-if="validURL && !submitted" class="rd-form-icon" @submit.prevent="exam">
										<div class="row">
											<div class="col-md-12 mb-3">
												<h3>Attend all the questions.</h3>
											</div>
											<div class="col-12 mb-4">
												<div class="card">
													<div class="card-body">
														<!-- <h5 class="card-title mb-0">Detail</h5> -->
														<div class="row">
															<div class="col-md-8 align-items-center">
																<label for="name" class="form-label mb-1">Name <span class="text-danger">*</span></label>
																<div class="input-group mb-3">
																	<input id="name" v-model="name" type="text" class="form-control form-control-lg" :class="(errors.length && errors.name.length) ? 'is-invalid' : ''" name="name" required autocomplete="name" autofocus aria-label="Name" >
																	<span class="invalid-feedback" v-if="Object.keys(errors).length" role="alert">
																		<strong>{{ errors.name }}</strong>
																	</span>
																</div>
															</div>
															<div class="col-md-4 align-items-center">
																<label for="phone" class="form-label mb-1">Phone <span class="text-danger">*</span></label>
																<div class="input-group mb-3">
																	<input id="phone" v-model="phone" type="text" class="form-control form-control-lg" :class="(errors.length && errors.phone.length) ? 'is-invalid' : ''" name="phone" required autocomplete="phone" autofocus aria-label="Phone" >
																	<span class="invalid-feedback" v-if="Object.keys(errors).length" role="alert">
																		<strong>{{ errors.phone }}</strong>
																	</span>
																</div>
															</div>
															<div class="col-md-4 align-items-center">
																<label for="company_name" class="form-label mb-1">Company Name <span class="text-danger">*</span></label>
																<div class="input-group mb-3">
																	<input id="company_name" v-model="company_name" type="text" class="form-control form-control-lg" :class="(errors.length && errors.company_name.length) ? 'is-invalid' : ''" name="company_name" required autocomplete="company_name" autofocus aria-label="Company Name" >
																	<span class="invalid-feedback" v-if="Object.keys(errors).length" role="alert">
																		<strong>{{ errors.company_name }}</strong>
																	</span>
																</div>
															</div>
															<div class="col-md-4 align-items-center">
																<label for="company_address" class="form-label mb-1">Company Address <span class="text-danger">*</span></label>
																<div class="input-group mb-3">
																	<input id="company_address" v-model="company_address" type="text" class="form-control form-control-lg" :class="(errors.length && errors.company_address.length) ? 'is-invalid' : ''" name="company_address" required autocomplete="company_address" autofocus aria-label="Company Name" >
																	<span class="invalid-feedback" v-if="Object.keys(errors).length" role="alert">
																		<strong>{{ errors.company_address }}</strong>
																	</span>
																</div>
															</div>
															<div class="col-md-4 align-items-center">
																<label for="designation" class="form-label mb-1">Designation <span class="text-danger">*</span></label>
																<div class="input-group mb-3">
																	<input id="designation" v-model="designation" type="text" class="form-control form-control-lg" :class="(errors.length && errors.designation.length) ? 'is-invalid' : ''" name="designation" required autocomplete="designation" autofocus aria-label="Designation" >
																	<span class="invalid-feedback" v-if="Object.keys(errors).length" role="alert">
																		<strong>{{ errors.designation }}</strong>
																	</span>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-12">
												<div class="row border p-2 ">
													<template v-for="(question, index) in questions">
														<div class="col-md-6 mt-2 mb-2 border-bottom" :key="`ques-${index}`">
															<div class="row">
																<div class="col-md-6 mb-3 align-items-center text-center fw-bold">
																	<label class="text-decoration-underline" :for="`question-0-${index}`">{{ question.question }}</label>
																</div>
																<div class="col-md-6 mb-3 align-items-center">
																	<div class="col-auto">
																		<template v-for="(ans, ansindex) in question.answers">
																			<select :key="`ans-${ansindex}`" class="form-control mb-2" id="answer_id" name="answer_id" v-model="answers['answer_'+ans.id]" required>
																				<option value="" checked>Select Answer</option>
																				<option :value="`${ans.question_id}|${ans.id}|${ans.answer_0}|0`" v-if="ans.answer_0 != ''">{{ ans.answer_0 }}</option>
																				<option :value="`${ans.question_id}|${ans.id}|${ans.answer_1}|1`" v-if="ans.answer_1 != ''">{{ ans.answer_1 }}</option>
																				<option :value="`${ans.question_id}|${ans.id}|${ans.answer_2}|2`" v-if="ans.answer_2 != ''">{{ ans.answer_2 }}</option>
																				<option :value="`${ans.question_id}|${ans.id}|${ans.answer_3}|3`" v-if="ans.answer_3 != ''">{{ ans.answer_3 }}</option>
																				<option :value="`${ans.question_id}|${ans.id}|${ans.answer_4}|4`" v-if="ans.answer_4 != ''">{{ ans.answer_4 }}</option>
																				<option :value="`${ans.question_id}|${ans.id}|${ans.answer_5}|5`" v-if="ans.answer_5 != ''">{{ ans.answer_5 }}</option>
																			</select>
																		</template>
																	</div>
																</div>
															</div>
														</div>
													</template>
												</div>
											</div>
											<div class="col-auto" style="margin: 0 auto;">
												<button type="submit" class="btn mt-3 btn-lg btn-default w-100 btn-submit">Submit</button>
											</div>
										</div>																	
									</form>
								</template>
								<h3 v-else>Loading...</h3>
								<h3 v-if="submitted" class="text-success">Thank you. Your exam has been submitted. <br/> Your Submission ID: <b>{{ submission_id }}</b></h3>
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
    name: 'ExamNow',
    data() {
        return {
			logo: '',
			errors: []
,			validURL: false,
			showMessage: false,
			message: '',
			showSuccessMessage: false,
			successMessage: '',
			rootUrl: process.env.MIX_APP_URL,
			name: '',
			phone: '',
			email: '',
			company_name: '',
			company_address: '',
			company_designation: '',
            questions: '',
			answers: {},
			submitted: false,
			alreadySubmitted: false,
			submission_id: '',
			loadComplete: false,
        }
    },
    methods: {
        exam() {
            let self = this;

			$('.btn-submit').attr('disabled', 'disabled');
			$('.btn-submit').html('Submitting...');

			self.showSuccessMessage = false;
			self.successMessage = '';

			var formData = new FormData();
			formData.append('unique_key', self.$route.params.uniqueKey);
			formData.append('answers', JSON.stringify(self.answers));

            axios.post(process.env.MIX_APP_URL+'/api/examiners/exam-submit', formData).then(function (response) {
				if(response.data.status == 'success')
                {
					self.showSuccessMessage = true;
					self.successMessage = response.data.message;
					self.submitted = true;
					self.submission_id = response.data.submission_id;
                }
				$('.btn-submit').removeAttr('disabled');
				$('.btn-submit').html('Submit');
            })
            .catch(error => {
				$('.btn-submit').removeAttr('disabled');
				$('.btn-submit').html('Submit');

                self.message = error.response.data.message;
                self.showMessage = true;
            });
        },
    },
	mounted() {
		var self = this;
		self.logo = self.rootUrl+'/storage/'+window.Laravel.website_logo;

		axios.get(process.env.MIX_APP_URL+'/api/examiners/exam-now/' + self.$route.params.uniqueKey, {
			headers: {
				'Authorization': 'Bearer '+localStorage.getItem("api_token") 
			}
		})
		.then(function (response) {
			if(response.data.status == 'success')
			{
				self.loadComplete = true;
				if(response.data.submission_id != '')
				{
					self.alreadySubmitted = true;
				}
				else
				{
					self.questions = response.data.questions;
					self.validURL = true;

					self.questions.forEach((queElement) => {
						queElement.answers.forEach((ansElement) => {
							var ansKey = 'answer_'+ansElement.id;
							// var obj = {};
							// obj[ansKey] = '';
							// self.answers.push(obj);

							self.answers[ansKey] = '';
						});
					});
				}
			}
			else
			{
				self.validURL = false
			}
		}).catch(function (error) {
			self.$router.push({ path: '/admin/login' });
		});
	}
}
</script>

<style scoped>
.login-wrap { width:auto; transform: none; position: unset;}
.form-control {
    opacity: 1 !important;
}
</style>
