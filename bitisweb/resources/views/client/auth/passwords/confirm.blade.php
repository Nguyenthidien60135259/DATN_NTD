@extends('layouts.frontend')

@section('meta')
  <title>ご本人様確認 - e-venz</title>
  <meta name="description" content="">
  <meta name="keywords" content="">
@endsection

@section('styles')
  <link href="{{asset('frontend/css/auth.css')}}" rel="stylesheet" />
@endsection

@section('content')
  <div class="container">
    <div class="col-xs-12 col-sm-6 col-sm-push-3" id="register_verify">
      <h1>ご本人様確認</h1>
      <div class="error-notice">
        <div class="text-center">
          <strong>ご本人様確認が完了していません。<br>[ご本人様確認コード]メールの確認コードを入力して、<br>会員登録を完了してください。</strong>
        </div>
      </div>
      <p>この度は、e-venzの会員登録にお申し込み頂き誠にありがとうございます。</p>
      <p>不正利用防止のため、ご本人様確認をおこなっております。ご登録頂いたメールアドレス宛に[ご本人様確認コード]メールを送信いたしました。メールに記載されている確認コードを入力して[確認する]ボタンをクリックしてください。</p>

      <div class="bg-quiet">
        <form method="POST" action="{{route('user.register.confirm', $confirm_token)}}" accept-charset="UTF-8" autocomplete="off">
          @csrf
          <div class="form-group">
            <label class="control-label pull-left" for="user_confirmation_code">確認コード</label>
            <div class="input-wrapper">
              <input class="form-control" placeholder="確認コードを入力してください" type="text" name="confirm_code">
              <span class="form-control-feedback">必須</span>
            </div>
          </div>
          <div class="form-group">
            <button type="submit">確認する</button>
          </div>
        </form>
      </div>

      <div class="success-notice">
        <p class="danger">メールが届かない場合は、下記をご確認ください。</p>
        <ol>
          <li>迷惑メールフォルダーをご確認ください。</li>
          <li>
            <strong>{{env('MAIL_FROM_ADDRESS')}}</strong>のメール受信が可能となっているか、ドメイン指定をご確認ください。(ドメイン指定の設定を変更した場合は、もう一度最初から<u><a href="/regist/">会員登録</a></u>を行ってください。)
          </li>
          <li>Yahoo!/Facebook/Googleなどのアカウントを利用して<u><a href="/regist/">会員登録</a></u>してください。</li>
          <li>上記の方法で解決しない場合は、<u><a rel="nofollow" target="_blank" href="/contact/">お問い合わせフォーム</a></u>よりご連絡ください。</li>
        </ol>
      </div>
    </div>
  </div>
@endsection

<style type="text/css">
  #register_verify {
    margin: 30px auto;
  }
  #register_verify > h1 {
    font-size: 20px;
  }
  #register_verify .error-notice {
    background: #ee7a64;
    color: #FFFFFF;
    padding: 1rem;
    border-radius: 5px;
    margin-bottom: 1rem;
  }
  #register_verify .bg-quiet {
    background: #F2F2F2;
    padding: 1rem;
    margin-bottom: 1rem;
  }
  #register_verify form .form-group {
    margin-top: 1rem;
  }
  #register_verify .input-wrapper {
    position: relative;
  }
  #register_verify .input-wrapper span.form-control-feedback {
    position: absolute;
    bottom: 8px;
    right: 10px;
    font-size: 12px;
    color: #d43518;
  }
  #register_verify form button[type="submit"] {
    background-color: #80ad60;
    color: #fff;
    border: none;
    height: 35px;
    padding: 0 25px;
    margin: 0 auto;
    display: table;
    border-radius: 5px;
  }
  #register_verify .success-notice > p.danger {
    color: #d43518;
    font-weight: bold;
  }
  #register_verify .success-notice ol {
    padding: 0 15px;
  }
  #register_verify .success-notice ol > li {
    margin-bottom: 5px;
  }
</style>