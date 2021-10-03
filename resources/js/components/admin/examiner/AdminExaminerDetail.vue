<template>
    <div class="detail">
		<table class="table table-striped" id="search-table">
			<thead>
				<tr>
				<th scope="col">Question</th>
				<th scope="col">Answer</th>
				<th scope="col">Score</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="(item, index) in assessments" :key="item.id">
					<td>{{ item.question.question }}</td>
					<td>{{ item.answer }}</td>
					<td>{{ item.user_score }}</td>
				</tr>
			</tbody>
		</table>
	</div>
</template>

<script>
export default {
    name: "AdminExaminerDetail",
    data() {
        return {
			logo: '',
			rootUrl: process.env.MIX_APP_URL,
			userType: JSON.parse(localStorage.getItem("user_detail")).user_type,
			examiner: {},
      		assessments: [],
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
