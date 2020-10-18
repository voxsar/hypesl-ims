<div class="form-group row">
	@if(isset($label) && $label != '')
		<label class="col-sm-4 col-form-label">{{$label}}</label>
		<div class="col-sm-8">
	@else
	<div class="col-sm-12">
	@endif
		<input @if(isset($viewmode) && $viewmode != "no") {{$viewmode}} @else name="{{$name}}" @endif class="form-control @if(isset($class)) {{$class}} @endif" @isset($type) type="{{$type}}" @else type="text" @endisset placeholder="{{$label}}" 
        @if(isset($value))
        	value="{{old($name, $value)}}"
        @else
        	value="{{old($name)}}"
        @endif />
		<x-errors name="{{$name}}" />
	</div>
</div>