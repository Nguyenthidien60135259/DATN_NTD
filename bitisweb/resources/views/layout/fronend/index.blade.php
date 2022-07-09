<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Biti's Nâng niu bàn chân Việt">
    <meta name="author" content="">
    <meta name="keywords" content="Giày Bitis, dép Bitis, bitis" />
    <meta name="robots" content="INDEX,FOLLOW" />
    <link rel="icon" type="image/x-icon" href="" />

    <title name="title">Cửa hàng Biti's Lê Hồng Phong</title>
    <link href="/fronend/css/bootstrap.min.css" rel="stylesheet">
    <link href="/fronend/css/font-awesome.min.css" rel="stylesheet">
    <link href="/fronend/css/prettyPhoto.css" rel="stylesheet">
    <link href="/fronend/css/price-range.css" rel="stylesheet">
    <link href="/fronend/css/animate.css" rel="stylesheet">
    <link href="/fronend/css/main.css" rel="stylesheet">
    <link href="/fronend/css/responsive.css" rel="stylesheet">
    <link href="/fronend/css/lightslider.css" rel="stylesheet">
    <link href="/fronend/css/lightgallery.min.css" rel="stylesheet">
    <link href="/fronend/css/prettify.css" rel="stylesheet">
    <link href="/fronend/css/sweetalert.css" rel="stylesheet">
    @yield("styles")
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/fronend/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/fronend/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/fronend/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="/fronend/images/ico/apple-touch-icon-57-precomposed.png">
</head>
<!--/head-->

@include('layout.fronend.header')
@yield('content')
@include('layout.fronend.footer')

<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
        <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
        <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
    </svg>
</div>

@yield('scripts')

<script src="/fronend/js/jquery.js"></script>
<script src="/fronend/js/bootstrap.min.js"></script>
<script src="/fronend/js/jquery.scrollUp.min.js"></script>
<script src="/fronend/js/price-range.js"></script>
<script src="/fronend/js/jquery.prettyPhoto.js"></script>
<script src="/fronend/js/main.js"></script>
<script src="/fronend/js/lightgallery-all.min.js"></script>
<script src="/fronend/js/lightslider.js"></script>
<script src="/fronend/js/prettify.js"></script>
<script src="/fronend/js/sweetalert.js"></script>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v14.0" nonce="h0fGZklB"></script>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v14.0" nonce="I3KqXnI4"></script>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v14.0" nonce="gHUZ4XOs"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script type="text/javascript">
    $.validate({

    });

</script>
</html>
