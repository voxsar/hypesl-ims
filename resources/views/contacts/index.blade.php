@extends('layouts.index')
@section('content')
	<x-breadcrumb pagename="Contacts" />
	<div class="card">
		<div class="card-header">Contacts</div>
		<div class="card-body">
			<div class="row">
			    <div class="col-md-12">
			    	<table id="example" class="table table-sm table-striped table-hover" style="width:100%">
			    		<thead>
			    			<tr>
			    				<th>First Name</th>
			    				<th>Last Name</th>
			    				<th>Other Name</th>
			    				<th>Mobile</th>
			    				<th>Email</th>
			    				<th>Organization</th>
			    				<th></th>
			    			</tr>
			    		</thead>
			    		<tbody class="table-bordered">
			    			@forelse($contacts as $contact)
				    			<tr>
				    				<td>{{$contact->fname}}</td>
				    				<td>{{$contact->lname}}</td>
				    				<td>{{$contact->oname}}</td>
				    				<td>{{$contact->mobile}}</td>
				    				<td>{{$contact->email}}</td>
				    				<td>{{$contact->organization}}</td>
				    				<td>
										<div class="btn-group dropleft">
											<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											Actions
											</button>
											<div class="dropdown-menu">
												<a class="dropdown-item" href="{{url('contacts', $contact->id)}}">View</a>
												<a class="dropdown-item" href="{{url('contacts', $contact->id)}}/edit">Edit</a>
												<h6 class="dropdown-header">Dangerous Actions</h6>
												<button class="dropdown-item text-danger" type="button">Delete</button>
											</div>
										</div>
				    				</td>
				    			</tr>
			    			@empty
			    			@endforelse
			    		</tbody>
			    	</table>
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
	<script type="text/javascript" src="{{asset('js/jquery.dataTables.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>
	<script type="text/javascript">
		$(document).ready( function () {
		    $('#example').DataTable({
		    	responsive: true,
			    columnDefs: [
			        { responsivePriority: 1, targets: -1 },
			    ],
		    });
		} );
	</script>
@endpush