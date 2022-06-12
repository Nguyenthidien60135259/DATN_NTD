@extends('layouts.auth-admin')

@section('title', 'Forgot Password')

@section('content')
<div class="admin-auth forgot-form">
  <div class="container">
    <div class="justify-content-center">
      <div class="card">
        <div class="card-header text-center">{{ __('Reset Password') }}</div>

        <div class="card-body">
          @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
          @endif

          <form method="POST" action="{{ route('admin.password.email') }}">
            @csrf

            <div class="form-group">
              <label for="email"><i class="fa fa-envelope-o" aria-hidden="true"></i> {{ __('メールアドレス') }}</label>

              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>

              @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary">
                {{ __('パスワード再設定メールを送信') }}
                <i class="fa fa-paper-plane" aria-hidden="true"></i>
              </button>
            </div>
            <div class="text-center">
              <a href="{{ route('admin.login') }}"> Login to dashboard</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
