<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
				<div class="login-wrap bg-transparent">
					<div class="">
						<div class="col-6 border bg-white" style="margin: 0 auto;">
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
								<form class="rd-form-icon" @submit.prevent="exam">
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
										<div class="col-auto">
											<button type="submit" class="btn btn-lg btn-default w-100 btn-submit">Enroll Now</button>
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
    name: 'ExamStepOne',
    data() {
        return {
			logo: '',
			showMessage: false,
			message: '',
			showSuccessMessage: false,
			successMessage: '',
			rootUrl: process.env.MIX_APP_URL,
            email: '',
        }
    },
    methods: {
        exam() {
            let self = this;

			$('.btn-submit').attr('disabled', 'disabled');
			$('.btn-submit').html('Enrolling...');

			self.showSuccessMessage = false;
			self.successMessage = '';

            axios.post(process.env.MIX_APP_URL+'/api/examiners/enroll', {
                email: self.email
            }).then(function (response) {
				if(response.data.status == 'success')
                {
					self.showSuccessMessage = true;
					self.successMessage = response.data.message;
					self.email = '';
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
    },
	mounted() {
		this.logo = this.rootUrl+'/storage/'+window.Laravel.website_logo;
	}
}
</script>

<style scoped>
.form-control {
    opacity: 1 !important;
}
svg#freepik_stories-online-shopping:not(.animated) .animable {opacity: 0;}svg#freepik_stories-online-shopping.animated #freepik--background-complete--inject-13 {animation: 0.5s 1 forwards cubic-bezier(.36,-0.01,.5,1.38) slideDown;animation-delay: 0s;}svg#freepik_stories-online-shopping.animated #elnc64i9vhzc {animation: 1s 1 forwards linear slideLeft;animation-delay: 0s;}svg#freepik_stories-online-shopping.animated #elqashfcsnce {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.03571428571428571s;opacity: 0}svg#freepik_stories-online-shopping.animated #el3epyznzmgwt {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.07142857142857142s;opacity: 0}svg#freepik_stories-online-shopping.animated #elre0vdjh8azg {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.10714285714285714s;opacity: 0}svg#freepik_stories-online-shopping.animated #eljlduy0tiz8s {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.14285714285714285s;opacity: 0}svg#freepik_stories-online-shopping.animated #el93vxw0o6sj6 {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.17857142857142855s;opacity: 0}svg#freepik_stories-online-shopping.animated #elnqtizqcb2k {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.21428571428571427s;opacity: 0}svg#freepik_stories-online-shopping.animated #elb6ag645plyv {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.25s;opacity: 0}svg#freepik_stories-online-shopping.animated #elvnsmoce0ix {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.2857142857142857s;opacity: 0}svg#freepik_stories-online-shopping.animated #elf58hvzaypg {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.3214285714285714s;opacity: 0}svg#freepik_stories-online-shopping.animated #el94vtij6h9pk {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.3571428571428571s;opacity: 0}svg#freepik_stories-online-shopping.animated #el5362jz2ye7h {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.39285714285714285s;opacity: 0}svg#freepik_stories-online-shopping.animated #elkx2tl0dxqtf {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.42857142857142855s;opacity: 0}svg#freepik_stories-online-shopping.animated #el0jqes9guhwgu {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.46428571428571425s;opacity: 0}svg#freepik_stories-online-shopping.animated #elz9tem2qwru {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.5s;opacity: 0}svg#freepik_stories-online-shopping.animated #elgjlsbme1hnf {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.5357142857142857s;opacity: 0}svg#freepik_stories-online-shopping.animated #elx8hw147rc79 {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.5714285714285714s;opacity: 0}svg#freepik_stories-online-shopping.animated #elatw6321o4bg {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.6071428571428571s;opacity: 0}svg#freepik_stories-online-shopping.animated #elivxxbksypvs {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.6428571428571428s;opacity: 0}svg#freepik_stories-online-shopping.animated #el74daxrja73c {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.6785714285714285s;opacity: 0}svg#freepik_stories-online-shopping.animated #elu0tv5ll16fc {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.7142857142857142s;opacity: 0}svg#freepik_stories-online-shopping.animated #elbqukfj5htkb {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.75s;opacity: 0}svg#freepik_stories-online-shopping.animated #elnaaksa2zm4p {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.7857142857142857s;opacity: 0}svg#freepik_stories-online-shopping.animated #elpky98fhdcke {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.8214285714285714s;opacity: 0}svg#freepik_stories-online-shopping.animated #elce2jovb452w {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.8571428571428571s;opacity: 0}svg#freepik_stories-online-shopping.animated #elh2ks273hjrn {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.8928571428571428s;opacity: 0}svg#freepik_stories-online-shopping.animated #el2qymhtms6ip {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.9285714285714285s;opacity: 0}svg#freepik_stories-online-shopping.animated #el3dqn1gl99af {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.9642857142857142s;opacity: 0}svg#freepik_stories-online-shopping.animated #freepik--Device--inject-13 {animation: 1s 1 forwards linear slideLeft,1.5s Infinite  linear floating;animation-delay: 0s,1s;}svg#freepik_stories-online-shopping.animated #freepik--Character--inject-13 {animation: 1s 1 forwards cubic-bezier(.36,-0.01,.5,1.38) slideLeft;animation-delay: 0s;}            @keyframes slideDown {                0% {                    opacity: 0;                    transform: translateY(-30px);                }                100% {                    opacity: 1;                    transform: translateY(0);                }            }                    @keyframes slideLeft {                0% {                    opacity: 0;                    transform: translateX(-30px);                }                100% {                    opacity: 1;                    transform: translateX(0);                }            }                    @keyframes floating {                0% {                    opacity: 1;                    transform: translateY(0px);                }                50% {                    transform: translateY(-10px);                }                100% {                    opacity: 1;                    transform: translateY(0px);                }            }        
</style>
