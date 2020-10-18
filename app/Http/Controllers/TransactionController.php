<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Journal;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $transactions = Transaction::all();
        $data = array(
                'transactions' => $transactions,
            );
        return view('finances.transactions.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $incomes = Account::income()->get();
        $expenses = Account::expenses()->get();
        $assets = Account::assets()->get();
        $equity = Account::equity()->get();
        $liabilities = Account::liabilities()->get();
        $data = array(
                'incomes' => $incomes,
                'expenses' => $expenses,
                'assets' => $assets,
                'equities' => $equity,
                'liabilities' => $liabilities,
            );
        return view('finances.transactions.create', $data);
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

        $transaction = new Transaction();

        $transaction->date = $request->date;
        $transaction->memo = $request->memo;
        $transaction->transactionable_type = $request->type;

        $transaction->save();

        //$transaction->amount = $request->amount;

        if($transaction->save()){
            if($request->has("income_dynamic")){
                foreach ($request->income_dynamic as $invoiceitem) {
                    # code...
                    $journal = new Journal();
                    $journal->memo = $invoiceitem['memo'];
                    $journal->credit = $invoiceitem['credit'];
                    $journal->debit = $invoiceitem['debit'];
                    $journal->account_id = $invoiceitem['account_id'];
                    $journal->transaction_id = $transaction->id;
                    $journal->save();
                }
            }
            if($request->has("expense_dynamic")){
                foreach ($request->expense_dynamic as $expenseitem) {
                    # code...
                    $journal = new Journal();
                    $journal->memo = $expenseitem['memo'];
                    $journal->credit = $expenseitem['credit'];
                    $journal->debit = $expenseitem['debit'];
                    $journal->account_id = $expenseitem['account_id'];
                    $journal->transaction_id = $transaction->id;
                    $journal->save();
                }
            }
            if($request->has("asset_dynamic")){
                foreach ($request->asset_dynamic as $assetitem) {
                    # code...
                    $journal = new Journal();
                    $journal->memo = $assetitem['memo'];
                    $journal->credit = $assetitem['credit'];
                    $journal->debit = $assetitem['debit'];
                    $journal->account_id = $assetitem['account_id'];
                    $journal->transaction_id = $transaction->id;
                    $journal->save();
                }
            }
            if($request->has("equity_dynamic")){
                foreach ($request->equity_dynamic as $equityitem) {
                    # code...
                    $journal = new Journal();
                    $journal->memo = $equityitem['memo'];
                    $journal->credit = $equityitem['credit'];
                    $journal->debit = $equityitem['debit'];
                    $journal->account_id = $equityitem['account_id'];
                    $journal->transaction_id = $transaction->id;
                    $journal->save();
                }
            }
            if($request->has("liability_dynamic")){
                foreach ($request->liability_dynamic as $liabilityitem) {
                    # code...
                    $journal = new Journal();
                    $journal->memo = $liabilityitem['memo'];
                    $journal->credit = $liabilityitem['credit'];
                    $journal->debit = $liabilityitem['debit'];
                    $journal->account_id = $liabilityitem['account_id'];
                    $journal->transaction_id = $transaction->id;
                    $journal->save();
                }
            }
        }

        return redirect()->route("transactions.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
