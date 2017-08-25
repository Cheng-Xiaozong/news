<!doctype html>
<html class="no-js fixed-layout">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> 甜头菜后台管理系统 - @yield('title')</title>
    <meta name="keywords" content="index">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="icon" type="image/png" href="{{asset('Amaze/i/favicon.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('Amaze/i/app-icon72x72@2x.png')}}">
    <meta name="apple-mobile-web-app-title" content="Amaze UI" />
    <link rel="stylesheet" href="{{asset('Amaze/css/amazeui.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('Amaze/css/admin.css')}}">
    @section('style')
    @show
</head>
<body>
<!--[if lte IE 9]>
<p class="browsehappy">你正在使用<strong>过时</strong>的浏览器，Amaze UI 暂不支持。 请 <a href="http://browsehappy.com/" target="_blank">升级浏览器</a>
    以获得更好的体验！</p>
<![endif]-->

{{--内容区域开始--}}
@yield('content')
{{--内容区域结束--}}

<!--[if lt IE 9]>
    <script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
    <script src="{{asset('Amaze/js/amazeui.ie8polyfill.min.js')}}"></script>
    <![endif]-->

    <!--[if (gte IE 9)|!(IE)]><!-->
    <script src="{{asset('static/jquery/jquery-3.2.1.min.js')}}"></script>
    <!--<![endif]-->
    <script src="{{asset('Amaze/js/amazeui.min.js')}}"></script>
    <script src="{{asset('Amaze/js/app.js')}}"></script>
@section('javascript')
@show
</body>
</html>
