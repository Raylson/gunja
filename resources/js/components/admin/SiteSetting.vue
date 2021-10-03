<template>
  <div class="site">
	<div class="position-fixed top-1 end-0 p-3" style="z-index: 5">
		<div class="toast align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
			<div class="d-flex">
				<div class="toast-body">
					<ul>
						<li v-for="(error, i) in errors" :key="`error_${i}`">{{ error[0] }}</li>
					</ul>
				</div>
				<button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
			</div>
		</div>
		<template v-if="showMessage == true">
			<p class="alert alert-success alert-dismissible fade show" role="alert">
				{{ message }}
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</p>
		</template>
	</div>
    <div class="page-title-box">
			<div class="row">
				<div class="col">
					<h4 class="page-title">Site Settings</h4>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
						<li class="breadcrumb-item"><a href="javascript:void(0);">Site Settings</a></li>
					</ol>
				</div><!--end col-->
			</div><!--end row-->
		</div>
		<form class="site-setting" @submit.prevent="updateSiteSetting">
			<div class="row create">
					<div class="col-12">
						<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="pills-general-tab" data-toggle="pill" href="#pills-general" role="tab" aria-controls="pills-general" aria-selected="true">General</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="pills-footer-tab" data-toggle="pill" href="#pills-footer" role="tab" aria-controls="pills-footer" aria-selected="false">Footer Settings</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="pills-company-tab" data-toggle="pill" href="#pills-company" role="tab" aria-controls="pills-company" aria-selected="false">Company Settings</a>
							</li>
						</ul>
						<div class="tab-content" id="pills-tabContent">
							<div class="tab-pane fade show active" id="pills-general" role="tabpanel" aria-labelledby="pills-general-tab">
								<div class="card">
									<div class="card-body">
										<div class="row mb-3 align-items-center">
											<div class="col-3">
												<label for="website_logo" class="form-label">Site Logo <span class="text-danger form-text">*</span></label>
											</div>
											<div class="col-9">
												<img class="product_images" :src="rootUrl+'/storage/'+settings.website_logo" id="website_logo_img" /><br/>
												<input
													type="file"
													name="website_logo"
													id="website_logo"
													accept="image/x-png, image/gif, image/jpeg"
													ref="website_logo"
													@change="handleWebsiteLogoUpload"
												/>
											</div>
										</div>

										<div class="row mb-3 align-items-center">
											<div class="col-3">
												<label for="title" class="form-label">Website Title <span class="text-danger form-text">*</span></label>
											</div>
											<div class="col-9">
												<input type="text" class="form-control" id="title" name="title" v-model="settings.title" required>
												<span class="invalid-feedback" v-if="Object.keys(errors).length" role="alert">
													<strong>{{ errors.title }}</strong>
												</span>
											</div>
										</div>

										<div class="row mb-3 align-items-center">
											<div class="col-3">
												<label for="meta_keywords" class="form-label">Meta Keywords <span class="text-danger form-text">*</span></label>
											</div>
											<div class="col-9">
												<input type="text" class="form-control" id="meta_keywords" name="meta_keywords" v-model="settings.meta_keywords" required>
												<span class="invalid-feedback" v-if="Object.keys(errors).length" role="alert">
													<strong>{{ errors.meta_keywords }}</strong>
												</span>
											</div>
										</div>

										<div class="row mb-3 align-items-center">
											<div class="col-3">
												<label for="meta_description" class="form-label">Meta Description <span class="text-danger form-text">*</span></label>
											</div>
											<div class="col-9">
												<textarea class="form-control" id="meta_description" name="meta_description" v-model="settings.meta_description" required></textarea>
												<span class="invalid-feedback" v-if="Object.keys(errors).length" role="alert">
													<strong>{{ errors.meta_description }}</strong>
												</span>
											</div>
										</div>

										<div class="row mb-3 align-items-center">
											<div class="col-3">
												<label for="analytics_code" class="form-label">Analytics Code </label>
											</div>
											<div class="col-9">
												<textarea class="form-control" id="analytics_code" name="analytics_code" rows="8" v-model="settings.analytics_code"></textarea>
												<span class="invalid-feedback" v-if="Object.keys(errors).length" role="alert">
													<strong>{{ errors.analytics_code }}</strong>
												</span>
											</div>
										</div>

										<div class="row mb-3 align-items-center">
											<div class="col-3">
												<label for="facebook" class="form-label">Facebook <span class="text-danger form-text">*</span></label>
											</div>
											<div class="col-9">
												<input type="text" class="form-control" id="facebook" name="facebook" v-model="settings.facebook" required>
												<span class="invalid-feedback" v-if="Object.keys(errors).length" role="alert">
													<strong>{{ errors.facebook }}</strong>
												</span>
											</div>
										</div>

										<div class="row mb-3 align-items-center">
											<div class="col-3">
												<label for="twitter" class="form-label">Twitter <span class="text-danger form-text">*</span></label>
											</div>
											<div class="col-9">
												<input type="text" class="form-control" id="twitter" name="twitter" v-model="settings.twitter" required>
												<span class="invalid-feedback" v-if="Object.keys(errors).length" role="alert">
													<strong>{{ errors.twitter }}</strong>
												</span>
											</div>
										</div>

										<div class="row mb-3 align-items-center">
											<div class="col-3">
												<label for="whatsapp" class="form-label">Whatsapp <span class="text-danger form-text">*</span></label>
											</div>
											<div class="col-9">
												<input type="text" class="form-control" id="whatsapp" name="whatsapp" v-model="settings.whatsapp" required>
												<span class="invalid-feedback" v-if="Object.keys(errors).length" role="alert">
													<strong>{{ errors.whatsapp }}</strong>
												</span>
											</div>
										</div>

										<div class="row mb-3 align-items-center">
											<div class="col-3">
												<label for="instagram" class="form-label">Instagram <span class="text-danger form-text">*</span></label>
											</div>
											<div class="col-9">
												<input type="text" class="form-control" id="instagram" name="instagram" v-model="settings.instagram" required>
												<span class="invalid-feedback" v-if="Object.keys(errors).length" role="alert">
													<strong>{{ errors.instagram }}</strong>
												</span>
											</div>
										</div>

										<div class="row mb-3 align-items-center">
											<div class="col-3">
												<label for="youtube" class="form-label">Youtube <span class="text-danger form-text">*</span></label>
											</div>
											<div class="col-9">
												<input type="text" class="form-control" id="youtube" name="youtube" v-model="settings.youtube" required>
												<span class="invalid-feedback" v-if="Object.keys(errors).length" role="alert">
													<strong>{{ errors.youtube }}</strong>
												</span>
											</div>
										</div>

									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="pills-footer" role="tabpanel" aria-labelledby="pills-footer-tab">
								<div class="card">
									<div class="card-body">
										<div class="row mb-3 align-items-center">
											<div class="col-3">
												<label for="footer_logo" class="form-label">Footer Logo <span class="text-danger form-text">*</span></label>
											</div>
											<div class="col-9">
												<img class="product_images" :src="rootUrl+'/storage/'+settings.footer_logo" id="footer_logo_img" /><br/>
												<input
													type="file"
													name="footer_logo"
													id="footer_logo"
													accept="image/x-png, image/gif, image/jpeg"
													ref="footer_logo"
													@change="handleFooterLogoUpload"
												/>												
											</div>
										</div>

										<div class="row mb-3 align-items-center">
											<div class="col-3">
												<label for="footer_address" class="form-label">Address <span class="text-danger form-text">*</span></label>
											</div>
											<div class="col-9">
												<textarea class="form-control" id="footer_address" name="footer_address" v-model="settings.footer_address" required></textarea>
												<span class="invalid-feedback" v-if="Object.keys(errors).length" role="alert">
													<strong>{{ errors.footer_address }}</strong>
												</span>
											</div>
										</div>

									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="pills-company" role="tabpanel" aria-labelledby="pills-company-tab">
								<div class="card">
									<div class="card-body">
										<div class="row mb-3 align-items-center">
											<div class="col-3">
												<label for="company_title" class="form-label">Company Title <span class="text-danger form-text">*</span></label>
											</div>
											<div class="col-9">
												<input type="text" class="form-control" id="company_title" name="company_title" v-model="settings.company_title" required>
												<span class="invalid-feedback" v-if="Object.keys(errors).length" role="alert">
													<strong>{{ errors.company_title }}</strong>
												</span>
											</div>
										</div>
										<div class="row mb-3 align-items-center">
											<div class="col-3">
												<label for="company_address" class="form-label">Company Address <span class="text-danger form-text">*</span></label>
											</div>
											<div class="col-9">
												<input type="text" class="form-control" id="company_address" name="company_address" v-model="settings.company_address" required>
												<span class="invalid-feedback" v-if="Object.keys(errors).length" role="alert">
													<strong>{{ errors.company_address }}</strong>
												</span>
											</div>
										</div>
										<div class="row mb-3 align-items-center">
											<div class="col-3">
												<label for="company_phone" class="form-label">Company Phone <span class="text-danger form-text">*</span></label>
											</div>
											<div class="col-9">
												<input type="text" class="form-control" id="company_phone" name="company_phone" v-model="settings.company_phone" required>
												<span class="invalid-feedback" v-if="Object.keys(errors).length" role="alert">
													<strong>{{ errors.company_phone }}</strong>
												</span>
											</div>
										</div>
										<div class="row mb-3 align-items-center">
											<div class="col-3">
												<label for="company_email" class="form-label">Company Email <span class="text-danger form-text">*</span></label>
											</div>
											<div class="col-9">
												<input type="email" class="form-control" id="company_email" name="company_email" v-model="settings.company_email" required>
												<span class="invalid-feedback" v-if="Object.keys(errors).length" role="alert">
													<strong>{{ errors.company_email }}</strong>
												</span>
											</div>
										</div>

									</div>
								</div>
							</div>
						</div>		
					</div>
					<div class="row">
						<hr>
						<div class="col-9 offset-2">
							<button class="btn btn-primary" type="submit">Submit</button>
						</div>
					</div>
			</div>
		</form>
  </div>
</template>

<script>
import axios from 'axios'
// import $ from 'jquery'
export default {
  name: 'SiteSetting',
  props: {
  },
  data: () => {
    return {
	  rootUrl: process.env.MIX_APP_URL,
	  showMessage: false,
	  message: '',
      errors: [],
	  settings: {
		title: '',
		website_logo: '',
		meta_keywords: '',
		meta_description: '',
		facebook: '',
		twitter: '',
		whatsapp: '',
		instagram: '',
		youtube: '',
		footer_logo: '',
		footer_address: '',
		footer_help: '',
		footer_info_news: '',
		footer_payments: '',
		footer_appstore: '',
		footer_desc: '',
		company_title: '',
		company_address: '',
		company_phone: '',
		company_email: ''
	  },
    }
  },
  methods: {
	
	updateSiteSetting() {
		let self = this;
		var formData = new FormData();
		for ( var key in self.settings ) {
			formData.append(key, self.settings[key]);
		}

		axios.post(process.env.MIX_APP_URL+'/api/settings', formData, {
			headers: {
				'Authorization': 'Bearer '+localStorage.getItem("api_token"),
				"Content-Type": "multipart/form-data"
			}
		})
		.then(function (response) {
			if(response.data.errors)
				self.errors = response.data.errors;

			if(response.data.status && response.data.status == 'success')
			{
				self.message = response.data.message;
				console.log(response.data.message)
                self.showMessage = true;

				setTimeout(() => {
					self.showMessage = false;
				}, 2000);
			}
		}).catch(function (error) {
			if(error.response)
			{
				if(error.response.data.errors)
				{
					self.errors = error.response.data.errors;
					var toastElList = [].slice.call(document.querySelectorAll('.toast'))
					var toastList = toastElList.map(function(toastEl) {
					// Creates an array of toasts (it only initializes them)
					return new bootstrap.Toast(toastEl, { animation: true, autohide: true, delay: 4000 }) // No need for options; use the default options
					});
					toastList.forEach(toast => toast.show()); // This show them
				}
			}
		});

	},

	handleWebsiteLogoUpload(event) {
      var self = this;
      self.settings.website_logo = event.target.files[0];

      var reader = new FileReader();
      reader.readAsDataURL(this.$refs.website_logo.files[0]);
      reader.onload = function() {
        document.getElementById("website_logo_img").src = reader.result;
        document.getElementById("website_logo_img").style.display = "block";
      };
    },

	handleFooterLogoUpload(event) {
      var self = this;
      self.settings.footer_logo = event.target.files[0];

      var reader = new FileReader();
      reader.readAsDataURL(this.$refs.footer_logo.files[0]);
      reader.onload = function() {
        document.getElementById("footer_logo_img").src = reader.result;
        document.getElementById("footer_logo_img").style.display = "block";
      };
    }

  },
  mounted: function(){
	var self = this;

	axios.get(process.env.MIX_APP_URL+'/api/settings', {
		headers: {
			'Authorization': 'Bearer '+localStorage.getItem("api_token") 
		}
	})
	.then(function (response) {
		if(response.data.status == 'success')
		{
			self.settings = response.data.settings;

			CKEDITOR.config.allowedContent = true;
			CKEDITOR.editorConfig = function( config ) {
				allowedContent: 'p[*] h1[*] h2[*] h3[*] h4[*] h5[*] h6[*] span[*] div[*] img[*] a[*] i[*] ul[*] li[*] button[*]';
				allowAttributes: 'class, id, title, dir, lang, xml:lang, itemscope, itemtype, itemprop target meta';
			};
			CKEDITOR.replace('meta_description', options);
			CKEDITOR.instances.meta_description.on('change', function() { 
				self.settings.meta_description = this.getData();
			});

			CKEDITOR.replace('footer_address', options);
			CKEDITOR.instances.footer_address.on('change', function() { 
				self.settings.footer_address = this.getData();
			});

			CKEDITOR.replace('footer_help', options);
			CKEDITOR.instances.footer_help.on('change', function() { 
				self.settings.footer_help = this.getData();
			});

			CKEDITOR.replace('footer_info_news', options);
			CKEDITOR.instances.footer_info_news.on('change', function() { 
				self.settings.footer_info_news = this.getData();
			});

			CKEDITOR.replace('footer_payments', options);
			CKEDITOR.instances.footer_payments.on('change', function() { 
				self.settings.footer_payments = this.getData();
			});

			CKEDITOR.replace('footer_appstore', options);
			CKEDITOR.instances.footer_appstore.on('change', function() { 
				self.settings.footer_appstore = this.getData();
			});

			CKEDITOR.replace('footer_desc', options);
			CKEDITOR.instances.footer_desc.on('change', function() { 
				self.settings.footer_desc = this.getData();
			});
		}
	}).catch(function (error) {
		console.log(error.response)
		// self.$roter.push({ path: '/admin/login' });
	});
  },
  computed: {
	  
  },
  watch: {
  },
  components: {
  },
}


</script>
<style scoped>
	.product_images { width: 100px; display: inline-block; padding: 10px 10px 10px 0; }
	.nav-item a.active:hover { color: #fff !important; }
</style>