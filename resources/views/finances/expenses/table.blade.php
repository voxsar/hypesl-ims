
<table id="invoice" class="table table-sm table-striped table-hover" style="width:100%">
	<thead>
		<tr>
			<th>Expense No</th>
			<th>Date</th>
			<th>Due Date</th>
			<th>Terms</th>
			<th>Remarks</th>
			<th>Amount</th>
			<th></th>
		</tr>
	</thead>
	<tbody class="table-bordered">
		@forelse($expenses as $expense)
			<tr>
				<td>{{$expense->expense_no}}</td>
				<td>{{$expense->transaction->date}}</td>
				<td>{{$expense->due_date}}</td>
				<td>{{$expense->terms}}</td>
				<td>{{$expense->transaction->memo}}</td>
				<td>{{$expense->amount}}</td>
				<td>
					<div class="btn-group dropleft">
						<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Actions
						</button>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="{{url('expenses', $expense->id)}}">View</a>
							<a class="dropdown-item" href="{{route('expenses.receipts.index', ['expense' => $expense])}}">View Receipts</a>
							<a class="dropdown-item" href="{{route('expenses.receipts.create', ['expense' => $expense])}}">Add Receipt</a>
							<a class="dropdown-item" href="{{url('expenses', $expense->id)}}/edit">Edit</a>
							<h6 class="dropdown-header">Dangerous Actions</h6>
							<button class="dropdown-item text-danger" type="button">Void Expense</button>
						</div>
					</div>
				</td>
			</tr>
		@empty
		@endforelse
	</tbody>
</table>
