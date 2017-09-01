@extends('layout.iframe')
@section('content')
    @include('Push.message')
    <div class="am-cf am-padding am-padding-bottom-0">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">推送管理</strong> / <small>Article Push Type List</small></div>
    </div>
    <hr>
    {{--终端分类选择--}}
    <div class="am-u-sm-12 am-u-md-3">
        <div class="am-form-group">
            <select  data-href="{{url('/push')}}"   data-am-selected="{btnSize: 'sm'}" class="select-push" name="app-type">
                <option value="null">请选择终端类型</option>
                @foreach($appList as $app)
                    <option {{isset($_GET['app_id']) && ($_GET['app_id']==$app->id) ? 'selected' : ''}} value="{{$app->id}}">{{$app->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    {{--文章分类选择--}}
    <div class="am-u-sm-12 am-u-md-3">
        <div class="am-form-group">
            <select  data-href="{{url('/push')}}" data-am-selected="{btnSize: 'sm'}"  class="select-push" name="article-type">
                <option value="null">请选择文章分类</option>
                @foreach($types as $type)
                    <option   @if(!empty($type['sonNum'])) style="font-weight:bold;color:#000;" disabled @endif {{isset($_GET['type_id']) && ($_GET['type_id']==$type['id']) ? 'selected' : ''}} value="{{$type['id']}}" @if(!empty($type['sonNum'])) style="font-weight:bold;color:#000;" @endif>{{str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;',$type['level']-1).$type['name']}}</option>
                @endforeach
            </select>
        </div>
    </div>

    {{--推送内容--}}
    <div class="am-g">
        <div class="am-u-sm-12">
            @if(count($articlePushList))
                <table class="am-table am-table-striped am-table-hover table-main">
                    <thead>
                    <tr>
                        <th class="table-id">ID</th>
                        <th class="table-title">标题</th>
                        <th class="table-type">终端</th>
                        <th class="table-type">类别</th>
                        <th class="table-author am-hide-sm-only">作者</th>
                        <th class="table-date am-hide-sm-only">发表日期</th>
                        <th class="table-date am-hide-sm-only">推送日期</th>
                        <th class="table-date am-hide-sm-only">点击量</th>
                        <th class="table-set">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($articlePushList as $articlePush)
                        <tr>
                            <td>{{$articlePush->id}}</td>
                            <td><a href="{{url('/article/detail',['id'=>$articlePush->articleInfo->id])}}">{{$articlePush->articleInfo->title}}</a></td>
                            <td>{{$articlePush->appName($articlePush->app_id)}}</td>
                            <td>{{$articlePush->type($articlePush->type_id)}}</td>
                            <td class="am-hide-sm-only">{{$articlePush->articleInfo->author}}</td>
                            <td class="am-hide-sm-only">{{$articlePush->articleInfo->created_at}}</td>
                            <td class="am-hide-sm-only">{{$articlePush->created_at}}</td>
                            <td class="am-hide-sm-only">{{$articlePush->articleInfo->hits}}</td>
                            <td>
                                <div class="am-btn-toolbar">
                                    <div class="am-btn-group am-btn-group-xs button-action">
                                        @if($articlePush->is_hot)
                                            <button data-href="{{url('/push/editHotStatus',['id'=>$articlePush->id])}}" class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><span class="am-icon-star"></span> 热门</button>
                                        @else
                                            <button data-href="{{url('/push/editHotStatus',['id'=>$articlePush->id])}}" class="am-btn am-btn-default am-btn-xs am-text-warning am-hide-sm-only"><span class="am-icon-star"></span> 热门</button>
                                        @endif

                                        @if($articlePush->is_recommend)
                                             <button data-href="{{url('/push/editRecommendStatus',['id'=>$articlePush->id])}}" class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><span class="am-icon-thumbs-up"></span> 推荐</button>
                                        @else
                                             <button data-href="{{url('/push/editRecommendStatus',['id'=>$articlePush->id])}}" class="am-btn am-btn-default am-btn-xs am-text-secondary am-hide-sm-only"><span class="am-icon-thumbs-up"></span> 推荐</button>
                                        @endif

                                        @if($articlePush->status)
                                            <button data-href="{{url('/push/editStatus',['id'=>$articlePush->id])}}" class="am-btn am-btn-default am-btn-xs am-hide-sm-only edit-status"><span class="am-icon-times-circle"></span> 禁用</button>
                                        @else
                                            <button data-href="{{url('/push/editStatus',['id'=>$articlePush->id])}}" class="am-btn am-btn-default am-btn-xs am-hide-sm-only am-text-success edit-status"><span class="am-icon-check-circle"></span>启用</button>
                                        @endif
                                        <button data-href="{{url('/push/delete',['id'=>$articlePush->id])}}" class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><span class="am-icon-trash-o"></span> 删除</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p style="margin: 10px auto;text-align: center"> 暂时还没有找到被推送的文章(┬＿┬)</p>
            @endif
            <div class="am-cf">
                {{$articlePushList->render()}}
            </div>
        </div>
    </div>
@endsection
