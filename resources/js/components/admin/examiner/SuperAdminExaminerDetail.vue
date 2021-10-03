<template>
    <div class="detail">
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
				<tr v-for="(item) in categories" :key="item.id" class="table-light border border-dark">
					<td>&nbsp;</td>
					<td colspan="8" class="text-start">{{ item.title }}</td>
				</tr>
			</tbody>
		</table>
	</div>
</template>

<script>
export default {
    name: "SuperAdminExaminerDetail",
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
