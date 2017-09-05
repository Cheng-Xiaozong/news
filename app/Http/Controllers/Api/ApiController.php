<?php

namespace App\Http\Controllers\Api;

use App\Service\ArticleService;
use App\Service\PushService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    protected $Article;
    protected $Push;
    protected $Request;
    protected $Action;
    protected $PostData;
    protected $ResponseData;
    public function __construct(ArticleService $article,PushService $push,Request $request)
    {
        $this->Article=$article;
        $this->Push=$push;
        $this->Request=$request;
        $this->Action=$this->Request->input('act') ?? '';
        $this->PostData=$this->Request->input('JSON') ?? '';
    }

    //入口文件
    public function index()
    {
        switch ($this->Action)
        {
           case 'newsGetDirectories':
               return $this->newsGetDirectories();
               break;
           case 'newsGetArticles':
               return $this->newsGetArticles();
               break;
           case 'newsGetArticleContent':
               return $this->newsGetArticleContent();
               break;
           default:
               return apiReturn(-1,'非法请求,请检查act参数！');
        }
    }


    //获取目录列表
    public function newsGetDirectories()
    {
        $this->postDataValidation();
        $appId=$this->PostData['appId'];
        if(count($this->Push::getEnabledAppById($appId))==0)
        {
            return apiReturn(-1,'appId不存在，或者被禁用！');
        }
        $data['directories']=$this->Push::newsGetDirectoriesApi();
        if(count($data['directories'])>0)
        {
            return apiReturn(0,'获取成功！',$data);
        }else{
            return apiReturn(-2,'暂无目录！');
        }
    }

    //获取文章列表
    public function newsGetArticles()
    {
        $this->postDataValidation();
        $appId=$this->PostData['appId'];
        if(isset($this->PostData['directoryId']))
        {
            $directoryId=$this->PostData['directoryId'];
        }else{
            return apiReturn(-3,'directoryId不能为空');
        }

        if(count($this->Push::getEnabledAppById($appId))==0)
        {
            return apiReturn(-1,'appId不存在，或者被禁用！');
        }

        if(empty($directoryId))
        {
            return apiReturn(-2,'分类ID不能为空！');
        }

        $data['articles']=$this->Article::newsGetArticlesApi($this->Push::getPushArticleIdList($appId,$directoryId));
        if(count($data['articles'])>0)
        {
            return apiReturn(0,'获取成功！',$data);
        }else{
            return apiReturn(-3,'暂无数据！');
        }
    }

    //获取文章内容
    public function newsGetArticleContent()
    {
        $this->postDataValidation();
        $appId=$this->PostData['appId'];
        if(isset($this->PostData['articleId']))
        {
            $articleId=$this->PostData['articleId'];
        }else{
            return apiReturn(-3,'appId或articleId不能为空');
        }

        if(count($this->Push::getEnabledAppById($appId))==0)
        {
            return apiReturn(-1,'appId不存在，或者被禁用！');
        }
        if(empty($articleId))
        {
            return apiReturn(-2,'文章ID不能为空！');
        }
        $data['content']=$this->Article::newsGetArticleContentApi($articleId);
        if($data['content'])
        {
            return apiReturn(0,'获取成功！',$data);
        }else{
            return apiReturn(-3,'暂无数据！');
        }
    }

    //参数处理
    public function postDataValidation()
    {
        //解决客户端和网页请求带来的不同
        if(is_string($this->PostData) && !empty($this->PostData))
        {
            $this->PostData=json_decode($this->PostData,true);
        }
        //判断appID
        if(!isset($this->PostData['appId']))
        {
            return apiReturn(-4,'appId不能为空');
        }
    }

}
