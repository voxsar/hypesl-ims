@extends('layouts.index')
@section('content')
	<x-breadcrumb pagename="New Contact" />
	<form action="{{url('contacts')}}" method="post">
		@csrf()
		<div class="row">
		    <div class="col-md-12">
				<div class="card">
					<div class="card-header">Details</div>
					<div class="card-body">
						<div class="row">
						    <div class="col-md-6">
						    	<x-input name="fname" label="First Name"/>
						    	<x-input name="lname" label="Last Name"/>
						    	<x-input name="oname" label="Other Name"/>
						    	<x-input name="mobile" label="Mobile"/>
						    	<x-input name="email" label="Email"/>
						    	<x-input name="street" label="Street"/>
						    	<x-input name="city" label="City"/>
						    	<x-input name="postal" label="Postal"/>
						    	<x-select2 name="type" label="Type">
						    		<x-slot name="options">
						    			<option value="child">Child</option>
						    			<option value="parent">Parent</option>
						    			<option value="guardian">Guardian</option>
						    			<option value="teacher">Teacher</option>
						    		</x-slot>
						    	</x-select2>
						    	<label class="form-label">Remarks</label>
						    	<textarea class="form-control" name="remarks"></textarea>
						    </div>
						    <div class="col-md-6">
						    	<div class="card">
							    	<div class="card-header">Relationships</div>
							    	<div class="card-body relations">
										<div class="row">
											<div class="col-md-12">
									    		<x-select2 name="relationship" class="select2-contact" label="Contact" :dbmodel="$contacts" :visible="['fname','lname', 'email']">
									    		</x-select2>
									    	</div>
									    </div>
										<div class="row">
											<div class="col-md-12">
									    		<x-select2 name="relationship" class="select2-type" label="Contact Relationship Type" :dbmodel="$contactrelationtypes" :visible="['name']">
									    		</x-select2>
									    	</div>
									    </div>
										<div class="row mb-4">
											<div class="col-md-6 offset-md-6">
								    			<button class="btn btn-primary btn-block add_contact_relation" type="button">Add Relationship <i class="fa fa-plus"></i></button>
								    		</div>
								    	</div>

							    	</div>
						    	</div>
						    	<div class="card mt-3">
							    	<div class="card-header">Addtional Fields</div>
							    	<div class="card-body">
						    			<x-input-dynamic name="other" label="Other Details"/>
						    		</div>
						    	</div>
						    </div>
						</div>
						<div class="row mt-3">
						    <div class="col-md-6">
						    	<button type="submit" class="btn btn-primary">Save Contact</button>
						    </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
@endsection
@push('scripts')
	
	<script type="text/javascript">
		$(document).ready(function() {
			$(".add_contact_relation").click(function() {
				var relation_template = $("#relation_template").html()
				if($(".select2-contact").select2('data')[0] && $(".select2-type").select2('data')[0]){
					relation_template = relation_template.replace("__name__", $(".select2-contact").select2('data')[0].text)
					relation_template = relation_template.replace("__relation__", $(".select2-type").select2('data')[0].text)
					relation_template = relation_template.replace("__nameid__", $(".select2-contact").select2('data')[0].id)
					relation_template = relation_template.replace("__relationid__", $(".select2-type").select2('data')[0].id)

					relation_template = relation_template.replace("__lation__", $(".select2-type").select2('data')[0].text)
					relation_template = relation_template.replace("__lationid__", $(".select2-type").select2('data')[0].id)

					$(".relations").append(relation_template)
				}
			})

			$(".relations").on("click", ".btn-danger", function() {
				$(this).parent().parent().remove()
			})
		})
	</script>

	<script type="text/html" id="relation_template">
		<div class="card mb-1">
			<div class="row p-2">
				<div class="col-md-7">
					<p>__name__</p>
					<input type="hidden" name="relation_dynamic[contact][]" value="__nameid__">
				</div>
				<div class="col-md-3">
					<p>__relation__</p>
					<input type="hidden" name="relation_dynamic[type][]" value="__relationid__">
				</div>
				<div class="col-md-1">
					<button class="btn btn-danger" type="button"><i class="fa fa-minus"></i></button>
				</div>
			</div>
		</div>
	</script>
@endpush