<template>
  <div class="examiners">
    <div class="page-title-box">
			<div class="row">
        <template v-if="showErrorMessage || showSuccessMessage">
            <div class="alert" :class="showErrorMessage ? 'alert-danger' : 'alert-success'" role="alert" v-html="message"></div>
        </template>
				<div class="col">
					<h4 class="page-title">Examiner</h4>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
						<li class="breadcrumb-item"><a href="/admin/examiners">Examiner</a></li>
						<li class="breadcrumb-item active">Detail</li>
					</ol>
				</div><!--end col-->
        <div class="col-auto align-self-center">
					<button class="btn btn-sm btn-default" @click="goBack">Back</button>
				</div><!--end col--> 
			</div><!--end row-->                                                              
		</div>
		<div class="card">
			<div class="card-body">
				<AdminExaminerDetail v-if="userType=='admin'"/>
				<SuperAdminExaminerDetail v-if="userType=='superadmin'"/>
			</div>
		</div>	
  </div>
</template>

<script>
import axios from 'axios'
import AdminExaminerDetail from './AdminExaminerDetail'
import SuperAdminExaminerDetail from './SuperAdminExaminerDetail'
const qs = require('querystring');

export default {
  name: 'ExaminerDetail',
  data: () => {
    return {
      showErrorMessage: false,
      showSuccessMessage: false,
      searchKeyword: '',
      searchError: '',
      message: '',
      userType: JSON.parse(localStorage.getItem("user_detail")).user_type,
    }
  },
  computed: {
  },
  methods: {
    goBack() {
      this.$router.replace({path: '/admin/examiners'})
    }
  },
  mounted: function(){
    let self = this;
  },
  components: {
    AdminExaminerDetail,
    SuperAdminExaminerDetail
  },
  metaInfo: {
    // Children can override the title.
    title: 'Examiner Detail',
    // Define meta tags here.
    meta: [
      {name: 'description', content: 'Manage Examiner Detail.'}
    ]
  }
}
</script>

<style scoped>
.card-body >>> table > tbody > tr > td {
  cursor: pointer;
}
</style>
