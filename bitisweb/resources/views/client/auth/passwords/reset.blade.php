@extends('layouts.frontend')

@section('styles')
  <link href="{{asset('frontend/css/auth.css')}}" rel="stylesheet" />
@endsection

@section('content')
  <div class="container">
    <ul class="breadcrumb">
      <li><a href="{{ url("/") }}">イベンツ</a>/ パスワード再設定</li>
    </ul>

    <div class="justify-content-center">
      <div class="auth-form register-form">
        <div class="card-header">{{ __('パスワード再設定') }}</div>
        <div class="card-body">

          <form method="POST" action="{{ route('user.reset.pass.confirm', $token) }}">

            @csrf
            <span>新しい、パスワードを再設定してください。</span>
            <br></br>

            <div class="form-group">
              <label for="password">{{ __('パスワード') }}</label>
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="4~20文字 半角英数字・記号" required autocomplete="new-password">
              <span class="form-control-feedback">必須</span>

                @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
            </div>

            <div class="form-group">
              <label for="password-confirm">{{ __('パスワード(確認)') }}</label>
              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="4~20文字 半角英数字・記号" required autocomplete="new-password">
              <span class="form-control-feedback">必須</span>
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary">{{ __('パスワードを再設定する') }}</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

