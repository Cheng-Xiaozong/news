

@extends('layout.iframe')
@section('content')
    <div class="admin-content-body">
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
            <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">首页</strong> / <small>Index</small></div>
        </div>
        <hr>

        <!--内容开始-->
        <div class="am-g">
            <div class="am-u-sm-12">
                <h4 class="am-text-center am-text-xl am-margin-top-lg am-text-secondary">欢迎登陆甜头菜文章管理系统</h4>
                <p class="am-text-center">Welcome to the Tiantoucia management system!</p>
                <pre class="page-404">          .----.
       _.'__    `.
   .--($)($$)---/#\
 .' @          /###\
 :         ,   #####
  `-..__.-' _.-\###/
        `;_:    `"'
      .'"""""`.
     /,  ya ,\\
    //  404!  \\
    `-._______.-'
    ___`. | .'___
   (______|______)
        </pre>

            </div>
        </div>

        <!--内容结束-->
        <footer class="admin-content-footer">
            <hr>
            <p class="am-padding-left">© 2014 AllMobilize, Inc. Licensed under MIT license.</p>
        </footer>

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


