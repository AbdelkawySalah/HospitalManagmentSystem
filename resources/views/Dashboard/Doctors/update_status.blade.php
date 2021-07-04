<div class="modal fade" id="update_status{{ $doctor->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
				{{trans('Dashboard\Doctors_trans.UpdateStatus')}}
				</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('update_status') }}" method="post" autocomplete="off">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                    <label for="status">{{trans('Dashboard/Doctors_trans.status')}}</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="" selected disabled>--{{trans('Dashboard/Doctors_trans.Choose')}}--</option>
                            <option value="1">{{trans('Dashboard/Doctors_trans.Active')}}</option>
                            <option value="0">{{trans('Dashboard/Doctors_trans.Not_Active')}}</option>
                        </select>
                    </div>
                    <input type="text" name="id" value="{{ $doctor->id }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('Dashboard/Doctors_trans.Close')}}</button>
                    <button type="submit" class="btn btn-danger">{{trans('Dashboard/Doctors_trans.Save Edit')}}</button>
                </div>
            </form>
           
        </div>
    </div>
</div>