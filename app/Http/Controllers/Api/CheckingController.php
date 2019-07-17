<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\AmountRequest;
use App\Services\TransactionService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class CheckingController extends Controller
{
    public function deposit(AmountRequest $request)
    {
        TransactionService::checkingDeposit(auth()->user(), $request->amount);

        return response()->json([],201);
    }

    public function withdraw(AmountRequest $request)
    {
        TransactionService::checkingWithdraw(auth()->user(), $request->amount);

        return response()->json([],201);
    }

    public function transfer(AmountRequest $request)
    {
        TransactionService::checkingToSavingTransfer(auth()->user(), $request->amount);

        return response()->json([],201);
    }
}
