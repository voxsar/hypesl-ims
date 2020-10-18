@extends('layouts.index')
@section('content')
	<x-breadcrumb pagename="New Invoice" />
	<form action="{{url('invoices')}}" method="post">
		@csrf()
		<div class="row">
		    <div class="col-md-12">
				<div class="card">
					<div class="card-header">Details</div>
					<div class="card-body">
						<div class="row">
						    <div class="col-md-6">
						    	<x-input name="invoice_no" label="Invoice No" :value="$invoices->count()+1" />
						    	<x-datetime name="date" label="Invoice Date" :value="Carbon\Carbon::now()->format('Y/m/d H:i')" />
						    	<x-datetime name="due_date" label="Date Due" :value="Carbon\Carbon::now()->addDays(15)->format('Y/m/d H:i')" />
						    	<x-select2 name="terms" label="Type">
						    		<x-slot name="options">
						    			<option value="15">15 Days</option>
						    			<option value="30">30 Days</option>
						    			<option value="45">45 Days</option>
						    			<option value="Custom">Custom</option>
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
							    	<div class="card-header">Invoice Items</div>
							    	<div class="card-body">
										<div class="row mb-4">
											<div class="col-md-3 offset-md-9">
								    			<button class="btn btn-primary btn-block add_invoice_item" type="button">Add Invoice Item <i class="fa fa-plus"></i></button>
								    		</div>
								    	</div>
							    		<div class="invoice_items">
							    			<div class="row">
							    				<div class="col-md-12">
						    						<x-errors name="invoice_dynamic" />
							    				</div>
							    			</div>
											<div class="row">
												<div class="col-md-4 p-1">
													<p>Memo</p>
												</div>
												<div class="col-md-3 p-1">
													<p>Type</p>
												</div>
												<div class="col-md-1 p-1 text-right">
													<p>Rate</p>
												</div>
												<div class="col-md-1 p-1 text-right">
													<p>Unit</p>
												</div>
												<div class="col-md-2 p-1 text-right">
													<p>Amount</p>
												</div>
											</div>
											
										</div>
										<div class="row mb-4">
											<div class="col-md-5 offset-md-7">
								    			<x-input name="amount" label="Amount" class="total-amount text-right" value="0.0" />
								    		</div>
								    	</div>
							    	</div>
						    	</div>
						    </div>
						</div>
						<div class="row mt-3">
						    <div class="col-md-6">
						    	<button type="submit" class="btn btn-primary">Issue Invoice</button>
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
			$(".add_invoice_item").click(function() {
				var invoice_template = $("#invoice_template").html()

				$(".invoice_items").append(invoice_template)
				
			})

			$(".invoice_items").on("click", ".btn-danger", function() {
				$(this).parent().parent().remove()
			})

			$(".invoice_items").on("keyup", ".quantity,.rate", function() {
				calculateRateQ($(this))
			})

			$(".invoice_items").on("keyup", ".amount", function() {
				calculateAmount($(this))
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

		function calculateAmount(child) {
			// body.../
			var quantity = $(child).parent().parent().find('.quantity').val()
			var amount = $(child).parent().parent().find('.amount').val()
			
			if(!isNaN(amount)){
				rate = amount / quantity
				$(child).parent().parent().find('.rate').val(rate.toFixed(2))
				total()
			}
		}

		function total() {
			var total = 0
			$(".amount").each(function() {
				total += parseFloat($(this).val())
			})
			if(!isNaN(total)){
				$(".total-amount").val(total.toFixed(2))
			}
		}
	</script>

	<script type="text/html" id="invoice_template">
		<div class="row">
			<div class="col-md-4 p-1">
				<textarea name="invoice_dynamic[memo][]" class="form-control"></textarea>
			</div>
			<div class="col-md-3 p-1">
				<select name="invoice_dynamic[account_id][]" class="form-control select2">
					@forelse($invoices as $invoice)
						<option value="{{$invoice->id}}">{{$invoice->name}}</option>
					@empty
					@endforelse
				</select>
			</div>
			<div class="col-md-1 p-1">
				<input name="invoice_dynamic[rate][]" class="rate form-control text-right" value="0.0">
			</div>
			<div class="col-md-1 p-1">
				<input name="invoice_dynamic[quantity][]" class="quantity form-control text-right" value="1">
			</div>
			<div class="col-md-2 p-1">
				<input name="invoice_dynamic[amount][]" class="amount form-control text-right" value="0.0">
			</div>
			<div class="col-md-1 p-1">
				<button class="btn btn-danger"><i class="fa fa-minus"></i></button>
			</div>
		</div>
	</script>
@endpush