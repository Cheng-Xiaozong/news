@extends('layout.iframe')
@section('content')
    <div class="admin-content-body">
        @include('Article.message')
        {{--错误处理--}}
        @if (count($errors))
            @foreach($errors->all() as $error)
                <div class="am-alert am-alert-danger" data-am-alert style="margin:10px">
                    <button type="button" class="am-close">&times;</button>
                    {{ $error }}
                </div>
            @endforeach
        @endif

        <div class="am-cf am-padding am-padding-bottom-0">
            <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">编辑推送文章分类</strong> / <small>edit Push Article</small></div>
        </div>
        <hr>
        <!--内容开始-->
        <div class="form-content">
            <form action="{{url('/push/editArticleType',['id'=>$articleType->id,'pid'=>$articleType->pid])}}" method="post" class="am-form" data-am-validator enctype="multipart/form-data">
             {{ csrf_field() }}
            <fieldset>
              {{--  <legend>发表文章</legend>--}}
                <div class="am-form-group">
                    <label for="doc-vld-name-2">分类名称：</label>
                    <input type="text" id="doc-vld-name-2" minlength="2" maxlength="10" placeholder="输入用分类名称（2-10个字符）" name="articleType[name]" value="{{old('articleType')['name'] ?? $articleType->name}}" required/>
                </div>
                <button class="am-btn am-btn-secondary" type="submit">提交</button>
            </fieldset>
        </form>
        </div>
    </div>
@endsection



