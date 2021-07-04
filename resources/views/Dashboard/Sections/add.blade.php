	<!-- Add Section modal -->

    <div class="modal" id="Addmodal">
			<div class="modal-dialog" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h6 class="modal-title">{{trans('Dashboard\Sections_trans.Add_Section')}}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
					</div>
					
						<form action="{{route('Sections.store')}}" method="post" autocomplete="off">
						   {{csrf_field()}}
						   <div class="modal-body">
						      <div class="form-group">
							     <label>{{trans('Dashboard\Sections_trans.Section_Name')}}</label>
								 <input type="text" class="form-control" id="section_name" name="section_name"   required>
							  </div>
				        	</div>
							<div class="modal-footer">
					    	<button class="btn ripple btn-primary" type="submit">{{trans('Dashboard\Sections_trans.Save')}}</button>
					    	<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">{{trans('Dashboard\Sections_trans.Close')}}</button>
					       </div>
						</form>
					
				</div>
			</div>
		</div>
		<!-- Add Section modal -->