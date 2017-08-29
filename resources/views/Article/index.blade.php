@extends('layout.iframe')
@section('content')
<div class="admin-content-body">
    @include('Article.message')
    <div class="am-cf am-padding am-padding-bottom-0">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">文章列表</strong> / <small>Article List</small></div>
    </div>
    <hr>
    <!--内容开始-->
    <div class="am-g">
        <div class="am-u-sm-12 am-u-md-3">
            <div class="am-form-group">
                <select data-am-selected="{btnSize: 'sm'}" class="article-type-select" data-href="{{url('/article/typeSelect')}}" data-index-href="{{url('/article')}}">
                    <option value="null">请选择分类</option>
                    @foreach($articleTypeList as $articleType)
                        <option value="{{$articleType->id}}" @if(explode('/',Request::getPathInfo())[count(explode('/',Request::getPathInfo()))-1] == $articleType->id) selected @endif>{{$articleType->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="am-u-sm-12 am-u-md-3">
            <div class="am-input-group am-input-group-sm">
                <input class="am-form-field article-search-content" type="text">
                <span class="am-input-group-btn">
            <button class="am-btn am-btn-default article-search" type="button" data-href="{{url('/article/search')}}">搜索</button>
          </span>
            </div>
        </div>
    </div>

    <div class="am-g">
        <div class="am-u-sm-12">
            @if(count($articleList))
                <table class="am-table am-table-striped am-table-hover table-main">
                    <thead>
                    <tr>
                       <th class="table-id">ID</th>
                        <th class="table-title">标题</th>
                        <th class="table-type">类别</th>
                        <th class="table-author am-hide-sm-only">作者</th>
                        <th class="table-date am-hide-sm-only">发表日期</th>
                        <th class="table-date am-hide-sm-only">点击量</th>
                        <th class="table-set">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($articleList as $article)
                    <tr>
                        <td>{{$article->id}}</td>
                        <td><a href="{{url('/article/detail',['id'=>$article->id])}}">{{$article->title}}</a></td>
                        <td>{{$article->type($article->type)}}</td>
                        <td class="am-hide-sm-only">{{$article->author}}</td>
                        <td class="am-hide-sm-only">{{$article->created_at}}</td>
                        <td class="am-hide-sm-only">{{$article->hits}}</td>
                        <td>
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs button-action">
                                    <button data-href="{{url('/article/edit',['id'=>$article->id])}}" class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 编辑</button>
                                    @if($article->status)
                                        <button data-href="{{url('/article/editStatus',['id'=>$article->id])}}" class="am-btn am-btn-default am-btn-xs am-hide-sm-only edit-status"><span class="am-icon-times-circle"></span> 禁用</button>
                                    @else
                                        <button data-href="{{url('/article/editStatus',['id'=>$article->id])}}" class="am-btn am-btn-default am-btn-xs am-hide-sm-only am-text-success edit-status"><span class="am-icon-check-circle"></span>启用</button>
                                    @endif
                                    <button data-href="{{url('/article/delete',['id'=>$article->id])}}" class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><span class="am-icon-trash-o"></span> 删除</button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p style="margin: 10px auto;text-align: center"> 暂时还没有找到文章(┬＿┬)</p>
            @endif
                <div class="am-cf">
                       {{$articleList->render()}}
                </div>
        </div>

    </div>
    <!--内容结束-->

    <footer class="admin-content-footer">
        <hr>
        <p class="am-padding-left">© 2014 AllMobilize, Inc. Licensed under MIT license.</p>
    </footer>
</div>
@endsection

