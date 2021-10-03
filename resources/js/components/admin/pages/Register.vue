<template>
  <div class="container">
    <div class="row justify-content-center">
			<div class="col-12">
				<div class="login-wrap">
					<div class="row align-items-center no-gutters">
						<div class="col-md-6 border-end bg-white">
							<div class="lwrap">
								<a href="/"><img :src="logo" style="height: 60px;" class="img-fluid mb-4" alt=""></a>
								<h2>Register Now!</h2>
								<form id="register-user" @submit.prevent="register">
									<div class="mb-3">
										<label for="first_name" class="form-label mb-1">First Name <span class="text-danger">*</span></label>
										<div class="input-group mb-3">
											<input id="first_name" v-model="first_name" type="text" class="form-control form-control-lg" :class="(errors.length && errors.first_name.length) ? 'is-invalid' : ''" name="first_name" required autocomplete="first_name" autofocus aria-label="Firstname" >
											<span class="invalid-feedback" v-if="Object.keys(errors).length" role="alert">
												<strong>{{ errors.first_name }}</strong>
											</span>
										</div>
									</div>
									<div class="mb-3">
										<label for="middle_name" class="form-label mb-1">Middle Name </label>
										<div class="input-group mb-3">
											<input id="middle_name" v-model="middle_name" type="text" class="form-control form-control-lg" name="middle_name"  autocomplete="middle_name" autofocus aria-label="Middlename" >
										</div>
									</div>
									<div class="mb-3">
										<label for="last_name" class="form-label mb-1">Last Name <span class="text-danger">*</span></label>
										<div class="input-group mb-3">
											<input id="last_name" v-model="last_name" type="text" class="form-control form-control-lg" :class="(errors.length && errors.last_name.length) ? 'is-invalid' : ''" name="last_name" required autocomplete="last_name" autofocus aria-label="Lastname" >
											<span class="invalid-feedback" v-if="Object.keys(errors).length" role="alert">
												<strong>{{ errors.last_name }}</strong>
											</span>
										</div>
									</div>
									<div class="mb-3">
										<div class="row">
											<div class="col-6">
												<label for="phone" class="form-label mb-1">Phone</label>
												<div class="input-group">
													<input id="phone" v-model="phone" type="text" class="form-control form-control-lg" :class="(errors.length && errors.phone.length) ? 'is-invalid' : ''" name="phone" autocomplete="phone" autofocus aria-label="Phone" >
													<span class="invalid-feedback" v-if="Object.keys(errors).length" role="alert">
														<strong>{{ errors.phone }}</strong>
													</span>
												</div>
											</div>
											<div class="col-6">
												<label for="mobile" class="form-label mb-1">Mobile <span class="text-danger">*</span></label>
												<div class="input-group">
													<input id="mobile" v-model="mobile" type="text" class="form-control form-control-lg" :class="(errors.length && errors.mobile.length) ? 'is-invalid' : ''" name="mobile" required autocomplete="mobile" autofocus aria-label="Mobile" >
													<span class="invalid-feedback" v-if="Object.keys(errors).length" role="alert">
														<strong>{{ errors.mobile }}</strong>
													</span>
												</div>
											</div>
										</div>
									</div>
                  					<div class="mb-3 rd-form-icon">
										<label for="address" class="form-label mb-1">Address </label>
										<div class="input-group mb-3">
											<div class="f-icon">
												<i class="fas fa-envelope"></i>
											</div>
											<input id="address" v-model="address" type="text" class="form-control form-control-lg" :class="(errors.length && errors.address.length) ? 'is-invalid' : ''" name="address" autocomplete="address" aria-label="address">
											<span class="invalid-feedback" v-if="Object.keys(errors).length" role="alert">
												<strong>{{ errors.address }}</strong>
											</span>
										</div>
									</div>
									<div class="mb-3 rd-form-icon">
										<label for="email" class="form-label mb-1">Email address <span class="text-danger">*</span></label>
										<div class="input-group mb-3">
											<div class="f-icon">
												<i class="fas fa-envelope"></i>
											</div>
											<input id="email" v-model="email" type="email" class="form-control form-control-lg" :class="(errors.length && errors.email.length) ? 'is-invalid' : ''" name="email" required autocomplete="email" aria-label="Email">
											<span class="invalid-feedback" v-if="Object.keys(errors).length" role="alert">
												<strong>{{ errors.email }}</strong>
											</span>
										</div>
									</div>
									<div class="mb-3 rd-form-icon">
										<label for="password" class="form-label mb-1">Password <span class="text-danger">*</span></label>
										<div class="input-group mb-3">
											<div class="f-icon">
												<i class="fas fa-lock"></i>
											</div>
											<input type="password" class="form-control form-control-lg" id="password" v-model="password" :class="(errors.length && errors.password.length) ? 'is-invalid' : ''" name="password" required autocomplete="new-password">
											<div class="s-icon" @click="showHidePassword">
												<i class="fas" :class="showPassword ? 'fa-eye fw-bolder' : 'fa-eye-slash' "></i>
											</div>
										</div>
									</div>
									<div class="mb-3 rd-form-icon">
										<label for="password-confirm" class="form-label mb-1">Confirm Password <span class="text-danger">*</span></label>
										<div class="input-group mb-3">
											<div class="f-icon">
												<i class="fas fa-lock"></i>
											</div>
											<input type="password" class="form-control form-control-lg" id="password-confirm" v-model="password_confirmation" name="password_confirmation" required autocomplete="new-password">
											<div class="s-icon" @click="showHideConfirmPassword">
												<i class="fas" :class="showConfirmPassword ? 'fa-eye fw-bolder' : 'fa-eye-slash' "></i>
											</div>
											<span class="invalid-feedback" v-if="Object.keys(errors).length" role="alert">
												<strong>{{ errors.password }}</strong>
											</span>
										</div>
									</div>
									<div class="row mb-3">
										<div class="col-12">
											<div class="form-check">
												<input type="checkbox" class="form-check-input" id="iAgree" v-model="iAgree">
												<label class="form-check-label" for="iAgree">I agree to all the <a href="#">Terms</a>, <a href="#">Privacy Policy</a> and <a href="#">Fees</a></label>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-12">
											<button type="submit" :class="iAgree ? '' : 'disabled'" class="btn btn-lg btn-default w-100"><i class="fas fa-user"></i> Register Now</button>
										</div>
									</div>	
									<div class="mt-3">
										Already have an account? <a href="/login" class="form-check-label" for="login">Log in</a>
									</div>																
								</form>
								<div class="or"></div>
								<div class="row">
									<div class="col-6">
										<a href="/oauth/google?ref=frontend" class="btn btn-social w-100 d-flex align-items-center justify-content-center"><img src="img/google.svg" alt=""> Signup with google</a>
									</div>
									<div class="col-6">
										<a href="/oauth/facebook?ref=frontend" class="btn btn-social w-100 d-flex align-items-center justify-content-center"><img src="img/facebook.svg" alt=""> Signup with Facebook</a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 text-center">
							<svg class="animated" id="freepik_stories-online-shopping" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs">
              
              <g id="freepik--background-complete--inject-13" class="animable" style="transform-origin: 250px 226.87px;"><rect y="382.4" width="500" height="0.25" style="fill: rgb(235, 235, 235); transform-origin: 250px 382.525px;" id="elybbajx674w" class="animable"></rect><rect x="363" y="398.49" width="86.9" height="0.25" style="fill: rgb(235, 235, 235); transform-origin: 406.45px 398.615px;" id="eli3oskd4e9xa" class="animable"></rect><rect x="357.66" y="389.21" width="8.69" height="0.25" style="fill: rgb(235, 235, 235); transform-origin: 362.005px 389.335px;" id="elwatmn7l7f4a" class="animable"></rect><rect x="280.12" y="397.5" width="19.19" height="0.25" style="fill: rgb(235, 235, 235); transform-origin: 289.715px 397.625px;" id="elutt9e5ydxxo" class="animable"></rect><rect x="52.46" y="390.89" width="21.6" height="0.25" style="fill: rgb(235, 235, 235); transform-origin: 63.26px 391.015px;" id="elss8nah2myp" class="animable"></rect><rect x="82.96" y="390.89" width="27.93" height="0.25" style="fill: rgb(235, 235, 235); transform-origin: 96.925px 391.015px;" id="elcukm0k10ubl" class="animable"></rect><rect x="207.67" y="394.99" width="46.84" height="0.25" style="fill: rgb(235, 235, 235); transform-origin: 231.09px 395.115px;" id="elyy12duo0vki" class="animable"></rect><path d="M237,337.8H43.91a5.71,5.71,0,0,1-5.7-5.71V60.66A5.71,5.71,0,0,1,43.91,55H237a5.71,5.71,0,0,1,5.71,5.71V332.09A5.71,5.71,0,0,1,237,337.8ZM43.91,55.2a5.46,5.46,0,0,0-5.45,5.46V332.09a5.46,5.46,0,0,0,5.45,5.46H237a5.47,5.47,0,0,0,5.46-5.46V60.66A5.47,5.47,0,0,0,237,55.2Z" style="fill: rgb(235, 235, 235); transform-origin: 140.46px 196.4px;" id="el8j9a92y64mm" class="animable"></path><path d="M453.31,337.8H260.21a5.72,5.72,0,0,1-5.71-5.71V60.66A5.72,5.72,0,0,1,260.21,55h193.1A5.71,5.71,0,0,1,459,60.66V332.09A5.71,5.71,0,0,1,453.31,337.8ZM260.21,55.2a5.47,5.47,0,0,0-5.46,5.46V332.09a5.47,5.47,0,0,0,5.46,5.46h193.1a5.47,5.47,0,0,0,5.46-5.46V60.66a5.47,5.47,0,0,0-5.46-5.46Z" style="fill: rgb(235, 235, 235); transform-origin: 356.75px 196.4px;" id="elg2mvjtecbro" class="animable"></path><path d="M258.6,319.84H194l-6.16-107a4.48,4.48,0,0,1,4.52-4.8h55a5.14,5.14,0,0,1,5.07,4.8Z" style="fill: rgb(224, 224, 224); transform-origin: 223.214px 263.94px;" id="elv5e9ai194ep" class="animable"></path><path d="M265.12,319.84H200.49l-6.17-107a4.49,4.49,0,0,1,4.53-4.8h55a5.15,5.15,0,0,1,5.08,4.8Z" style="fill: rgb(235, 235, 235); transform-origin: 229.715px 263.94px;" id="el7aqfkg97tvx" class="animable"></path><path d="M201.78,306.49h45a0,0,0,0,1,0,0v13.35a0,0,0,0,1,0,0H197a0,0,0,0,1,0,0v-8.55A4.8,4.8,0,0,1,201.78,306.49Z" style="fill: rgb(224, 224, 224); transform-origin: 221.89px 313.165px;" id="elohp6ut35fj" class="animable"></path><path d="M236.86,306.49h57.28a4.8,4.8,0,0,1,4.8,4.8v8.55a0,0,0,0,1,0,0H232.06a0,0,0,0,1,0,0v-8.55A4.8,4.8,0,0,1,236.86,306.49Z" style="fill: rgb(235, 235, 235); transform-origin: 265.5px 313.165px;" id="ela0bh24ldb96" class="animable"></path><rect x="193.96" y="319.84" width="4.43" height="62.56" style="fill: rgb(224, 224, 224); transform-origin: 196.175px 351.12px;" id="elpu2b6b24r1" class="animable"></rect><rect x="226.49" y="319.84" width="4.43" height="62.56" style="fill: rgb(224, 224, 224); transform-origin: 228.705px 351.12px;" id="ely4zwgmsw3sh" class="animable"></rect><rect x="260.97" y="319.84" width="4.43" height="62.56" style="fill: rgb(224, 224, 224); transform-origin: 263.185px 351.12px;" id="elip9ohjqzr6s" class="animable"></rect><rect x="293.49" y="319.84" width="4.43" height="62.56" style="fill: rgb(224, 224, 224); transform-origin: 295.705px 351.12px;" id="elsluzxavfpfk" class="animable"></rect><rect x="90.73" y="270.43" width="98.73" height="5.75" style="fill: rgb(230, 230, 230); transform-origin: 140.095px 273.305px;" id="el1mt6f1xio0k" class="animable"></rect><rect x="97.29" y="276.18" width="92.18" height="99.26" style="fill: rgb(235, 235, 235); transform-origin: 143.38px 325.81px;" id="elw8z4gkt6ym" class="animable"></rect><g id="elh56svpd4vxh"><rect x="189.47" y="276.18" width="222.25" height="99.26" style="fill: rgb(245, 245, 245); transform-origin: 300.595px 325.81px; transform: rotate(180deg);" class="animable"></rect></g><g id="el6y1p8j4wuy4"><rect x="97.29" y="276.18" width="314.43" height="4.26" style="fill: rgb(224, 224, 224); transform-origin: 254.505px 278.31px; transform: rotate(180deg);" class="animable"></rect></g><g id="el15aht2i8ohb"><rect x="189.47" y="270.43" width="228.81" height="5.75" style="fill: rgb(240, 240, 240); transform-origin: 303.875px 273.305px; transform: rotate(180deg);" class="animable"></rect></g><polygon points="97.29 375.44 97.29 382.4 115.65 375.44 97.29 375.44" style="fill: rgb(235, 235, 235); transform-origin: 106.47px 378.92px;" id="elbt9ubi6r8a" class="animable"></polygon><polygon points="189.47 375.44 189.47 382.4 207.83 375.44 189.47 375.44" style="fill: rgb(245, 245, 245); transform-origin: 198.65px 378.92px;" id="elcwpo395i2y" class="animable"></polygon><polygon points="411.72 375.44 411.72 382.4 393.36 375.44 411.72 375.44" style="fill: rgb(245, 245, 245); transform-origin: 402.54px 378.92px;" id="elq8hwc8oa8ok" class="animable"></polygon><polygon points="189.47 375.44 189.47 382.4 171.1 375.44 189.47 375.44" style="fill: rgb(235, 235, 235); transform-origin: 180.285px 378.92px;" id="el4en7aklhudu" class="animable"></polygon><polygon points="319.54 375.44 319.54 382.4 301.18 375.44 319.54 375.44" style="fill: rgb(224, 224, 224); transform-origin: 310.36px 378.92px;" id="elye451ums04" class="animable"></polygon><polygon points="319.54 375.44 319.54 382.4 337.91 375.44 319.54 375.44" style="fill: rgb(224, 224, 224); transform-origin: 328.725px 378.92px;" id="eluskya8erokn" class="animable"></polygon><rect x="206.48" y="77.33" width="82.03" height="103.79" style="fill: rgb(230, 230, 230); transform-origin: 247.495px 129.225px;" id="el3flubkv7mh2" class="animable"></rect><rect x="211.49" y="77.33" width="82.03" height="103.79" style="fill: rgb(245, 245, 245); transform-origin: 252.505px 129.225px;" id="elaiwsdcyxwzv" class="animable"></rect><g id="elrdhh0vrujp"><rect x="205.28" y="97.2" width="94.44" height="64.04" style="fill: rgb(255, 255, 255); transform-origin: 252.5px 129.22px; transform: rotate(90deg);" class="animable"></rect></g><g id="elyi2794z2ixd"><rect x="235.41" y="127.33" width="94.44" height="3.79" style="fill: rgb(230, 230, 230); transform-origin: 282.63px 129.225px; transform: rotate(90deg);" class="animable"></rect></g><rect x="215.21" y="124.18" width="74.59" height="6.27" style="fill: rgb(245, 245, 245); transform-origin: 252.505px 127.315px;" id="elvuy73ghs3ta" class="animable"></rect><rect x="215.21" y="103.32" width="74.59" height="6.27" style="fill: rgb(245, 245, 245); transform-origin: 252.505px 106.455px;" id="el43o0uw45hjs" class="animable"></rect><rect x="317.07" y="77.33" width="82.03" height="103.79" style="fill: rgb(230, 230, 230); transform-origin: 358.085px 129.225px;" id="elnxx8kc0n9kl" class="animable"></rect><rect x="322.09" y="77.33" width="82.03" height="103.79" style="fill: rgb(245, 245, 245); transform-origin: 363.105px 129.225px;" id="eldc540pnaiqh" class="animable"></rect><g id="elmyg03t9nuyc"><rect x="315.88" y="97.2" width="94.44" height="64.04" style="fill: rgb(255, 255, 255); transform-origin: 363.1px 129.22px; transform: rotate(90deg);" class="animable"></rect></g><g id="eliu3ca4mb88s"><rect x="346" y="127.33" width="94.44" height="3.79" style="fill: rgb(230, 230, 230); transform-origin: 393.22px 129.225px; transform: rotate(90deg);" class="animable"></rect></g><rect x="325.81" y="153.92" width="74.59" height="6.27" style="fill: rgb(245, 245, 245); transform-origin: 363.105px 157.055px;" id="ela7ke62gt2ea" class="animable"></rect><rect x="325.81" y="103.32" width="74.59" height="6.27" style="fill: rgb(245, 245, 245); transform-origin: 363.105px 106.455px;" id="elpf7coavpbu" class="animable"></rect><rect x="95.88" y="77.33" width="82.03" height="103.79" style="fill: rgb(230, 230, 230); transform-origin: 136.895px 129.225px;" id="elwxbetuhu2k8" class="animable"></rect><rect x="100.9" y="77.33" width="82.03" height="103.79" style="fill: rgb(245, 245, 245); transform-origin: 141.915px 129.225px;" id="elqg5s6e2wn1n" class="animable"></rect><g id="elk8apqrowvnn"><rect x="94.69" y="97.2" width="94.44" height="64.04" style="fill: rgb(255, 255, 255); transform-origin: 141.91px 129.22px; transform: rotate(90deg);" class="animable"></rect></g><g id="elzhv0ukcyaf"><rect x="124.81" y="127.33" width="94.44" height="3.79" style="fill: rgb(230, 230, 230); transform-origin: 172.03px 129.225px; transform: rotate(90deg);" class="animable"></rect></g><rect x="104.62" y="161.48" width="74.59" height="6.27" style="fill: rgb(245, 245, 245); transform-origin: 141.915px 164.615px;" id="elpucta4d2z6" class="animable"></rect><rect x="104.62" y="114.26" width="74.59" height="6.27" style="fill: rgb(245, 245, 245); transform-origin: 141.915px 117.395px;" id="elbv110w2sgni" class="animable"></rect><path d="M369.82,232H354s2.75,8.58,2.75,13.62-12.05,24.83,5.17,24.83,5.17-19.78,5.17-24.83S369.82,232,369.82,232Z" style="fill: rgb(230, 230, 230); transform-origin: 361.92px 251.225px;" id="elnf89856tpoe" class="animable"></path><path d="M311.29,262.18c0,4.54,8.93,8.25,19.86,8.25H341c10.93,0,19.86-3.71,19.86-8.25Z" style="fill: rgb(240, 240, 240); transform-origin: 336.075px 266.305px;" id="elx6phk3jg1bp" class="animable"></path><rect x="123.94" y="249.67" width="17.4" height="20.76" style="fill: rgb(230, 230, 230); transform-origin: 132.64px 260.05px;" id="elajigr0zfz7p" class="animable"></rect><g id="elllyx83vqfl"><rect x="141.35" y="249.67" width="17.4" height="20.76" style="fill: rgb(245, 245, 245); transform-origin: 150.05px 260.05px; transform: rotate(180deg);" class="animable"></rect></g><rect x="147.5" y="253.93" width="13.83" height="16.5" style="fill: rgb(230, 230, 230); transform-origin: 154.415px 262.18px;" id="elxgfplvui03m" class="animable"></rect><g id="el95hy2udvpof"><rect x="161.33" y="253.93" width="13.83" height="16.5" style="fill: rgb(245, 245, 245); transform-origin: 168.245px 262.18px; transform: rotate(180deg);" class="animable"></rect></g></g><g id="freepik--Shadow--inject-13" class="animable" style="transform-origin: 250px 416.24px;"><ellipse id="freepik--path--inject-13" cx="250" cy="416.24" rx="193.89" ry="11.32" style="fill: rgb(245, 245, 245); transform-origin: 250px 416.24px;" class="animable"></ellipse></g><g id="freepik--Device--inject-13" class="animable animator-active" style="transform-origin: 213.94px 221.58px;"><path d="M286.76,357.35H152a12.73,12.73,0,0,1-12.55-12L128.26,102a11.39,11.39,0,0,1,11.45-12H274.49A12.73,12.73,0,0,1,287,102l11.17,243.33A11.39,11.39,0,0,1,286.76,357.35Z" style="fill: rgb(38, 50, 56); transform-origin: 213.216px 223.675px;" id="elnc64i9vhzc" class="animable"></path><rect x="174.17" y="85.81" width="20.33" height="1" style="fill: rgb(225, 92, 92); transform-origin: 184.335px 86.31px;" id="elqashfcsnce" class="animable"></rect><rect x="162.03" y="85.81" width="5.47" height="1" style="fill: rgb(225, 92, 92); transform-origin: 164.765px 86.31px;" id="el3epyznzmgwt" class="animable"></rect><path d="M288.17,356.65H153.4a12.73,12.73,0,0,1-12.55-12L129.68,101.31a11.39,11.39,0,0,1,11.45-12H275.9a12.73,12.73,0,0,1,12.55,12l11.17,243.34A11.39,11.39,0,0,1,288.17,356.65Z" style="fill: rgb(225, 92, 92); transform-origin: 214.65px 222.98px;" id="elre0vdjh8azg" class="animable"></path><path d="M153.17,351.65a7.4,7.4,0,0,1-7.32-7L134.68,101.31a6.62,6.62,0,0,1,6.67-7H276.13a7.4,7.4,0,0,1,7.32,7l11.17,243.34a6.63,6.63,0,0,1-6.67,7Z" style="fill: rgb(255, 255, 255); transform-origin: 214.65px 222.98px;" id="eljlduy0tiz8s" class="animable"></path><path d="M210.79,157.29a24.22,24.22,0,0,1-23.93-22.88,21.71,21.71,0,0,1,21.86-22.91,24.23,24.23,0,0,1,23.93,22.88,21.69,21.69,0,0,1-21.86,22.91Zm-2.07-45.07a21,21,0,0,0-21.14,22.16,23.49,23.49,0,0,0,23.21,22.19,21,21,0,0,0,21.14-22.16A23.49,23.49,0,0,0,208.72,112.22Z" style="fill: rgb(224, 224, 224); transform-origin: 209.756px 134.395px;" id="el93vxw0o6sj6" class="animable"></path><path d="M193.61,150.12h2.31a3.33,3.33,0,0,0-.86,2.4,3.71,3.71,0,0,0,3.67,3.51,3.32,3.32,0,0,0,3.35-3.51,3.71,3.71,0,0,0-1.08-2.4H220a3.33,3.33,0,0,0-.85,2.4,3.71,3.71,0,0,0,3.67,3.51,3.32,3.32,0,0,0,3.34-3.51,3.65,3.65,0,0,0-1.07-2.4h2.3l-.1-2.21H193.51Z" style="fill: rgb(225, 92, 92); transform-origin: 210.45px 151.97px;" id="elnqtizqcb2k" class="animable"></path><polygon points="235.93 119.23 231.44 119.23 228.44 119.23 186.68 119.23 194.54 144.45 225.9 144.45 230.95 121.44 236.03 121.44 235.93 119.23" style="fill: rgb(225, 92, 92); transform-origin: 211.355px 131.84px;" id="elb6ag645plyv" class="animable"></polygon><path d="M212.93,294.71H159.21a.34.34,0,0,1-.34-.33l-2.47-53.72a.38.38,0,0,1,.09-.25.35.35,0,0,1,.25-.1h53.72a.34.34,0,0,1,.34.32l2.47,53.72a.33.33,0,0,1-.1.25A.32.32,0,0,1,212.93,294.71Zm-53.4-.68h53l-2.43-53h-53Z" style="fill: rgb(224, 224, 224); transform-origin: 184.835px 267.51px;" id="elvnsmoce0ix" class="animable"></path><path d="M195.51,248.26H172.39a.54.54,0,0,0-.55.57l.07,1.52.52,11.34,1.11,24.08a1,1,0,0,0,1,1h7.79a.93.93,0,0,0,.94-.92l.51-24.15h1.51l2.73,24.15a1,1,0,0,0,1,.92h7.8a.94.94,0,0,0,.94-1l-1.11-24.08-.52-11.34-.07-1.52A.6.6,0,0,0,195.51,248.26Z" style="fill: rgb(224, 224, 224); transform-origin: 184.801px 267.515px;" id="elf58hvzaypg" class="animable"></path><path d="M276.65,294.71H222.93a.34.34,0,0,1-.34-.33l-2.47-53.72a.38.38,0,0,1,.09-.25.35.35,0,0,1,.25-.1h53.72a.34.34,0,0,1,.34.32L277,294.35a.33.33,0,0,1-.1.25A.32.32,0,0,1,276.65,294.71Zm-53.4-.68h53l-2.43-53h-53Z" style="fill: rgb(224, 224, 224); transform-origin: 248.56px 267.51px;" id="el94vtij6h9pk" class="animable"></path><polygon points="261.42 287.44 237.52 287.44 235.79 249.67 259.68 249.67 261.42 287.44" style="fill: rgb(224, 224, 224); transform-origin: 248.605px 268.555px;" id="el5362jz2ye7h" class="animable"></polygon><polygon points="231.71 267.84 226.39 257.32 235.79 249.67 241 257.79 231.71 267.84" style="fill: rgb(224, 224, 224); transform-origin: 233.695px 258.755px;" id="elkx2tl0dxqtf" class="animable"></polygon><polygon points="265.43 267.84 269.79 257.32 259.68 249.67 255.22 257.79 265.43 267.84" style="fill: rgb(224, 224, 224); transform-origin: 262.505px 258.755px;" id="el0jqes9guhwgu" class="animable"></polygon><path d="M241.84,249.67a6.24,6.24,0,0,0,6.17,5.9,5.58,5.58,0,0,0,5.63-5.9Z" style="fill: rgb(235, 235, 235); transform-origin: 247.745px 252.62px;" id="elz9tem2qwru" class="animable"></path><path d="M273.72,231.15H220a.5.5,0,0,1-.5-.48L217,177a.5.5,0,0,1,.13-.37.52.52,0,0,1,.37-.16h53.72a.5.5,0,0,1,.5.48l2.46,53.72a.5.5,0,0,1-.13.37A.52.52,0,0,1,273.72,231.15Zm-53.24-1H273.2l-2.42-52.73H218.06Z" style="fill: rgb(225, 92, 92); transform-origin: 245.59px 203.81px;" id="elgjlsbme1hnf" class="animable"></path><path d="M262.82,197.9l-5.83-.43.13-.44a2.54,2.54,0,0,0-2.44-3.22h-6.06a2.32,2.32,0,0,0-2.1,3.32l.75,1.7-.5.13-1.39.37-2.32.6-1.39.36-2.31.6-1.39.36-5.74,1.5h0c-2.38.68-4.38,2.11-4.26,4.62a5,5,0,0,0,4.9,4.7v0H261a3.75,3.75,0,0,0,3.79-4l-.39-8.54A1.76,1.76,0,0,0,262.82,197.9Z" style="fill: rgb(225, 92, 92); transform-origin: 246.382px 202.94px;" id="elx8hw147rc79" class="animable"></path><g id="elatw6321o4bg"><polygon points="250.37 200.7 249 201.07 245.38 199.33 246.78 198.96 250.37 200.7" style="fill: rgb(255, 255, 255); opacity: 0.3; transform-origin: 247.875px 200.015px;" class="animable"></polygon></g><g id="elivxxbksypvs"><polygon points="246.71 201.69 245.34 202.06 241.67 200.29 243.06 199.93 246.71 201.69" style="fill: rgb(255, 255, 255); opacity: 0.3; transform-origin: 244.19px 200.995px;" class="animable"></polygon></g><g id="el74daxrja73c"><polygon points="243.05 202.68 241.68 203.05 237.97 201.25 239.36 200.89 243.05 202.68" style="fill: rgb(255, 255, 255); opacity: 0.3; transform-origin: 240.51px 201.97px;" class="animable"></polygon></g><g id="elu0tv5ll16fc"><path d="M264.73,205.75l.1,2.35a3.75,3.75,0,0,1-3.79,4h-4.66a7.37,7.37,0,0,1,7.38-6.39A7.77,7.77,0,0,1,264.73,205.75Z" style="fill: rgb(255, 255, 255); opacity: 0.3; transform-origin: 260.609px 208.904px;" class="animable"></path></g><path d="M210,231H156.28a.35.35,0,0,1-.34-.33l-2.47-53.72a.35.35,0,0,1,.1-.25.32.32,0,0,1,.24-.11h53.73a.35.35,0,0,1,.34.33l2.46,53.72a.34.34,0,0,1-.09.25A.36.36,0,0,1,210,231Zm-53.39-.68h53l-2.44-53.05h-53Z" style="fill: rgb(224, 224, 224); transform-origin: 181.905px 203.795px;" id="elbqukfj5htkb" class="animable"></path><path d="M201,194.88l.21,4.46a3.09,3.09,0,0,1-3.48,3.27,9.18,9.18,0,0,0-1.17-.07,8.28,8.28,0,0,0-3.61.81,8.12,8.12,0,0,0-4.52,7.71v.21a4.46,4.46,0,0,1-.55,2.38,4.35,4.35,0,0,1-3.82,2.21h-3.14a4.81,4.81,0,0,1-4-2.21,4.74,4.74,0,0,1-.78-2.38v-.21a8.79,8.79,0,0,0-1.7-4.79,9.22,9.22,0,0,0-3.54-2.92,8.72,8.72,0,0,0-3.67-.81,9,9,0,0,0-1.17.07,3.43,3.43,0,0,1-3.78-3.27l-.2-4.46a1.35,1.35,0,0,1,1.37-1.44h36.06A1.52,1.52,0,0,1,201,194.88Z" style="fill: rgb(224, 224, 224); transform-origin: 181.647px 204.65px;" id="elnaaksa2zm4p" class="animable"></path><path d="M187.85,213.65a4.35,4.35,0,0,1-3.82,2.21h-3.14a4.81,4.81,0,0,1-4-2.21,5.58,5.58,0,0,1,5.31-3.7A6.27,6.27,0,0,1,187.85,213.65Z" style="fill: rgb(235, 235, 235); transform-origin: 182.37px 212.905px;" id="elpky98fhdcke" class="animable"></path><path d="M240.6,338.87H199.34a9.22,9.22,0,0,1-9.1-8.7l-.54-11.6a8.27,8.27,0,0,1,8.31-8.71h41.26a9.23,9.23,0,0,1,9.1,8.71l.54,11.6A8.26,8.26,0,0,1,240.6,338.87Z" style="fill: rgb(225, 92, 92); transform-origin: 219.305px 324.365px;" id="elce2jovb452w" class="animable"></path><path d="M199.54,318.18h7a4,4,0,0,1,2.74.87,3,3,0,0,1,1.05,2.16,2.64,2.64,0,0,1-.59,1.85,2.89,2.89,0,0,1-1.28.81,3.58,3.58,0,0,1,2,1.09,3,3,0,0,1,.71,1.93,3.2,3.2,0,0,1-.36,1.7,3.08,3.08,0,0,1-1.15,1.2,3.88,3.88,0,0,1-1.41.39,14.13,14.13,0,0,1-1.68.17H200.1Zm4,4.77h1.64a1.82,1.82,0,0,0,1.21-.3,1.06,1.06,0,0,0,.3-.88,1.07,1.07,0,0,0-.38-.83,1.9,1.9,0,0,0-1.21-.3h-1.66Zm.22,4.78h1.92a2.06,2.06,0,0,0,1.36-.34,1.12,1.12,0,0,0,.35-.93,1.1,1.1,0,0,0-.43-.86,2.28,2.28,0,0,0-1.4-.33h-1.91Z" style="fill: rgb(255, 255, 255); transform-origin: 205.359px 324.261px;" id="elh2ks273hjrn" class="animable"></path><path d="M220.24,318.18H224l.34,7.25a6,6,0,0,1-.25,2,4.13,4.13,0,0,1-1,1.67,4,4,0,0,1-1.46,1,7.47,7.47,0,0,1-2.62.41,15.27,15.27,0,0,1-1.94-.13,5.07,5.07,0,0,1-1.78-.49,4.85,4.85,0,0,1-1.34-1.05,4.16,4.16,0,0,1-.87-1.4,7.88,7.88,0,0,1-.44-2.06l-.33-7.25h3.75l.34,7.42a2.21,2.21,0,0,0,.63,1.56,2.13,2.13,0,0,0,1.55.56,2,2,0,0,0,1.5-.55,2.05,2.05,0,0,0,.48-1.57Z" style="fill: rgb(255, 255, 255); transform-origin: 218.328px 324.321px;" id="el2qymhtms6ip" class="animable"></path><path d="M225.26,318.18h4.17l2.64,4.1,2.27-4.1h4.16l-4.41,7.07.24,5.1h-3.77l-.24-5.1Z" style="fill: rgb(255, 255, 255); transform-origin: 231.88px 324.265px;" id="el3dqn1gl99af" class="animable"></path></g><g id="freepik--Character--inject-13" class="animable" style="transform-origin: 315.659px 281.103px;"><path d="M342.41,191.28c1,1.21,1.75,2.28,2.55,3.44s1.53,2.31,2.26,3.48a82.84,82.84,0,0,1,4,7.3c.61,1.24,1.17,2.51,1.72,3.79s1,2.58,1.48,3.91a63.39,63.39,0,0,1,2.25,8.1l0,.19a2.6,2.6,0,0,1,.06.78,61.34,61.34,0,0,1-.76,6.27c-.35,2.06-.81,4.09-1.35,6.09s-1.17,4-1.86,5.89a58.85,58.85,0,0,1-2.43,5.73,2.1,2.1,0,0,1-3.94-1.38l0-.09c.4-1.83.81-3.77,1.12-5.67s.64-3.82.86-5.73.42-3.8.55-5.69.15-3.77.16-5.63l.1,1a66.59,66.59,0,0,0-2.37-7c-.94-2.3-2-4.57-3.12-6.79s-2.4-4.41-3.73-6.54c-.67-1.06-1.34-2.12-2.05-3.15s-1.45-2.09-2.1-3l-.09-.11a4.22,4.22,0,0,1,6.67-5.18Z" style="fill: rgb(255, 139, 123); transform-origin: 345.786px 218.552px;" id="ellbmtle8bych" class="animable"></path><path d="M347.49,242.92l-5.06,6.63,8.39-.4s2.33-4.77.32-7.56Z" style="fill: rgb(255, 139, 123); transform-origin: 347.194px 245.57px;" id="el5pruprm9hca" class="animable"></path><polygon points="342.51 256.5 349.52 255.78 350.82 249.15 342.43 249.55 342.51 256.5" style="fill: rgb(255, 139, 123); transform-origin: 346.625px 252.825px;" id="elp94mpit0h99" class="animable"></polygon><path d="M328.51,171.55c-.8,4.94-1.45,13.95,2.09,17.1A24.92,24.92,0,0,1,319.13,199c-6.7-3.88-3.76-9.86-3.76-9.86,5.42-1.49,5.14-5.54,4.06-9.32Z" style="fill: rgb(255, 139, 123); transform-origin: 322.664px 185.275px;" id="eleak253qojn" class="animable"></path><path d="M310.79,161.93c-.09.66-.52,1.14-1,1.08s-.7-.64-.61-1.3.52-1.15.95-1.09S310.89,161.27,310.79,161.93Z" style="fill: rgb(38, 50, 56); transform-origin: 309.984px 161.815px;" id="ela2efn8n9f3" class="animable"></path><path d="M310.37,160.69l-1.52-.69S309.48,161.36,310.37,160.69Z" style="fill: rgb(38, 50, 56); transform-origin: 309.61px 160.438px;" id="elz8oxuq6zpmd" class="animable"></path><path d="M310.42,163.42a17.59,17.59,0,0,1-2.95,3.87,2.87,2.87,0,0,0,2.29.78Z" style="fill: rgb(255, 86, 82); transform-origin: 308.945px 165.753px;" id="el4bi2tvibive" class="animable"></path><path d="M313.13,158.65a.42.42,0,0,0,.29,0,.39.39,0,0,0,.14-.54,3.9,3.9,0,0,0-3-2,.4.4,0,0,0-.41.37.41.41,0,0,0,.37.42,3.1,3.1,0,0,1,2.34,1.59A.38.38,0,0,0,313.13,158.65Z" style="fill: rgb(38, 50, 56); transform-origin: 311.883px 157.393px;" id="elbued7tio6jm" class="animable"></path><path d="M333.37,162.38c-1.65,8-2.18,11.48-6.86,15.05-7.05,5.39-16.56,1.6-17.34-6.76-.71-7.53,2.11-19.41,10.5-21.51A11.19,11.19,0,0,1,333.37,162.38Z" style="fill: rgb(255, 139, 123); transform-origin: 321.345px 164.374px;" id="elo7dcvys3wpk" class="animable"></path><path d="M311.9,240.26s-2,62.24-1.51,87.44c.56,26.21.81,87.43.81,87.43h4.58s12.59-50.88,9.47-87.43c4.72-28.07,7.92-87.44,7.92-87.44Z" style="fill: rgb(255, 139, 123); transform-origin: 321.741px 327.695px;" id="elr2b07ps3hlj" class="animable"></path><path d="M313.27,240.26S329.72,302.5,336,327.7c6.52,26.21,20.68,87.43,20.68,87.43h4.58s1-50.88-10.39-87.43c-1.65-28.07-11.94-87.44-11.94-87.44Z" style="fill: rgb(255, 139, 123); transform-origin: 337.276px 327.695px;" id="el35na0kkqabx" class="animable"></path><path d="M302.09,195.91a6.59,6.59,0,0,1,5.48-6.36c2.67-.45,6.18-1,9.46-1.28a104.69,104.69,0,0,1,15.24,0c2,.12,3.85.26,5.57.46a7.34,7.34,0,0,1,6.35,8.82c-4.72,22.18-4.12,30.36-3.61,42.71,13.82,20.22,10.3,48.91,12,73.41l-44.26,15.5c-2.32-40.39-1.31-82.73.12-88.91C304.23,214.37,302,201.91,302.09,195.91Z" style="fill: rgb(225, 92, 92); transform-origin: 327.334px 258.581px;" id="elfmd4khcvtv8" class="animable"></path><g id="elf1mvqmbw4op"><polygon points="328.89 297.3 330.89 269.3 339.12 264.02 328.89 297.3" style="fill: rgb(38, 50, 56); opacity: 0.2; transform-origin: 334.005px 280.66px;" class="animable"></polygon></g><path d="M340.89,240.88l-32.78,2.44a.75.75,0,0,1-.85-.72l-.12-2.73a1.14,1.14,0,0,1,1-1.12L341,236.31a.75.75,0,0,1,.84.72l.13,2.73A1.15,1.15,0,0,1,340.89,240.88Z" style="fill: rgb(38, 50, 56); transform-origin: 324.555px 239.816px;" id="eld2pkpxml9x" class="animable"></path><polygon points="319.89 187.72 327.67 189.58 329.28 187.86 326.72 187.25 319.89 187.72" style="fill: rgb(255, 139, 123); transform-origin: 324.585px 188.415px;" id="elmuwsl6i0l4o" class="animable"></polygon><path d="M310.06,195.27c0,1.45,0,2.65,0,3.95s-.15,2.54-.26,3.8c-.23,2.53-.65,5-1.13,7.52a64,64,0,0,1-4.72,14.58l-.89,1.79c-.17.32-.26.55-.49.93a12.08,12.08,0,0,1-.75,1.12,8.95,8.95,0,0,1-10.35,3.28,16.12,16.12,0,0,1-4-2.07,32.66,32.66,0,0,1-5.8-5.39c-.85-1-1.61-2-2.35-3s-1.44-2-2.12-3.15a2.1,2.1,0,0,1,3.31-2.55l.05.05c1.56,1.63,3.29,3.27,5,4.74a28.82,28.82,0,0,0,5.32,3.74,9,9,0,0,0,2.49,1,2.21,2.21,0,0,0,1.47-.08,2.83,2.83,0,0,0,.88-.95l.22-.4c.07-.14.2-.47.29-.69l.63-1.49a68.09,68.09,0,0,0,3.61-13c.39-2.24.65-4.51.88-6.77.11-1.13.19-2.27.24-3.39s.09-2.31.09-3.27v-.16a4.23,4.23,0,0,1,8.45-.13Z" style="fill: rgb(255, 139, 123); transform-origin: 293.507px 212.038px;" id="elfjk116b6fri" class="animable"></path><path d="M281.32,217.14l-5.16-6.56-1.7,8.23s4,3.45,7.23,2.2Z" style="fill: rgb(255, 139, 123); transform-origin: 278.075px 215.931px;" id="elxi3s83cx2ws" class="animable"></path><polygon points="269.42 208.92 268.36 215.89 274.45 218.81 276.17 210.58 269.42 208.92" style="fill: rgb(255, 139, 123); transform-origin: 272.265px 213.865px;" id="elwf4wbd77qwk" class="animable"></polygon><path d="M315.54,165.21c2.41,3-8,5.48-4.24,13.95s-6,5-.52,16.58c5.4,11.41,24.82,17.39,36,12.7-4.33-.79-7.8-6.14-4.15-8.77,5.23-3.79,6.53-9.23,3.71-14.22s-9.74-12.84-6.56-18.95c3.89-7.47,4-12.73-4-18.58-8.18-6-26.55-11-26,.13S315.54,165.21,315.54,165.21Z" style="fill: rgb(38, 50, 56); transform-origin: 328.431px 175.742px;" id="el6unis84bgil" class="animable"></path><path d="M336.23,173.39l-9.56-.93a3.24,3.24,0,0,1-2.87-4.15h0a4.64,4.64,0,0,1,4.78-3.4l9.55.94A3.24,3.24,0,0,1,341,170h0A4.65,4.65,0,0,1,336.23,173.39Z" style="fill: rgb(225, 92, 92); transform-origin: 332.4px 169.15px;" id="elfz0kujf2vap" class="animable"></path><path d="M318,164.45a6,6,0,0,1-3.09,3.38c-1.91.87-3.2-.76-2.94-2.73.23-1.78,1.51-4.38,3.56-4.42A2.69,2.69,0,0,1,318,164.45Z" style="fill: rgb(255, 139, 123); transform-origin: 315.082px 164.375px;" id="elo6cy7nytcsf" class="animable"></path><path d="M310.89,413.71h5.43a.63.63,0,0,1,.62.5l1.05,5.24a1.07,1.07,0,0,1-1.06,1.31c-2.89-.05-3.77-.22-7.4-.22-3.12,0-3.81.23-8.8.23-3,0-2.26-2.44-1-2.63,4.5-.66,6.39-1,9.69-3.4C310,414.36,310.25,413.71,310.89,413.71Z" style="fill: rgb(38, 50, 56); transform-origin: 308.324px 417.24px;" id="elya8cy0j5dr" class="animable"></path><path d="M355.87,413.71h5.43a.65.65,0,0,1,.63.5l1,5.24a1.07,1.07,0,0,1-1.05,1.31c-2.9-.05-2,0-5.6,0h-5.19c-3,0-2.25-2.35-1-2.63,2.49-.56,3.12-1.45,4.29-3.4A1.78,1.78,0,0,1,355.87,413.71Z" style="fill: rgb(38, 50, 56); transform-origin: 355.976px 417.235px;" id="ellsk8d9ym89" class="animable"></path></g><defs>     <filter id="active" height="200%">         <feMorphology in="SourceAlpha" result="DILATED" operator="dilate" radius="2"></feMorphology>                <feFlood flood-color="#32DFEC" flood-opacity="1" result="PINK"></feFlood>        <feComposite in="PINK" in2="DILATED" operator="in" result="OUTLINE"></feComposite>        <feMerge>            <feMergeNode in="OUTLINE"></feMergeNode>            <feMergeNode in="SourceGraphic"></feMergeNode>        </feMerge>    </filter>    <filter id="hover" height="200%">        <feMorphology in="SourceAlpha" result="DILATED" operator="dilate" radius="2"></feMorphology>                <feFlood flood-color="#ff0000" flood-opacity="0.5" result="PINK"></feFlood>        <feComposite in="PINK" in2="DILATED" operator="in" result="OUTLINE"></feComposite>        <feMerge>            <feMergeNode in="OUTLINE"></feMergeNode>            <feMergeNode in="SourceGraphic"></feMergeNode>        </feMerge>            <feColorMatrix type="matrix" values="0   0   0   0   0                0   1   0   0   0                0   0   0   0   0                0   0   0   1   0 "></feColorMatrix>    </filter></defs></svg>
						</div>
					</div>
				</div>
			</div>
		</div>
</div>
</template>

  <script>
    import axios from 'axios'

    export default {
      data() {
        return {
		  logo: '',
		  rootUrl: process.env.MIX_APP_URL,
          first_name: '',
          middle_name: '',
          last_name: '',
          email: '',
          phone: '',
          mobile: '',
          address: '',
          password: '',
          password_confirmation: '',
          errors: '',
		  showPassword: false,
		  showConfirmPassword: false,
          iAgree: false
        }
      },    
      methods: {
        register() {
          var self = this;
          self.errors = '';
          axios.post(process.env.MIX_APP_URL+ '/api/register', {
            first_name: self.first_name,
            middle_name: self.middle_name,
            last_name: self.last_name,
            email: self.email,
            phone: self.phone,
            mobile: self.mobile,
            address: self.address,
            password: self.password,
            password_confirmation: self.password_confirmation
          }).then(function (response) {
            if(response.data.message)
            {
              self.first_name = '',
			  self.middle_name = '',
			  self.last_name = '',
              self.email = '';
              self.phone = '';
              self.mobile = '';
              self.address = '';
              self.password = '';
              self.password_confirmation = '';
            }
            else
            {
              // need to implement flash message
              self.$router.push({ path: '/login' });
            }
          })
          .catch(function (error) {
            self.errors = error.response.data.errors;
          });  
        },

		showHidePassword() {
			var x = document.getElementById("password");
			if (x.type === "password") {
				x.type = "text";
				this.showPassword = true;

			} else {
				x.type = "password";
				this.showPassword = false;
			}
		},

		showHideConfirmPassword() {
			var x = document.getElementById("password-confirm");
			if (x.type === "password") {
				x.type = "text";
				this.showConfirmPassword = true;

			} else {
				x.type = "password";
				this.showConfirmPassword = false;
			}
		}
      },

	  mounted() {
			this.logo = this.rootUrl+'/storage/'+window.Laravel.website_logo;
		}
    }
  
  </script>

  <<style scoped>
  .invalid-feedback { display: block; }

  svg#freepik_stories-online-shopping:not(.animated) .animable {opacity: 0;}svg#freepik_stories-online-shopping.animated #freepik--background-complete--inject-13 {animation: 0.5s 1 forwards cubic-bezier(.36,-0.01,.5,1.38) slideDown;animation-delay: 0s;}svg#freepik_stories-online-shopping.animated #elnc64i9vhzc {animation: 1s 1 forwards linear slideLeft;animation-delay: 0s;}svg#freepik_stories-online-shopping.animated #elqashfcsnce {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.03571428571428571s;opacity: 0}svg#freepik_stories-online-shopping.animated #el3epyznzmgwt {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.07142857142857142s;opacity: 0}svg#freepik_stories-online-shopping.animated #elre0vdjh8azg {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.10714285714285714s;opacity: 0}svg#freepik_stories-online-shopping.animated #eljlduy0tiz8s {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.14285714285714285s;opacity: 0}svg#freepik_stories-online-shopping.animated #el93vxw0o6sj6 {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.17857142857142855s;opacity: 0}svg#freepik_stories-online-shopping.animated #elnqtizqcb2k {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.21428571428571427s;opacity: 0}svg#freepik_stories-online-shopping.animated #elb6ag645plyv {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.25s;opacity: 0}svg#freepik_stories-online-shopping.animated #elvnsmoce0ix {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.2857142857142857s;opacity: 0}svg#freepik_stories-online-shopping.animated #elf58hvzaypg {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.3214285714285714s;opacity: 0}svg#freepik_stories-online-shopping.animated #el94vtij6h9pk {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.3571428571428571s;opacity: 0}svg#freepik_stories-online-shopping.animated #el5362jz2ye7h {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.39285714285714285s;opacity: 0}svg#freepik_stories-online-shopping.animated #elkx2tl0dxqtf {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.42857142857142855s;opacity: 0}svg#freepik_stories-online-shopping.animated #el0jqes9guhwgu {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.46428571428571425s;opacity: 0}svg#freepik_stories-online-shopping.animated #elz9tem2qwru {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.5s;opacity: 0}svg#freepik_stories-online-shopping.animated #elgjlsbme1hnf {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.5357142857142857s;opacity: 0}svg#freepik_stories-online-shopping.animated #elx8hw147rc79 {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.5714285714285714s;opacity: 0}svg#freepik_stories-online-shopping.animated #elatw6321o4bg {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.6071428571428571s;opacity: 0}svg#freepik_stories-online-shopping.animated #elivxxbksypvs {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.6428571428571428s;opacity: 0}svg#freepik_stories-online-shopping.animated #el74daxrja73c {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.6785714285714285s;opacity: 0}svg#freepik_stories-online-shopping.animated #elu0tv5ll16fc {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.7142857142857142s;opacity: 0}svg#freepik_stories-online-shopping.animated #elbqukfj5htkb {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.75s;opacity: 0}svg#freepik_stories-online-shopping.animated #elnaaksa2zm4p {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.7857142857142857s;opacity: 0}svg#freepik_stories-online-shopping.animated #elpky98fhdcke {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.8214285714285714s;opacity: 0}svg#freepik_stories-online-shopping.animated #elce2jovb452w {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.8571428571428571s;opacity: 0}svg#freepik_stories-online-shopping.animated #elh2ks273hjrn {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.8928571428571428s;opacity: 0}svg#freepik_stories-online-shopping.animated #el2qymhtms6ip {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.9285714285714285s;opacity: 0}svg#freepik_stories-online-shopping.animated #el3dqn1gl99af {animation: 1s 1 forwards linear slideLeft;animation-delay: 0.9642857142857142s;opacity: 0}svg#freepik_stories-online-shopping.animated #freepik--Device--inject-13 {animation: 1s 1 forwards linear slideLeft,1.5s Infinite  linear floating;animation-delay: 0s,1s;}svg#freepik_stories-online-shopping.animated #freepik--Character--inject-13 {animation: 1s 1 forwards cubic-bezier(.36,-0.01,.5,1.38) slideLeft;animation-delay: 0s;}            @keyframes slideDown {                0% {                    opacity: 0;                    transform: translateY(-30px);                }                100% {                    opacity: 1;                    transform: translateY(0);                }            }                    @keyframes slideLeft {                0% {                    opacity: 0;                    transform: translateX(-30px);                }                100% {                    opacity: 1;                    transform: translateX(0);                }            }                    @keyframes floating {                0% {                    opacity: 1;                    transform: translateY(0px);                }                50% {                    transform: translateY(-10px);                }                100% {                    opacity: 1;                    transform: translateY(0px);                }            }        

  </style>
