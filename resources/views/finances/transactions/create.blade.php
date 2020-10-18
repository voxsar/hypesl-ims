@extends('layouts.index')
@section('content')
	<x-breadcrumb pagename="New Transaction" />
	<form action="{{route('transactions.store')}}" method="post">
		@csrf()
		<div class="row">
		    <div class="col-md-12">
				<div class="card">
					<div class="card-header">Details</div>
					<div class="card-body">
						<div class="row">
						    <div class="col-md-6">
						    	<x-datetime name="date" label="Transaction Date" :value="Carbon\Carbon::now()->format('Y/m/d H:i')" />
						    	<x-select2 name="type" label="Type">
						    		<x-slot name="options">
						    			<option value="App\Models\Error">Error Correction</option>
						    			<option value="App\Models\Tax">Tax</option>
						    			<option value="App\Models\Other">Other Transaction</option>
						    			<option value="App\Models\Invoice">Invoice</option>
						    			<option value="App\Models\Payment">Payment</option>
						    			<option value="App\Models\Expense">Expense</option>
						    			<option value="App\Models\Receipt">Receipt</option>
						    		</x-slot>
						    	</x-select2>
						    </div>
						    <div class="col-md-6">
						    	<label class="form-label">Memo</label>
						    	<textarea class="form-control" name="memo">{{ old('memo') }}</textarea>
						    	<x-errors name="memo" />
						    </div>
						</div>
						<div class="row">
						    <div class="col-md-12">
						    	<div class="card">
							    	<div class="card-header">Journal Items</div>
							    	<div class="card-body">
										<div class="row mb-4">
											<div class="col-md-2">
								    			<button class="btn btn-primary btn-block add_income_item" type="button">Income Item <i class="fa fa-plus"></i></button>
								    		</div>
											<div class="col-md-2">
								    			<button class="btn btn-primary btn-block add_expense_item" type="button">Expense Item <i class="fa fa-plus"></i></button>
								    		</div>
											<div class="col-md-2">
								    			<button class="btn btn-primary btn-block add_asset_item" type="button">Asset Item <i class="fa fa-plus"></i></button>
								    		</div>
											<div class="col-md-2">
								    			<button class="btn btn-primary btn-block add_equity_item" type="button">Equity Item <i class="fa fa-plus"></i></button>
								    		</div>
											<div class="col-md-2">
								    			<button class="btn btn-primary btn-block add_liability_item" type="button">Liability Item <i class="fa fa-plus"></i></button>
								    		</div>
								    	</div>
							    		<div class="journal_items">
							    			<div class="row">
							    				<div class="col-md-12">
						    						<x-errors name="income_dynamic" />
						    						<x-errors name="expense_dynamic" />
						    						<x-errors name="asset_dynamic" />
						    						<x-errors name="equity_dynamic" />
						    						<x-errors name="liability_dynamic" />
							    				</div>
							    			</div>
											<div class="row">
												<div class="col-md-4 p-1">
													<p>Memo</p>
												</div>
												<div class="col-md-3 p-1">
													<p>Type</p>
												</div>
												<div class="col-md-2 p-1 text-right">
													<p>Credit</p>
												</div>
												<div class="col-md-2 p-1 text-right">
													<p>Debit</p>
												</div>
											</div>
											
										</div>
										<div class="row">
											<div class="col-md-2 offset-md-7 p-1">
								    			<x-input name="credit" class="credit-amount text-right" value="0.0" />
								    		</div>
											<div class="col-md-2 dp-1">
								    			<x-input name="debit" class="debit-amount text-right" value="0.0" />
								    		</div>
								    	</div>
							    	</div>
						    	</div>
						    </div>
						</div>
						<div class="row mt-3">
						    <div class="col-md-6">
						    	<button type="submit" class="btn btn-primary">Add Transaction</button>
						    </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
@endsection
@push('scripts')
	<script type="text/javascript">
		$(document).ready(function() {
			$(".add_income_item").click(function() {
				var income_template = $("#income_template").html()
				$(".journal_items").append(income_template)
			})
			$(".add_expense_item").click(function() {
				var expense_template = $("#expense_template").html()
				$(".journal_items").append(expense_template)
			})
			$(".add_asset_item").click(function() {
				var asset_template = $("#asset_template").html()
				$(".journal_items").append(asset_template)
			})
			$(".add_equity_item").click(function() {
				var equity_template = $("#equity_template").html()
				$(".journal_items").append(equity_template)
			})
			$(".add_liability_item").click(function() {
				var liability_template = $("#liability_template").html()
				$(".journal_items").append(liability_template)
			})

			$(".journal_items").on("click", ".btn-danger", function() {
				$(this).parent().parent().remove()
			})

			$(".journal_items").on("keyup", ".credit", function() {
				calculateCredit($(this))
				calculateDebit($(this))
			})

			$(".journal_items").on("keyup", ".debit", function() {
				calculateCredit($(this))
				calculateDebit($(this))
			})
		})

		function calculateRateQ(child) {
			// body...
			var rate = $(child).parent().parent().find('.rate').val()
			var quantity = $(child).parent().parent().find('.quantity').val()
			var amount = $(child).parent().parent().find('.amount').val()
			
			if(!isNaN(quantity) && !isNaN(rate)){
				amount = quantity * rate
				$(child).parent().parent().find('.amount').val(amount.toFixed(2))
				total()
			}
		}

		function calculateCredit(child) {
			// body.../
			var quantity = $(child).parent().parent().find('.quantity').val()
			var amount = $(child).parent().parent().find('.credit').val()
			
			if(!isNaN(amount)){
				rate = amount / quantity
				$(child).parent().parent().find('.rate').val(rate.toFixed(2))
				creditTotal()
			}
		}

		function calculateDebit(child) {
			// body.../
			var quantity = $(child).parent().parent().find('.quantity').val()
			var amount = $(child).parent().parent().find('.debit').val()
			
			if(!isNaN(amount)){
				rate = amount / quantity
				$(child).parent().parent().find('.rate').val(rate.toFixed(2))
				debitTotal()
			}
		}

		function creditTotal() {
			var total = 0
			$(".credit").each(function() {
				total += parseFloat($(this).val())
			})
			if(!isNaN(total)){
				$(".credit-amount").val(total.toFixed(2))
			}
		}

		function debitTotal() {
			var total = 0
			$(".debit").each(function() {
				total += parseFloat($(this).val())
			})
			if(!isNaN(total)){
				$(".debit-amount").val(total.toFixed(2))
			}
		}
	</script>

	<script type="text/html" id="income_template">
		<div class="row">
			<div class="col-md-4 p-1">
				<textarea name="income_dynamic[memo][]" class="form-control"></textarea>
			</div>
			<div class="col-md-3 p-1">
				<select name="income_dynamic[account_id][]" class="form-control select2">
					@forelse($incomes as $income)
						<option value="{{$income->id}}">{{$income->name}}</option>
					@empty
					@endforelse
				</select>
			</div>
			<div class="col-md-2 p-1">
				<input name="income_dynamic[credit][]" class="credit form-control text-right" value="0.0">
			</div>
			<div class="col-md-2 p-1">
				<input name="income_dynamic[debit][]" class="debit form-control text-right" value="0.0">
			</div>
			<div class="col-md-1 p-1">
				<button class="btn btn-danger"><i class="fa fa-minus"></i></button>
			</div>
		</div>
	</script>

	<script type="text/html" id="expense_template">
		<div class="row">
			<div class="col-md-4 p-1">
				<textarea name="expense_dynamic[memo][]" class="form-control"></textarea>
			</div>
			<div class="col-md-3 p-1">
				<select name="expense_dynamic[account_id][]" class="form-control select2">
					@forelse($expenses as $expense)
						<option value="{{$expense->id}}">{{$expense->name}}</option>
					@empty
					@endforelse
				</select>
			</div>
			<div class="col-md-2 p-1">
				<input name="expense_dynamic[credit][]" class="credit form-control text-right" value="0.0">
			</div>
			<div class="col-md-2 p-1">
				<input name="expense_dynamic[debit][]" class="debit form-control text-right" value="0.0">
			</div>
			<div class="col-md-1 p-1">
				<button class="btn btn-danger"><i class="fa fa-minus"></i></button>
			</div>
		</div>
	</script>

	<script type="text/html" id="asset_template">
		<div class="row">
			<div class="col-md-4 p-1">
				<textarea name="asset_dynamic[memo][]" class="form-control"></textarea>
			</div>
			<div class="col-md-3 p-1">
				<select name="asset_dynamic[account_id][]" class="form-control select2">
					@forelse($assets as $asset)
						<option value="{{$asset->id}}">{{$asset->name}}</option>
					@empty
					@endforelse
				</select>
			</div>
			<div class="col-md-2 p-1">
				<input name="asset_dynamic[credit][]" class="credit form-control text-right" value="0.0">
			</div>
			<div class="col-md-2 p-1">
				<input name="asset_dynamic[debit][]" class="debit form-control text-right" value="0.0">
			</div>
			<div class="col-md-1 p-1">
				<button class="btn btn-danger"><i class="fa fa-minus"></i></button>
			</div>
		</div>
	</script>

	<script type="text/html" id="equity_template">
		<div class="row">
			<div class="col-md-4 p-1">
				<textarea name="equity_dynamic[memo][]" class="form-control"></textarea>
			</div>
			<div class="col-md-3 p-1">
				<select name="equity_dynamic[account_id][]" class="form-control select2">
					@forelse($equities as $equity)
						<option value="{{$equity->id}}">{{$equity->name}}</option>
					@empty
					@endforelse
				</select>
			</div>
			<div class="col-md-2 p-1">
				<input name="equity_dynamic[credit][]" class="credit form-control text-right" value="0.0">
			</div>
			<div class="col-md-2 p-1">
				<input name="equity_dynamic[debit][]" class="debit form-control text-right" value="0.0">
			</div>
			<div class="col-md-1 p-1">
				<button class="btn btn-danger"><i class="fa fa-minus"></i></button>
			</div>
		</div>
	</script>

	<script type="text/html" id="liability_template">
		<div class="row">
			<div class="col-md-4 p-1">
				<textarea name="liability_dynamic[memo][]" class="form-control"></textarea>
			</div>
			<div class="col-md-3 p-1">
				<select name="liability_dynamic[account_id][]" class="form-control select2">
					@forelse($liabilities as $liability)
						<option value="{{$liability->id}}">{{$liability->name}}</option>
					@empty
					@endforelse
				</select>
			</div>
			<div class="col-md-2 p-1">
				<input name="liability_dynamic[credit][]" class="credit form-control text-right" value="0.0">
			</div>
			<div class="col-md-2 p-1">
				<input name="liability_dynamic[debit][]" class="debit form-control text-right" value="0.0">
			</div>
			<div class="col-md-1 p-1">
				<button class="btn btn-danger"><i class="fa fa-minus"></i></button>
			</div>
		</div>
	</script>
@endpush