@extends('frontend.layout')


@section('content')
@php $siteSetting = site_settings() @endphp
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="row login-wrap mt-4 bg-transparent">
				<div class="">
					<div class="col-md-12 border bg-white" style="margin: 0 auto;">
						<div class="lwrap">
							<img src="{{ asset('/storage/'.$siteSetting->website_logo) }}" style="max-height: 4rem; display: block; margin: 0 auto;" class="img-fluid mb-4 text-center" alt="">

							@if (count($errors) > 0)
								<div class = "alert alert-danger">
									<ul>
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
									</ul>
								</div>
							@endif

							@if(Session::has('success'))
								<div class="alert alert-success text-center">
									{{Session::get('success')}}
								</div>
							@endif 
							@php
								if($examiner->submitted_date)
									$to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $examiner->submitted_date);
								else
									$to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', date('Y-m-d H:i:s'));
								$from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', date('Y-m-d H:i:s'));
								$diff_in_hours = $to->diffInHours($from);
							@endphp
							@if($diff_in_hours > 0)
								<h3 class="text-center">Sorry! The link is invalid or you have already submitted the exam.</h3>
								<a href="/" class="text-center btn btn-sm btn-secondary d-block mt-3" style="margin: 0 auto; width:fit-content;">Register Now</a>
							@else
								<form class="rd-form-icon exam-form" method="post" action="{{ route('submit.exam', [$uniqueKey]) }}" novalidate>
									@csrf
									<div class="row">
										<div class="col-md-12 mb-3">
											<h3>PLEASE FILL IN THE ASSESSMENT FORM CAREFULLY.</h3>
										</div>
										<div class="col-12 mb-4">
											<div class="card">
												<div class="card-body">
													<!-- <h5 class="card-title mb-0">Detail</h5> -->
													<div class="row">
														<div class="col-md-8 align-items-center">
															<label for="name" class="form-label mb-1">Name <span class="text-danger">*</span></label>
															<div class="input-group mb-3">
																<input id="name" type="text" class="form-control form-control-lg" name="name" required autocomplete="name" autofocus aria-label="Name" >
																@error('name')
																	<span class="invalid-feedback" role="alert">
																		<strong>{{ $message }}</strong>
																	</span>
																@enderror
																<div class="invalid-feedback">
																	Please provide your name.
																</div>
															</div>
														</div>
														<div class="col-md-4 align-items-center">
															<label for="phone" class="form-label mb-1">Phone <span class="text-danger">*</span></label>
															<div class="input-group mb-3">
																<input id="phone" type="text" class="form-control form-control-lg" name="phone" required autocomplete="phone" autofocus aria-label="Phone" >
																@error('phone')
																	<span class="invalid-feedback" role="alert">
																		<strong>{{ $message }}</strong>
																	</span>
																@enderror
																<div class="invalid-feedback">
																	Please provide your phone
																</div>
															</div>
														</div>
														<div class="col-md-4 align-items-center">
															<label for="company_name" class="form-label mb-1">Company Name <span class="text-danger">*</span></label>
															<div class="input-group mb-3">
																<input id="company_name" type="text" class="form-control form-control-lg" name="company_name" required autocomplete="company_name" autofocus aria-label="Company Name" >
																@error('company_name')
																	<span class="invalid-feedback" role="alert">
																		<strong>{{ $message }}</strong>
																	</span>
																@enderror
																<div class="invalid-feedback">
																	Please provide your company name
																</div>
															</div>
														</div>
														<div class="col-md-4 align-items-center">
															<label for="company_address" class="form-label mb-1">Company Address <span class="text-danger">*</span></label>
															<div class="input-group mb-3">
																<input id="company_address" type="text" class="form-control form-control-lg" name="company_address" required autocomplete="company_address" autofocus aria-label="Company Name" >
																@error('company_address')
																	<span class="invalid-feedback" role="alert">
																		<strong>{{ $message }}</strong>
																	</span>
																@enderror
																<div class="invalid-feedback">
																	Please provide your company address
																</div>
															</div>
														</div>
														<div class="col-md-4 align-items-center">
															<label for="designation" class="form-label mb-1">Designation <span class="text-danger">*</span></label>
															<div class="input-group mb-3">
																<input id="designation" type="text" class="form-control form-control-lg" name="designation" required autocomplete="designation" autofocus aria-label="Designation" >
																@error('designation')
																	<span class="invalid-feedback" role="alert">
																		<strong>{{ $message }}</strong>
																	</span>
																@enderror
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="col-12 text-start">
											<h3 style="font-weight:bold; margin-bottom:2rem; color:red;">कृपया मूल्याङ्कन फारम भर्दा तोकिएको सूचक मापनको पुष्ट्यै हुने कुरामा सुनिश्चित  हुनुपर्नेछ।</h3>
										</div>
										
										<div class="col-12 text-start">
											<h3 class="bg-secondary p-2 mb-3" style="color: #fff;">९. अनूसूचि १ - अंक दिने बिधि</h3>
										</div>

										<div class="col-12 text-center">
											<div class="table-responsive fixed-table-body">
												@if(count($categories))
														@foreach($categories as $ck => $cv)
														<table class="table border border-dark table-bordered" id="search-table">
															<tr class="bg-primary table-bordered text-start" style="color: #fff;"><td colspan="7">9.{{$ck + 1}} {{ $cv->title }}</td></tr>
															@if(count($cv->subCategories))
																@foreach($cv->subCategories as $sck => $scv)
																	<tr class="bg-secondary text-start" style="color: #fff;"><td colspan="7">{{$sck + 1}}. {{ $scv->title }}</td></tr>
																	<tr>
																		<td class="border-end border-bottom border-dark text-start" style="color: #fff; background: #999;">सूचक</td>
																		<td class="border-end border-bottom border-dark text-start" style="color: #fff; background: #999;">०</td>
																		<td class="border-end border-bottom border-dark text-start" style="color: #fff; background: #999;">१</td>
																		<td class="border-end border-bottom border-dark text-start" style="color: #fff; background: #999;">२</td>
																		<td class="border-end border-bottom border-dark text-start" style="color: #fff; background: #999;">३</td>
																		<td class="border-end border-bottom border-dark text-start" style="color: #fff; background: #999;">४</td>
																		<td class="border-end border-bottom border-dark text-start" style="color: #fff; background: #999;">५</td>
																	</tr>
																	@if(count($scv->questions))
																		@foreach($scv->questions as $qk => $qv)
																		<tr class="border-bottom border-dark">
																			<td class="border-end border-bottom border-dark text-start" @if(count($qv->answers) > 1) rowspan="{{count($qv->answers)}}" @endif>{{ $qv->question }}</td>
																			@if(count($qv->answers))
																				@foreach($qv->answers as $ak => $av)
																				<td class="border-end @if(count($qv->answers) > 1) border-bottom @endif border-dark text-start">
																					@if($av->answer_0 != '')
																					<input class="" required type="radio" name="answers[{{$qv->id}}][{{$av->id}}]" id="question_{{$qv->id}}_{{$av->id}}_answer0" value="{{$qv->id}}|{{$av->id}}|{{ $av->answer_0 }}|0">
																					<label class="form-check-label" for="question_{{$qv->id}}_{{$av->id}}_answer0">
																						{{ $av->answer_0 }}
																					</label>
																					@endif
																				</td>
																				<td class="border-end @if(count($qv->answers) > 1) border-bottom @endif border-dark text-start">
																					@if($av->answer_1 != '')
																					<input class="" required type="radio" name="answers[{{$qv->id}}][{{$av->id}}]" id="question_{{$qv->id}}_{{$av->id}}_answer1" value="{{$qv->id}}|{{$av->id}}|{{ $av->answer_1 }}|1">
																					<label class="form-check-label" for="question_{{$qv->id}}_{{$av->id}}_answer1">
																						{{ $av->answer_1 }}
																					</label>
																					@endif
																				</td>
																				<td class="border-end @if(count($qv->answers) > 1) border-bottom @endif border-dark text-start">
																					@if($av->answer_2 != '')
																					<input class="" required type="radio" name="answers[{{$qv->id}}][{{$av->id}}]" id="question_{{$qv->id}}_{{$av->id}}_answer2" value="{{$qv->id}}|{{$av->id}}|{{ $av->answer_2 }}|2">
																					<label class="form-check-label" for="question_{{$qv->id}}_{{$av->id}}_answer2">
																						{{ $av->answer_2 }}
																					</label>
																					@endif
																				</td>
																				<td class="border-end @if(count($qv->answers) > 1) border-bottom @endif border-dark text-start">
																					@if($av->answer_3 != '')
																					<input class="" required type="radio" name="answers[{{$qv->id}}][{{$av->id}}]" id="question_{{$qv->id}}_{{$av->id}}_answer3" value="{{$qv->id}}|{{$av->id}}|{{ $av->answer_3 }}|3">
																					<label class="form-check-label" for="question_{{$qv->id}}_{{$av->id}}_answer3">
																						{{ $av->answer_3 }}
																					</label>
																					@endif
																				</td>
																				<td class="border-end @if(count($qv->answers) > 1) border-bottom @endif border-dark text-start">
																					@if($av->answer_4 != '')
																					<input class="" required type="radio" name="answers[{{$qv->id}}][{{$av->id}}]" id="question_{{$qv->id}}_{{$av->id}}_answer4" value="{{$qv->id}}|{{$av->id}}|{{ $av->answer_4 }}|4">
																					<label class="form-check-label" for="question_{{$qv->id}}_{{$av->id}}_answer4">
																						{{ $av->answer_4 }}
																					</label>
																					@endif
																				</td>
																				<td class="border-end @if(count($qv->answers) > 1) border-bottom @endif border-dark text-start">
																					@if($av->answer_5 != '')
																					<input class="" required type="radio" name="answers[{{$qv->id}}][{{$av->id}}]" id="question_{{$qv->id}}_{{$av->id}}_answer5" value="{{$qv->id}}|{{$av->id}}|{{ $av->answer_5 }}|5">
																					<label class="form-check-label" for="question_{{$qv->id}}_{{$av->id}}_answer5">
																						{{ $av->answer_5 }}
																					</label>
																					@endif
																				</td>
																				@if(count($qv->answers) > 1 && $ak < count($qv->answers))
																				</tr></tr>
																				@endif
																				@endforeach
																			@else
																			<td class="border-end border-dark text-start">&nbsp;</td>
																			<td class="border-end border-dark text-start">&nbsp;</td>
																			<td class="border-end border-dark text-start">&nbsp;</td>
																			<td class="border-end border-dark text-start">&nbsp;</td>
																			<td class="border-end border-dark text-start">&nbsp;</td>
																			<td class="border-end border-dark text-start">&nbsp;</td>
																			@endif
																		</tr>
																		@endforeach
																	@endif
																@endforeach
															@endif
														</table>
														@endforeach
													@endif
											</div>
										</div>
										<div class="text-danger text-center p-2 required-errors" style="display:none;">Please fill all the required fields.</div>
										<div class="col-auto" style="margin: 0 auto;">
											<button type="button" class="btn mt-3 btn-lg btn-default w-100 btn-submit">Submit</button>
										</div>
									</div>																	
								</form>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$('.btn-submit').on('click', function() {
		$('.required-errors').css('display', 'none');

		if($('#name').val() == '' || $('#phone').val() == '' || $('#company_name').val() == '' || $('#company_address').val() == '' || $('#designation').val() == '')
		{
			$('.required-errors').css('display', 'block');
			if($('#name').val() == '')
				$('#name').focus();
			else if($('#phone').val() == '')
				$('#phone').focus();
			else if($('#company_name').val() == '')
				$('#company_name').focus();
			else if($('#company_address').val() == '')
				$('#company_address').focus();
			else if($('#designation').val() == '')
				$('#designation').focus();

			return false;
		}

		var names = {};
		$(':radio').each(function() {
			names[$(this).attr('name')] = true;
		});
		var count = 0;
		$.each(names, function() { 
			count++;
		});
		if ($(':radio:checked').length === count) {
			$('.exam-form').submit();
		}
		else
			$('.required-errors').css('display', 'block');
			
	});

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
</script>
@endsection