@extends('Dashboard.layouts.master')
@section('title')
{{trans('Dashboard\Sections_trans.Sections')}}
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
							<h4 class="content-title mb-0 my-auto">{{trans('Dashboard\Sections_trans.Sections')}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{trans('Dashboard\Sections_trans.Sections List')}}</span>
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
								<a class="btn ripple btn-primary" style="width:100%"  data-target="#Addmodal" data-toggle="modal" href="">{{trans('Dashboard\Sections_trans.Add_Section')}}</a>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table text-md-nowrap" id="example1">
										<thead>
											<tr>
												<th class="wd-15p border-bottom-0">#</th>
												<th class="wd-15p border-bottom-0">{{trans('Dashboard\Sections_trans.Section_Name')}}</th>
												<th class="wd-15p border-bottom-0">{{trans('Dashboard\Sections_trans.Description')}}</th>
												<th class="wd-20p border-bottom-0">{{trans('Dashboard\Sections_trans.Created_Date')}}</th>
												<th class="wd-15p border-bottom-0">{{trans('Dashboard\Sections_trans.Process')}}</th>
											</tr>
										</thead>
										<tbody>
											@foreach($sections as $sections)
											<tr>
												<td>{{$loop->iteration}}</td>
												<td><a href="{{route('Sections.show',$sections->id)}}">{{ $sections->name}}</a></td>
												<td>{{ \Str::Limit($sections->description,50) }}</td>
												<td>{{ $sections->created_at->diffForHumans() }}</td>
                                                <td>
												   <button type="button" class="modal-effect btn btn-sm btn-info" data-effect="effect-scale" data-toggle="modal"
                                                     data-target="#editsectionmodal{{ $sections->id }}"
                                                     title="تعديل"><i class="las la-pen"></i>
												   </button>
												   <button type="button" class="modal-effect btn btn-danger btn-sm" data-effect="effect-scale" data-toggle="modal"
                                                     data-target="#deletesectionmodal{{ $sections->id }}"
                                                     title="حذف"><i class="las la-trash"></i>
												   </button>
												</td>
											</tr>
											@include('Dashboard.Sections.Edit')
											@include('Dashboard.Sections.Delete')
										   @endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<!--/div-->

				</div>
				@include('Dashboard.Sections.add')

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