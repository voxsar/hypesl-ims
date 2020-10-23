@extends('layouts.index')
@section('content')
	<x-breadcrumb pagename="Events" />
	<div class="row">
			<div class="col-md-3">
					<div class="card mb-4">
							<div class="card-body">
									<h6 class="mb-3">Upcoming Events</h6>
									<p class="text-20 text-success line-height-1 mb-3">
										<i class="fa fa-calendar-day"></i>&nbsp;Upcoming {{$future}}
									</p>
									<small class="text-muted">Next event 4 days from now</small>
							</div>
					</div>
			</div>
			<div class="col-md-3">
					<div class="card mb-4">
							<div class="card-body">
									<h6 class="mb-3">Past Events</h6>
									<p class="text-20 text-danger line-height-1 mb-3">
										<i class="fa fa-calendar-day"></i>&nbsp;Past {{$past}}
									</p>
									<small class="text-muted">Completed 4 days from ago</small>
							</div>
					</div>
			</div>
			<div class="col-md-4">
					<div class="card mb-4">
							<div class="card-body">
									<h6 class="mb-3">Pending Events</h6>
									<p class="text-20 text-warning line-height-1 mb-3">
										<i class="fa fa-calendar-day"></i>&nbsp;Pending {{$pending}}
									</p>
									<small class="text-muted">Pending event 4 days from ago</small>
							</div>
					</div>
			</div>
			<div class="col-md-2">
					<div class="card mb-4">
							<div class="card-body">
									<h6 class="mb-3">Total Events</h6>
									<p class="text-20 text-primary line-height-1 mb-3">
										<i class="fa fa-calendar-day"></i>&nbsp;{{$total}}
									</p>
									<small class="text-muted"></small>
							</div>
					</div>
			</div>
	</div>
	<div style="display: hidden" id="calendar_loader" class="row">
		<div class="col-md-5">
		</div>
		<div class="col-md-1">
			<div class="spinner-bubble spinner-bubble-primary m-5"></div>
		</div>
	</div>
	<div style="display: hidden" class="row" id="calendar_data">
		<div class="col-md-12">
			<div id="calendar"></div>
		</div>
	</div>
@endsection
@push('models')
	<!--  Modal -->
	<div class="modal fade" id="appointmentReschedule" tabindex="-1" role="dialog" aria-labelledby="appointmentRescheduleLabel" aria-hidden="true">
	    <div class="modal-dialog" role="document">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h5 class="modal-title" id="appointmentRescheduleLabel">Confirm Events Reschedule</h5>
	                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
	            </div>
	            <div class="modal-body">
	                <p>Are you sure you want to move this event, it will be rescheduled (google calendar may take a while to update)</p>
	            </div>
	            <div class="modal-footer">
	                <button id="closeAppointmentReschedule" class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
	                <button id="confirmAppointmentReschedule" class="btn btn-primary ml-2" type="button" data-dismiss="modal">Confirm Event Reschedule</button>
	            </div>
	        </div>
	    </div>
	</div>
	<!--  Modal -->
	<div class="modal fade" id="appointmentResize" tabindex="-1" role="dialog" aria-labelledby="appointmentResizeLabel" aria-hidden="true">
	    <div class="modal-dialog" role="document">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h5 class="modal-title" id="appointmentResizeLabel">Confirm Event Resize</h5>
	                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
	            </div>
	            <div class="modal-body">
	                <p>Are you sure you want to change duration of the event, it will be altered (google calendar may take a while to update)</p>
	            </div>
	            <div class="modal-footer">
	                <button id="closeAppointmentResize" class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
	                <button id="confirmAppointmentResize" class="btn btn-primary ml-2" type="button" data-dismiss="modal">Confirm Event Resize</button>
	            </div>
	        </div>
	    </div>
	</div>
	<!--  Modal -->
	<div class="modal fade" id="appointmentClick" tabindex="-1" role="dialog" aria-labelledby="appointmentClickLabel" aria-hidden="true">
	    <div class="modal-dialog" role="document">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h5 class="modal-title" id="appointmentClickLabel">Event Details</h5>
	                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
	            </div>
	            <div class="modal-body">
	                <p>Are you sure you want to change duration of the event, it will be altered (google calendar may take time reflect changes)</p>
	            </div>
	            <div class="modal-footer">
	                <button id="closeAppointmentClick" class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
	                <button id="deleteAppointmentClick" class="btn btn-danger" type="button" data-dismiss="modal">Delete</button>
	                <a id="viewAppointmentClick" class="btn btn-success ml-2" type="button" data-dismiss="modal">View Event</a>
	            </div>
	        </div>
	    </div>
	</div>
	<!--  Modal -->
	<div class="modal fade" id="appointmentDelete" tabindex="-1" role="dialog" aria-labelledby="appointmentDeleteLabel" aria-hidden="true">
	    <div class="modal-dialog" role="document">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h5 class="modal-title" id="appointmentDeleteLabel">Delete Event</h5>
	                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
	            </div>
	            <div class="modal-body">
	                <p>Are you sure you want to delete this event (google calendar may take time reflect changes)</p>
	            </div>
	            <div class="modal-footer">
	                <button id="closeAppointmentDelete" class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
	                <button id="deleteAppointmentDelete" class="btn btn-danger" type="button" data-dismiss="modal">Delete</button>
	            </div>
	        </div>
	    </div>
	</div>
	<!--  Modal -->
	<div class="modal fade" id="appointmentUpdated" tabindex="-1" role="dialog" aria-labelledby="appointmentUpdatedLabel" aria-hidden="true">
	    <div class="modal-dialog" role="document">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h5 class="modal-title" id="appointmentUpdatedLabel">Event Updated</h5>
	                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
	            </div>
	            <div class="modal-body">
	                <p>The event has been updated (google calendar may take time reflect changes)</p>
	            </div>
	            <div class="modal-footer">
	                <button class="btn btn-success" type="button" data-dismiss="modal">OK</button>
	            </div>
	        </div>
	    </div>
	</div>
	<!--  Modal -->
	<div class="modal fade" id="appointmentCreate" tabindex="-1" role="dialog" aria-labelledby="appointmentCreateLabel" aria-hidden="true">
	    <div class="modal-dialog modal-lg" role="document">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h5 class="modal-title" id="appointmentCreateLabel">Create Event</h5>
	                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
	            </div>
	            <div class="modal-body m-3">
	                <p>Create an Event</p>
					<div class="row">
					    <div class="col-md-6">
					    	<x-input name="title" class="appointment_title" label="Event Name" />

					    	<x-select2 name="status" class="status" label="Event Status">
                        		<x-slot name="options">
                        			<option value="Pending">Pending</option>
                        			<option value="Complete">Complete</option>
                        			<option value="Canceled">Canceled</option>
                        		</x-slot>
					    	</x-select2>

					    	<x-datetime name="start" class="start" label="Start Date/Time"/>
					    	<x-datetime name="end" class="end" label="End Date/Time"/>

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
								        <input type="checkbox" name="daysofweek[0]" class="form-control daysofweek" value="0" checked="checked" /><span>Sun</span><span class="checkmark"></span>
								    </label>
							    	<label style="display: inline;" class="checkbox checkbox-primary">
								        <input type="checkbox" name="daysofweek[1]" class="form-control daysofweek" value="1" checked="checked" /><span>Mon</span><span class="checkmark"></span>
								    </label>
							    	<label style="display: inline;" class="checkbox checkbox-primary">
								        <input type="checkbox" name="daysofweek[2]" class="form-control daysofweek" value="2" checked="checked" /><span>Tue</span><span class="checkmark"></span>
								    </label>
							    	<label style="display: inline;" class="checkbox checkbox-primary">
								        <input type="checkbox" name="daysofweek[3]" class="form-control daysofweek" value="3" checked="checked" /><span>Wed</span><span class="checkmark"></span>
								    </label>
								    <br/>
								    <br/>
							    	<label style="display: inline;" class="checkbox checkbox-primary">
								        <input type="checkbox" name="daysofweek[4]" class="form-control daysofweek" value="4" checked="checked" /><span>Thur</span><span class="checkmark"></span>
								    </label>
							    	<label style="display: inline;" class="checkbox checkbox-primary">
								        <input type="checkbox" name="daysofweek[5]" class="form-control daysofweek" value="5" checked="checked" /><span>Fri</span><span class="checkmark"></span>
								    </label>
							    	<label style="display: inline;" class="checkbox checkbox-primary">
								        <input type="checkbox" name="daysofweek[6]" class="form-control daysofweek" value="6" checked="checked" /><span>Sat</span><span class="checkmark"></span>
								    </label>
								</div>
							</div>
					    </div>
					    <div class="col-md-6">
					    	<x-select2 name="mentor" class="mentor" label="Host" :dbmodel="$users" :visible="['fname', 'lname']" />

					    	<x-select2 name="contacts[]" class="contacts"  multiple="multiple" label="Participants" :dbmodel="$contacts" :visible="['fname', 'lname']" />

					    	<x-select2 name="appointment_type" class="appointment_type" label="Event Type" :dbmodel="$appointmenttypes" :visible="['name']" />

					    	<x-select2 name="appointment_constraint" class="appointment_constraint" label="Event Constraint" :dbmodel="$appointmentconstraints" :visible="['name']" />

							<x-select2 name="appointment_color" class="appointment_color" label="Event Color" :dbmodel="$appointmentcolors" :visible="['name']" />

					    </div>
					</div>
					<div class="row">
					    <div class="col-md-12">
						    <x-area name="description" class="description" label="Description"/>
					    </div>
					</div>
	            </div>
	            <div class="modal-footer">
	                <button id="closeAppointmentCreate" class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
	                <button id="saveAppointmentCreate" class="btn btn-success" type="button" data-dismiss="modal">Save Event</button>
	            </div>
	        </div>
	    </div>
	</div>
@endpush
@push('scripts')
<script src="{{asset('js/moment.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script type="text/javascript">
	var calendar;
	var repeatType = [];
	$(document).ready(function() {

		$(".repeat_type").on("change", function(e) {
			switch($(this).val()){
				case "Daily":
					repeatType = [];
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

		var calendarEl = document.getElementById('calendar');
		$("#calendar_loader").slideDown();
		$("#calendar_data").slideUp();
		calendar = new FullCalendar.Calendar(calendarEl, {
			initialView: 'dayGridMonth',
			initialDate: new Date(),
			selectable: true,
			selectMirror: true,
			headerToolbar: {
				left: 'prev,next today',
				center: 'title',
				right: 'dayGridMonth,timeGridWeek,timeGridDay'
			},
			eventSources: [
				{
					events: function(info, successCallback, failureCallback) {
						axios.get('{{url('api/calendar')}}')
						    .then(response => {
								$("#calendar_data").slideDown();
								$("#calendar_loader").slideUp();
						        successCallback(response.data.data)
						    });
					}
				}
			],
			editable: true,
			eventResize: function(info) {
				$("#appointmentResize").data('info', info)
				$("#appointmentResize").modal('show')
			},
			eventDrop: function(info) {
				console.log(info.event.id)
				$("#appointmentReschedule").data('info', info)
				$("#appointmentReschedule").modal('show')
			},
			eventClick: function(info) {
				info.jsEvent.preventDefault();
				$("#appointmentClick").data('info', info)
				$("#viewAppointmentClick").attr('href', info.event.url)
				$("#appointmentClick").modal('show')
			},
			select: function(info) {
				//alert('selected ' + info.startStr + ' to ' + info.endStr);
				$("#appointmentCreate").data('info', info)
				console.log(info)
				$(".start").val(moment(info.start).format("YYYY/MM/DD HH:mm"))
				$(".end").val(moment(info.end).format("YYYY/MM/DD HH:mm"))
				$(".repeat_until").val(null)

				$("#appointmentCreate").modal('show')
			}
		});

		calendar.render();

		$("#saveAppointmentCreate").click(function(e) {
			var info = $("#appointmentCreate").data('info')

			axios.post("{{url('api/calendar')}}", {
					title: $(".appointment_title").val(),
					status: $(".status").val(),
					description: $(".description").val(),
					start: $(".start").val(),
					end: $(".end").val(),
					allday: info.allDay,
					daysofweek: repeatType,
					repeat_type: $(".repeat_type").val(),
					repeat_until: $(".repeat_until").val(),
					mentor: $(".mentor").val(),
					contacts: $(".contacts").val(),
					appointment_type: $(".appointment_type").val(),
					appointment_constraint: $(".appointment_constraint").val(),
					backgroundcolor: $(".appointment_color").val(),
				})
				.then(function(response) {
					calendar.addEvent(response.data.data)
				})
				.catch(function() {
					info.revert()
				})
		})

		$("#deleteAppointmentClick").click(function (e) {
			// do something...
			var info = $("#appointmentClick").data('info')
			$("#appointmentDelete").data('info', info)
			$("#appointmentDelete").modal('show')
		})

		$("#deleteAppointmentDelete").click(function() {
			var info = $("#appointmentDelete").data('info')
			axios.delete('{{url('api/calendar')}}/'+info.event.id)
				.then(function(response) {
					info.event.remove()
					$("#appointmentUpdated").modal('show')
				})
				.catch(function(error) {
					info.revert();
				})
		})

		$("#confirmAppointmentResize").click(function (e) {
			// do something...
			var info = $("#appointmentResize").data('info')
			axios.patch('{{url('api/calendar')}}/'+info.oldEvent.id, {
					resize: info.event
				})
				.then(function(response) {
					$("#appointmentUpdated").modal('show')
				})
				.catch(function(error) {
					info.revert();
				})
		})

		$("#confirmAppointmentReschedule").click(function (e) {
			// do something...
			var info = $("#appointmentReschedule").data('info')
			console.log(info.event)
			axios.patch('{{url('api/calendar')}}/'+info.oldEvent.id, {
					reschedule: info.event
				})
				.then(function(response) {
					$("#appointmentUpdated").modal('show')
				})
				.catch(function(error) {
					info.revert();
				})
		})

		$("#closeAppointmentResize").click(function (e) {
			// do something...
			var info = $("#closeAppointmentClick").data('info')
			info.revert();
		})

		$("#closeAppointmentResize").click(function (e) {
			// do something...
			var info = $("#appointmentResize").data('info')
			info.revert();
		})

		$("#closeAppointmentReschedule").click(function (e) {
			// do something...
			var info = $("#appointmentReschedule").data('info')
			info.revert();
		})
	});
</script>
@endpush