<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{

    const TYPE_CHECKING = 'checking';
    const TYPE_SAVING = 'saving';

    protected $fillable = [
        'type'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function balance()
    {
        $debitSum = $this->transactions()->whereType(Transaction::TYPE_DEBIT)->get()->sum('amount');

        $creditSum = $this->transactions()->whereType(Transaction::TYPE_CREDIT)->get()->sum('amount');

        return $creditSum - $debitSum;
    }


}
