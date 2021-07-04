@extends('Dashboard.layouts.master')
@section('css')
    <link href="{{URL::asset('dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
@endsection
@section('title')
{{trans('Dashboard\Patient_trans.Patients')}}
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">{{trans('Dashboard\Patient_trans.Patients_List')}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{trans('Dashboard\Patient_trans.Patients')}}</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
<!-- Messages Page -->
@include('Dashboard.Messages_Hospital')

<!-- Messages Page --> 	
			<!-- row opened -->
				<div class="row row-sm">
					<!--div-->
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
                                    <a href="{{route('Patients.create')}}" class="btn btn-primary">{{trans('Dashboard\Patient_trans.Add_Patient')}}</a>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table text-md-nowrap" id="example1">
										<thead>
											<tr>
												<th>#</th>
												<th>{{trans('Dashboard\Patient_trans.Patient_Name')}}</th>
												<th >{{trans('Dashboard\Patient_trans.Email')}}</th>
												<th>{{trans('Dashboard\Patient_trans.Birth_Date')}}</th>
												<th>{{trans('Dashboard\Patient_trans.Phone')}}</th>
												<th>{{trans('Dashboard\Patient_trans.Gender')}}</th>
                                                <th >{{trans('Dashboard\Patient_trans.Blood_Type')}}</th>
                                                <th >{{trans('Dashboard\Patient_trans.Address')}}</th>
                                                <th>{{trans('Dashboard\Patient_trans.Proccess')}}</th>
											</tr>
										</thead>
										<tbody>
                                        @foreach($patient as $Patient)
											<tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$Patient->name}}</td>
                                                <td>{{$Patient->email}}</td>
                                                <td>{{$Patient->Date_Birth}}</td>
                                                <td>{{$Patient->Phone}}</td>
                                                <td>{{$Patient->Gender == 1 ?trans('Dashboard\Patient_trans.Male'):trans('Dashboard\Patient_trans.Female')}}</td>
                                                <td>{{$Patient->Blood_Group}}</td>
                                                <td>{{$Patient->Address}}</td>
                                                <td>
                                                    <a href="{{route('Patients.edit',$Patient->id)}}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
													<button class="btn btn-sm btn-success" data-toggle="modal" data-target="#DeletedPatient{{$Patient->id}}"><i class="fas fa-trash"></i>
                                                    </button> 
											    </td>
											</tr>
											@include('Dashboard.Patients.Delete')
                                        @endforeach

										</tbody>
									</table>
								</div>
							</div><!-- bd -->
						</div><!-- bd -->
					</div>
					<!--/div-->
				</div>
				<!-- /row -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Notify js -->
    <script src="{{URL::asset('dashboard/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('/plugins/notify/js/notifit-custom.js')}}"></script>
@endsection