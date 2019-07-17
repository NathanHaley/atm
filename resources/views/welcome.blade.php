@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="alert alert-info">
                    <p>
                        Don't have an account and PIN yet, register <a href="{{ route('register') }}">here</a>.
                    </p>
                    <p>
                        If you have already registered you can login below with your PIN. If you don't know your PIN or
                        want to login with your email address click <a href="{{ route('login') }}">here</a>.
                    </p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Enter Your PIN To Login</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login.pin') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="pin" class="col-md-4 col-form-label text-md-right">PIN</label>

                                <div class="col-md-6">
                                    <input id="pin" type="input" class="form-control @error('pin') is-invalid @enderror" name="pin" value="{{ old('pin') }}" required autocomplete="pin">

                                    @error('pin')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Go!
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


