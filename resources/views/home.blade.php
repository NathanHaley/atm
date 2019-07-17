@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-4">
        <h1>{{ ucwords($accountType) }} Account</h1>
    </div>
    <div class="row justify-content-center mb-4">
        <a href="{{ route('home', ['accountType' => $switchToAccountType]) }}" class="btn btn-primary">Go To {{ ucwords($switchToAccountType) }}</a>
    </div>
    <div class="row mt-2 justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h4>Account Information</h4></div>
                <div class="card-body">
                    Current Balance: @money($balance)
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-2 justify-content-center">
        <div class="col-md-4">
            <transaction-form
                    route="{{ route($accountType.'.deposit') }}"
                    heading="Deposit"
                    button_text="Take My Money!"></transaction-form>
        </div>
        <div class="col-md-4">
            <transaction-form
                    route="{{ route($accountType.'.withdraw') }}"
                    heading="Withdraw"
                    button_text="Give Me My Money!"></transaction-form>
        </div>
        <div class="col-md-4">
            <transaction-form
                    route="{{ route($accountType.'.transfer') }}"
                    heading="Transfer To Savings"
                    button_text="Move My Money!"></transaction-form>
        </div>
    </div>
    <div class="row mt-2 justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h4>Transactions</h4></div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Transaction</th>
                                <th>Description</th>
                                <th>Amount</th>
                                <th>Date/Time CST</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($transactions as $transaction)
                            <tr>
                                <td class="text-uppercase">{{ $transaction->source }}</td>
                                <td>{{ $transaction->description }}</td>
                                <td>@money(($transaction->type === \App\Transaction::TYPE_DEBIT) ? -$transaction->amount : $transaction->amount)</td>
                                <td>{{ $transaction->created_at->toDayDateTimeString() }}</td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No transactions at this time.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        {{ $transactions->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
    </script>
@endsection
