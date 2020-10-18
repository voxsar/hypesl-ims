@extends('layouts.index')
@section('content')
	<x-breadcrumb pagename="Accounts | Sub Accounts" />
	<div class="card">
		<div class="card-header">
			Sub Accounts of {{$account->name}}
			<a class="d-inline-flex align-items-end btn btn-primary" href="{{route('accounts.subaccounts.create', ['account' => $account])}}">Add Sub Account</a>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-12">
					@include("finances.accounts.table", ["accounts" => $account->subaccounts])
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
			$('#account').DataTable({
				responsive: true,
				columnDefs: [
					{ responsivePriority: 1, targets: -1 },
				],
			});
		} );
	</script>
@endpush