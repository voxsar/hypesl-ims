<div class="{{$name}}-dynamic-container">
	<div class="form-group row">
		<label class="col-sm-4 col-form-label">{{$label}}</label>
		<div class="col-sm-7 mr-0 pr-0">
			<select class='select2 {{$name}}-select2' style="width: 100%;">
				<option value="text">Text</option>
				<option value="email">Email</option>
				<option value="mobile">Mobile</option>
				<option value="longtext">Long Text</option>
			</select>
		</div>
		<div class="col-sm-1 ml-0 pl-0">
			<button type="button" data-trigger="hover" data-toggle="tooltip" data-original-title="Click to add extra field" class="btn btn-primary {{$name}}-click"><i class="fa fa-plus"></i></button>
			<input type="hidden" name="_dynamic[{{$name}}]" value="{{$name}}">
		</div>
	</div>
	@if(isset($value) && is_array($value))
		@forelse($value as $row)
			@switch($row['type'])
				@case('text')
					<div class="form-group row">
						<label class="col-sm-4 col-form-label">{{$row['label']}}</label>
						<div class="col-sm-3 mr-0 pr-0">
							<input type="text" name="{{$name}}[label][]" required="" class="form-control field_title" placeholder="Field Title" value="{{$row['label']}}">
							<input type="hidden" name="{{$name}}[type][]" value="text">
						</div>
						<div class="col-sm-4 m-0 p-0">
							<input @if(isset($viewmode) && $viewmode != "no") {{$viewmode}} @else name="{{$name}}[data][]" @endif class="form-control @if(isset($class)) {{$class}} @endif" @isset($type) type="text" @else type="text" @endisset placeholder="Field Value" value="{{$row['value']}}" />
						</div>
						<div class="col-sm-1 ml-0 pl-0">
							<button type="button" data-trigger="hover" data-toggle="tooltip" data-original-title="Remove Field" class="btn btn-danger field_remove"><i class="fa fa-minus"></i></button>
						</div>
					</div>
					@break
				@case('email')
					<div class="form-group row">
						<label class="col-sm-4 col-form-label">{{$row['label']}}</label>
						<div class="col-sm-3 mr-0 pr-0">
							<input type="text" name="{{$name}}[label][]" required="" class="form-control field_title" placeholder="Field Title" value="{{$row['label']}}">
							<input type="hidden" name="{{$name}}[type][]" value="email">
						</div>
						<div class="col-sm-4 m-0 p-0">
							<input @if(isset($viewmode) && $viewmode != "no") {{$viewmode}} @else name="{{$name}}[data][]" @endif class="form-control @if(isset($class)) {{$class}} @endif" @isset($type) type="text" @else type="email" @endisset placeholder="Field Value" value="{{$row['value']}}" />
						</div>
						<div class="col-sm-1 ml-0 pl-0">
							<button type="button" data-trigger="hover" data-toggle="tooltip" data-original-title="Remove Field" class="btn btn-danger field_remove"><i class="fa fa-minus"></i></button>
						</div>
					</div>
					@break
				@case('tel')
					<div class="form-group row">
						<label class="col-sm-4 col-form-label">{{$row['label']}}</label>
						<div class="col-sm-3 mr-0 pr-0">
							<input type="text" name="{{$name}}[label][]" required="" class="form-control field_title" placeholder="Field Title" value="{{$row['label']}}">
							<input type="hidden" name="{{$name}}[type][]" value="tel">
						</div>
						<div class="col-sm-4 m-0 p-0">
							<input @if(isset($viewmode) && $viewmode != "no") {{$viewmode}} @else name="{{$name}}[data][]" @endif class="form-control @if(isset($class)) {{$class}} @endif" @isset($type) type="text" @else type="tel" @endisset placeholder="Field Value" value="{{$row['value']}}" />
						</div>
						<div class="col-sm-1 ml-0 pl-0">
							<button type="button" data-trigger="hover" data-toggle="tooltip" data-original-title="Remove Field" class="btn btn-danger field_remove"><i class="fa fa-minus"></i></button>
						</div>
					</div>
					@break
				@case('textarea')
					<div class="form-group row">
						<label class="col-sm-4 col-form-label">{{$row['label']}}</label>
						<div class="col-sm-3 mr-0 pr-0">
							<input type="text" name="{{$name}}[label][]" required="" class="form-control field_title" placeholder="Field Title" value="{{$row['label']}}">
							<input type="hidden" name="{{$name}}[type][]" value="textarea">
						</div>
						<div class="col-sm-4 m-0 p-0">
							<textarea @if(isset($viewmode) && $viewmode != "no") {{$viewmode}} @else name="{{$name}}[data][]" @endif class="form-control @if(isset($class)) {{$class}} @endif" required="" placeholder="{{$label}}">{{$row['value']}}</textarea>
						</div>
						<div class="col-sm-1 ml-0 pl-0">
							<button type="button" data-trigger="hover" data-toggle="tooltip" data-original-title="Remove Field" class="btn btn-danger field_remove"><i class="fa fa-minus"></i></button>
						</div>
					</div>
					@break
			@endswitch
		@empty
		@endforelse
	@endisset
</div>
@once
    @push('css')
        <link rel="stylesheet" href="{{asset('css/select2.min.css')}}" />
        <link rel="stylesheet" href="{{asset('css/select2-bootstrap4.css')}}" />
    @endpush
    @push('scripts')
        <script src="{{asset('js/select2.min.js')}}"></script>
    @endpush
@endonce
@push('scripts')
	<script type="text/javascript"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$(".{{$name}}-select2").select2({
				theme: 'bootstrap4'
			});

			$('[data-toggle="tooltip"]').tooltip();

			$(".{{$name}}-click").click(function() {
				switch($(".{{$name}}-select2").val()){
					case "text":
						$(".{{$name}}-dynamic-container").append($("#{{$name}}-template-text").html());
						break;
					case "email":
						$(".{{$name}}-dynamic-container").append($("#{{$name}}-template-email").html());
						break;
					case "mobile":
						$(".{{$name}}-dynamic-container").append($("#{{$name}}-template-mobile").html());
						break;
					case "longtext":
						$(".{{$name}}-dynamic-container").append($("#{{$name}}-template-longtext").html());
						break;
				}
			});

			$(".{{$name}}-dynamic-container").on("keyup", ".field_title", function() {
				$(this).parent().parent().find(".col-form-label").html($(this).val())
			})

			$(".{{$name}}-dynamic-container").on("keyup", ".field_title", function() {
				$(this).parent().parent().find(".col-form-label").html($(this).val())
			})

			$(".{{$name}}-dynamic-container").on("click", ".field_remove", function() {
				$(this).parent().parent().remove()
			})
		})
	</script>

	<script id="{{$name}}-template-text" type="text/html">
		<div class="form-group row">
			<label class="col-sm-4 col-form-label">{{$label}}</label>
			<div class="col-sm-3 mr-0 pr-0">
				<input type="text" name="{{$name}}[label][]" required="" class="form-control field_title" placeholder="Field Title">
				<input type="hidden" name="{{$name}}[type][]" value="text">
			</div>
			<div class="col-sm-4 m-0 p-0">
				<input @if(isset($viewmode) && $viewmode != "no") {{$viewmode}} @else name="{{$name}}[data][]" @endif class="form-control @if(isset($class)) {{$class}} @endif" @isset($type) type="text" @else type="text" @endisset placeholder="Field Value" />
			</div>
			<div class="col-sm-1 ml-0 pl-0">
				<button type="button" data-trigger="hover" data-toggle="tooltip" data-original-title="Remove Field" class="btn btn-danger field_remove"><i class="fa fa-minus"></i></button>
			</div>
		</div>
	</script>

	<script id="{{$name}}-template-email" type="text/html">
		<div class="form-group row">
			<label class="col-sm-4 col-form-label">{{$label}}</label>
			<div class="col-sm-3 mr-0 pr-0">
				<input type="text" name="{{$name}}[label][]" required="" class="form-control field_title" placeholder="Field Title">
				<input type="hidden" name="{{$name}}[type][]" value="email">
			</div>
			<div class="col-sm-4 m-0 p-0">
				<input @if(isset($viewmode) && $viewmode != "no") {{$viewmode}} @else name="{{$name}}[data][]" @endif class="form-control @if(isset($class)) {{$class}} @endif" type="email" required="" placeholder="{{$label}}" />
			</div>
			<div class="col-sm-1 ml-0 pl-0">
				<button type="button" data-trigger="hover" data-toggle="tooltip" data-original-title="Remove Field" class="btn btn-danger field_remove"><i class="fa fa-minus"></i></button>
			</div>
		</div>
	</script>

	<script id="{{$name}}-template-mobile" type="text/html">
		<div class="form-group row">
			<label class="col-sm-4 col-form-label">{{$label}}</label>
			<div class="col-sm-3 mr-0 pr-0">
				<input type="text" name="{{$name}}[label][]" required="" class="form-control field_title" placeholder="Field Title">
				<input type="hidden" name="{{$name}}[type][]" value="tel">
			</div>
			<div class="col-sm-4 m-0 p-0">
				<input @if(isset($viewmode) && $viewmode != "no") {{$viewmode}} @else name="{{$name}}[data][]" @endif class="form-control @if(isset($class)) {{$class}} @endif" type="tel" required="" placeholder="{{$label}}" />
			</div>
			<div class="col-sm-1 ml-0 pl-0">
				<button type="button" data-trigger="hover" data-toggle="tooltip" data-original-title="Remove Field" class="btn btn-danger field_remove"><i class="fa fa-minus"></i></button>
			</div>
		</div>
	</script>

	<script id="{{$name}}-template-longtext" type="text/html">
		<div class="form-group row">
			<label class="col-sm-4 col-form-label">{{$label}}</label>
			<div class="col-sm-3 mr-0 pr-0">
				<input type="text" name="{{$name}}[label][]" required="" class="form-control field_title" placeholder="Field Title">
				<input type="hidden" name="{{$name}}[type][]" value="textarea">
			</div>
			<div class="col-sm-4 m-0 p-0">
				<textarea @if(isset($viewmode) && $viewmode != "no") {{$viewmode}} @else name="{{$name}}[data][]" @endif class="form-control @if(isset($class)) {{$class}} @endif" required="" placeholder="{{$label}}"></textarea>
			</div>
			<div class="col-sm-1 ml-0 pl-0">
				<button type="button" data-trigger="hover" data-toggle="tooltip" data-original-title="Remove Field" class="btn btn-danger field_remove"><i class="fa fa-minus"></i></button>
			</div>
		</div>
	</script>
@endpush