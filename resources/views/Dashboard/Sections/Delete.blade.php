<!-- deletesectionmodal -->
<div class="modal" id="deletesectionmodal{{ $sections->id }}">
												<div class="modal-dialog" role="document">
													<div class="modal-content modal-content-demo">
														<div class="modal-header">
															<h6 class="modal-title">{{trans('Dashboard\Sections_trans.Delete_Section')}}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
														</div>
														
															<form action="{{route('Sections.destroy','test')}}" method="post">
															{{method_field('Delete')}}
															@csrf
															<div class="modal-body">
																<div class="form-group">
																	<label>{{trans('Dashboard\Sections_trans.Section_Name')}}</label>
																	<input type="text" class="form-control" id="section_name" name="sectionname"  value="{{ $sections->name }}"
																			autocomplete="off" disabled>
																	<input type="hidden" class="form-control" id="sectionid" name="sectionid"  value="{{ $sections->id }}"
																			autocomplete="off" required>
																</div>
																</div>
																<div class="modal-footer">
																<button class="btn ripple btn-primary" type="submit">{{trans('Dashboard\Sections_trans.Delete')}}</button>
																<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">{{trans('Dashboard\Sections_trans.Close')}}</button>
															</div>
															</form>
														
													</div>
												</div>
											</div>
											<!--deletesectionmodal -->