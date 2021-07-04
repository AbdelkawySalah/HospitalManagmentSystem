@extends('Dashboard.layouts.master')
@section('css')
    <!--Internal   Notify -->
    <link href="{{URL::asset('dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
@endsection
@section('title')
{{trans('Dashboard\Patient_trans.Edit_PatientData')}}
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">{{trans('Dashboard\Patient_trans.Edit_PatientData')}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{trans('Dashboard\Patient_trans.Patients')}}</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- Messages Page -->
@include('Dashboard.Messages_Hospital')

<!-- Messages Page --> 	<!-- row -->
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <form action="{{route('Patients.update','test')}}" method="post" autocomplete="off">
                {{method_field('patch')}}
				 @csrf
                    <div class="row">
                        <div class="col-3">
                            <label>{{trans('Dashboard\Patient_trans.Patient_Name')}}</label>
                            <input type="text" name="name"  value="{{$patient->name}}" class="form-control @error('name') is-invalid @enderror " required>
                        </div>
                     {{--hiddenid---}}
                     <input type="hidden" name="patientid"  value="{{$patient->id}}" class="form-control">
                        <div class="col">
                            <label>{{trans('Dashboard\Patient_trans.Email')}}</label>
                            <input type="email" name="email"  value="{{$patient->email}}" class="form-control @error('email') is-invalid @enderror" required>
                        </div>


                        <div class="col">
                            <label>{{trans('Dashboard\Patient_trans.Birth_Date')}}</label>
                            <input class="form-control fc-datepicker" name="Date_Birth" placeholder="YYYY-MM-DD"
                             type="text" required value="{{$patient->Date_Birth}}">
                        </div>

                    </div>
                    <br>

                    <div class="row">
                        <div class="col-3">
                            <label>{{trans('Dashboard\Patient_trans.Phone')}}</label>
                            <input type="number" name="Phone"  value="{{$patient->Phone}}" class="form-control @error('Phone') is-invalid @enderror" required>
                        </div>

                        <div class="col">
                            <label>{{trans('Dashboard\Patient_trans.Gender')}}</label>
                            <select class="form-control" name="Gender" required>
                                <option value="" disabled selected>-- {{trans('Dashboard\Patient_trans.ChooseFromList')}} --</option>
                                <option value="1" {{$patient->Gender == 1 ? 'selected':''}}>{{trans('Dashboard\Patient_trans.Male')}}</option>
                                <option value="2" {{$patient->Gender == 2 ? 'selected':''}}>{{trans('Dashboard\Patient_trans.Female')}}</option>
                            </select>
                        </div>

                        <div class="col">
                            <label>فصلية الدم</label>
                            <select class="form-control" name="Blood_Group" required>
                                <option value="O-" {{$patient->Blood_Group == 'O-' ? 'selected':''}}>O-</option>
                                <option value="O+" {{$patient->Blood_Group == 'O+' ? 'selected':''}}>O+</option>
                                <option value="A+" {{$patient->Blood_Group == 'A+' ? 'selected':''}}>A+</option>
                                <option value="A-" {{$patient->Blood_Group == 'A-' ? 'selected':''}}>A-</option>
                                <option value="B+" {{$patient->Blood_Group == 'B+' ? 'selected':''}}>B+</option>
                                <option value="B-" {{$patient->Blood_Group == 'B-' ? 'selected':''}}>B-</option>
                                <option value="AB+" {{$patient->Blood_Group == 'AB+' ? 'selected':''}}>AB+</option>
                                <option value="AB-" {{$patient->Blood_Group == 'AB-' ? 'selected':''}}>AB-</option>
                            </select>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col">
                            <label>{{trans('Dashboard\Patient_trans.Address')}}</label>
                            <textarea rows="5" cols="10" class="form-control" name="Address">{{$patient->Address}}</textarea>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col">
                            <button class="btn btn-success">{{trans('Dashboard\Patient_trans.Save')}}</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('dashboard/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();
    </script>
    <script src="{{URL::asset('dashboard/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('/plugins/notify/js/notifit-custom.js')}}"></script>
@endsection