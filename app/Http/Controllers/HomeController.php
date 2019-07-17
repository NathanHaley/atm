<?php

namespace App\Http\Controllers;

use App\Account;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(string $accountType = Account::TYPE_CHECKING)
    {
        $user = auth()->user();

        $switchToAccountType = ($accountType === Account::TYPE_CHECKING) ? Account::TYPE_SAVING : Account::TYPE_CHECKING;

        $account = $user->accounts()->whereType($accountType)->first();

        $transactions = $account->transactions()->latest()->paginate(5);

        $balance = $account->balance();

        return view('home', compact('accountType', 'switchToAccountType', 'transactions', 'balance'));
    }
}
