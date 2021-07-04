<div class="modal fade" id="delete{{ $doctor->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
				{{trans('Dashboard\Doctors_trans.Delete_Doctor')}}
				</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('Doctors.destroy', 'test') }}" method="post">
                {{ method_field('delete') }}
                {{ csrf_field() }}
                <div class="modal-body">
                    <h5>
					{{trans('Dashboard\Doctors_trans.Warning')}}
					</h5>
                    <input type="text" value="1" name="page_id">
                  <!-- هنا بقوله لو في صورة هتعرض اسمها  -->
                    @if($doctor->image)
                        <input type="text" name="filename" value="{{$doctor->image->filename}}">
                    @endif
                    <input type="text" name="id" value="{{ $doctor->id }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('Dashboard/sections_trans.Close')}}</button>
                    <button type="submit" class="btn btn-danger">{{trans('Dashboard/Doctors_trans.Delete')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>