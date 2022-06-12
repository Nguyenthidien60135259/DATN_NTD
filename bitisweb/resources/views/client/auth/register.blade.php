@extends('layouts.frontend')

@section('meta')
  <title>新規会員登録 - e-venz</title>
  <meta name="description" content="イベンツの新規会員登録ページはこちらから。会員登録がまだの方はぜひご登録ください。">
  <link rel="canonical" href="{{ Request::fullUrl() }}/">
  <meta property="og:title" content="新規会員登録">
  <meta property="og:type" content="website">
  <meta property="og:url" content="{{ Request::url() }}/">
  <meta property="og:image" content="{{ Request::root() }}/{{SYSTEM_UPLOAD_DIR}}{{ isset($system_information->og_image) ? $system_information->og_image : '' }}">
  <meta property="og:image:width" content="1260">
  <meta property="og:image:height" content="630">
  <meta property="og:site_name" content="e-venz">
  <meta property="og:description" content="イベンツの新規会員登録ページはこちらから。会員登録がまだの方はぜひご登録ください。">
  <meta property="og:locale" content="ja_JP">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:site" content="@evenzparty">
  <meta name="twitter:title" content="新規会員登録">
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
            "name": "新規会員登録"
          }
        ]
      }
  </script>
@endsection

@section('styles')
  <link href="{{asset('frontend/css/auth.css')}}" rel="stylesheet" />
  <style type="text/css">
    .register-form input.error {
      border-color: #ff4a4aa8;
    }
    .register-form i.error {
      font-size: 10px;
      margin-top: 2px;
      color: red;
    }
  </style>
@endsection

@section('content')
  <div class="container">
    @if(!isMobile())
      <ul class="breadcrumb">
        <li><a href="{{ url("/") }}">イベントTOP</a>/ 新規会員登録</li>
      </ul>
    @endif

    <div class="justify-content-center">
      <div class="auth-form register-form">
        <div class="card-header"><h1>{{ __('新規会員登録') }}</h1></div>
        <div class="card-body">
          <div class="social-login">
            <a href="{{ route("socialite", array("yahoo")) }}" class="btn yahoo-btn">Yahoo!で登録</a>
            <a href="{{ route("socialite", array("facebook")) }}" class="btn facebook-btn">Facebookで登録</a>
            <a href="{{ route("socialite", array("google")) }}" class="btn google-btn">Googleで登録</a>
          </div>

          <p class="text-center">or</p>

          <form method="POST" action="{{route('user.register.submit')}}">

            @csrf

            <div class="form-group">
              <label for="email">{{ __('メールアドレス') }}</label>
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="info@e-venz.com" value="{{ old('email') }}"  autocomplete="email">
              {{-- <span class="form-control-feedback">必須</span> --}}
              @error('email')
                <i class="error" style="color: red">{{ $message }}</i>
              @enderror
              <i id="mail_alert" class="error"></i>
            </div>

            <div class="form-group">
              <label for="password">{{ __('パスワード') }}</label>
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="4~20文字 半角英数字・記号"  autocomplete="new-password">
              {{-- <span class="form-control-feedback">必須</span> --}}

              @error('password')
                <i class="error" style="color: red">{{ $message }}</i>
              @enderror
            </div>

            <div class="form-group">
              <label for="password-confirm">{{ __('パスワード(確認)') }}</label>
              <input id="password-confirm" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="4~20文字 半角英数字・記号"  autocomplete="new-password">
              {{-- <span class="form-control-feedback">必須</span> --}}
              @error('password_confirmation')
                <i class="error" style="color: red">{{ $message }}</i>
            　 @enderror
            </div>

            <div class="form-group">
              <input type="checkbox" value="true" name="agree_term" id="agree_term">
              <a rel="nofollow" target="_blank" href="/terms/">イベンツ利用規約</a>に同意する
            </div>

            <div class="form-group">
              <button id="register_btn" type="submit" class="single-click btn btn-primary" onclick="singleClick()" disabled="disabled">{{ __('会員登録') }}</button>
            </div>

            <div class="login-btn">
              <p class="text-center">既に会員の方はこちら</p>
              <a class="btn-primary" href="{{ route('login') }}/">ログイン</a>
            </div>
          </form>
        </div>
      </div>
    </div>

    @if(isMobile())
      <ul class="breadcrumb">
        <li><a href="{{ url("/") }}">イベントTOP</a></li>
        <li><img src="{{ asset('frontend/image/awesome-icon') }}/chevron-right-b.svg" width="12px" height="12px"></li>
        <li>新規会員登録</li>
      </ul>
    @endif
  </div>
@endsection

@section('scripts')
  <script type="text/javascript">
    $("input#email").on('keyup input', function() {
      var email = $(this).val();
      validateEmail(email);
    });

    function validateEmail(email) {
      var reg = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/

      if(reg.test(email) == false) {
        $('#mail_alert').text("正しいメールアドレスを入力してください");
        $('#register_btn').prop('disabled', true);
        $('input#email').addClass('error');
      } else {
        $('#mail_alert').text("");
        $('#register_btn').prop('disabled', false);
        $('input#email').removeClass('error');
      }
    }
  </script>
@endsection