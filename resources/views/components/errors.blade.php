@isset($name)
	@error($name)
		<div class="alert alert-danger" role="alert">
			{{ $message }}
		    <button class="close" type="button" data-dismiss="alert" aria-label="Close">
		    	<span aria-hidden="true">&times;</span>
		    </button>
		</div>
	@enderror
@endisset