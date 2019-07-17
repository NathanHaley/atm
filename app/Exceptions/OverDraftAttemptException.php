<?php

namespace App\Exceptions;

use Exception;

class OverDraftAttemptException extends Exception
{
    public function render($request)
    {
        return response()->json(['message' => $this->getMessage(), 'errors' => [
            'amount' => ['Enter an amount that is less than or equal to the account balance or deposit money.']]],422);
    }
}
