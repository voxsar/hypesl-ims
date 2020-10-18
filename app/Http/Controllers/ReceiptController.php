<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Receipt;
use App\Models\Account;
use App\Models\Journal;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function index(Expense $expense)
    {
        //
        $data = array('expense' => $expense);
        return view('finances.expenses.receipts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function create(Expense $expense)
    {
        //
        $data = array('expense' => $expense);
        return view('finances.expenses.receipts.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Expense $expense)
    {
        //
        $receipt = new Receipt();
        $receipt->receipt_no = $request->receipt_no;
        $receipt->expense_id = $expense->id;

        $receipt->save();

        $transaction = new Transaction();

        $transaction->date = $request->date;
        $transaction->memo = $request->memo;
        $transaction->transactionable_id = $receipt->id;
        $transaction->transactionable_type = 'App\Models\Receipt';

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
        return redirect(route('expenses.receipts.index', $expense));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @param  \App\Models\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense, Receipt $receipt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @param  \App\Models\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense, Receipt $receipt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expense  $expense
     * @param  \App\Models\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense, Receipt $receipt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expense
     * @param  \App\Models\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense, Receipt $receipt)
    {
        //
    }
}
