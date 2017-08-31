@extends('layout.iframe')
@section('content')
    @include('Push.message')
    <div class="am-cf am-padding am-padding-bottom-0">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">推送管理</strong> / <small>Article Push Type List</small></div>
    </div>
    <hr>

    <div class="am-tabs" data-am-tabs style="margin: 20px;">
        <ul class="am-tabs-nav am-nav am-nav-tabs">
            @foreach($appList as $app)
                <li><a href="#id-{{$app->id}}">{{$app->name}}</a></li>
            @endforeach
        </ul>
        <div class="am-tabs-bd">
            @foreach($appList as $app)
                <div class="am-tab-panel am-fade am-in" id="id-{{$app->id}}">
                    {{--分类选择--}}
                    <div class="am-u-sm-12 am-u-md-3">
                        <div class="am-form-group">
                            <select  data-href="{{url('/push/articleTypeSelect')}}" data-index-href="{{url('/push/articleType')}}">
                                <option value="null">请选择分类</option>
                                @foreach($types as $type)
                                    <option data-pid="{{$type['pid']}}" @if(explode('/',Request::getPathInfo())[count(explode('/',Request::getPathInfo()))-1] == $type['id']) selected @endif value="{{$type['id']}}" @if(!empty($type['sonNum'])) style="font-weight:bold;color:#000;" @endif>{{str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;',$type['level']-1).$type['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    {{--文章列表--}}
                    <div class="am-u-sm-12">
                        @if(count($app->pushArticles))
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
                                @foreach($app->Articles as $key=>$val)
                                    <tr>
                                        <td>{{$val->id}}</td>
                                        <td><a href="{{url('/article/detail',['id'=>$val->id])}}">{{$val->title}}</a></td>
                                        <td>{{$app->Articles[$key]->type($app->Articles[$key]->type)}}</td>
                                        <td class="am-hide-sm-only">{{$val->author}}</td>
                                        <td class="am-hide-sm-only">{{$val->created_at}}</td>
                                        <td class="am-hide-sm-only">{{$val->hits}}</td>
                                        <td>
                                            <div class="am-btn-toolbar">
                                                <div class="am-btn-group am-btn-group-xs button-action">
                                                    <button data-href="{{url('/article/edit',['id'=>$val->id])}}" class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 编辑</button>
                                                    @if($val->status)
                                                        <button data-href="{{url('/article/editStatus',['id'=>$val->id])}}" class="am-btn am-btn-default am-btn-xs am-hide-sm-only edit-status"><span class="am-icon-times-circle"></span> 禁用</button>
                                                    @else
                                                        <button data-href="{{url('/article/editStatus',['id'=>$val->id])}}" class="am-btn am-btn-default am-btn-xs am-hide-sm-only am-text-success edit-status"><span class="am-icon-check-circle"></span>启用</button>
                                                    @endif
                                                    <button data-href="{{url('/article/delete',['id'=>$val->id])}}" class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><span class="am-icon-trash-o"></span> 删除</button>
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
                            {{$app->Articles->render()}}
                        </div>
                    </div>
                    {{--文章列表--}}

                </div>
            @endforeach
        </div>
    </div>


@endsection
