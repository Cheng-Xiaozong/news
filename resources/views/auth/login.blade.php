@extends('layout.iframe')
@section('style')
    <link rel="stylesheet" href="{{asset('Amaze/css/login.css')}}">
@endsection
@section('content')
    <div class="am-g main_part">
        <div class="am-u-sm-centered" style="width:50%">
            <h1><span>甜头菜</span>后台管理系统</h1>
            <form class="am-form" action="{{ url('/login') }}" method="post">
                {{ csrf_field() }}
                <fieldset class="am-form-set">
                    <input type="email" placeholder="邮箱" name="email" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                        <p>{{ $errors->first('email') }}</p>
                    @endif
                    <input type="password" placeholder="密码" name="password">
                    @if ($errors->has('password'))
                        <p>{{ $errors->first('password') }}</p>
                    @endif
                </fieldset>
                <button type="submit" class="am-btn am-btn-primary am-btn-block">登录</button>
            </form>
        </div>
    </div>
@endsection

