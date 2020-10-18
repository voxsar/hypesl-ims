@extends('layouts.index')
@section('content')
	<x-breadcrumb pagename="New Invoice" />
	@isset($account)
		<form action="{{route('accounts.subaccounts.store', ['account' => $account])}}" method="post">
	@else
	<form action="{{route('accounts.store')}}" method="post">
	@endisset
		@csrf()
		<div class="row">
		    <div class="col-md-12">
				<div class="card">
					<div class="card-header">Details</div>
					<div class="card-body">
						<div class="row">
						    <div class="col-md-6">
						    	<x-input name="name" label="Account Name" />
						    	<x-select2 name="type" label="Type">
						    		<x-slot name="options">
						    			@isset($account)
						    				<option value="{{$account->type}}">{{$account->type}}</option>
						    			@else
							    			<option value="Income">Income</option>
							    			<option value="Expenses">Expenses</option>
							    			<option value="Equities">Equities</option>
							    			<option value="Assets">Assets</option>
							    			<option value="Liabilities">Liabilities</option>
							    		@endisset
						    		</x-slot>
						    	</x-select2>
						    	<x-select2 name="account_id" label="Parent Account">
						    		<x-slot name="options">
						    			@isset($account)
						    				<option value="{{$account->id}}">{{$account->name}}</option>
						    			@else
						    				<option value="null">No Parent Account</option>
							    			@forelse($accounts as $account)
							    				<option value="{{$account->id}}">{{$account->name}}</option>
							    			@empty
							    			@endforelse
							    		@endisset
						    		</x-slot>
						    	</x-select2>
					    	</div>
					    </div>
						<div class="row mt-3">
						    <div class="col-md-6">
						    	<button type="submit" class="btn btn-primary">Create Account</button>
						    </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
@endsection