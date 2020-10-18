@extends('layouts.index')
@section('content')
	<x-breadcrumb pagename="New Event" />
	<form action="{{url('appointments')}}" method="post">
		@csrf()
		<div class="row">
		    <div class="col-md-6">
				<div class="card">
					<div class="card-header">Details</div>
					<div class="card-body">
						<div class="row">
						    <div class="col-md-12">
						    	<x-input name="title" label="Event Name" />

						    	<x-select2 name="status" label="Event Status">
	                        		<x-slot name="options">
	                        			<option value="Pending">Pending</option>
	                        			<option value="Complete">Complete</option>
	                        			<option value="Canceled">Canceled</option>
	                        		</x-slot>
						    	</x-select2>

						    	<x-datetime name="start" label="Start Date/Time"/>
						    	<x-datetime name="end" label="End Date/Time"/>

					    		<x-select2 name="repeat_type" class="repeat_type" label="Repeat Type">
	                        		<x-slot name="options">
	                        			<option selected="" value="No Repeat">No Repeat</option>
	                        			<option value="Daily">Daily</option>
	                        			<option value="Weekly">Weekly</option>
	                        		</x-slot>
						    	</x-select2>

						    	<x-date name="repeat_until" label="Repeat Until Date/Time" disabled="disabled" class="repeat_until"/>

								<div class="form-group row repeatWeekdaysRow" style="display: none;">
									<label class="col-sm-4 col-form-label">Repeat Weekdays</label>
									<div class="col-sm-8">
								    	<label style="display: inline;" class="checkbox checkbox-primary">
								        	<input type="hidden" name="daysofweek[0]" value="">
									        <input type="checkbox" name="daysofweek[0]" class="form-control" value="0" checked="checked" /><span>Sun</span><span class="checkmark"></span>
									    </label>
								    	<label style="display: inline;" class="checkbox checkbox-primary">
								        	<input type="hidden" name="daysofweek[1]" value="">
									        <input type="checkbox" name="daysofweek[1]" class="form-control" value="1" checked="checked" /><span>Mon</span><span class="checkmark"></span>
									    </label>
								    	<label style="display: inline;" class="checkbox checkbox-primary">
								        	<input type="hidden" name="daysofweek[2]" value="">
									        <input type="checkbox" name="daysofweek[2]" class="form-control" value="2" checked="checked" /><span>Tue</span><span class="checkmark"></span>
									    </label>
								    	<label style="display: inline;" class="checkbox checkbox-primary">
								        	<input type="hidden" name="daysofweek[3]" value="">
									        <input type="checkbox" name="daysofweek[3]" class="form-control" value="3" checked="checked" /><span>Wed</span><span class="checkmark"></span>
									    </label>
									    <br/>
									    <br/>
								    	<label style="display: inline;" class="checkbox checkbox-primary">
								        	<input type="hidden" name="daysofweek[4]" value="">
									        <input type="checkbox" name="daysofweek[4]" class="form-control" value="4" checked="checked" /><span>Thur</span><span class="checkmark"></span>
									    </label>
								    	<label style="display: inline;" class="checkbox checkbox-primary">
								        	<input type="hidden" name="daysofweek[5]" value="">
									        <input type="checkbox" name="daysofweek[5]" class="form-control" value="5" checked="checked" /><span>Fri</span><span class="checkmark"></span>
									    </label>
								    	<label style="display: inline;" class="checkbox checkbox-primary">
								        	<input type="hidden" name="daysofweek[6]" value="">
									        <input type="checkbox" name="daysofweek[6]" class="form-control" value="6" checked="checked" /><span>Sat</span><span class="checkmark"></span>
									    </label>
									</div>
								</div>
						    </div>
						</div>
					</div>
				</div>
			</div>
		    <div class="col-md-6">
				<div class="card">
					<div class="card-header">Event Type Details </div>
					<div class="card-body">
						<div class="row">
						    <div class="col-md-12">
						    	<x-select2 name="mentor" label="Mentor" :dbmodel="$users" :visible="['fname', 'lname']" />

						    	<x-select2 name="contacts[]"  multiple="multiple" label="Select student (or private appointment)" :dbmodel="$contacts" :visible="['fname', 'lname']" />

						    	<x-select2 name="appointment_type" label="Appointment Type" :dbmodel="$appointmenttypes" :visible="['name']" />

						    	<x-select2 name="appointment_constraint" label="Appointment Constraint" :dbmodel="$appointmentconstraints" :visible="['name']" />

						    	<x-input-dynamic name="appointment_additional" label="Additional Fields" />
						    </div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row mt-4">
		    <div class="col-md-12">
				<div class="card">
					<div class="card-header default_settings" style="cursor: pointer;">Event Calendar Details (Optional)</div>
					<div class="card-body default_settings_view" style="display: none;">
						<div class="row">
							<div class="col-md-6">
								<x-select2 name="allday" label="Full Day/Hourly">
	                        		<x-slot name="options">
	                        			<option value="0">Include Time in Event</option>
	                        			<option value="1">Full Event</option>
	                        		</x-slot>
						    	</x-select2>
								<x-select2 name="starteditable" label="Event Editable from Calendar">
	                        		<x-slot name="options">
	                        			<option value="1">Yes</option>
	                        			<option value="0">No</option>
	                        		</x-slot>
						    	</x-select2>
								<x-select2 name="durationeditable" label="Event Duration Editable from Calendar">
	                        		<x-slot name="options">
	                        			<option value="1">Yes</option>
	                        			<option value="0">No</option>
	                        		</x-slot>
						    	</x-select2>
								<x-select2 name="resourceeditable" label="Event Resource Editable from Calendar">
	                        		<x-slot name="options">
	                        			<option value="1">Yes</option>
	                        			<option value="0">No</option>
	                        		</x-slot>
						    	</x-select2>
						    </div>
							<div class="col-md-6">
								<x-select2 name="overlap" label="Allow overlapping for Event">
	                        		<x-slot name="options">
	                        			<option value="0">No</option>
	                        			<option value="1">Yes</option>
	                        		</x-slot>
						    	</x-select2>
								<x-select2 name="display" label="Display Type in Calendar">
	                        		<x-slot name="options">
	                        			<option value="auto">Auto</option>
	                        			<option value="block">Block</option>
	                        			<option value="list-item">List Item</option>
	                        			<option value="background">Background Event</option>
	                        		</x-slot>
						    	</x-select2>
								
								<x-select2 name="appointment_color" label="Event Color" :dbmodel="$appointmentcolors" :visible="['name']" />

								<x-select2 name="appointment_text_color" label="Event Text Color" :dbmodel="$appointmentcolors" :visible="['name']" />
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row mt-4">
		    <div class="col-md-12">
				<div class="card">
					<div class="card-header">Event Details</div>
					<div class="card-body">
						<div class="row">
						    <div class="col-md-12">
						    	<x-area name="description" label="Description"/>
						    	<button type="submit" class="btn btn-primary">Create Event</button>
						    </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
@endsection
@push("scripts")
	<script type="text/javascript">
		var repeatType = []
		$(document).ready(function() {
			$(".repeat_type").on("change", function(e) {
				switch($(this).val()){
					case "Daily":
						repeatType = []
						$(".repeatWeekdaysRow").slideUp();
						$(".repeat_until").removeAttr("disabled")
						break;
					case "Weekly":
						$(".repeatWeekdaysRow").slideDown();
						$(".repeat_until").removeAttr("disabled")
						var daysArray = []
						$(".daysofweek").each(function(f) {
							if($(this).prop('checked')){
								daysArray.push($(this).val())
							}else{

							}
						})
						repeatType = daysArray
						break;
					case "No Repeat":
						$(".repeatWeekdaysRow").slideUp();
						$(".repeat_until").attr("disabled", "disabled");
						break;
					default:
						repeatType = [];
						break;
				}
			})

			$(".repeatable").click(function() {
				if($(this).prop('checked')){
					$(".repeat_until").removeAttr("disabled")
				}else{
					$(".repeat_until").attr("disabled", "disabled");
				}
				
			})

			$(".default_settings").click(function() {
				$(".default_settings_view").slideToggle();
			})

			
		})
	</script>
@endpush