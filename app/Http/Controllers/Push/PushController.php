<?php

namespace App\Http\Controllers\Push;

use App\Service\PushService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PushController extends Controller
{

    protected $Push;
    public function __construct(PushService $push)
    {
        $this->Push=$push;
    }

    //首页
    public function articleType()
    {
        $result = $this->Push::pushArticleTypeList();
        $data['types']=$this->getSubs($result);
        $data['typeList']=$this->Push::typeList();
        return view('Push.index',$data);
    }

    //分类筛选
    public function articleTypeSelect($id)
    {
        $result = $this->Push::pushArticleTypeList();
        $data['types']=$this->getSubs($result);
        if($id=='null')
        {
            $data['typeList']=$this->Push::typeList();
        }else{
            $data['typeList']=$this->arrayToObject($this->getSubs($result,$id));
        }
        return view('Push.index',$data);
    }

    //搜索分类
    public function searchType($content)
    {
        $result = $this->Push::pushArticleTypeList();
        $data['types']=$this->getSubs($result);
        $data['typeList']=$this->Push::searchType($content);
        return view('Push.index',$data);
    }

    //编辑分类
    public function editArticleType($id=null,Request $request)
    {
        if($request->isMethod('post'))
        {
            $this->verificationEditArticleTypeData($request);
            $data=$request->input('articleType');
            if($this->Push::editArticleType($id,$data)==0)
            {
                return redirect()->back()->with('error','编辑失败！');
            }else{
                return redirect('/push/articleType')->with('success','编辑成功！');
            }
        }
        $data['articleType']=$this->Push::getArticleTypeById($id);
        return view('Push.editArticleType',$data);
    }

    //删除文章分类
    public function deleteArticleType($id,$pid)
    {
        $types = $this->Push::pushArticleTypeList();
        if($this->sonNum($types,$id)!=0)
        {
            return redirect('/push/articleTypeSelect/'.$pid)->with('error','该分类下有子分类，不能删除！');
        }

        if($this->Push::deleteArticleType($id))
        {
            return redirect('/push/articleTypeSelect/'.$pid)->with('success','删除成功！');
        }else{
            return redirect('/push/articleTypeSelect/'.$pid)->with('error','删除失败！');
        }
    }

    //新增文章分类
    public function addArticleType(Request $request)
    {
        if($request->isMethod('post'))
        {
            $this->verificationAddArticleTypeData($request);
            $data=$request->input('articleType');
            $result=$this->Push::addArticleType($data);
            if($result)
            {
                $data['pid']= empty($data['pid']) ? 'null' : $data['pid'];
                $this->Push::editArticleTypePath($result);
                return redirect('/push/articleTypeSelect/'.$data['pid'])->with('success','新增成功！');
            }else{
                return redirect()->back()->with('error','新增失败！');
            }
        }
        $result = $this->Push::pushArticleTypeList();
        $data['types']=$this->getSubs($result);
        return view('Push.addArticleType',$data);
    }

    //验证数据
    public function verificationEditArticleTypeData($request)
    {
        $this->validate($request, [
            "articleType.name" => 'required',
        ], [
            'required' => ':attribute 为必填项',
            'integer' => ':attribute 必须为整数',
        ], [
            'articleType.name' => '分类名称',
        ]);
    }

    //验证数据
    public function verificationAddArticleTypeData($request)
    {
        $this->validate($request, [
            "articleType.name" => 'required',
            "articleType.pid" => 'required|integer',
        ], [
            'required' => ':attribute 为必填项',
            'integer' => ':attribute 必须为整数',
        ], [
            'articleType.name' => '分类名称',
            'articleType.pid' => '分类的父元素',
        ]);
    }

    //编辑文章分类状态
    public function editArticleTypeStatus($id,$pid)
    {
        if($this->Push::editArticleTypeStatus($id))
        {
            return redirect('/push/articleTypeSelect/'.$pid)->with('success','操作成功！');
        }else{
            return redirect('/push/articleTypeSelect/'.$pid)->with('error','操作失败！');
        }
    }


    //获取某分类的直接子分类
    public function getSons($categorys,$id=0){
        $sons=array();
        foreach($categorys as $item){
            if($item['pid']==$id)
                $sons[]=$item;
        }
        return $sons;
    }

    //获取某个分类的所有子分类
    public function getSubs($categorys,$id=0,$level=1){
        $subs=array();
        foreach($categorys as $item){
            if($item['pid']==$id){
                $item['level']=$level;
                $item['sonNum']=$this->sonNum($categorys,$item['id']);
                $subs[]=$item;
                $subs=array_merge($subs,$this->getSubs($categorys,$item['id'],$level+1));
            }

        }
        return $subs;
    }

    //获取某个分类的所有父分类
    public function getParents($categorys,$id){
        $tree=array();
        foreach($categorys as $item){
            if($item['id']==$id){
                if($item['pid']>0)
                    $tree=array_merge($tree,$this->getParents($categorys,$item['pid']));
                $tree[]=$item;
                break;
            }
        }
        return $tree;
    }

    //判断某个类下面子分类的数量
    public function sonNum($array,$id=0)
    {
        return count($this->getSubs($array,$id));
    }

    //数组转对象
    public function arrayToObject($arr) {
        if (gettype($arr) != 'array') {
            return;
        }
        foreach ($arr as $k => $v) {
            if (gettype($v) == 'array' || getType($v) == 'object') {
                $arr[$k] = (object)$this->arrayToObject($v);
            }
        }

        return (object)$arr;
    }

    //对象转数组
    public function objectToArray($obj)
    {
        $obj = (array)$obj;
        foreach ($obj as $k => $v) {
            if (gettype($v) == 'resource') {
                return;
            }
            if (gettype($v) == 'object' || gettype($v) == 'array') {
                $obj[$k] = (array)$this->objectToArray($v);
            }
        }
        return $obj;
    }

    //终端列表
    public function appList()
    {
        $data['appList']=$this->Push::appList();
        return view('push.appList',$data);
    }

    //编辑终端状态
    public function editAppStatus($id)
    {
        if($this->Push::editappStatus($id))
        {
            return redirect('/push/appList')->with('success','操作成功！');
        }else{
            return redirect('/push/appList')->with('error','操作失败！');
        }
    }

    //编辑终端
    public function editApp($id=null,Request $request)
    {
        if($request->isMethod('post'))
        {
            $this->verificationAddAppData($request);
            $data=$request->input('app');
            if($this->Push::editApp($id,$data)==0)
            {
                return redirect()->back()->with('error','编辑失败！');
            }else{
                return redirect('/push/appList')->with('success','编辑成功！');
            }
        }
        $data['app']=$this->Push::getAppById($id);
        return view('push.editApp',$data);
    }

    //删除终端
    public function deleteApp($id)
    {
        $result=$this->Push::deleteApp($id);
        if($result)
        {
            return redirect('/push/appList')->with('success','删除成功！');
        }else{
            return redirect('/push/appList')->with('error','删除失败！');
        }
    }

    //新增终端
    public function createApp(Request $request)
    {
        if($request->isMethod('post'))
        {
            $this->verificationAddAppData($request);
            $data=$request->input('app');
            if($this->Push::createApp($data))
            {
                return redirect('/push/appList')->with('success','新增成功！');
            }else{
                return redirect()->back()->with('error','新增失败！');
            }
        }
        return view('push.createApp');
    }

    //验证数据
    public function verificationAddAppData($request)
    {
        $this->validate($request, [
            "app.name" => 'required',
            "app.status" => 'required|integer',
        ], [
            'required' => ':attribute 为必填项',
            'integer' => ':attribute 必须为整数',
        ], [
            'app.name' => '终端名称',
            'app.status' => '终端状态',
        ]);
    }





}
