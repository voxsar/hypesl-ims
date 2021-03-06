@extends('layouts.index')
@section('content')
	<x-breadcrumb pagename="Invoices" />
	<div class="card">
		<div class="card-header">
			Invoices
			<a class="d-inline-flex align-items-end btn btn-primary" href="{{route('invoices.create')}}">Add Invoice</a>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-12">
					@include("finances.invoices.table", ["invoices" => $invoices])
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
			$('#invoice').DataTable({
				responsive: true,
				columnDefs: [
					{ responsivePriority: 1, targets: -1 },
				],
			});
		} );
	</script>
@endpush