<?php

namespace App\Http\Controllers;

use Auth;

use App\Models\Invoice;
use App\Models\Account;
use App\Models\Journal;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Requests\RequestInvoice;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $invoices = Invoice::all();
        $data = array(
                'invoices' => $invoices,
            );
        return view('finances.invoices.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $invoices = Account::income()->get();
        $data = array(
                'invoices' => $invoices
            );
        return view('finances.invoices.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestInvoice $request)
    {
        //
        $invoice = new Invoice();
        $invoice->invoice_no = $request->invoice_no;
        $invoice->due_date = $request->due_date;
        $invoice->terms = $request->terms;

        $invoice->save();

        $transaction = new Transaction();

        $transaction->date = $request->date;
        $transaction->memo = $request->memo;
        $transaction->transactionable_id = $invoice->id;
        $transaction->transactionable_type = 'App\Models\Invoice';

        $transaction->save();

        //$transaction->amount = $request->amount;

        if($transaction->save()){
            foreach ($request->invoice_dynamic as $invoiceitem) {
                # code...
                $journal = new Journal();
                $journal->memo = $invoiceitem['memo'];
                $journal->credit = $invoiceitem['amount'];
                $journal->account_id = $invoiceitem['account_id'];
                $journal->transaction_id = $transaction->id;
                $journal->save();
            }

            $journal = new Journal();
            $journal->memo = "Credited to A/R";
            $journal->debit = $transaction->credit;
            $journal->account_id = Account::receivable()->id;
            $journal->transaction_id = $transaction->id;
            $journal->save();
        }

        return redirect("invoices");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        //
        $data = array('invoice' => $invoice);
        return view('finances.invoices.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
        $invoices = Invoice::all();
        $data = array(
                'invoices' => $invoices,
                'invoice' => $invoice
            );
        return view('finances.invoices.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(RequestInvoice $request, Invoice $invoice)
    {
        //
        $invoice->invoice_no = $request->invoice_no;
        $invoice->invoice_date = $request->invoice_date;
        $invoice->due_date = $request->due_date;
        $invoice->terms = $request->terms;
        $invoice->amount = $request->amount;
        $invoice->address = $request->address;
        $invoice->remarks = $request->remarks;

        if($invoice->save()){
            if($request->has('invoiceedit_dynamic')){
                foreach ($request->invoiceedit_dynamic as $invoiceitem) {
                    # code...
                    $invoiceItem = InvoiceItem::find($invoiceitem['item_id']);
                    if($invoiceitem['remove'] == 1){
                        $invoiceItem->invoiceable_type = 'App\Models\InvoiceHistory';
                        $invoiceItem->save();
                        continue;
                    }
                    $invoiceItem->description = $invoiceitem['description'];
                    $invoiceItem->line_type = $invoiceitem['type'];
                    $invoiceItem->rate = $invoiceitem['rate'];
                    $invoiceItem->quantity = $invoiceitem['quantity'];
                    $invoiceItem->amount = $invoiceitem['amount'];
                    $invoiceItem->invoiceable_id = $invoice->id;
                    $invoiceItem->invoiceable_type = 'App\Models\Invoice';
                    $invoiceItem->save();
                }
            }
            if($request->has('invoice_dynamic')){
                foreach ($request->invoice_dynamic as $invoiceitem) {
                    # code...
                    $invoiceItem = new InvoiceItem();
                    $invoiceItem->description = $invoiceitem['description'];
                    $invoiceItem->line_type = $invoiceitem['type'];
                    $invoiceItem->rate = $invoiceitem['rate'];
                    $invoiceItem->quantity = $invoiceitem['quantity'];
                    $invoiceItem->amount = $invoiceitem['amount'];
                    $invoiceItem->invoiceable_id = $invoice->id;
                    $invoiceItem->invoiceable_type = 'App\Models\Invoice';
                    $invoiceItem->save();
                }
            }
        }

        return redirect(url("invoices", $invoice->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
