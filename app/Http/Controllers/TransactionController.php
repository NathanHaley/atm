<?php

namespace App\Http\Controllers;

use App\Http\Requests\AmountRequest;
use App\Http\Requests\TransactionRequest;
use App\Services\TransactionService;
use App\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
//    public function __construct()
//    {
//        $this->authorizeResource(Transaction::class);
//    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TransactionRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionRequest $request)
    {
        //
    }

    public function checkingDeposit(AmountRequest $request)
    {
        $user = auth()->user();

        TransactionService::checkingDeposit($user, $request->amount);

        flash('Deposit successful.')->success();

        return back();
    }

    public function savingDeposit(TransactionRequest $request)
    {
        $user = auth()->user();

        TransactionService::savingDeposit($user, $request->amount);

        flash('Deposit successful.')->success();


        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
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
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
