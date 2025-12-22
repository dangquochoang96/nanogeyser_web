@extends('layouts.login')
@section('content')
<div class="content">
    <!-- BEGIN LOGIN FORM -->
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <h3 class="form-title">Sign In</h3>
        <div class="form-group row">
            <label for="email" class="control-label visible-ie8 visible-ie9">{{ __('E-Mail Address') }}</label>
            <input id="email" class="form-control form-control-solid placeholder-no-fix {{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" autocomplete="off" placeholder="Email" name="email" value="{{ old('email') }}" />            
            @if ($errors->has('email'))
                <span class="error invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group row">
            <label for="password" class="control-label visible-ie8 visible-ie9">{{ __('Password') }}</label>
            <input id="password" class="form-control form-control-solid placeholder-no-fix {{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" autocomplete="off" placeholder="password" name="password" />
            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
             @endif    
        </div>

        <div class="form-group row">
            <div class="col-md-6 offset-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Login') }}
                </button>

                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            </div>
        </div>
    </form>
</div>
@endsection