@extends('frontend.layout')


@section('content')
@php $siteSetting = site_settings() @endphp
<div class="container">
	<header>
		<div class="row">
			<div class="col-md-6">
				<img src="{{ asset('/storage/'.$siteSetting->website_logo) }}" style="max-height:4rem; display: block;" class="img-fluid mb-4 text-center" alt="">
			</div>
			<div class="col-md-6">
				<button class="btn btn-sm btn-secondary ms-2 float-end" id="close-tab">Close</button>
				<button class="btn btn-sm btn-secondary float-end ms-2" id="print-summary"><i class="fas fa-print">Print</i></button>
				<a href="/examiners/verified/list" class="btn btn-sm btn-secondary float-end" id="print-summary">Back</a>
			</div>
		</div>
	</header>
</div>
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="row login-wrap mt-4 bg-transparent">
				<div class="">
					<div class="col-md-12 border bg-white lwrap summary" style="margin: 0 auto;">
						<form class="rd-form-icon exam-form" method="post" action="{{ route('exam.score.update', [$examiner->id]) }}" novalidate>
						@csrf
						<div class="" id="summary">
							<div class="row header" style="padding-bottom: 3rem;">
								<div class="col-md-4" style="width: 34%; float:left; color: #aaa; border-bottom: 1px solid #aaa; margin-bottom: 2rem;">&nbsp;</div>
								<div class="col-md-4 text-center" style="width: 32%; color: #aaa; float:left; text-align:center; padding-top: 0.6rem;">{{ user_name(auth()->user()) }}</div>
								<div class="col-md-4" style="width: 34%; float:left; color: #aaa; border-bottom: 1px solid #aaa; margin-bottom: 2rem;">&nbsp;</div>
							</div>
							@if(Session::has('success'))
								<div class="alert alert-success text-center mt-2 mb-2">
									{{Session::get('success')}}
								</div>
							@endif  
							<div class="row">
								<div class="col-12 mb-4">
									<div class="card" style="position: relative; display: flex; flex-direction: column; margin-bottom: 1rem; min-width: 0; word-wrap: break-word; background-color: #fff; background-clip: border-box; border: 1px solid rgba(0,0,0,.125); border-radius: .25rem;">
											<div class="card-body" style="flex: 1 1 auto; padding: 1rem 1rem;">
												<div class="row" style="width: 100%;">
													<div class="col-md-4 align-items-center" style="width: 30%; display:inline-block; margin-bottom:0.5rem;">
														<label class="col-form-label"><span>Name: </span>{{ $examiner->name }}</label>
													</div>
													<div class="col-md-4 align-items-center" style="width: 30%; display:inline-block; margin-bottom:0.5rem;">
														<label class="col-form-label"><span>Email: </span>{{ $examiner->email }}</label>
													</div>
													<div class="col-md-4 align-items-center" style="width: 30%; display:inline-block; margin-bottom:0.5rem;">
														<label class="col-form-label"><span>Phone: </span>{{ $examiner->phone }}</label>
													</div>
													<div class="col-md-4 align-items-center" style="width: 30%; display:inline-block; margin-bottom:0.5rem;">
														<label class="col-form-label"><span>Company Name: </span>{{ $examiner->company_name }}</label>
													</div>
													<div class="col-md-4 align-items-center" style="width: 30%; display:inline-block; margin-bottom:0.5rem;">
														<label class="col-form-label"><span>Company Address: </span>{{ $examiner->company_address }}</label>
													</div>
													<div class="col-md-4 align-items-center" style="width: 30%; display:inline-block; margin-bottom:0.5rem;">
														<label class="col-form-label"><span>Designation: </span>{{ $examiner->designation }}</label>
													</div>
													<div class="col-md-4 align-items-center" style="width: 30%; display:inline-block; margin-bottom:0.5rem;">
														<label class="col-form-label"><span>Submission ID: </span>{{ $examiner->submission_id }}</label>
													</div>
													<div class="col-md-4 align-items-center" style="width: 30%; display:inline-block; margin-bottom:0.5rem;">
														<label class="col-form-label"><span>Submission Date: </span>{{ $examiner->submitted_date }}</label>
													</div>
													<div class="col-md-4 align-items-center" style="width: 30%; display:inline-block; margin-bottom:0.5rem;">
														<label class="col-form-label"><span>Status: </span><span class="badge {{ $examiner->status == 'pending' ? 'bg-danger' : 'bg-success' }}">{{ $examiner->status == 'pending' ? 'Pending' : 'Verified' }}</span></label>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-12 text-center">
									<div class="table-responsive fixed-table-body">										
										<table class="table border border-dark" id="search-table" border="1" style="width:100%;">
											<thead>
												<tr class="table-dark" style="background: #212529; color: #fff;">
													<th colspan="5">प्रतिस्पर्धात्मकता बर्गिकरणका तत्वहरु</th>
													<th>उद्योगद्वारा मूल्यांकन</th>
													<th>जम्मा प्राप्ताड्ढ</th>
													<th>वणिज्यद्वारा मूल्यांकन</th>
													<th>कैफियत</th>
												</tr>
												<tr class="table-dark" style="background: #212529; color: #fff;">
													<th colspan="4">&nbsp;</th>
													<th class="table-active border-end border-dark" style="background: #373B3E; color: #fff;">अंक भार</th>
													<th class="table-active border-end border-dark" style="background: #373B3E; color: #fff;">प्राप्ताड्ढ</th>
													<th class="table-active border-end border-dark" style="background: #373B3E; color: #fff;">०-५</th>
													<th class="table-active border-end border-dark" style="background: #373B3E; color: #fff;">०-५</th>
													<th class="table-active" style="background: #373B3E; color: #fff;">&nbsp;</th>
												</tr>
											</thead>
											<tbody class="">
											@if(count($categories))
												@php
													$totalScore = 0;
													$totalUserScore = 0;
													$totalAvgAdminScore = 0;
													$totalAdminScore = 0;
												@endphp
												@foreach($categories as $ck => $cv)
													<tr class="table-light border border-dark">
														<td class="border-end border-dark">&nbsp;</td>
														<td colspan="8" class="border-end border-dark text-start">{{ $cv->title }}</td>
													</tr>
													@if(count($cv->subCategories))
														@foreach($cv->subCategories as $sck => $scv)
															<tr class="table-light table-active border border-dark" style="background: #DFE0E1;">
																<td class="border-end border-dark">{{ $sck + 1 }}</td>
																<td colspan="3" class="border-end border-dark text-start">{{ $scv->title }}</td>
																<td colspan="5" class="border-end border-dark text-start" style="padding-left:3%;">{{ $scv->score }}</td>
															</tr>
															@if(count($scv->questions))
																@foreach($scv->questions as $qk => $qv)
																<tr class="table-light border border-dark">
																	<td class="border-end border-dark">&nbsp;</td>
																	<td colspan="3" class="border-end border-dark text-start">{{ $qv->question }}</td>
																	<td class="border-end border-dark" style="text-align:center;">{{ $qv->score }}</td>
																	@php
																		$user_asse_det = examiner_assessment_detail($qv->id, $examiner->assessments);
																		if(isset($user_asse_det['user_score']))
																		{
																			$user_score =  $user_asse_det['user_score'];
																			$admin_score = $user_asse_det['admin_score'];
																			if(($sck + 1) == 10)
																			{
																				$score_avg = round((((double)$qv->score / 4) * $user_score), 2);
																				$totalAvgAdminScore += round((((double)$qv->score / 4) * $admin_score), 2);
																			}
																			else
																			{
																				$score_avg = round((((double)$qv->score / 5) * $user_score), 2);
																				$totalAvgAdminScore += round((((double)$qv->score / 5) * $admin_score), 2);
																			}
																		}
																		else
																		{
																			$user_score = '0';
																			$score_avg = '0';
																		}
																		$totalScore += round((double)$qv->score, 2);
																		$totalUserScore += round($score_avg, 2);
																		$totalAdminScore += $user_asse_det['admin_score'];
																	@endphp
																	<td class="border-end border-dark" style="text-align:center;">{{ $score_avg }}</td>
																	<td class="border-end border-dark" style="text-align:center;">{{ $user_score }}</td>
																	@if(isset($user_asse_det['user_score']))
																	<td class="border-end border-dark" style="text-align:center;"><input type="number" min="0" max="5" value="{{ $user_asse_det['admin_score'] }}" name="scores[{{$user_asse_det['id']}}]" class="form-control" required></td>
																	<td class="border-end border-dark" style="text-align:center;"><input type="text" class="form-control" name="reviews[{{$user_asse_det['id']}}]" value="{{ $user_asse_det['review'] }}"></td>
																	@else
																	<td class="border-end border-dark" style="text-align:center;">&nbsp;</td>
																	<td class="border-end border-dark" style="text-align:center;">&nbsp;</td>
																	@endif
																</tr>
																@endforeach
															@endif
														@endforeach
													@endif
												@endforeach
											@endif
											<tr class="table-light bg-light fw-bold border border-dark">
												<td colspan="4" class="border-end border-dark text-end">Total Score: </td>
												<td style="text-align: center;">&nbsp;</td>
												<td class="border-end border-dark" style="text-align: center;">{{ $totalUserScore }}</td>
												<td style="text-align: center;">&nbsp;</td>
												<td style="text-align: center;"> {{ $totalAdminScore }}</td>
												<td style="text-align: center;">&nbsp;</td>
											</tr>
											@php
												$percentage = round((($totalUserScore / $totalScore) * 100) , 2);
												if($percentage <= 55)
													$grade = 'काँस्य';
												else if($percentage <= 60)
													$grade = 'चाँदी';
												else if($percentage <= 65)
													$grade = 'सुन';
												else
													$grade = 'प्लाटिनम';

												$percentage_admin = round((($totalAvgAdminScore / $totalScore) * 100) , 2);
												if($percentage_admin <= 55)
													$grade_admin = 'काँस्य';
												else if($percentage_admin <= 60)
													$grade_admin = 'चाँदी';
												else if($percentage_admin <= 65)
													$grade_admin = 'सुन';
												else
													$grade_admin = 'प्लाटिनम';
											@endphp
											<tr class="table-light bg-light fw-bold border border-dark">
												<td colspan="4" class="border-end border-dark text-end">Percentage: </td>
												<td style="text-align: center;">&nbsp;</td>
												<td class="border-end border-dark" style="text-align: center;">{{ $percentage }} %</td>
												<td style="text-align: center;">&nbsp;</td>
												<td style="text-align: center;"> {{ $percentage_admin }} %</td>
												<td style="text-align: center;">&nbsp;</td>
											</tr>
											<tr class="table-light bg-light fw-bold border border-dark">
												<td colspan="4" class="border-end border-dark text-end">Grade: </td>
												<td style="text-align: center;">&nbsp;</td>
												<td class="border-end border-dark" style="text-align: center;">{{ $grade }}</td>
												<td style="text-align: center;">&nbsp;</td>
												<td style="text-align: center;"> {{ $grade_admin }}</td>
												<td style="text-align: center;">&nbsp;</td>
											</tr>
											</tbody>
										</table>
									</div>
								</div>
								<div class="col-md-12 text-center" style="width:100%; margin-top:3rem;">
									<div class="row">
										<div class="col-md-6" style="width:45%; display:inline-block;">
											<p class="text-start">
												.........................<br/>
												पेश गर्नेको नामः<br/>
												पदः<br/>
												मितिः
											</p>
										</div>
										<div class="col-md-6 ps-5" style="width:45%; display:inline-block;"">
											<p class="text-start ps-5" style="padding-left:3rem;">
												.........................<br/>
												सदर गर्नेको नामः<br/>
												पदः<br/>
												मितिः
											</p>
										</div>
										<div class="col-md-12 mt-5 p-0" style="margin-left: 0.8rem;">
											<p class="text-start">
												कार्यालयको छाप: 
											</p>
										</div>
									</div>
								</div>
								<div class="row header" style="padding-top: 3rem;">
									<div class="col-md-4" style="width: 34%; float:left; color: #aaa; border-bottom: 1px solid #aaa; margin-bottom: 2rem;">&nbsp;</div>
									<div class="col-md-4 text-center" style="width: 32%; color: #aaa; float:left; text-align:center; padding-top: 0.6rem;">{{ user_name(auth()->user()) }}</div>
									<div class="col-md-4" style="width: 34%; float:left; color: #aaa; border-bottom: 1px solid #aaa; margin-bottom: 2rem;">&nbsp;</div>
								</div>
							</div>
						</div>
						<div class="col-sm-2" style="margin: 0 auto;">
							<button type="submit" class="btn btn-sm btn-primary mt-1">Submit</button>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	// Example starter JavaScript for disabling form submissions if there are invalid fields
	(function () {
	'use strict'

	// Fetch all the forms we want to apply custom Bootstrap validation styles to
	var forms = document.querySelectorAll('.exam-form')

	// Loop over them and prevent submission
	Array.prototype.slice.call(forms)
		.forEach(function (form) {
			form.addEventListener('submit', function (event) {
				if (!form.checkValidity()) {
					event.preventDefault()
					event.stopPropagation()
				}
				form.classList.add('was-validated')
			}, false)
		})
	})()

	$('#print-summary').on('click', function() {
		var summaryContent = document.getElementById("summary").innerHTML;
		var newWin= window.open("");
		newWin.document.write(summaryContent);
		newWin.print();
		newWin.close();
	});

	$('#close-tab').on('click', function() {
		window.close();
	});
</script>
@endsection

@section('extra_css')
<style>
	header { position: relative; padding: 1rem; }
	.header, .header div { color: #aaa; }
</style>
@endsection