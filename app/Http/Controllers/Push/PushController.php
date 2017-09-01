<?php

namespace App\Http\Controllers\Push;

use App\Service\ArticleService;
use App\Service\PushService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PushController extends Controller
{
    protected $Push;
    protected $Article;
    public function __construct(PushService $push,ArticleService $article)
    {
        $this->Push=$push;
        $this->Article=$article;
    }

    //首页
    public function articleType()
    {
        $result = $this->Push::pushArticleTypeList();
        $data['types']=$this->Push::getSubs($result);
        $data['typeList']=$this->Push::typeList();
        return view('Push.articleType',$data);
    }

    //分类筛选
    public function articleTypeSelect($id)
    {
        $result = $this->Push::pushArticleTypeList();
        $data['types']=$this->Push::getSubs($result);
        if($id=='null')
        {
            $data['typeList']=$this->Push::typeList();
        }else{
            $data['typeList']=$this->Push::arrayToObject($this->Push::getSubs($result,$id));
        }
        return view('Push.articleType',$data);
    }

    //搜索分类
    public function searchType($content)
    {
        $result = $this->Push::pushArticleTypeList();
        $data['types']=$this->Push::getSubs($result);
        $data['typeList']=$this->Push::searchType($content);
        return view('Push.articleType',$data);
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
        if($this->Push::sonNum($types,$id)!=0)
        {
            return redirect('/push/articleTypeSelect/'.$pid)->with('error','该分类下有子分类，不能删除！');
        }

        $pushArticleType=$this->Push::getPushArticleType($id);
        $idList=[];
        foreach ($pushArticleType as $k=>$v)
        {
            $idList[$k]=$v['id'];
        }
        $idList=implode("、",$idList);
        if(count($pushArticleType)>0)
        {
            return redirect('/push/articleTypeSelect/'.$pid)->with('error','该分类下有推送ID为【'.$idList.'】文章，不能删除，请至推送管理中删除对应文章后删除！');
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
        $data['types']=$this->Push::getSubs($this->Push::pushEnabledArticleTypeList());
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
        $types = $this->Push::pushArticleTypeList();
        if($this->Push::sonNum($types,$id)!=0)
        {
            return redirect('/push/articleTypeSelect/'.$pid)->with('error','该分类下有子分类，不能禁用！');
        }

        if($this->Push::editArticleTypeStatus($id))
        {
            return redirect('/push/articleTypeSelect/'.$pid)->with('success','操作成功！');
        }else{
            return redirect('/push/articleTypeSelect/'.$pid)->with('error','操作失败！');
        }
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

     //推送管理
     public function push(Request $request)
     {
         $app_id=$request->input('app_id') ?? null;
         $type_id=$request->input('type_id') ?? null;
         $data['articlePushList']=$this->selectPushData($app_id,$type_id);
         $data['appList']=$this->Push::appLists();
         $data['types']=$this->Push::getSubs($this->Push::pushArticleTypeList());
         return view('Push.index',$data);
     }

     //根据条件筛选数据
     public function selectPushData($app_id,$type_id)
     {
         $pushArticles=$this->Push::selectPushData($app_id,$type_id);
         foreach ($pushArticles as $pushArticle)
         {
             $pushArticle->articleInfo= $this->Article::getArticleById($pushArticle->article_id);
         }
         return $pushArticles;
     }

     //推送文章
     public function create(Request $request)
     {
         $articleId=$request->input('article_id');
         $typeId=$request->input('type_id');
         $apps=$request->input('app');
         $pushArticles=$this->Push::getSelectedById($articleId);
         $ids=[];
         foreach ($pushArticles as $pushArticle)
         {
             $ids[]=$pushArticle->id;
         }
         $this->Push::deletePushArticle($ids);
         foreach ($apps as $k=>$v)
         {
             $data['article_id']=$articleId;
             $data['type_id']=$typeId;
             $data['app_id']=$v;
             $result[$k]=$this->Push::addPushArticle($data);
             if(empty($result[$k])){
                 return redirect()->back()->with('error','推送失败！');
             }
         }
         return redirect('/article')->with('success','推送成功，请至【推送管理】中进行管理！');
     }


    //删除推送
    public function delete($id)
    {
        $result=$this->Push::delete($id);
        if($result)
        {
            return redirect('/push')->with('success','删除成功！');
        }else{
            return redirect('/push')->with('error','删除失败！');
        }
    }


    //编辑推送状态
    public function editStatus($id)
    {
        if($this->Push::editStatus($id))
        {
            return redirect('/push')->with('success','操作成功！');
        }else{
            return redirect('/push')->with('error','操作失败！');
        }
    }

    //编辑推送是否热门
    public function editHotStatus($id)
    {
        if($this->Push::editHotStatus($id))
        {
            return redirect('/push')->with('success','操作成功！');
        }else{
            return redirect('/push')->with('error','操作失败！');
        }
    }

    //编辑推送是否推荐
    public function editRecommendStatus($id)
    {
        if($this->Push::editRecommendStatus($id))
        {
            return redirect('/push')->with('success','操作成功！');
        }else{
            return redirect('/push')->with('error','操作失败！');
        }
    }





}
