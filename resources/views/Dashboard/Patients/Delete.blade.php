<!-- Deleted insurance -->
<div class="modal fade" id="DeletedPatient{{$Patient->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('Dashboard\Patient_trans.Title_deleted')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('Patients.destroy','test')}}" method="post">
                    @method('DELETE')
                    @csrf

                    {{-- input hidden value => id   --}}
					<input type="text" name="name" readonly value="{{$Patient->name}}">
                    <input type="hidden" name="id" value="{{$Patient->id}}">

                    <div class="row">
                        <div class="col">
                            <p class="h5 text-danger">{{trans('Dashboard\Patient_trans.Warning Deleted')}}</p>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('Dashboard\Patient_trans.Close')}}</button>
                        <button class="btn btn-success">{{trans('Dashboard\Patient_trans.Delete')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>