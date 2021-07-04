@extends('Dashboard.layouts.master2')
@section('title')
@if(App::getlocale()=='ar')
برنامج إدارة المستشفيات
@else
Hospitals Software
@endif
@endsection
@section('css')
<!-- عشان اخفي الفورم لوجين  -->
    <style>
        .panel {display: none;}
    </style>
<!-- Sidemenu-respoansive-tabs css -->
<link href="{{URL::asset('Dashboard/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css')}}" rel="stylesheet">
@endsection
@section('content')
		<div class="container-fluid">
			<div class="row no-gutter">
				<!-- The image half -->
				<div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
					<div class="row wd-100p mx-auto text-center">
						<div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
							<img src="{{URL::asset('Dashboard/img/media/login.png')}}" class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
						</div>
					</div>
				</div>
				<!-- The content half -->
				<div class="col-md-6 col-lg-6 col-xl-5 bg-white">
					<div class="login d-flex align-items-center py-2">
						<!-- Demo content-->
						<div class="container p-0">
							<div class="row">
								<div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
									<div class="card-sigin">
										<div class="mb-5 d-flex"> <a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('Dashboard/img/brand/favicon.png')}}" class="sign-favicon ht-40" alt="logo"></a><h1 class="main-logo1 ml-1 mr-0 my-auto tx-28">Va<span>le</span>x</h1></div>
										<div class="card-sigin">
											<div class="main-signup-header">
												<h2>{{trans('Dashboard/login_trans.Welcome back!')}}</h2>
												<!-- //لاظهار الأخطاء -->
												@if ($errors->any())
												<div class="alert alert-danger">
													<ul>
														@foreach ($errors->all() as $error)
															<li>{{ $error }}</li>
														@endforeach
													</ul>
												</div>
											@endif
											<!--اختيار الدخول كــ-->
												<div class="form-group">
                                                    <label for="exampleFormControlSelect1">{{trans('Dashboard/login_trans.Select The entry Method')}}</label>
                                                    <select class="form-control" id="sectionChooser">
                                                        <option value="" selected disabled>{{trans('Dashboard/login_trans.Choose From The List')}}</option>
                                                        <option value="user">{{trans('Dashboard/login_trans.Login As Patient')}}</option>
                                                        <option value="admin">{{trans('Dashboard/login_trans.Login as Admin')}}</option>
                                                    </select>
                                                </div>
											<!--اختيار الدخول كــ-->
											{{--form user--}}
                                                <div class="panel" id="user">
													<!-- <h5 class="font-weight-semibold mb-4">{{trans('Dashboard/login_trans.Login As Patient')}}</h5> -->
													<form method="POST" action="{{ route('login.user') }}">			
													@csrf
													<div class="form-group">
															<label>{{trans('Dashboard/login_trans.Email')}}</label> 
															<input class="form-control" id="email" placeholder="{{trans('Dashboard/login_trans.Enter your email')}}" type="email" name="email" :value="old('email')" required autofocus />
														</div>
														<div class="form-group">
															<label>{{trans('Dashboard/login_trans.Password')}}</label> 
														<input class="form-control" placeholder="{{trans('Dashboard/login_trans.Enter your password')}}"  type="password" name="password" required autocomplete="current-password" />
														</div><button type="submit" class="btn btn-main-primary btn-block">{{trans('Dashboard/login_trans.Sign In')}}</button>
													</form>
												</div>

										<!--ااختيار الدخول ك ادمن -->
										{{--form admin--}}
                                                <div class="panel" id="admin">
													<!-- <h5 class="font-weight-semibold mb-4">{{trans('Dashboard/login_trans.Login as Admin')}}</h5> -->
													<form method="POST" action="{{ route('login.admin') }}">			
													@csrf
													<div class="form-group">
															<label>{{trans('Dashboard/login_trans.Email')}}</label> 
															<input class="form-control" id="email" placeholder="{{trans('Dashboard/login_trans.Enter your email')}}" type="email" name="email" :value="old('email')" required autofocus />
														</div>
														<div class="form-group">
															<label>{{trans('Dashboard/login_trans.Password')}}</label> 
														<input class="form-control" placeholder="{{trans('Dashboard/login_trans.Enter your password')}}"  type="password" name="password" required autocomplete="current-password" />
														</div><button type="submit" class="btn btn-main-primary btn-block">{{trans('Dashboard/login_trans.Sign In')}}</button>
													</form>
												</div>


											</div>
										</div>
									</div>
								</div>
							</div>
						</div><!-- End -->
					</div>
				</div><!-- End -->
			</div>
		</div>
@endsection
@section('js')
<script>
        $('#sectionChooser').change(function(){
            var myID = $(this).val();
            $('.panel').each(function(){
                myID === $(this).attr('id') ? $(this).show() : $(this).hide();
            });
        });
    </script>
@endsection