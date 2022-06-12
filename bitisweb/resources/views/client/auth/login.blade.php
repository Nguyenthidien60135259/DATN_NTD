@extends('layouts.frontend')

@section('meta')
  <title>ログイン - e-venz</title>
  <meta name="description" content="イベンツのログインページはこちら">
  <meta name="keywords" content="ログイン">
  <link rel="canonical" href="{{ Request::fullUrl() }}/">
  <meta property="og:title" content="ログイン">
  <meta property="og:type" content="website">
  <meta property="og:url" content="{{ Request::url() }}/">
  <meta property="og:image" content="{{ Request::root() }}/{{SYSTEM_UPLOAD_DIR}}{{ isset($system_information->og_image) ? $system_information->og_image : '' }}">
  <meta property="og:image:width" content="1260">
  <meta property="og:image:height" content="630">
  <meta property="og:site_name" content="e-venz">
  <meta property="og:description" content="イベンツのログインページはこちら">
  <meta property="og:locale" content="ja_JP">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:site" content="@evenzparty">
  <meta name="twitter:title" content="ログイン">
  <script type="application/ld+json">
      {
      "@context": "https://schema.org",
      "@type": "BreadcrumbList",
        "itemListElement": [{
          "@type": "ListItem",
          "position": 1,
          "item": { "name": "イベントTOP", "@id" : "{{ url("/") }}/"}
        }
        ,{
            "@type": "ListItem",
            "position": 2,
            "name": "ログイン"
          }
        ]
      }
  </script>
@endsection

@section('styles')
  <link href="{{asset('frontend/css/auth.css')}}" rel="stylesheet" />
@endsection

@section('content')
  <div class="container">
    @if(!isMobile())
      <ul class="breadcrumb">
        <li><a href="{{ url("/") }}">イベントTOP</a>/ ログイン</li>
      </ul>
    @endif

    <div class="justify-content-center">
      <div class="auth-form login-form">
        <div class="card-header"><h1>{{ __('ログイン') }}</h1></div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <div class="card-body">
          <div class="social-login">
            <a href="{{ route("socialite", array("yahoo")) }}" class="btn yahoo-btn">Yahoo!でログイン</a>
            <a href="{{ route("socialite", array("facebook")) }}" class="btn facebook-btn">Facebookでログイン</a>
            <a href="{{ route("socialite", array("google")) }}" class="btn google-btn">Googleでログイン</a>
          </div>

          <p class="text-center">or</p>

          <form method="POST" action="{{route('login')}}">

            @csrf
            @if ($message = Session::get('error'))
            <div class="alert alert-danger">
                <p>{{ $message }}</p>
            </div>
            @endif

            <div class="form-group">
              <label for="email">{{ __('メールアドレス') }}</label>

              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="info@e-venz.com" value="{{ old('email') }}" autocomplete="email" autofocus>
              {{-- <span class="form-control-feedback">必須</span> --}}
              @error('email')
                <i class="error" style="color: red">{{ $message }}</i>
              @enderror
            </div>

            <div class="form-group">
              <label for="password">{{ __('パスワード') }}</label>
              @if (Route::has('password.request'))
              <span class="right">
                <a href="{{ route('password.request') }}/">
                  {{ __('パスワードをお忘れの方はこちら') }}
                </a>
              </span>
              @endif

              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="4~20文字 半角英数字・記号" autocomplete="current-password">
              {{-- <span class="form-control-feedback">必須</span> --}}
              @error('password')
                <i class="error" style="color: red">{{ $message }}</i>
              @enderror
            </div>

            <div class="form-group">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <span>{{ __('次回から自動でログインする') }}</span>
              </div>
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary">{{ __('ログイン') }}</button>
            </div>

            <div class="login-btn">
              <p class="text-center">新規ご利用の方はこちら</p>
              <a class="btn-primary" href="{{route('user.register')}}/">会員登録</a>
            </div>
          </form>
        </div>
      </div>
    </div>

    @if(isMobile())
      <ul class="breadcrumb">
        <li><a href="{{ url("/") }}">イベントTOP</a></li>
        <li><img src="{{ asset('frontend/image/awesome-icon') }}/chevron-right-b.svg" width="12px" height="12px"></li>
        <li>ログイン</li>
      </ul>
    @endif
  </div>
@endsection
