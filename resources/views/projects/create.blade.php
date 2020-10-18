@extends('layouts.index')
@section('content')
	<x-breadcrumb pagename="New Contact" />
	<form action="{{route('projects.store')}}" method="post">
		@csrf()
		<div class="row">
		    <div class="col-md-12">
				<div class="card">
					<div class="card-header">Details</div>
					<div class="card-body">
						<div class="row">
						    <div class="col-md-6">
						    	<x-input name="name" label="Project Name"/>
						    	<x-input name="category" label="Category"/>
						    	<label class="form-label">Description</label>
						    	<textarea class="form-control" name="description"></textarea>
						    </div>
						    <div class="col-md-6">
						    	<div class="card mt-3">
							    	<div class="card-header">Addtional Fields</div>
							    	<div class="card-body">
						    			<x-input-dynamic name="other" label="Other Details"/>
						    		</div>
						    	</div>
						    </div>
						</div>
						<div class="row mt-3">
						    <div class="col-md-6">
						    	<button type="submit" class="btn btn-primary">Save Project</button>
						    </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
@endsection
@push('scripts')

@endpush