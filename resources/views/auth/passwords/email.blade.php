@extends('layouts.login')

@section('content')
<div class="content">
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <h3 class="form-title">{{ __('Reset Password') }}</h3>
        <div class="form-group row">
            <label for="email" class="control-label visible-ie8 visible-ie9">{{ __('E-Mail Address') }}</label>
            <input id="email" class="form-control form-control-solid placeholder-no-fix {{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" autocomplete="off" placeholder="Email" name="email" value="{{ old('email') }}" />            
            @if ($errors->has('email'))
                <span class="error invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Send Password Reset Link') }}
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
