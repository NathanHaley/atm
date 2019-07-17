<?php

namespace App\Services;


use App\Account;
use App\Exceptions\OverDraftAttemptException;
use App\Transaction;
use App\User;

class TransactionService
{

    static function checkingDeposit(User $user, string $amount) : Transaction
    {
        return static::createTransaction(
            $user,
            Account::TYPE_CHECKING,
            Transaction::SOURCE_DEPOSIT,
            Transaction::TYPE_CREDIT,
          Account::TYPE_CHECKING.' '.Transaction::SOURCE_DEPOSIT,
            $amount
        );
    }

    static function savingDeposit(User $user, string $amount) : Transaction
    {
        return static::createTransaction(
            $user,
            Account::TYPE_SAVING,
            Transaction::SOURCE_DEPOSIT,
            Transaction::TYPE_CREDIT,
            Account::TYPE_CHECKING.' '.Transaction::SOURCE_DEPOSIT,
            $amount
        );
    }

    static function checkingWithdraw(User $user, string $amount) : Transaction
    {
        return static::createTransaction(
            $user,
            Account::TYPE_CHECKING,
            Transaction::SOURCE_WITHDRAW,
            Transaction::TYPE_DEBIT,
            Account::TYPE_CHECKING.' '.Transaction::SOURCE_WITHDRAW,
            $amount
        );
    }

    static function savingWithdraw(User $user, string $amount) : Transaction
    {
        return static::createTransaction(
            $user,
            Account::TYPE_SAVING,
            Transaction::SOURCE_WITHDRAW,
            Transaction::TYPE_DEBIT,
            Account::TYPE_CHECKING.' '.Transaction::SOURCE_WITHDRAW,
            $amount
        );
    }

    static function checkingToSavingTransfer(User $user, string $amount) : bool
    {
        $description = Account::TYPE_CHECKING.' '.Transaction::SOURCE_TRANSFER.' to '.Account::TYPE_SAVING;

        //Note keep debit first or add transaction to roll back credit if OverDraftAttemptException
        $checkingTransaction = static::createTransaction(
            $user,
            Account::TYPE_CHECKING,
            Transaction::SOURCE_TRANSFER,
            Transaction::TYPE_DEBIT,
            $description,
            $amount
        );

        $savingTransaction = static::createTransaction(
            $user,
            Account::TYPE_SAVING,
            Transaction::SOURCE_TRANSFER,
            Transaction::TYPE_CREDIT,
            $description,
            $amount
        );

        return true;
    }

    static function savingToCheckingTransfer(User $user, string $amount) : bool
    {
        $description = Account::TYPE_SAVING.' '.Transaction::SOURCE_TRANSFER.' to '.Account::TYPE_CHECKING;

        //Note keep debit first or add transaction to roll back credit if OverDraftAttemptException
        $savingTransaction = static::createTransaction(
            $user,
            Account::TYPE_SAVING,
            Transaction::SOURCE_TRANSFER,
            Transaction::TYPE_DEBIT,
            $description,
            $amount
        );

        $checkingTransaction = static::createTransaction(
            $user,
            Account::TYPE_CHECKING,
            Transaction::SOURCE_TRANSFER,
            Transaction::TYPE_CREDIT,
            $description,
            $amount
        );


        return true;
    }

    static private function createTransaction(User $user, string $accountType, string $source, string $type, string $description, string $amount) : Transaction
    {
        $amount = $amount * 100;
        $description = ucfirst($description);

        $account = $user->accounts()
                        ->whereType($accountType)
                        ->first();

        if ($type === Transaction::TYPE_DEBIT && (($account->balance() - $amount) < 0)) {
            throw new OverDraftAttemptException('This transaction would cause a negative balance which is not allowed.');
        }

        return $account->transactions()
                        ->create([
                            'source' => $source,
                            'type' => $type,
                            'description' => $description,
                            'amount' => $amount
                        ]);
    }
}