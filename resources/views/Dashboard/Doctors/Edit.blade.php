@extends('Dashboard.layouts.master')
@section('title')
{{trans('Dashboard\Doctors_trans.Doctor_Edit')}}
@endsection
@section('css')
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('Dashboard/plugins/sumoselect/sumoselect-rtl.css') }}">
    <link href="{{URL::asset('dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>


@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"> {{trans('Dashboard\Doctors_trans.Doctors List')}}
</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/
					{{trans('Dashboard\Doctors_trans.Doctor_Edit')}}
</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

@include('Dashboard.Messages_Hospital')

    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('Doctors.update','test') }}" method="post" autocomplete="off" enctype="multipart/form-data">
					{{method_field('patch')}}
					@csrf
                        <div class="pd-30 pd-sm-40 bg-gray-200">
						 <div>
                                @if($doctor->image)
                                    <img style="border-radius:20%"
                                         src="{{Url::asset('Dashboard/img/doctors/'.$doctor->image->filename)}}"
                                         height="150px" width="150px" alt="">
                                @else
                                    <img style="border-radius:50%"
                                         src="{{Url::asset('Dashboard/img/doctors/doctor_default.png')}}"
                                         height="50px"
                                         width="50px" alt="">
                                @endif
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
									{{trans('Dashboard\Doctors_trans.Name')}}
									</label>
                                </div>
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <input class="form-control" autofocus name="name" type="text" value='{{$doctor->name}}'>
									<input class="form-control" value="{{$doctor->id}}" name="id" type="hidden">
							    </div>
                            </div>

                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
									{{trans('Dashboard\Doctors_trans.email')}}</label>
                                </div>
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <input class="form-control" name="email" type="email" value='{{$doctor->email}}'>
                                </div>
                            </div>

                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
									{{trans('Dashboard\Doctors_trans.phone')}}</label>
                                </div>
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <input class="form-control" name="phone" type="tel" value='{{$doctor->phone}}'>
                                </div>
                            </div>


                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
									{{trans('Dashboard\Doctors_trans.Doctor_Section')}}</label>
                                </div>

                               <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <select name="section_id" class="form-control SlectBox">
                                        @foreach($sections as $section)
                                            <option
                                                value="{{$section->id}}" {{$section->id == $doctor->section_id ? 'selected':"" }}>{{$section->name}}
											</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
										{{trans('Dashboard\Doctors_trans.appointments')}}
										</label>
                                </div>

                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <select multiple="multiple" class="testselect2" name="appointments[]">
                                        <!-- @foreach($doctor->doctorappointments as $appointmentDOC)
                                            <option value="{{$appointmentDOC->id}}" selected>{{$appointmentDOC->name}}</option>
                                        @endforeach

                                        @foreach($appointments as $appointment)
                                            <option
                                                value="{{$appointment->id}}">{{$appointment->name}}</option>
                                        @endforeach -->
                                        @foreach($appointments as $appointment)
                                            <!-- @php $check = []; @endphp -->
                                            @foreach ($doctor->doctorappointments as  $appointmentDOC)
                                                @php
                                                    $check[] = $appointmentDOC->id;
                                                @endphp
                                            @endforeach
                                            <option value="{{$appointment->id}}" {{ in_array($appointment->id, $check) ? 'selected' : '' }}>{{$appointment->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
										{{trans('Dashboard\Doctors_trans.doctor_photo')}}
										</label>
                                </div>
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <input type="file" accept="image/*" name="photo" onchange="loadFile(event)">
                                    <img style="border-radius:50%" width="150px" height="150px" id="output"/>
                                </div>
                            </div>



                            <button type="submit"
                                    class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5">
									{{trans('Dashboard\Doctors_trans.Save')}}
									</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
<!-- عشان املي صورة الفاضية بصورة اللي انا اخترتها عشان تتعرض قدامي -->
    <script>
        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>

    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('Dashboard/js/select2.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/js/advanced-form-elements.js') }}"></script>

    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('Dashboard/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Notify js -->
    <script src="{{URL::asset('dashboard/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('/plugins/notify/js/notifit-custom.js')}}"></script>


@endsection