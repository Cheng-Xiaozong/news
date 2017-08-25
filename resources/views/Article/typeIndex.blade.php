@extends('layout.iframe')
@section('content')
<div class="admin-content-body">
    @include('Article.message')
    <div class="am-cf am-padding am-padding-bottom-0">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">文章分类列表</strong> / <small>Article Type List</small></div>
    </div>
    <hr>
    <!--内容开始-->
    <div class="am-g">
        <div class="am-u-sm-12">
            @if(count($articleTypeList))
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
                    @foreach($articleTypeList as $articleType)
                    <tr>
                        <td>{{$articleType->id}}</td>
                        <td>{{$articleType->name}}</td>
                        <td>{{$articleType->created_at}}</td>
                        <td>
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs button-action">
                                    <button data-href="{{url('/article/editType',['id'=>$articleType->id])}}" class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 编辑</button>
                                    @if($articleType->status)
                                        <button data-href="{{url('/article/editTypeStatus',['id'=>$articleType->id])}}" class="am-btn am-btn-default am-btn-xs am-hide-sm-only edit-status"><span class="am-icon-times-circle"></span> 禁用</button>
                                    @else
                                        <button data-href="{{url('/article/editTypeStatus',['id'=>$articleType->id])}}" class="am-btn am-btn-default am-btn-xs am-hide-sm-only am-text-success edit-status"><span class="am-icon-check-circle"></span>启用</button>
                                    @endif
                                    <button data-href="{{url('/article/deleteType',['id'=>$articleType->id])}}" class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><span class="am-icon-trash-o"></span> 删除</button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <pre class="page-404">
                    <p style="margin: 10px auto;text-align: center"> 暂时还没有分类(┬＿┬)，请添加分类！</p>
                                .----.
                             _.'__    `.
                         .--($)($$)---/#\
                        .' @          /###\
                        :         ,   #####
                        `-..__.-' _.-\###/
                              `;_:    `"'
                            .'"""""`.
                           /,  ya ,\\
                          //  sorry \\
                          `-._______.-'
                          ___`. | .'___
                         (______|______)
                  </pre>
            @endif
                <div class="am-cf">
                    <div class="am-cf">
                        {{$articleTypeList->render()}}
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

