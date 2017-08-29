@extends('layout.iframe')
@section('content')
    <div class="admin-content-body">
    @include('Push.message')
    <div class="am-cf am-padding am-padding-bottom-0">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">分类列表</strong> / <small>Article Push Type List</small></div>
    </div>
    <hr>
    <!--内容开始-->
    <div class="am-g">

        <div class="am-u-sm-12 am-u-md-3">
            <div class="am-form-group">
                <select  class="push-article-type-select" data-href="{{url('/push/articleTypeSelect')}}" data-index-href="{{url('/push/articleType')}}">
                    <option value="null">请选择分类</option>
                    @foreach($types as $type)
                        <option data-pid="{{$type['pid']}}" @if(explode('/',Request::getPathInfo())[count(explode('/',Request::getPathInfo()))-1] == $type['id']) selected @endif value="{{$type['id']}}" @if(!empty($type['sonNum'])) style="font-weight:bold;color:#000;" @endif>{{str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;',$type['level']-1).$type['name']}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="am-u-sm-12 am-u-md-3">
            <div class="am-input-group am-input-group-sm">
                <input class="am-form-field article-search-content" type="text">
                <span class="am-input-group-btn">
            <button class="am-btn am-btn-default article-search" type="button" data-href="{{url('/push/searchType')}}">搜索</button>
          </span>
            </div>
        </div>
    </div>

   <div class="am-g">
        <div class="am-u-sm-12">
            @if(count($typeList))
                <table class="am-table am-table-striped am-table-hover table-main">
                    <thead>
                    <tr>
                        <th class="table-id">ID</th>
                        <th class="table-title">名称</th>
                        <th class="table-type">路径</th>
                        <th class="table-date am-hide-sm-only">创建日期</th>
                        <th class="table-set">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($typeList as $type)
                        <tr>
                            <td>{{$type->id}}</td>
                            <td>{{$type->name}}</td>
                            <td>{{$type->path}}</td>
                            <td class="am-hide-sm-only">{{$type->created_at}}</td>
                            <td>
                                <div class="am-btn-toolbar">
                                    <div class="am-btn-group am-btn-group-xs button-action-push">
                                        <button data-href="{{url('/push/editArticleType',['id'=>$type->id])}}" class="am-btn am-btn-default am-btn-xs am-text-secondary  button-push-article-type-edit"><span class="am-icon-pencil-square-o"></span> 编辑</button>
                                        @if($type->status)
                                            <button data-href="{{url('/push/editArticleTypeStatus',['id'=>$type->id])}}" class="am-btn am-btn-default am-btn-xs am-hide-sm-only edit-status button-push-article-type-status"><span class="am-icon-times-circle"></span> 禁用</button>
                                        @else
                                            <button data-href="{{url('/push/editArticleTypeStatus',['id'=>$type->id])}}" class="am-btn am-btn-default am-btn-xs am-hide-sm-only am-text-success edit-status button-push-article-type-status"><span class="am-icon-check-circle"></span>启用</button>
                                        @endif
                                        <button data-href="{{url('/push/deleteArticleType',['id'=>$type->id])}}" class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only button-push-article-type-delete"><span class="am-icon-trash-o"></span> 删除</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p style="margin: 10px auto;text-align: center"> 暂时还没有找到分类(┬＿┬)</p>
            @endif
            <div class="am-cf">
                @if(Request::getPathInfo()=='{{url("/push")}}')
                    {{$typeList->render()}}
                @endif
            </div>
        </div>

    </div>
    <!--内容结束-->
@endsection

@section('javascript')

@endsection


