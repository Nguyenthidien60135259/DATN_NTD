@extends('layouts.frontend')

@section('meta')
  <title>パスワード再設定 - e-venz</title>
@endsection

@section('styles')
  <link href="{{asset('frontend/css/auth.css')}}" rel="stylesheet" />
@endsection

@section('content')
  <div class="container">
    <ul class="breadcrumb">
      <li><a href="{{ url("/") }}">イベンツ</a>/ パスワード再設定</li>
    </ul>

    <div class="justify-content-center">
      <div class="auth-form forgot-form">
        <div class="card-header">{{ __('パスワード再設定') }}</div>
        <div class="card-body">
          @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
          @endif

          <form method="POST" action="{{ route('password.email') }}">

            @csrf

            <div class="form-group">
              <label for="email">{{ __('メールアドレス') }}</label>

              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="info@e-venz.com" value="{{ old('email') }}" required autocomplete="email" autofocus>
              <span class="form-control-feedback">必須</span>

              @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary">
                <img src="{{ asset('frontend/image') }}/plane.svg" alt="Plane" />{{ __('パスワード再設定メールを送信') }}
              </button>
            </div>

            <div class="login-btn">
              <p class="text-center">既に会員の方はこちら</p>
              <a class="btn-primary" href="{{ route('login') }}/">
                <img src="{{ asset('frontend/image/awesome-icon') }}/sign-in-w.svg" width="16" height="16" alt="Sign In" />
                ログイン
              </a>
              <p class="text-center">新規ご利用の方はこちら</p>
              <a class="btn-primary" href="{{ route('user.register') }}/">
                <img src="{{ asset('frontend/image/awesome-icon') }}/user-circle-o-w.svg" width="15" height="15" alt="Sign In" />
                会員登録
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
