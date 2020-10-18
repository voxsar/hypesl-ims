@extends('layouts.index')
@section('content')
	<x-breadcrumb pagename="New Invoice" />
	<form action="{{route('invoices.payments.store', ['invoice' => $invoice])}}" method="post">
		@csrf()
		<div class="row">
		    <div class="col-md-12">
				<div class="card">
					<div class="card-header">Details</div>
					<div class="card-body">
						<div class="row">
						    <div class="col-md-6">
						    	<x-input name="payment_no" label="Payment No" :value="$invoice->invoice_no.'-'.($invoice->payments->count()+1)" />
						    	<x-date name="date" label="Payment Date" :value="Carbon\Carbon::now()->format('m/d/Y')" />
						    	<label class="col-form-label">Remarks</label>
						    	<textarea class="form-control" name="memo">{{ old('memo') }}</textarea>
						    	<x-errors name="memo" />
						    </div>
						    <div class="col-md-6">
						    	<table class="table">
						    		<thead>
							    		<tr>
							    			<th>Payment No</th>
							    			<th class="text-right">Amount</th>
							    		</tr>
						    		</thead>
						    		<tbody>
								    	@forelse($invoice->payments as $previous_payment)
								    		<tr>
								    			<td>{{$previous_payment->payment_no}}</td>
								    			<td class="text-right">{{$previous_payment->amount}}</td>
								    		</tr>
								    	@empty
								    		<tr>
								    			<td class="text-center" colspan="2">No Previous Payments</td>
								    		</tr>
								    	@endforelse
						    		</tbody>
						    		<tfoot>
						    			<tr>
						    				<td>Total</td>
						    				<td class="text-right">{{$invoice->amount}}</td>
						    			</tr>
						    			<tr>
						    				<td>Total Remaing</td>
						    				<td class="text-right">
						    					{{$invoice->amount - $invoice->payments->sum('amount')}}
						    					<input type="hidden" name="amount" value="{{$invoice->amount - $invoice->payments->sum('amount')}}" class="remaining_amount">
						    				</td>
						    			</tr>
						    			<tr>
						    				<td>Payment</td>
						    				<td class="text-right">
						    					<x-input name="amount" label="Amount" class="text-right amount" value="0.0" />
						    				</td>
						    			</tr>
						    			<tr>
						    				<td>New Balance</td>
						    				<td class="text-right new_balance">
						    					{{$invoice->amount - $invoice->payments->sum('amount')}}
						    				</td>
						    			</tr>
						    		</tfoot>
						    	</table>
						    	
						    	<button type="submit" class="btn btn-primary">Accept Payment</button>
						    </div>
						</div>
						<div class="row mt-3">
						    <div class="col-md-6">
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
			$(".amount").keyup(function() {
				var newBalance = parseFloat($(".remaining_amount").val()) - parseFloat($(this).val())
				$('.new_balance').html(newBalance.toFixed(2))
			})
		})

	</script>

@endpush