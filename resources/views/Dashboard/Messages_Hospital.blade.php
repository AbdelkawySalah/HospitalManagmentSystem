<!-- for alll errors -->
@if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                           <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                          </ul>
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                           </button>
                           </div>
   @endif

<!-- flash add -->
@if (session()->has('add'))
					<script>
						window.onload = function() {
							notif({
								msg: "{{trans('Dashboard\Message_trans.MsgAdd')}}",
								type: "success"
							})
						}
					</script>
  @endif
  <!-- flash add -->

  <!-- flash Update -->
@if (session()->has('Update'))
					<script>
						window.onload = function() {
							notif({
								msg: "{{trans('Dashboard\Message_trans.MsgUpdate')}}",
								type: "success"
							})
						}
					</script>
  @endif
  <!-- flash update -->

  
   <!-- flash DeleteSection -->
@if (session()->has('Delete'))
					<script>
						window.onload = function() {
							notif({
								msg: "{{trans('Dashboard\Message_trans.MsgDelete')}}",
								type: "success"
							})
						}
					</script>
  @endif
  <!-- flash update -->

 
