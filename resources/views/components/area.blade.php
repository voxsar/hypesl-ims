<div class="form-group row">
	<label class="col-sm-4 col-form-label">{{$label}}</label>
	<div class="col-sm-8">
		<div class="border border-dark rounded" id="editor_{{$name}}">@if(isset($value))
				{!!old($name, $value)!!}
			@else
				{!!old($name)!!}
			@endif</div>
		<textarea style="display: none;" @if(isset($viewmode) && $viewmode != "no") {{$viewmode}} @else name="{{$name}}" @endif placeholder="{{$label}}" id="editor_text_{{$name}}" class="form-control @if(isset($class)) {{$class}} @endif" >
			@if(isset($value))
				{{old($name, $value)}}
			@else
				{{old($name)}}
			@endif
		</textarea>

		<x-errors name="{{$name}}" />
	</div>
</div>
@once
	@push('scripts')
		<script src="https://cdn.ckeditor.com/ckeditor5/22.0.0/balloon/ckeditor.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				 BalloonEditor
					.create( document.querySelector( '#editor_{{$name}}' ) )
					.then( editor => {
						console.log( editor );

						editor.model.document.on( 'change:data', () => {
							console.log(editor.getData())
							$("#editor_text_{{$name}}").val(editor.getData())
						});
					})
					.catch( error => {
						console.error( error );
					});
			})
		</script>
	@endpush
@endonce