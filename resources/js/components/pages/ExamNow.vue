<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
				<div class="login-wrap bg-transparent">
					<div class="">
						<div class="col-6 border bg-white" style="margin: 0 auto;">
							<div class="lwrap">
								<a href="/"><img :src="logo" style="height: 60px; margin:0 auto; display:block;" class="img-fluid mb-4" alt=""></a>
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
								<h3 v-if="validURL == false">Sorry! The link is invalid or you have already submitted the exam.</h3>
								<!-- <h3 v-if="alreadySubmitted">Sorry! You have already submitted the exam.</h3> -->
								<form v-if="validURL && !submitted" class="rd-form-icon" @submit.prevent="exam">
									<div class="row">
										<div class="col-12">
											<h3>Attend all the questions.</h3>
										</div>
										<div class="col-12">
											<template v-for="(question, index) in questions">
												<div class="row border p-2 mt-2" :key="`ques-${index}`">
													<div class="col-6 mb-3 align-items-center text-center fw-bold">
														<label class="text-decoration-underline" :for="`question-0-${index}`">{{ question.question }}</label>
													</div>
													<div class="col-6 mb-3 align-items-center">
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
											</template>
										</div>
										<div class="col-auto" style="margin: 0 auto;">
											<button type="submit" class="btn mt-3 btn-lg btn-default w-100 btn-submit">Submit</button>
										</div>
									</div>																	
								</form>
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
			validURL: false,
			showMessage: false,
			message: '',
			showSuccessMessage: false,
			successMessage: '',
			rootUrl: process.env.MIX_APP_URL,
            questions: '',
			answers: {},
			submitted: false,
			alreadySubmitted: false,
			submission_id: '',
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
				console.log('here: '+response.data.submission_id)
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
.form-control {
    opacity: 1 !important;
}
svg#freepik_stories-online-shopping:not(.animated) .animable {opacity: 0;}svg#freepik_stories-online-shopping.animated #freepik--background-complete--inject-13 {animation: 0.5s 1 forwards cubic-bezier(.36,-0.01,.5,1.38) slideDown;animation-delay: 0s;}svg#freepik_stories-online-shopping.animated #elnc64i9vhzc {animation: 1s 1 forwards linear slideLeft;animation-delay: 0s;}svg#freepik_stories-online-shopping.animated #elqashfcsnce {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.03571428571428571s;opacity: 0}svg#freepik_stories-online-shopping.animated #el3epyznzmgwt {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.07142857142857142s;opacity: 0}svg#freepik_stories-online-shopping.animated #elre0vdjh8azg {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.10714285714285714s;opacity: 0}svg#freepik_stories-online-shopping.animated #eljlduy0tiz8s {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.14285714285714285s;opacity: 0}svg#freepik_stories-online-shopping.animated #el93vxw0o6sj6 {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.17857142857142855s;opacity: 0}svg#freepik_stories-online-shopping.animated #elnqtizqcb2k {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.21428571428571427s;opacity: 0}svg#freepik_stories-online-shopping.animated #elb6ag645plyv {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.25s;opacity: 0}svg#freepik_stories-online-shopping.animated #elvnsmoce0ix {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.2857142857142857s;opacity: 0}svg#freepik_stories-online-shopping.animated #elf58hvzaypg {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.3214285714285714s;opacity: 0}svg#freepik_stories-online-shopping.animated #el94vtij6h9pk {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.3571428571428571s;opacity: 0}svg#freepik_stories-online-shopping.animated #el5362jz2ye7h {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.39285714285714285s;opacity: 0}svg#freepik_stories-online-shopping.animated #elkx2tl0dxqtf {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.42857142857142855s;opacity: 0}svg#freepik_stories-online-shopping.animated #el0jqes9guhwgu {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.46428571428571425s;opacity: 0}svg#freepik_stories-online-shopping.animated #elz9tem2qwru {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.5s;opacity: 0}svg#freepik_stories-online-shopping.animated #elgjlsbme1hnf {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.5357142857142857s;opacity: 0}svg#freepik_stories-online-shopping.animated #elx8hw147rc79 {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.5714285714285714s;opacity: 0}svg#freepik_stories-online-shopping.animated #elatw6321o4bg {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.6071428571428571s;opacity: 0}svg#freepik_stories-online-shopping.animated #elivxxbksypvs {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.6428571428571428s;opacity: 0}svg#freepik_stories-online-shopping.animated #el74daxrja73c {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.6785714285714285s;opacity: 0}svg#freepik_stories-online-shopping.animated #elu0tv5ll16fc {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.7142857142857142s;opacity: 0}svg#freepik_stories-online-shopping.animated #elbqukfj5htkb {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.75s;opacity: 0}svg#freepik_stories-online-shopping.animated #elnaaksa2zm4p {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.7857142857142857s;opacity: 0}svg#freepik_stories-online-shopping.animated #elpky98fhdcke {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.8214285714285714s;opacity: 0}svg#freepik_stories-online-shopping.animated #elce2jovb452w {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.8571428571428571s;opacity: 0}svg#freepik_stories-online-shopping.animated #elh2ks273hjrn {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.8928571428571428s;opacity: 0}svg#freepik_stories-online-shopping.animated #el2qymhtms6ip {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.9285714285714285s;opacity: 0}svg#freepik_stories-online-shopping.animated #el3dqn1gl99af {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.9642857142857142s;opacity: 0}svg#freepik_stories-online-shopping.animated #freepik--Device--inject-13 {animation: 1s 1 forwards linear slideLeft,1.5s Infinite  linear floating;animation-delay: 0s,1s;}svg#freepik_stories-online-shopping.animated #freepik--Character--inject-13 {animation: 1s 1 forwards cubic-bezier(.36,-0.01,.5,1.38) slideLeft;animation-delay: 0s;}            @keyframes slideDown {                0% {                    opacity: 0;                    transform: translateY(-30px);                }                100% {                    opacity: 1;                    transform: translateY(0);                }            }                    @keyframes slideLeft {                0% {                    opacity: 0;                    transform: translateX(-30px);                }                100% {                    opacity: 1;                    transform: translateX(0);                }            }                    @keyframes floating {                0% {                    opacity: 1;                    transform: translateY(0px);                }                50% {                    transform: translateY(-10px);                }                100% {                    opacity: 1;                    transform: translateY(0px);                }            }        
</style>
