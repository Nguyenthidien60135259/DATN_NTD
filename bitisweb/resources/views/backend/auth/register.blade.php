@extends('layouts.auth-admin')

@section('title', 'Register')

@section('content')
  <div class="admin-auth register-form">
    <div class="container">
      <div class="justify-content-center">
        <div class="card">
          <div class="card-header text-center">{{ __('Register') }} <i class="fa fa-sign-in" aria-hidden="true"></i></div>

          <div class="card-body">
            <form method="POST" action="{{ route('admin.register.submit') }}">
              @csrf

              <div class="form-group">
                <label for="name"><i class="fa fa-address-card-o" aria-hidden="true"></i> {{ __('Name') }}</label>

                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>

                @error('name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="form-group">
                <label for="email"><i class="fa fa-envelope-o" aria-hidden="true"></i> {{ __('E-Mail Address') }}</label>

                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">

                @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="form-group">
                <label for="password"><i class="fa fa-lock" aria-hidden="true"></i> {{ __('Password') }}</label>

                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="form-group">
                <label for="password-confirm"><i class="fa fa-lock" aria-hidden="true"></i> {{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
              </div>

              <div class="form-group">
                <button type="submit" class="btn btn-primary">{{ __('Register') }} <i class="fa fa-paper-plane" aria-hidden="true"></i></button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection