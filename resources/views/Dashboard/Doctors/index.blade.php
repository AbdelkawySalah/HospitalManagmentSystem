@extends('Dashboard.layouts.master')
@section('title')
{{trans('Dashboard\Doctors_trans.Doctors')}}
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
							<h4 class="content-title mb-0 my-auto">{{trans('Dashboard\Doctors_trans.Doctors')}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{trans('Dashboard\Doctors_trans.Doctors List')}}</span>
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
								<a class="btn ripple btn-primary" href="{{Route('Doctors.create')}}">{{trans('Dashboard\Doctors_trans.Add_Doctors')}}</a>
							<!-- هنعمل زر خاص بالحذف العتاصر المختارة -->
								<button type="button" class="btn btn-danger" id="btn_delete_all">{{trans('Dashboard\Doctors_trans.doctor_select')}}</button>
							</div>
							<div class="card-body">
								<div class="table-responsive">
								<table id="example" width="100%"  class="table key-buttons text-md-nowrap">
                            <thead>
                            <tr>
                                <th>#</th>
								<th><input name="select_all"  id="example-select-all"  type="checkbox" /></th>
								<th >{{trans('Dashboard\Doctors_trans.doctor_photo')}}</th>
                                <th >{{trans('Dashboard\Doctors_trans.Name')}}</th>
                                <th >{{trans('Dashboard\Doctors_trans.email')}}</th>
                                <th>{{trans('Dashboard\Doctors_trans.Doctor_Section')}}</th>
                                <th >{{trans('Dashboard\Doctors_trans.phone')}}</th>
                                <th >{{trans('Dashboard\Doctors_trans.appointments')}}</th>
                                <th >{{trans('Dashboard\Doctors_trans.status')}}</th>
                                <th>{{trans('Dashboard\Doctors_trans.created_at')}}</th>
                                <th>{{trans('Dashboard\Doctors_trans.Process')}}</th>
                            </tr>
                            </thead>
                            <tbody>
								@foreach($doctors as $doctor)
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td><input type="checkbox" name="delete_select" value="{{$doctor->id}}" class="delete_select"></td>
										<td>
										<!-- //هنا بقوله لو في صوره اعرضها لو مفيش هتعرض صورة افتراضية -->
											@if($doctor->image)
												<img src="{{Url::asset('Dashboard/img/doctors/'.$doctor->image->filename)}}" height="50px" width="50px" title="{{ $doctor->name }}" alt="{{ $doctor->name }}">
											@else
												<img src="{{Url::asset('Dashboard/img/doctors/doctor_default.png')}}" height="50px" width="50px" alt="">
											@endif
                                        </td>
										<td>{{ $doctor->name }}</td>
										<td>{{ $doctor->email }}</td>
										<td>{{ $doctor->section->name}}</td>
										<td>{{ $doctor->phone}}</td>
										<!-- <td>{{ $doctor->appointments}}</td> -->
										<td>
											@foreach($doctor->doctorappointments as $appointments)
											{{ $appointments->name}}
											@endforeach
										</td>
										<td>
											<div class="dot-label bg-{{$doctor->status == 1 ? 'success':'danger'}} ml-1"></div>
											{{$doctor->status == 1 ? trans('Dashboard\Doctors_trans.Active'):trans('Dashboard\Doctors_trans.Not_Active')}}
										</td>

										<td>{{ $doctor->created_at->diffForHumans() }}</td>
										<!-- <td>
											<a class="modal-effect btn btn-sm btn-info" href="{{route('Doctors.edit',$doctor->id)}}"><i class="las la-pen"></i></a>
											<a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"  data-toggle="modal" href="#delete{{$doctor->id}}"><i class="las la-trash"></i></a>
										</td> -->
										<td>
											<div class="dropdown">
											<button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-outline-primary btn-sm" data-toggle="dropdown" type="button">{{trans('Dashboard\Doctors_trans.Process')}}<i class="fas fa-caret-down mr-1"></i></button>
											<div class="dropdown-menu tx-13">
												<a class="dropdown-item" href="{{route('Doctors.edit',$doctor->id)}}"><i style="color: #0ba360" class="text-success ti-user"></i>&nbsp;&nbsp;تعديل البيانات</a>
												<a class="dropdown-item" href="#" data-toggle="modal" data-target="#update_password{{$doctor->id}}"><i   class="text-primary ti-key"></i>&nbsp;&nbsp;تغير كلمة المرور</a>
												<a class="dropdown-item" href="#" data-toggle="modal" data-target="#update_status{{$doctor->id}}"><i   class="text-warning ti-back-right"></i>&nbsp;&nbsp;تغير الحالة</a>
												<a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete{{$doctor->id}}"><i   class="text-danger  ti-trash"></i>&nbsp;&nbsp;حذف البيانات</a>
											</div>
											</div>
										 </td>

									</tr>
									@include('Dashboard.Doctors.Delete')
									@include('Dashboard.Doctors.delete_select')
									@include('Dashboard.Doctors.update_password')
									@include('Dashboard.Doctors.update_status')

								@endforeach
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

<!-- كود عشان لما اضغط علي اتشك بوكس اللي في هيدر يحدد كل اللي  اتشك بوكسس اللي في صفحة -->
    <script>
        $(function() {
            jQuery("[name=select_all]").click(function(source) {
                checkboxes = jQuery("[name=delete_select]");
                for(var i in checkboxes){
                    checkboxes[i].checked = source.target.checked;
                }
            });
        })
     </script>

<script type="text/javascript">
        $(function () {
            $("#btn_delete_all").click(function () {
                var selected = [];
                $("#example input[name=delete_select]:checked").each(function () {
                    selected.push(this.value);
                });
                if (selected.length > 0) {
                    $('#delete_select').modal('show')
                    $('input[id="delete_select_id"]').val(selected);
                }
            });
        });
    </script>
	
@endsection