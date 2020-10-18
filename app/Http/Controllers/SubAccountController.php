<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class SubAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function index(Account $account)
    {
        //
        $data = array(
            'account' => $account
        );
        return view("finances.accounts.subaccounts.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function create(Account $account)
    {
        //
        $data = array(
            'account' => $account
        );
        return view("finances.accounts.create", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Account $account)
    {
        //
        $subaccount = new Account();
        $subaccount->name = $request->name;
        $subaccount->type = $request->type;
        if($request->has('account_id') && $request->account_id != "null"){
            $subaccount->account_id = $request->account_id;
        }
        $subaccount->save();
        return redirect()->route("accounts.subaccounts.index", ['account' => $account->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account, Account $subaccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account, Account $subaccount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Account  $account
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account, Account $subaccount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Account  $account
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account, Account $subaccount)
    {
        //
    }
}
