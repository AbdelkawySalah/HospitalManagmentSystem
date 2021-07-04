<!-- Deleted insurance -->
<div class="modal fade" id="Deleted{{$ambulance->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('Dashboard\Ambulance_trans.Title_deleted')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('Ambulance.destroy','test')}}" method="post">
                    @method('DELETE')
                    @csrf

                    {{-- input hidden value => id   --}}
					<input type="text" name="name" value="{{$ambulance->car_number}}">
                    <input type="text" name="id" value="{{$ambulance->id}}">

                    <div class="row">
                        <div class="col">
                            <p class="h5 text-danger">{{trans('Dashboard\Ambulance_trans.Warning Deleted')}}</p>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('Dashboard\Ambulance_trans.Close')}}</button>
                        <button class="btn btn-success">{{trans('Dashboard\Ambulance_trans.Delete')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>