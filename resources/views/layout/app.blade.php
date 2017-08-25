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
@section('header')
    <header class="am-topbar am-topbar-inverse admin-header">
        <div class="am-topbar-brand">
            <strong>甜头菜</strong> <small>后台管理系统</small>
        </div>

        <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>

        <div class="am-collapse am-topbar-collapse" id="topbar-collapse">

            <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list">
                <li><a href="javascript:;"><span class="am-icon-envelope-o"></span> 收件箱 <span class="am-badge am-badge-warning">5</span></a></li>
                <li class="am-dropdown" data-am-dropdown>
                    <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
                        <span class="am-icon-users"></span> 管理员 <span class="am-icon-caret-down"></span>
                    </a>
                    <ul class="am-dropdown-content">
                        <li><a href="#"><span class="am-icon-user"></span> 资料</a></li>
                        <li><a href="#"><span class="am-icon-cog"></span> 设置</a></li>
                        <li><a href="{{url('/logout')}}"><span class="am-icon-power-off"></span> 退出</a></li>
                    </ul>
                </li>
                <li class="am-hide-sm-only"><a href="javascript:;" id="admin-fullscreen"><span class="am-icon-arrows-alt"></span> <span class="admin-fullText">开启全屏</span></a></li>
            </ul>
        </div>
    </header>
@show


<div class="am-cf admin-main">
    <!-- sidebar start -->
    @section('admin-sidebar')
        <div class="admin-sidebar am-offcanvas" id="admin-offcanvas">
        <div class="am-offcanvas-bar admin-offcanvas-bar">
            <ul class="am-list admin-sidebar-list" id="collapase-nav">
                <li><a href="{{url('/')}}"><span class="am-icon-home"></span> 首页</a></li>
                <li class="admin-parent">
                    <a class="am-cf" data-am-collapse="{parent: '#collapase-nav', target: '#user-nav'}"><span class="am-icon-file"></span> 文章管理 <span class="am-icon-angle-right am-fr am-margin-right"></span></a>
                    <ul class="click-active am-list am-collapse admin-sidebar-sub am-in" id="user-nav">
                        <li><a data-href="{{url('/article')}}" class="am-cf"><span class="am-icon-th-list"></span> 文章管理</a></li>
                        <li><a data-href="{{url('/article/create')}}"><span class="am-icon-edit"></span> 发表文章</a></li>
                        <li><a data-href="{{url('/article/type')}}"><span class="am-icon-calendar"></span> 分类管理</a></li>
                        <li><a data-href="{{url('/article/createType')}}"><span class="am-icon-th"></span> 新增分类</a></li>
                    </ul>
                </li>
                <li><a href="{{url('/logout')}}"><span class="am-icon-sign-out"></span> 注销</a></li>
            </ul>

            <div class="am-panel am-panel-default admin-sidebar-panel">
                <div class="am-panel-bd">
                    <p><span class="am-icon-bookmark"></span> 公告</p>
                    <p>时光静好，与君语；细水流年，与君同。—— Administrator</p>
                </div>
            </div>

            <div class="am-panel am-panel-default admin-sidebar-panel">
                <div class="am-panel-bd">
                    <p><span class="am-icon-tag"></span> wiki</p>
                    <p>Welcome to the Tiantoucia management system!</p>
                </div>
            </div>
        </div>
    </div>
    @show
    <!-- sidebar end -->

    <!-- content start -->
    <iframe src="@yield('admin-content')" frameborder="0" class="admin-content"></iframe>
    <!-- content end -->

</div>

<a href="#" class="am-icon-btn am-icon-th-list am-show-sm-only admin-menu" data-am-offcanvas="{target: '#admin-offcanvas'}"></a>

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
