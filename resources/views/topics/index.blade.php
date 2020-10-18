@extends('layouts.index')
@section('content')
	<x-breadcrumb pagename="Messages" />
	<div class="card">
		<div class="card-header">
			Messages
			<button class="btn btn-primary" type="button" data-toggle="modal" data-target=".bd-example-modal-lg">New Topic</button>
		</div>
		<div class="card-body chatwindow" data-current-topic="">
			<div class="row">
				<div class="col-md-3">
					<input class="form-control" id="search" type="text" placeholder="Search Topics" />
					<div class="list-group topics perfect-scrollbar" style="position: relative; max-height: 360px;">
						
					</div>
				</div>
				<div class="col-md-6	">
					<div class="chats perfect-scrollbar" style="position: relative; max-height: 360px;">
						
					</div>
				</div>
				<div class="col-md-3">
					<div class="card">
                        <div class="card-body perfect-scrollbar" style="position: relative; max-height: 360px;">
                            <div class="card-title topicnamed"></div>
                            <p class="topic_status"></p>
                            <div class="participants_topic">

                            </div>
                        </div>
                    </div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6">
					<textarea class="form-control" id="message_data"></textarea>
					<small>Press Enter to send, Press Shift+Enter for new listen</small>
				</div>
				<div class="col-md-3">
				</div>
			</div>
		</div>
	</div>
@endsection
@push('css')
	<link rel="stylesheet" type="text/css" href="{{asset('css/jquery.dataTables.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/dataTables.bootstrap4.min.css')}}">
@endpush
@push('scripts')
	<script src="{{asset('js/moment.min.js')}}"></script>
	<script src="{{asset('js/plugins/axios.min.js')}}"></script>

	<script type="text/javascript" src="{{asset('js/jquery.dataTables.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/main.js')}}"></script>
	<script type="text/javascript">
		$(document).ready( function () {
			loadTopics(null)

			$("#search").keyup(function() {
				loadTopics($(this).val())
			})

			$(".topics").on("click", ".topic", function() {
				$(".chatwindow").data('current-topic', $(this).data('topicid'))
				getTopic($(this).data('topicid'));
			})

			$("#createTopicBtn").click(function() {
				createTopic()
			})

			$("#message_data").keyup(function(e) {
				var code = e.key; // recommended to use e.key, it's normalized across devices and languages
				switch($(this).val()){
					case '':
					case '\n':
					case '\n\n':
					case '\n\n\n':
							$(this).val('')
						break;

					default:
						if(code==="Enter" && e.shiftKey == false){
		    				e.preventDefault();
		    				if($(".chatwindow").data('current-topic') == ''){
		    					return;
		    				}
		    				createMessage($(".chatwindow").data('current-topic'), $(this).val())
		    				$(this).val('')
		    			}
						break;
				}
			})
		});

		function loadTopics(keyword) {
			// body...
			$(".topics").html($("#topicLoadingTemplate").html())
			console.log(keyword)
			axios.get("{{route('topics.index')}}", {
					params: {
						keyword: keyword	
					}
				})
				.then(function(response) {
					$(".topics").html('')
					response.data.forEach(function(item) {
						addTopicToList(item)
					})
				})
				.catch(function(err) {
					console.log(err)
				})
		}

		//dom update only
		function addTopicToList(item) {
			// body...
			var topicTemplate = $($("#topicTemplate").html())
			topicTemplate.find('h5').html(item.name)
			topicTemplate.data('topicid', item.id)
			topicTemplate.find('.lastMessage').html(item.updated_at_human)
			topicTemplate.find('.lastMessage').data('topicid', item.id)
			switch(item.status){
				case "Pending":
					topicTemplate.find('.status').addClass('badge-warning')
					break
				case "Open":
					topicTemplate.find('.status').addClass('badge-success')
					break
				case "Canceled":
					topicTemplate.find('.status').addClass('badge-danger')
					break
				case "Closed":
					topicTemplate.find('.status').addClass('badge-primary')
					break
			}
			topicTemplate.find('.status').html(item.status)
			$(".topics").prepend($(topicTemplate))
		}

		function createTopic() {
			// body...
			axios.post("{{route('topics.store')}}", {
				topic: $(".topicname").val(),
				type: $(".type").val(),
				status: $(".status_message").val(),
				is_confidential: $(".is_confidential").val(),
				participants: $(".participants").val(),
			})
			.then(function(response) {
				$("#createTopicModel").modal('hide')
				addTopicToList(response.data)
				<x-alert name="createTopicSuccess" title="Topic Created" body="New topic created" />
			})
			.catch(function(error) {
				<x-alert name="createTopicError" title="Topic Creatation Error" body="There was an error creating the topic" />
			})
		}

		function getTopic(topicId) {
			// body...
			axios.get("{{url('api/topics')}}/"+topicId)
			.then(function(response) {
				$(".topicnamed").html(response.data.name)
				$(".topic_status").html(response.data.status)
				$(".participants_topic").html('')
				response.data.users.forEach(function(item) {
					var participant = $($("#participant").html());
					participant.find(".initial").html('AA')
					participant.find(".individual").html(item.fname+' '+item.lname)
					$(".participants_topic").append($(participant))
				})
				loadMessages(topicId)

				Echo.private('topics.'+topicId+'.users')
					.listen('MessageSent', function (e) {
						// body...
						if($(".chatwindow").data('current-topic') == topicId){
							addMessageToChat(e.message)	
						}
						scrollChat()
					});
			})
			.catch(function(error) {
				<x-alert name="getTopicError" title="Topic Error" body="Error selecting topic" />
			})
		}

		function loadMessages(topicId) {
			// body...
			axios.get("{{url('api/topics')}}/" + topicId + "/messages")
			.then(function(response) {
				$(".chats").html('')
				response.data.forEach(function(item) {
					if(item.messageable_type == 'App\\Models\\User' && item.messageable_id == '{{Auth::id()}}'){
						addReplyToChat(item)
					}else{
						addMessageToChat(item)
					}
				})
				scrollChat()
			})
			.catch(function(error) {

			})
		}

		function addReplyToChat(item) {
			// body...
			var replyTemplate = $($("#replyTemplate").html())
			replyTemplate.find(".initial").html(item.initial)
			replyTemplate.find(".name").html(item.messenger_name)
			replyTemplate.find(".time").html(item.time)
			replyTemplate.find(".message").html(item.message)
			$(".chats").append($(replyTemplate))
		}

		function addMessageToChat(item) {
			// body...
			var messageTemplate = $($("#messageTemplate").html())
			messageTemplate.find(".initial").html(item.initial)
			messageTemplate.find(".name").html(item.messenger_name)
			messageTemplate.find(".message").html(item.message)
			messageTemplate.find(".time").html(item.time)
			$(".chats").append($(messageTemplate))
		}

		function createMessage(topicId, message) {
			// body...
			axios.post("{{url('api/topics')}}/" + topicId + "/messages", {
				message_data: message,
				messageable_id: '{{Auth::id()}}',
				messageable_type: 'App\\Models\\User',
			})
			.then(function(response) {
				var item = response.data
				addReplyToChat(item)
				scrollChat()
			})
			.catch(function(error) {

			})
		}

		function scrollChat() {
			// body...
			$(".chats").animate({ scrollTop: $('.chats').prop("scrollHeight")}, 500);
		}

		Echo.private('topics.users.'+'{{Auth::id()}}')
			.listen('TopicCreated', function (e) {
				// body...
				addTopicToList(e.messagetopic)
			});
	</script>
	<script type="text/html" id="topicTemplate">
        <a href="#" class="list-group-item list-group-item-action topic" data-topicid="">
			<div class="d-flex w-100 justify-content-between">
				<h5 class="mb-1"></h5>
				<small><span data-topicid class="lastMessage"></span></small>
			</div>
			<p class="mb-1"></p>
			<small><span class="badge badge-pill p-2 status"></span></small>
		</a>
	</script>
	<script type="text/html" id="topicLoadingTemplate">
        <a href="#" class="list-group-item list-group-item-action topic" data-topicid="">
			<div class="d-flex w-100 justify-content-between">
				<h6 class="mb-1" style="font-style: italic;">Loading</h6>
				<small><span class="lastMessage"></span></small>
			</div>
			<p class="mb-1"></p>
			<small><span class="badge badge-pill m-1 p-2 status"></span></small>
		</a>
	</script>
	<script type="text/html" id="messageTemplate">
		<div class="media mt-4">
			<div class="align-self-center mr-3 d-flex flex-column justify-content-end">
				<button style="width: 50px; height: 50px; font-weight: bold;" type="button" class="btn btn-primary rounded-circle initial"></button>
				<span class="badge badge-light m-2 time"></span>
			</div>
			<div class="media-body">
				<p class="mt-0 name font-weight-bold"></p>
				<p class="message rounded p-2 float-left bg-light"></p>
			</div>
		</div>
	</script>
	<script type="text/html" id="replyTemplate">
		<div class="media mt-4">
			<div class="media-body">
				<p class="mr-3 name text-right font-weight-bold"></p>
				<p class="mr-3 message text-right rounded p-2 float-right bg-light"></p>
			</div>
			<div class="align-self-center mr-3 d-flex flex-column justify-content-end">
				<button style="width: 50px; height: 50px; font-weight: bold;" type="button" class="btn btn-primary rounded-circle initial"></button>
				<span class="badge badge-light m-2 time"></span>
			</div>
		</div>
	</script>
	<script type="text/html" id="participant">
        <div class="mb-4">
        	<button style="width: 20px; height: 20px; font-weight: bold;" type="button" class="btn btn-primary p-0 m-0 rounded-circle initial"></button>
        	<span class="text individual"></span>
        </div>
	</script>
@endpush
@push('models')
	<div class="modal fade bd-example-modal-lg" tabindex="-1" id="createTopicModel" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	    <div class="modal-dialog modal-lg">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h5 class="modal-title">New Topic</h5>
	                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
	            </div>
	            <div class="modal-body">
	                <div class="row">
	                	<div class="col-md-12">
	                		<x-input name="topic" class="topicname" label="Topic"/>
	                		<x-input name="type" class="type" label="Type"/>
	                		<x-select2 name="status_message" class="status_message" label="Status">
	                			<x-slot name="options">
		                			<option value="Pending">Pending</option>
		                			<option value="Open">Open</option>
		                			<option value="Canceled">Canceled</option>
		                			<option value="Closed">Closed</option>
		                		</x-slot>
	                		</x-select2>
	                		<x-select2 name="is_confidential" class="is_confidential" label="Confidential Topic">
	                			<x-slot name="options">
		                			<option value="0">Yes</option>
		                			<option value="1">No</option>
		                		</x-slot>
	                		</x-select2>
	                		<x-select2 name="particpants" class="participants" multiple label="Participants">
	                			<x-slot name="options">
		                			@forelse($users as $user)
		                				<option value="{{$user->id}}">{{$user->fname}} {{$user->lname}}</option>
		                			@empty
		                			@endforelse
		                		</x-slot>
	                		</x-select2>
	                	</div>
	                </div>
	            </div>
	            <div class="modal-footer">
	                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
	                <button class="btn btn-primary ml-2" type="button" id="createTopicBtn">Create Topic</button>
	            </div>
	        </div>
	    </div>
	</div>
@endpush