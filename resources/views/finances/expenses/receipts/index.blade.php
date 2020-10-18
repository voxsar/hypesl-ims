@extends('layouts.index')
@section('content')
	<x-breadcrumb pagename="Payments" />
	<div class="card">
		<div class="card-header">
			Payments
			<a class="d-inline-flex align-items-end btn btn-primary" href="{{route('payments.create')}}">Add Payment</a>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-12">
					<table id="payment" class="table table-sm table-striped table-hover" style="width:100%">
						<thead>
							<tr>
								<th>Payment No</th>
								<th>Date</th>
								<th>Remarks</th>
								<th>Amount</th>
								<th></th>
							</tr>
						</thead>
						<tbody class="table-bordered">
							@forelse($expense->receipts as $receipt)
								<tr>
									<td>{{$receipt->receipt_no}}</td>
									<td>{{$receipt->transaction->date}}</td>
									<td>{{$receipt->transaction->memo}}</td>
									<td>{{$receipt->amount}}</td>
									<td>
										<div class="btn-group dropleft">
											<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											Actions
											</button>
											<div class="dropdown-menu">
												<a class="dropdown-item" href="{{route('expenses.receipts.show', ['expense' => $expense, 'receipt' => $receipt])}}">View</a>
												<a class="dropdown-item" href="{{route('expenses.receipts.edit', ['expense' => $expense, 'receipt' => $receipt])}}">Edit</a>
												<h6 class="dropdown-header">Dangerous Actions</h6>
												<button class="dropdown-item text-danger" type="button">Void Payment</button>
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
			$('#payment').DataTable({
				responsive: true,
				columnDefs: [
					{ responsivePriority: 1, targets: -1 },
				],
			});
		} );
	</script>
@endpush