<?php

namespace App\Http\Controllers;

use Auth;

use App\Models\Expense;
use App\Models\Account;
use App\Models\Journal;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $expenses = Expense::all();
        $data = array(
                'expenses' => $expenses,
            );
        return view('finances.expenses.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $expenses = Account::expenses()->get();
        $data = array(
                'expenses' => $expenses
            );
        return view('finances.expenses.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $expense = new Expense();
        $expense->expense_no = $request->expense_no;
        $expense->due_date = $request->due_date;
        $expense->terms = $request->terms;

        $expense->save();

        $transaction = new Transaction();

        $transaction->date = $request->date;
        $transaction->memo = $request->memo;
        $transaction->transactionable_id = $expense->id;
        $transaction->transactionable_type = 'App\Models\Expense';

        $transaction->save();

        //$transaction->amount = $request->amount;

        if($transaction->save()){
            foreach ($request->invoice_dynamic as $invoiceitem) {
                # code...
                $journal = new Journal();
                $journal->memo = $invoiceitem['memo'];
                $journal->debit = $invoiceitem['amount'];
                $journal->account_id = $invoiceitem['account_id'];
                $journal->transaction_id = $transaction->id;
                $journal->save();
            }

            $journal = new Journal();
            $journal->memo = "Credited to A/P";
            $journal->credit = $transaction->debit;
            $journal->account_id = Account::receivable()->id;
            $journal->transaction_id = $transaction->id;
            $journal->save();
        }

        return redirect("expenses");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        //
    }
}
