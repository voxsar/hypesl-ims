<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Account;
use App\Models\Journal;
use App\Models\Transaction;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function index(Invoice $invoice)
    {
        //
        $data = array('invoice' => $invoice);
        return view('finances.invoices.payments.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function create(Invoice $invoice)
    {
        //
        $data = array('invoice' => $invoice);
        return view('finances.invoices.payments.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Invoice $invoice)
    {
        //
        $payment = new Payment();
        $payment->payment_no = $request->payment_no;
        $payment->invoice_id = $invoice->id;

        $payment->save();

        $transaction = new Transaction();

        $transaction->date = $request->date;
        $transaction->memo = $request->memo;
        $transaction->transactionable_id = $payment->id;
        $transaction->transactionable_type = 'App\Models\Payment';

        if($transaction->save()){
            $journal = new Journal();
            $journal->memo = "Debited from A/R";
            $journal->debit = $request->amount;
            $journal->account_id = Account::receivable()->id;
            $journal->transaction_id = $transaction->id;
            $journal->save();

            $journal = new Journal();
            $journal->memo = $request->memo;
            $journal->credit = $transaction->debit;
            $journal->account_id = Account::payable()->id;
            $journal->transaction_id = $transaction->id;
            $journal->save();
        }
        return redirect(route('invoices.payments.index', $invoice));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice, Payment $payment)
    {
        //
        $data = array('invoice' => $invoice);
        return view('finances.invoices.payments.edit', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice, Payment $payment)
    {
        //
        $data = array('invoice' => $invoice);
        return view('finances.invoices.payments.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice, Payment $payment)
    {
        //
    }
}
