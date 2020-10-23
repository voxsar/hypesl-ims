@extends('layouts.index')
@section('content')
    <x-breadcrumb pagename="View Invoice" />
    <div class="card">
        <div class="card-body">
            <div class="d-sm-flex mb-5" data-view="print"><span class="m-auto"></span>
                <a href="{{url('invoices', $invoice->id)}}/edit" class="btn btn-primary">Edit Invoice</a>&nbsp;
                <button onclick="window.print()" class="btn btn-primary mb-sm-0 mb-3 print-invoice">Print Invoice</button>&nbsp;
                <a href="{{route('invoices.payments.index', ['invoice' => $invoice])}}" class="btn btn-success mb-sm-0 mb-3 print-invoice">View Payments</a>
            </div>
            <!-- -===== Print Area =======-->
            <div id="print-area">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="font-weight-bold">Invoice Info</h4>
                        <p>{{$invoice->invoice_no}}</p>
                    </div>
                    <div class="col-md-6 text-sm-right">
                        <p><strong>Order status: </strong>Unpaid</p>
                        <p><strong>Order date: </strong>{{$invoice->invoice_date->format('d M, Y')}}</p>
                    </div>
                </div>
                <div class="mt-3 mb-4 border-top"></div>
                <div class="row mb-5">
                    <div class="col-md-6 mb-3 mb-sm-0">
                        <h5 class="font-weight-bold">Bill From</h5>
                        <p>Points Automated Billing</p><span style="white-space: pre-line">
                            
                        </span>
                    </div>
                    <div class="col-md-6 text-sm-right">
                        <h5 class="font-weight-bold">Bill To</h5>
                        <p>Name</p><span style="white-space: pre-line">
                            {{$invoice->address}}
                        </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 table-responsive">
                        <table class="table table-hover mb-4">
                            <thead class="bg-gray-300">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Rate</th>
                                    <th scope="col">Unit</th>
                                    <th scope="col">Cost</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($invoice->transaction->journals as $key => $item)
                                    <tr>
                                        <th scope="row">{{$key}}</th>
                                        <td>{{$item->description}}</td>
                                        <td>{{$item->line_type}}</td>
                                        <td>{{$item->rate}}</td>
                                        <td>{{$item->quantity}}</td>
                                        <td>{{$item->amount}}</td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <div class="invoice-summary">
                            <p>Sub total: <span>{{$invoice->amount}}</span></p>
                            <p>Vat: <span>0</span></p>
                            <h5 class="font-weight-bold">Grand Total: <span>{{$invoice->amount}}</span></h5>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ==== / Print Area =====-->
        </div>
    </div>
@endsection