<div class="form-group row">
	<label class="col-sm-4 col-form-label">{{$label}}</label>
	<div class="col-sm-8">
		<select style="width: 100%;" @if(isset($viewmode) && $viewmode != "no") {{$viewmode}} @else name="{{$name}}" @endif class="form-control select2 select2-{{$name}} @isset($class) {{$class}} @endisset" @if(isset($multiple) && $multiple != null) multiple="{{$multiple}}" @endif >
			@isset($selected)
				{{$selected}}
			@endisset
			@isset($options)
				{{$options}}
			@endisset
			@if(isset($dbmodel) && get_class($dbmodel) == "Illuminate\Database\Eloquent\Collection")
				@forelse($dbmodel as $dbrow)
					<option value="{{$dbrow->id}}">@forelse($visible as $vis){{$dbrow->$vis}} @empty @endforelse</option>
    			@empty
    			@endforelse
			@endif
		</select>
	</div>
</div>
@once
	@push('css')
        <link href="{{asset('css/select2.min.css')}}" rel="stylesheet">
        <link href="{{asset('css/select2-bootstrap4.css')}}" rel="stylesheet">
	@endpush
	@push('scripts')
        <script src="{{asset('js/select2.min.js')}}"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				//$('.boot-time').datepicker();
				$('.select2').select2({
					theme: 'bootstrap4'
				});
			})
		</script>
	@endpush
@endonce
@push('scripts')
@endpush