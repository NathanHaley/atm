<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    const MAX=1000000;//10,000.00
    const MIN=0.01;

    const SOURCE_DEPOSIT = 'deposit';
    const SOURCE_WITHDRAW = 'withdraw';
    const SOURCE_TRANSFER = 'transfer';

    const TYPE_DEBIT = 'debit';
    const TYPE_CREDIT = 'credit';

    protected $fillable = [
        'source',
        'type',
        'description',
        'amount'
    ];


    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
