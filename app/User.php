<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'pin'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }

    public function savingAccount()
    {
        return $this->accounts()->where('type', Account::TYPE_SAVING)->first();
    }

    public function checkingAccount()
    {
        return $this->accounts()->where('type', Account::TYPE_CHECKING)->first();
    }
}
