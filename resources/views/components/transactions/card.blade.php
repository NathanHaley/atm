<div class="card">
    <div class="card-header">Deposit</div>
    <div class="card-body">
        <form method="POST" action="{{ $route }}">
            @csrf
            <div class="form-group row">
                <label for="amount" class="col-md-12 col-form-label">
                    Amount <p class="small">(Example: 7.50)</p>
                </label>
                <div class="col-md-12">
                    <input id="amount"
                           type="text"
                           class="form-control @if($hasError) is-invalid @endif"
                           name="amount"
                           value="{{ $oldAmount }}"
                           required>

                    @if($hasError)
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errorMessage }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-12">
                    <button onclick="this.disabled" type="submit" class="btn btn-primary">
                        {{ $buttonText }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>