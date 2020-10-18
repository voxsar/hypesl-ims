<div class="form-group row">
	<label class="col-sm-4 col-form-label">{{$label}}</label>
	<div class="col-sm-8">
        <label class="checkbox checkbox-primary">
        	<input type="hidden" @if(isset($viewmode) && $viewmode != "no") {{$viewmode}} @else name="{{$name}}" @endif class="@if(isset($class)) {{$class}} @endif" value="0">
	        <input type="checkbox"  @if(isset($viewmode) && $viewmode != "no") {{$viewmode}} @else name="{{$name}}" @endif class="form-control @if(isset($class)) {{$class}} @endif" 
	        	@if(isset($value))
		        	value="{{old($name, $value)}}"
		        @else
		        	value="{{old($name)}}"
		        @endif
	        	checked="checked" /><span></span><span class="checkmark"></span>
	    </label>
		<x-errors name="{{$name}}" />
	</div>
</div>