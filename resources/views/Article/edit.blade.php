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
            <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">编辑文章</strong> / <small>edit Article</small></div>
        </div>
        <hr>

        <!--内容开始-->
        <div class="form-content">
            <form action="{{url('/article/edit',['id'=>$article->id])}}" method="post" class="am-form" data-am-validator enctype="multipart/form-data">
             {{ csrf_field() }}
            <fieldset>
              {{--  <legend>发表文章</legend>--}}
                <div class="am-form-group">
                    <label for="doc-vld-name-2">文章标题：</label>
                    <input type="text" id="doc-vld-name-2" minlength="2" maxlength="25" placeholder="输入用标题（2-25个字符）" name="article[title]" value="{{old('article')['title'] ?? $article->title}}" required/>
                </div>

                <div class="am-form-group">
                    <label for="doc-vld-name-2">文章作者：</label>
                    <input type="text" id="doc-vld-name-2" minlength="1" maxlength="10" placeholder="输入用作者（1-10个字符）" name="article[author]" value="{{old('article')['author'] ?? $article->author}}" required/>
                </div>

                <div class="am-form-group">
                    <label for="doc-vld-name-2">文章来源：</label>
                    <input type="text" id="doc-vld-name-2" minlength="1" maxlength="30" placeholder="输入用文章来源（1-30个字符）" name="article[source]" value="{{old('article')['source'] ?? $article->source}}" required/>
                </div>

                <div class="am-form-group">
                    <label for="doc-select-1">文章分类：</label>
                    <select id="doc-select-1" required name="article[type]" >
                        <option value="">请选择文章分类</option>
                        @foreach($articleTypeList as $articleType)
                            <option value="{{$articleType->id}}" @if($article->type == $articleType->id) selected @endif>{{$articleType->name}}</option>
                        @endforeach

                    </select>
                    <span class="am-form-caret"></span>
                </div>

                <div class="am-form-group">
                    <label class="am-form-label">文章封面：</label>
                    <input type="file" name="face" multiple>
                     &nbsp;&nbsp;&nbsp;<a href=""><img src="{{$article->face($article->face)}}" alt="当前封面" class="am-img-thumbnail" style="width:150px;height:100px;"></a>
                </div>

                <div class="am-form-group">
                    <label>文章状态： </label>
                    <label class="am-radio-inline">
                        <input type="radio"  value="0" name="article[status]" required  @if($article->status == 0) checked @endif data-am-ucheck> 启用
                    </label>
                    <label class="am-radio-inline">
                        <input type="radio" value="1" name="article[status]"   @if($article->status == 1) checked @endif  data-am-ucheck> 禁用
                    </label>
                </div>

               {{--标签功能废弃，没有意义--}}
               {{-- <div class="am-form-group">
                    <label class="am-form-label">文章标签：</label>
                    <label class="am-checkbox-inline">
                        <input type="checkbox"  value="1" data-am-ucheck name="article[tag][]"  minchecked="1" maxchecked="5"  @if($article->tag && in_array(1,explode(',',$article->tag))) checked @endif required> 咨询
                    </label>
                    <label class="am-checkbox-inline">
                        <input type="checkbox"  value="2" data-am-ucheck name="article[tag][]" @if($article->tag && in_array(2,explode(',',$article->tag))) checked @endif> 新闻
                    </label>
                    <label class="am-checkbox-inline">
                        <input type="checkbox"  value="3" data-am-ucheck name="article[tag][]" @if($article->tag && in_array(3,explode(',',$article->tag))) checked @endif> 行情
                    </label>
                </div>--}}

                <div class="am-form-group">
                    <label for="doc-vld-ta-2">文章摘要：</label><small>10-200字</small>
                    <textarea id="doc-vld-ta-2" minlength="10" maxlength="200" name="article[excerpt]" required>{{$article->excerpt}}</textarea>
                </div>

                <div class="am-form-group">
                    <label for="doc-vld-ta-2">文章详情：</label>
                    <!-- 加载编辑器的容器 -->
                    <script id="container" name="article[content]" type="text/plain">{!!old('article')['content'] ?? $article->content!!}</script>
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


