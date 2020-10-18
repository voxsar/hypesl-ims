@extends('layouts.index')
@section('content')
	<x-breadcrumb pagename="Edit Invoice" />
	<form action="{{url('invoices', $invoice->id)}}" method="post">
		@csrf()
		@method('PATCH')
		<div class="row">
		    <div class="col-md-12">
				<div class="card">
					<div class="card-header">Details</div>
					<div class="card-body">
						<div class="row">
						    <div class="col-md-6">
						    	<x-input name="invoice_no" label="Invoice No" :value="$invoices->count()+1" />
						    	<x-date name="invoice_date" label="Invoice Date" :value="Carbon\Carbon::now()->format('m/d/Y')" />
						    	<x-date name="due_date" label="Date Due" :value="Carbon\Carbon::now()->addDays(15)->format('m/d/Y')" />
						    	<x-select2 name="terms" label="Type">
						    		<x-slot name="options">
						    			<option value="15">15 Days</option>
						    			<option value="30">30 Days</option>
						    			<option value="45">45 Days</option>
						    			<option value="custom">Custom</option>
						    		</x-slot>
						    	</x-select2>
						    	<x-select2 name="contact" label="Client">
						    		<x-slot name="options">
						    			@forelse($contacts as $contact)
						    				<option value="{{$contact->id}}">{{$contact->fname}} {{$contact->lname}}</option>
						    			@empty
						    			@endforelse
						    		</x-slot>
						    	</x-select2>
						    </div>
						    <div class="col-md-6">
						    	<label class="form-label">Remarks</label>
						    	<textarea class="form-control" name="remarks">{{ old('remarks') }}</textarea>
						    	<x-errors name="remarks" />
						    	<label class="form-label">Address</label>
						    	<textarea class="form-control" name="address">{{ old('address') }}</textarea>
						    	<x-errors name="address" />
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
													<p>Description</p>
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
			                                @forelse($invoice->items as $key => $item)
				                                <div class="row">
													<div class="col-md-4 p-1">
														<input type="hidden" name="invoiceedit_dynamic[item_id][{{$item->id}}]" value="{{$item->id}}">
														<textarea name="invoiceedit_dynamic[description][{{$item->id}}]" class="form-control">{{old("invoiceedit_dynamic.".$item->id.".description", $item->description)}}</textarea>
														<x-errors name="invoiceedit_dynamic.{{$item->id}}.description" />
													</div>
													<div class="col-md-3 p-1">
														<select name="invoiceedit_dynamic[type][{{$item->id}}]" class="form-control select2">
															<option>{{$item->line_type}}</option>
															<option>Service Line</option>
															<option>Discount Line</option>
															<option></option>
														</select>
														<x-errors name="invoiceedit_dynamic.{{$item->id}}.type" />
														<x-errors name="invoiceedit_dynamic.{{$item->id}}.rate" />
														<x-errors name="invoiceedit_dynamic.{{$item->id}}.quantity" />
														<x-errors name="invoiceedit_dynamic.{{$item->id}}.amount" />
													</div>
													<div class="col-md-1 p-1">
														<input name="invoiceedit_dynamic[rate][{{$item->id}}]" class="rate form-control text-right" value="{{old("invoiceedit_dynamic.".$item->id.".rate", $item->rate)}}">
													</div>
													<div class="col-md-1 p-1">
														<input name="invoiceedit_dynamic[quantity][{{$item->id}}]" class="quantity form-control text-right" 
														value='{{old("invoiceedit_dynamic.".$item->id.".quantity", $item->quantity)}}'>
													</div>
													<div class="col-md-2 p-1">
														<input name="invoiceedit_dynamic[amount][{{$item->id}}]" class="amount form-control text-right" value="{{old("invoiceedit_dynamic.".$item->id.".amount", $item->amount)}}">
													</div>
													<div class="col-md-1 p-1">
						                                <label class="checkbox checkbox-danger">
						                                	<input type="hidden" name="invoiceedit_dynamic[remove][{{$item->id}}]" value="1">
						                                    <input type="checkbox" name="invoiceedit_dynamic[remove][{{$item->id}}]" value="0" checked="checked" /><span class="checkmark"></span>
						                                </label>
													</div>
												</div>
			                                @empty
			                                @endforelse
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
				<textarea name="invoice_dynamic[description][]" class="form-control"></textarea>
			</div>
			<div class="col-md-3 p-1">
				<select name="invoice_dynamic[type][]" class="form-control select2">
					<option>Service Line</option>
					<option>Discount Line</option>
					<option></option>
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