<template>
    <div class="detail">
		<div class="row p-4 mdisplay">
			<div class="col-12 mb-3" style="margin:0;">
				<div class="col-auto align-self-center float-end">
					<button class="btn btn-sm btn-default" @click="goBack">Back</button>
				</div><!--end col-->                                                           
			</div>
			<div class="col-12 mb-4">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title mb-0">Detail</h5>
						<div class="row align-items-center">
							<label class="col-form-label mt-2">Email: {{ examiner.email }}</label>
						</div>
						<div class="row">
							<div class="col-md-4 align-items-center">
								<label class="col-form-label">Submission ID: {{ examiner.submission_id }}</label>
							</div>
							<div class="col-md-4 align-items-center">
								<label class="col-form-label">Submission Date: {{ examiner.submitted_date }}</label>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 text-center">
				<div class="table-responsive fixed-table-body">
					<table class="table" id="search-table">
						<thead>
							<tr class="table-dark">
								<th colspan="5">प्रतिस्पर्धात्मकता वर्गीकरणका तङ्खवहरु</th>
								<th>उद्योगद्वारा मूल्यांकन</th>
								<th>जम्मा प्राप्ताड्ढ</th>
								<th>वणिज्यद्वारा मूल्यांकन</th>
								<th>कैफियत</th>
							</tr>
							<tr class="table-dark">
								<th colspan="4">&nbsp;</th>
								<th class="table-active border-end border-dark">अंक भार</th>
								<th class="table-active border-end border-dark">प्राप्ताड्ढ</th>
								<th class="table-active border-end border-dark">०-५</th>
								<th class="table-active border-end border-dark">०-५</th>
								<th class="table-active">&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							<template v-for="(item) in categories">
								<tr :key="item.id" class="table-light border border-dark">
									<td class="border-end border-dark">&nbsp;</td>
									<td colspan="8" class="text-start">{{ item.title }}</td>
								</tr>
								<tr class="table-light border border-dark" :key="item.id" v-html="subCateList(item.sub_categories)"></tr>
							</template>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
    name: "UserExaminerDetail",
    data() {
        return {
			logo: '',
			rootUrl: process.env.MIX_APP_URL,
			userType: JSON.parse(localStorage.getItem("user_detail")).user_type,
			examiner: {},
      		assessments: [],
			categories: []
        };
    },
	methods: {
		goBack() {
			this.$router.replace({path: '/examiners/list'})
		},

		subCateList(subCategories)
		{
			var html = '';
			for(var i=0; i < subCategories.length; i++){
				// html += '<tr class="table-light border border-dark">';
				if(i==0)
					html += '<td class="table-active border-end border-dark text-start">'+(i + 1)+'</td><td class="table-active border-end border-dark text-start" colspan="3">'+subCategories[i].title+'</td><td class="table-active border-end border-dark text-start" colspan="5">'+subCategories[i].score+'</td></tr>';
				// else
				// {
				// 	html += '<tr class="table-light border border-dark">';
				// 	html += '<td class="table-light">'+(i + 1)+'</td><td colspan="3">'+subCategories[i].title+'</td>';

				// 	if(i != (subCategories.length - 1))
				// 		html += '</tr>';
				// }
			}
			return html;
		}
	},
    mounted() {
        let self = this;

		self.logo = self.rootUrl+'/storage/'+window.Laravel.website_logo;

		axios.get(process.env.MIX_APP_URL+'/api/examiners/' + self.$route.params.id, {
			headers: {
				'Authorization': 'Bearer '+localStorage.getItem("api_token") 
			}
		})
		.then(function (response) {
			self.examiner = response.data.examiner;
			self.assessments = response.data.assessments;
			self.categories = response.data.categories;
		}).catch(function (error) {
			self.$router.push({ path: '/admin/login' });
		});
    }
}
</script>

<style scoped>
.sidenav {
    
}

.nav-active { background: #08ACDA; }
.nav-active a, .nav-active a:hover { color: #fff !important;}
</style>
