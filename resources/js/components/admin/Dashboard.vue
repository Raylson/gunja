<template>
    <div class="dashboard">
        <div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h2>Dashboard</h2>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-12 border-end">
								<div class="leads-info">
									<div class="row d-flex align-items-center">
										<div class="col-12 text-center mb-3">
											<!-- <i class="fas fa-3x fa-phone float-start pe-2"></i> -->
											<h2>Welcome to ILO ENCOMPASS.</h2>
											<p>Competitiveness and Resilience Assessment Tool</p>
										</div>
										<!-- <div class="col-4 text-end">
											<button type="button" class="btn btn-outline-secondary btn-sm">More Details</button>
										</div> -->
									</div>
									<div class="row">
										<div class="col-lg-3 col-6">
											<!-- small box -->
											<div class="small-box">
											<div class="inner">
												<h3>{{ categoriesCount }}</h3>
												<p>Categories</p>
											</div>
											<div class="icon">
												<i class="ion ion-pie-graph"></i>
											</div>
											<a href="/admin/categories" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
											</div>
										</div>
										<div class="col-lg-3 col-6">
											<!-- small box -->
											<div class="small-box">
											<div class="inner">
												<h3>{{ subCategoriesCount }}</h3>
												<p>Sub-Categories</p>
											</div>
											<div class="icon">
												<i class="ion ion-pie-graph"></i>
											</div>
											<a href="/admin/sub-categories" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
											</div>
										</div>
										<div class="col-lg-3 col-6">
											<!-- small box -->
											<div class="small-box">
											<div class="inner">
												<h3>{{ questionsCount }}</h3>
												<p>Questions</p>
											</div>
											<div class="icon">
												<i class="ion ion-pie-graph"></i>
											</div>
											<a href="/admin/questions" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
											</div>
										</div>
										<div class="col-lg-3 col-6">
											<!-- small box -->
											<div class="small-box">
											<div class="inner">
												<h3>{{ examinersCount }}</h3>
												<p>Examiners</p>
											</div>
											<div class="icon">
												<i class="ion ion-pie-graph"></i>
											</div>
											<a href="/examiners/verified/list" target="_blank" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
											</div>
										</div>
									</div>
								</div>
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
    name: "Dashboard",
    data() {
        return {
			categoriesCount: 0,
			subCategoriesCount: 0,
			questionsCount: 0,
			examinersCount: 0,
        };
    },
    mounted() {
		var self = this;
		axios.post(process.env.MIX_APP_URL+'/api/getCountDashboard', {}, {
			headers: {
			'Authorization': 'Bearer '+localStorage.getItem("api_token") 
			}
		}).then(function (response) {
			if(response.data.status == 'success')
			{
				self.categoriesCount = response.data.cat_count;
				self.subCategoriesCount = response.data.subcat_count;
				self.questionsCount = response.data.question_count;
				self.examinersCount = response.data.examiner_count;
			}
		})
		.catch(error => {
			console.log(error.response.data.message);
		});

        console.log('Component mounted.');
		if(localStorage.getItem("api_token") == null)
		{
			console.log('no token')
			let self = this;
			axios.post(process.env.MIX_APP_URL+'/api/checkToken', {}, {
				headers: {
				'Authorization': 'Bearer '+localStorage.getItem("api_token") 
				}
			}).then(function (response) {
				if(response.data.status == 'success')
				{
					localStorage.setItem("api_token", response.data.access_token);
				}
			})
			.catch(error => {
				console.log(error.response.data.message);
			});
		}
		else
			console.log('yes token')
    }
}
</script>

<style scoped>
    .dashboard {

    }

	.small-box {
		border-radius: .25rem;
		box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);
		display: block;
		margin-bottom: 20px;
		position: relative;
		color: #fff;
		background: #0E4F91;
		text-align: center;;
	}
	.small-box>.inner {
		padding: 10px;
	}

	@media (min-width: 1200px) {
		.col-lg-3 .small-box h3, .col-md-3 .small-box h3, .col-xl-3 .small-box h3 {
			font-size: 2.2rem;
		}
	}
	@media (min-width: 992px) {
		.col-lg-3 .small-box h3, .col-md-3 .small-box h3, .col-xl-3 .small-box h3 {
			font-size: 1.6rem;
		}
	}

	.small-box h3, .small-box p {
		z-index: 5;
	}
	.small-box h3 {
		font-size: 2.2rem;
		font-weight: 700;
		margin: 0 0 10px;
		padding: 0;
		white-space: nowrap;
	}
	.small-box h3, .small-box p {
		z-index: 5;
	}
	.small-box p {
		font-size: 1rem;
	}
	p {
		margin-top: 0;
		margin-bottom: 1rem;
	}
	.small-box .icon {
		color: rgba(0,0,0,.15);
		z-index: 0;
	}
	*, ::after, ::before {
		box-sizing: border-box;
	}
	.small-box .icon>i.fa, .small-box .icon>i.fab, .small-box .icon>i.fad, .small-box .icon>i.fal, .small-box .icon>i.far, .small-box .icon>i.fas, .small-box .icon>i.ion {
		font-size: 70px;
		top: 20px;
	}
	.small-box .icon>i {
		font-size: 90px;
		position: absolute;
		right: 15px;
		top: 15px;
		transition: -webkit-transform .3s linear;
		transition: transform .3s linear;
		transition: transform .3s linear,-webkit-transform .3s linear;
	}
	.small-box>.small-box-footer {
		background-color: rgba(0,0,0,.1);
		color: rgba(255,255,255,.8);
		display: block;
		padding: 3px 0;
		position: relative;
		text-align: center;
		text-decoration: none;
		z-index: 10;
	}
</style>