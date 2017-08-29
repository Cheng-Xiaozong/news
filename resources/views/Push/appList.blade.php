@extends('layout.iframe')
@section('content')
<div class="admin-content-body">
    @include('Article.message')
    <div class="am-cf am-padding am-padding-bottom-0">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">终端列表</strong> / <small>App List</small></div>
    </div>
    <hr>
    <!--内容开始-->
    <div class="am-g">
        <div class="am-u-sm-12">
            @if(count($appList))
                <table class="am-table am-table-striped am-table-hover table-main">
                    <thead>
                    <tr>
                        <th class="table-id">ID</th>
                        <th class="table-title">名称</th>
                        <th class="table-date am-hide-sm-only">创建日期</th>
                        <th class="table-set">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($appList as $app)
                    <tr>
                        <td>{{$app->id}}</td>
                        <td>{{$app->name}}</td>
                        <td>{{$app->created_at}}</td>
                        <td>
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs button-action">
                                    <button data-href="{{url('/push/editApp',['id'=>$app->id])}}" class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 编辑</button>
                                    @if($app->status)
                                        <button data-href="{{url('/push/editAppStatus',['id'=>$app->id])}}" class="am-btn am-btn-default am-btn-xs am-hide-sm-only edit-status"><span class="am-icon-times-circle"></span> 禁用</button>
                                    @else
                                        <button data-href="{{url('/push/editAppStatus',['id'=>$app->id])}}" class="am-btn am-btn-default am-btn-xs am-hide-sm-only am-text-success edit-status"><span class="am-icon-check-circle"></span>启用</button>
                                    @endif
                                    <button data-href="{{url('/push/deleteApp',['id'=>$app->id])}}" class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><span class="am-icon-trash-o"></span> 删除</button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <pre class="page-404">
                    <p style="margin: 10px auto;text-align: center"> 暂时还没有终端(┬＿┬)，请添加终端！</p>

                  </pre>
            @endif
                <div class="am-cf">
                    <div class="am-cf">
                        {{$appList->render()}}
                    </div>
                </div>
        </div>

    </div>
    <!--内容结束-->

    <footer class="admin-content-footer">
        <hr>
        <p class="am-padding-left">© 2014 AllMobilize, Inc. Licensed under MIT license.</p>
    </footer>

@endsection

