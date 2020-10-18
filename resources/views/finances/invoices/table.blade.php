
<table id="invoice" class="table table-sm table-striped table-hover" style="width:100%">
	<thead>
		<tr>
			<th>Invoice No</th>
			<th>Date</th>
			<th>Due Date</th>
			<th>Terms</th>
			<th>Remarks</th>
			<th>Amount</th>
			<th></th>
		</tr>
	</thead>
	<tbody class="table-bordered">
		@forelse($invoices as $invoice)
			<tr>
				<td>{{$invoice->invoice_no}}</td>
				<td>{{$invoice->transaction->date}}</td>
				<td>{{$invoice->due_date}}</td>
				<td>{{$invoice->terms}}</td>
				<td>{{$invoice->transaction->memo}}</td>
				<td>{{$invoice->amount}}</td>
				<td>
					<div class="btn-group dropleft">
						<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Actions
						</button>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="{{url('invoices', $invoice->id)}}">View</a>
							<a class="dropdown-item" href="{{route('invoices.payments.index', ['invoice' => $invoice])}}">View Payments</a>
							<a class="dropdown-item" href="{{route('invoices.payments.create', ['invoice' => $invoice])}}">Add Payment</a>
							<a class="dropdown-item" href="{{url('invoices', $invoice->id)}}/edit">Edit</a>
							<h6 class="dropdown-header">Dangerous Actions</h6>
							<button class="dropdown-item text-danger" type="button">Void Invoice</button>
						</div>
					</div>
				</td>
			</tr>
		@empty
		@endforelse
	</tbody>
</table>
