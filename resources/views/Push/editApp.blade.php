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
            <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">编辑终端</strong> / <small>edit App</small></div>
        </div>
        <hr>

        <!--内容开始-->
        <div class="form-content">
            <form action="{{url('/push/editApp',['id'=>$app->id])}}" method="post" class="am-form" data-am-validator>
             {{ csrf_field() }}
            <fieldset>
                <div class="am-form-group">
                    <label for="doc-vld-name-2">终端名称：</label>
                    <input type="text" id="doc-vld-name-2" minlength="2" maxlength="10" placeholder="输入终端名称（2-10个字符）" name="app[name]" value="{{old('app')['name'] ?? $app->name}}" required/>
                </div>
                <div class="am-form-group">
                    <label>终端状态： </label>
                    <label class="am-radio-inline">
                        <input type="radio"  value="0" name="app[status]" required  @if($app->status == 0) checked @endif data-am-ucheck> 启用
                    </label>
                    <label class="am-radio-inline">
                        <input type="radio" value="1" name="app[status]"   @if($app->status == 1) checked @endif  data-am-ucheck> 禁用
                    </label>
                </div>
                <button class="am-btn am-btn-secondary" type="submit">提交</button>
            </fieldset>
        </form>
        </div>
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


