@extends('Dashboard.layouts.master')
@section('css')
    <!--Internal   Notify -->
    <link href="{{URL::asset('dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
@endsection
@section('title')
{{trans('Dashboard\Ambulance_trans.Edit_Ambulance')}}
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">{{trans('Dashboard\Ambulance_trans.Edit_Ambulance')}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{trans('Dashboard\Ambulance_trans.Ambulance')}}</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')

@include('Dashboard.Messages_Hospital')
<!-- row -->
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <form action="{{route('Ambulance.update','test')}}" method="post" autocomplete="off">
                @method('PUT')
                @csrf
                    <div class="row">
                        <div class="col">
                            <label>{{trans('Dashboard\Ambulance_trans.car_number')}}</label>
                            <input type="text" name="car_number"  value="{{$ambulances->car_number}}" class="form-control @error('car_number') is-invalid @enderror">
                            {{-- input hidden value => id   --}}
							<input type="hidden" name="Ambulanceid"  value="{{$ambulances->id}}">
						   
                        </div>

                        <div class="col">
                            <label>{{trans('Dashboard\Ambulance_trans.car_model')}}</label>
                            <input type="text" name="car_model"  value="{{$ambulances->car_model}}" class="form-control @error('car_model') is-invalid @enderror">
                        </div>

                        <div class="col">
                            <label>{{trans('Dashboard\Ambulance_trans.car_year_made')}}</label>
                            <input type="number" name="car_year_made"  value="{{$ambulances->car_year_made}}" class="form-control @error('car_year_made') is-invalid @enderror">
                        </div>

                        <div class="col">
                            <label>{{trans('Dashboard\Ambulance_trans.car_type')}}</label>
                            <select class="form-control" name="car_type">
                                <option value="1" {{$ambulances->car_type == 1 ? 'selected':''}}>مملوكة</option>
                                <option value="2" {{$ambulances->car_type == 2 ? 'selected':''}}>ايجار</option>
                            </select>
                        </div>

                    </div>
                    <br>

                    <div class="row">
                        <div class="col-3">
                            <label>{{trans('Dashboard\Ambulance_trans.driver_name')}}</label>
                            <input type="text" name="driver_name"  value="{{$ambulances->driver_name}}" class="form-control @error('driver_name') is-invalid @enderror">
                        </div>

                        <div class="col-3">
                            <label>{{trans('Dashboard\Ambulance_trans.driver_license_number')}}</label>
                            <input type="number" name="driver_license_number"  value="{{$ambulances->driver_license_number}}" class="form-control @error('driver_license_number') is-invalid @enderror">
                        </div>

                        <div class="col-6">
                            <label>{{trans('Dashboard\Ambulance_trans.driver_phone')}}</label>
                            <input type="number" name="driver_phone"  value="{{$ambulances->driver_phone}}" class="form-control @error('driver_phone') is-invalid @enderror">
                        </div>

                    </div>

                    <br>

                    <div class="row">
                        <div class="col">
                            <label>{{trans('Dashboard\Ambulance_trans.notes')}}</label>
                            <textarea rows="5" cols="10" class="form-control" name="notes">{{$ambulances->notes}}</textarea>
                        </div>
                    </div>

                    <br>
                    <div class="row">
                            <div class="col">
                                <label>حالة السيارة</label>
                                 &nbsp;
                                <input name="is_available" {{$ambulances->is_available == 1 ? 'checked' : ''}} type="checkbox" class="form-check-input" id="exampleCheck1">
                            </div>
                        </div>
                    <div class="row">
                        <div class="col">
                            <button class="btn btn-success" type="submit">{{trans('Dashboard\Ambulance_trans.Save')}}</button>
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
    <script src="{{URL::asset('dashboard/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('/plugins/notify/js/notifit-custom.js')}}"></script>
@endsection