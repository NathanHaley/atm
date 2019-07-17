<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\AmountRequest;
use App\Services\TransactionService;
use App\Http\Controllers\Controller;

class SavingController extends Controller
{
    public function deposit(AmountRequest $request)
    {
        TransactionService::savingDeposit(auth()->user(), $request->amount);

        return response()->json([],201);
    }

    public function withdraw(AmountRequest $request)
    {
        TransactionService::savingWithdraw(auth()->user(), $request->amount);

        return response()->json([],201);
    }

    public function transfer(AmountRequest $request)
    {
        TransactionService::savingToCheckingTransfer(auth()->user(), $request->amount);

        return response()->json([],201);
    }
}
