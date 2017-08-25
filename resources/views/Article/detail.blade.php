@extends('layout.iframe')
@section('content')
    <div class="admin-content-body">
        <div class="am-cf am-padding am-padding-bottom-0">
            <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">文章详情</strong> / <small>Article detail</small></div>
        </div>
        <hr>

        <!--内容开始-->
        <article class="am-article" style="margin: 30px;">
            <div class="am-article-hd">
                <h1 class="am-article-title">{{$article->title}}</h1>
                <ol class="am-breadcrumb am-breadcrumb-slash">
                    <li class="am-active">作者：{{$article->author}}</li>
                    <li class="am-active"> 发表日期：{{$article->created_at}}</li>
                    <li class="am-active"> 浏览量：{{$article->hits}}</li>
                </ol>
            </div>
            <p class="am-article-lead">
                摘要：{{$article->excerpt}}
            </p>
            <div class="">
                {!! $article->content !!}
            </div>
            <div class="am-panel am-panel-default">
                <div class="am-panel-bd">文章来源：{{$article->source}}</div>
            </div>
        </article>
        <!--内容结束-->
    </div>
@endsection

@section('javascript')
    <!-- 配置文件 -->
    <script type="text/javascript" src="{{asset('ueditor/ueditor.config.js')}}"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="{{asset('ueditor/ueditor.all.js')}}"></script>
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('container', {
            initialFrameHeight: 400
        });
    </script>
@endsection


