@extends('layouts.index')
@section('content')
	<x-breadcrumb pagename="Accounts" />
	<div class="card">
		<div class="card-header">
			Accounts
			<a class="d-inline-flex align-items-end btn btn-primary" href="{{route('transactions.create')}}">Add Transaction</a>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-12">
					<h2 class="text-center">{{$account->name}}</h2>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Debits (Dr)</th>
								<th>Credits (Cr)</th>
							</tr>
						</thead>
						<tbody>
							@if($account->journals()->exists())
								@forelse($account->journals as $journal)
									<tr>
										<td><a href="{{route('transactions.show', $journal->transaction)}}">{{$journal->debit}}</a></td>
										<td><a href="{{route('transactions.show', $journal->transaction)}}">{{$journal->credit}}</a></td>
									</tr>
								@empty
								@endforelse
							@endif
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
			$('#account').DataTable({
				responsive: true,
				columnDefs: [
					{ responsivePriority: 1, targets: -1 },
				],
			});
		} );
	</script>
@endpush