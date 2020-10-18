@extends('layouts.index')
@section('content')
	<x-breadcrumb pagename="Payments" />
	<div class="card">
		<div class="card-header">
			Payments
			<a class="d-inline-flex align-items-end btn btn-primary" href="{{route('invoices.payments.create', ['invoice' => $invoice])}}">Add Payment</a>
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
							@forelse($invoice->payments as $payment)
								<tr>
									<td>{{$payment->payment_no}}</td>
									<td>{{$payment->transaction->date}}</td>
									<td>{{$payment->transaction->memo}}</td>
									<td>{{$payment->amount}}</td>
									<td>
										<div class="btn-group dropleft">
											<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											Actions
											</button>
											<div class="dropdown-menu">
												<a class="dropdown-item" href="{{route('invoices.payments.show', ['invoice' => $invoice, 'payment' => $payment])}}">View</a>
												<a class="dropdown-item" href="{{route('invoices.payments.edit', ['invoice' => $invoice, 'payment' => $payment])}}">Edit</a>
												<h6 class="dropdown-header">Dangerous Actions</h6>
												<button class="dropdown-item text-danger" type="button">Void Payment</button>
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
			$('#payment').DataTable({
				responsive: true,
				columnDefs: [
					{ responsivePriority: 1, targets: -1 },
				],
			});
		} );
	</script>
@endpush