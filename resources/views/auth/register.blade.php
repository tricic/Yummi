@extends('layouts.app')

@section('title', 'Register')

@section('content')
<form class="card" action="{{ route('register') }}" method="POST">
    @csrf

    <div class="card-header">
        {{ __('Register') }}
    </div>

    <div class="card-body">
        <div class="account-info">
            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>
        </div>

        <hr>

        <div class="delivery-info">
            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">First name</label>

                <div class="col-md-6">
                    <input name="first_name" type="text" class="form-control" placeholder="John">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Last name</label>

                <div class="col-md-6">
                    <input name="last_name" type="text" class="form-control" placeholder="Doe">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Address</label>

                <div class="col-md-6">
                    <input name="address" type="text" class="form-control" placeholder="1234 Main St">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">City</label>

                <div class="col-md-6">
                    <input name="city" type="text" class="form-control" placeholder="Springfield">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Phone</label>
                <div class="col-md-6">
                    <input name="phone" type="text" class="form-control" placeholder="123 456 789" pattern="^(?=.*\d)[\d ]+$">
                </div>
            </div>
        </div>
    </div>

    <div class="card-footer text-right">
        <button type="submit" class="btn btn-primary px-5">
            {{ __('Register') }}
        </button>
    </div>
</form>
@endsection
