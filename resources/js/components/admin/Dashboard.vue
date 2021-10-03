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
										<div class="col-8">
											<!-- <i class="fas fa-3x fa-phone float-start pe-2"></i> -->
											<h2>Welcome to Dashboard <i class="fas fa-check-circle text-success"></i></h2>
										</div>
										<!-- <div class="col-4 text-end">
											<button type="button" class="btn btn-outline-secondary btn-sm">More Details</button>
										</div> -->
									</div>
									<div class="row">
										<div class="col">
											<div class="chart-info">
												<div id="chart"></div>
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
        };
    },
    mounted() {
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
</style>
