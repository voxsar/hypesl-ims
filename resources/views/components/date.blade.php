<div class="form-group row">
	<label class="col-sm-4 col-form-label">{{$label}}</label>
	<div class="col-sm-8">
		<div class="input-group mb-3">
		    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-calendar" id="basic-addon1"></i></span></div>
		    <input @isset($disabled){{$disabled}}@endisset name="{{$name}}" type="text" placeholder="{{$label}}" aria-label="{{$label}}" class="form-control boot-date @if(isset($class)) {{$class}} @endif"
		    @if(isset($value))
	        	value="{{old($name, $value)}}"
	        @else
	        	value="{{old($name)}}"
	        @endif />
		</div>
		<x-errors name="{{$name}}" />
	</div>
</div>
@once
	@push('css')
    	<link href="{{asset('css/tempusdominus-bootstrap-4.min.css')}}" rel="stylesheet">
	@endpush
	@push('scripts')
		<script src="{{asset('js/tempusdominus-bootstrap-4.min.js')}}"></script>
	@endpush
@endonce
@push('scripts')
	<script type="text/javascript">
		$(document).ready(function() {
			$('.boot-date').datetimepicker({
				timepicker:false,
				format: 'Y/m/d',
 				mask:true,
			});
		})
	</script>
@endpush