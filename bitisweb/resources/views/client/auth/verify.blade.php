@extends('frontend.layouts.app')

@section('meta')
  <title>ご本人様確認 - e-venz</title>
  <meta name="description" content="不正利用防止のため、ご本人様確認をおこなっております。ご登録頂いたメールアドレス宛に[ご本人様確認コード]メールを送信いたしました。">
  <link rel="canonical" href="{{ Request::fullUrl() }}/">
  <meta property="og:title" content="ご本人様確認">
  <meta property="og:type" content="website">
  <meta property="og:url" content="{{ Request::url() }}/">
  <meta property="og:image" content="{{ Request::root() }}/{{SYSTEM_UPLOAD_DIR}}{{ isset($system_information->og_image) ? $system_information->og_image : '' }}">
  <meta property="og:image:width" content="1260">
  <meta property="og:image:height" content="630">
  <meta property="og:site_name" content="e-venz">
  <meta property="og:description" content="不正利用防止のため、ご本人様確認をおこなっております。ご登録頂いたメールアドレス宛に[ご本人様確認コード]メールを送信いたしました。">
  <meta property="og:locale" content="ja_JP">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:site" content="@evenzparty">
  <meta name="twitter:title" content="ご本人様確認">
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
            "name": "ご本人様確認"
          }
        ]
      }
  </script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
