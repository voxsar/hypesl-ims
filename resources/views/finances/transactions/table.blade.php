
<table id="invoice" class="table table-sm table-striped table-hover" style="width:100%">
	<thead>
		<tr>
			<th>Transaction No</th>
			<th>Transaction Type</th>
			<th>Date</th>
			<th>Remarks</th>
			<th>Amount</th>
			<th></th>
		</tr>
	</thead>
	<tbody class="table-bordered">
		@forelse($transactions as $transaction)
			<tr>
				<td>{{$transaction->id}}</td>
				<td>{{$transaction->type}}</td>
				<td>{{$transaction->date}}</td>
				<td>{{$transaction->memo}}</td>
				<td>{{$transaction->amount}}</td>
				<td>
					<div class="btn-group dropleft">
						<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Actions
						</button>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="{{url('transactions', $transaction->id)}}">View</a>
							<a class="dropdown-item" href="{{route('transactions.journals.index', ['transaction' => $transaction])}}">View Jounal Entries</a>>
							<h6 class="dropdown-header">Dangerous Actions</h6>
							<button class="dropdown-item text-danger" type="button">Void Transaction</button>
						</div>
					</div>
				</td>
			</tr>
		@empty
		@endforelse
	</tbody>
</table>
