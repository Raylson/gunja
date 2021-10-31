<!DOCTYPE html>
<html>
  <head>
  	<meta charset="UTF-16">
    <!-- <meta http-equiv="Content-Type" content="charset=utf-16" /> -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    @php $siteSetting = site_settings() @endphp
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="icon" href="/favicon.ico">

    <meta name="description" content="" />
    <meta name="keywords" content="" />    
    <title>{{ $siteSetting->title }}</title>

    <link href="/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/all.css"/>
    <link rel="stylesheet" href="/css/all.min.css">
    <link href="/css/dashboard.min.css" rel="stylesheet">

    <!-- jQuery library -->
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script src="/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
      .login-wrap { width:auto; transform: none; position: unset;}
      .login-wrap .lwrap .rd-form-icon .form-control { padding: .375rem 1rem; }
      .col-form-label span { font-weight: bold; }
    </style>

  </head>

  <body>
    <div class="main-container">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-12">
					<div class="row login-wrap mt-4 bg-transparent">
						<div class="">
							<div class="col-md-12 border bg-white lwrap summary" style="margin: 0 auto;">
								<div class="" id="summary">
									<img src="{{ asset('/storage/'.$siteSetting->website_logo) }}" style="max-height: 4rem; display: block; margin: 0 auto;" class="img-fluid mb-4 text-center" alt="">

									<div class="row">
										<div class="col-12 mb-4">
											<div class="card">
												<div class="card-body">
													<div class="row">
														<div class="col-md-4 align-items-center">
															<label class="col-form-label"><span>Name: </span>{{ $examiner->name }}</label>
														</div>
														<div class="col-md-4 align-items-center">
															<label class="col-form-label"><span>Email: </span>{{ $examiner->email }}</label>
														</div>
														<div class="col-md-4 align-items-center">
															<label class="col-form-label"><span>Phone: </span>{{ $examiner->phone }}</label>
														</div>
														<div class="col-md-4 align-items-center">
															<label class="col-form-label"><span>Company Name: </span>{{ $examiner->company_name }}</label>
														</div>
														<div class="col-md-4 align-items-center">
															<label class="col-form-label"><span>Company Address: </span>{{ $examiner->company_address }}</label>
														</div>
														<div class="col-md-4 align-items-center">
															<label class="col-form-label"><span>Designation: </span>{{ $examiner->designation }}</label>
														</div>
														<div class="col-md-4 align-items-center">
															<label class="col-form-label"><span>Submission ID: </span>{{ $examiner->submission_id }}</label>
														</div>
														<div class="col-md-4 align-items-center">
															<label class="col-form-label"><span>Submission Date: </span>{{ $examiner->submitted_date }}</label>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-12 text-center">
											<div class="table-responsive fixed-table-body">
												<table class="table border border-dark" id="search-table">
													<thead>
														<tr class="table-dark">
															<th colspan="5">प्रतिस्पर्धात्मकता बर्गिकरणका तत्वहरु</th>
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
													<tbody class="">
													@if(count($categories))
														@foreach($categories as $ck => $cv)
															<tr class="table-light border border-dark">
																<td class="border-end border-dark">&nbsp;</td>
																<td colspan="8" class="border-end border-dark text-start">{{ $cv->title }}</td>
															</tr>
															@if(count($cv->subCategories))
																@foreach($cv->subCategories as $sck => $scv)
																	<tr class="table-light table-active border border-dark">
																		<td class="border-end border-dark">{{ $sck + 1 }}</td>
																		<td colspan="3" class="border-end border-dark text-start">{{ $scv->title }}</td>
																		<td colspan="5" class="border-end border-dark text-start" style="padding-left:4.2%;">{{ $scv->score }}</td>
																	</tr>
																	@if(count($scv->questions))
																		@foreach($scv->questions as $qk => $qv)
																		<tr class="table-light border border-dark">
																			<td class="border-end border-dark">&nbsp;</td>
																			<td colspan="3" class="border-end border-dark text-start">{{ $qv->question }}</td>
																			<td class="border-end border-dark text-start">{{ $qv->score }}</td>
																			<td class="border-end border-dark text-start">{{ examiner_score($qv->id, $examiner->assessments) }}</td>
																			<td class="border-end border-dark text-start">&nbsp;</td>
																			<td class="border-end border-dark text-start">&nbsp;</td>
																			<td class="border-end border-dark text-start">&nbsp;</td>
																		</tr>
																		@endforeach
																	@endif
																@endforeach
															@endif
														@endforeach
													@endif
													</tbody>
												</table>
											</div>
										</div>

										<div class="col-md-12 text-center mt-5 ms-4">
											<div class="row">
												<div class="col-md-6">
													<p class="text-start">
														.........................<br/>
														पेश गर्नेको नामः<br/>
														पदः<br/>
														मितिः
													</p>
												</div>
												<div class="col-md-6 ps-5">
													<p class="text-start ps-5">
														.........................<br/>
														सदर गर्नेको नामः<br/>
														पदः<br/>
														मितिः
													</p>
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
	</div>
  </body>
</html>