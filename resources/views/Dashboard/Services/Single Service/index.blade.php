@extends('Dashboard.layouts.master')
@section('title')
{{trans('Dashboard\Services_trans.Single_Service')}}
@endsection
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('Dashboard/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('Dashboard/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('Dashboard/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('Dashboard/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('Dashboard/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('Dashboard/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<!--Internal   Notify -->
<link href="{{ URL::asset('Dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">{{trans('Dashboard\Services_trans.Services')}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{trans('Dashboard\Services_trans.Single_Service')}}</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')

<!-- Messages Page -->
@include('Dashboard.Messages_Hospital')

<!-- Messages Page --> 

				<!-- row -->
				<div class="row row-sm">
				<div class="col-xl-12">
						<div class="card">
						<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
								<a class="btn ripple btn-primary"   data-target="#AddServicemodal" data-toggle="modal" href="">{{trans('Dashboard\Services_trans.Add_Service')}}</a>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table text-md-nowrap" id="example1">
										<thead>
											<tr>
												<th class="wd-15p border-bottom-0">#</th>
												<th class="wd-15p border-bottom-0">{{trans('Dashboard\Services_trans.Service_Name')}}</th>
												<th class="wd-15p border-bottom-0">{{trans('Dashboard\Services_trans.Service_Price')}}</th>
												<th class="wd-20p border-bottom-0">{{trans('Dashboard\Services_trans.Status')}}</th>
												<th class="wd-15p border-bottom-0">{{trans('Dashboard\Services_trans.Notes')}}</th>
												<th class="wd-15p border-bottom-0">{{trans('Dashboard\Services_trans.Created_Date')}}</th>
												<th class="wd-15p border-bottom-0">{{trans('Dashboard\Services_trans.Process')}}</th>
											</tr>
										</thead>
										<tbody>
											@foreach($services as $service)
											<tr>
												<td>{{$loop->iteration}}</td>
												<td>{{$service->name}}</td>
                                                <td>{{$service->price}}</td>												
												<td>
												  <div
													class="dot-label bg-{{$service->status == 1 ? 'success':'danger'}} ml-1">
												   </div>
													{{$service->status == 1 ? trans('Dashboard\Services_trans.Active'):trans('Dashboard\Services_trans.Not_Active')}}
												 </td>
												 <td> {{ Str::limit($service->description, 50) }}</td>
										
												 <td>{{ $service->created_at->diffForHumans() }}</td>
                                                 <td>
												 <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                     data-toggle="modal" href="#edit{{$service->id}}"><i
                                                     class="las la-pen"></i></a>
                                                  <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                     data-toggle="modal" href="#delete{{$service->id}}"><i
                                                     class="las la-trash"></i></a>
												</td>
											</tr>
											@include('Dashboard.Services.Single Service.Edit')
											@include('Dashboard.Services.Single Service.Delete')

										   @endforeach
										   @include('Dashboard.Services.Single Service.add')
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<!--/div-->

				</div>

				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('Dashboard/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('Dashboard/js/table-data.js')}}"></script>
<!--Internal  Notify js -->
<script src="{{ URL::asset('Dashboard/plugins/notify/js/notifIt.js') }}"></script>
 <script src="{{ URL::asset('Dashboard/plugins/notify/js/notifit-custom.js') }}"></script>
@endsection