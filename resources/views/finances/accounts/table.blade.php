
<table id="account" class="table table-sm table-striped table-hover" style="width:100%">
	<thead>
		<tr>
			<th>Account Name</th>
			<th>Type</th>
			<th></th>
		</tr>
	</thead>
	<tbody class="table-bordered">
		@forelse($accounts as $account)
			<tr>
				<td>{{$account->name}}</td>
				<td>{{$account->type}}</td>
				<td>
					<div class="btn-group dropleft">
						<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Actions
						</button>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="{{url('accounts', $account->id)}}">View</a>
							<a class="dropdown-item" href="{{route("accounts.subaccounts.index", ['account' => $account])}}">View Sub Accounts</a>
							<a class="dropdown-item" href="{{url('accounts', $account->id)}}/edit">Edit</a>
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
