<?php
/**
 * Created by PhpStorm.
 * User: cheney
 * Date: 2017/8/24
 * Time: 11:12
 */
namespace App\Service;
use App\App;
use App\PushArticleType;

class PushService
{
    //文章分类列表（搜索用）
    public static function pushArticleTypeList()
    {
        return PushArticleType::all()->toArray();
    }

    //文章分类列表（顶级分类）
    public static function typeList()
    {
        return PushArticleType::where('pid','=','0')->paginate(PushArticleType::PAGE_NUM);
    }

    //搜索文章分类
    public static function searchType($content)
    {
        return PushArticleType::where('name','like','%'.$content.'%')->paginate(PushArticleType::PAGE_NUM);
    }

    //编辑文章分类
    public static function editArticleType($id,$data)
    {
        return PushArticleType::where('id','=',$id)->update($data);
    }

    //查找文章分类
    public static function getArticleTypeById($id)
    {
        return PushArticleType::find($id);
    }

    //编辑状态
    public static function editArticleTypeStatus($id)
    {
        $articleType = PushArticleType::find($id);
        if($articleType->status == PushArticleType::ARTICLE_TYPE_STATUS_ENABLE)
        {
            $articleType->status = PushArticleType::ARTICLE_TYPE_STATUS_DISABLE;
        }else{
            $articleType->status = PushArticleType::ARTICLE_TYPE_STATUS_ENABLE;
        }
        return $articleType->save();
    }

    //删除文章分类
    public static function deleteArticleType($id)
    {
        return PushArticleType::destroy($id);
    }

    //新增文章分类
    public static function addArticleType($data)
    {
        return PushArticleType::create($data);
    }

    //更新path
    public static function editArticleTypePath($result)
    {
        $data['path']=empty($result->path) ? $result->id : $result->path.'-'.$result->id;
        return PushArticleType::where('id','=',$result->id)->update($data);
    }

    //新增终端
    public static function createApp($data)
    {
        return App::create($data);
    }

    //删除终端
    public static function deleteApp($id)
    {
        return App::destroy($id);
    }

    //编辑终端
    public static function editApp($id,$data)
    {
        return App::where('id','=',$id)->update($data);
    }

    //编辑终端状态
    public static function editAppStatus($id)
    {
        $app = App::find($id);
        if($app->status == App::APP_STATUS_ENABLE)
        {
            $app->status = App::APP_STATUS_DISABLE;
        }else{
            $app->status = App::APP_STATUS_ENABLE;
        }
        return $app->save();
    }

    //终端列表
    public static function appList()
    {
        return App::paginate(App::APP_PAGE_NUM);
    }

    //终端列表
    public static function appEnableList()
    {
        return App::where('status','=',App::APP_STATUS_ENABLE)->get();
    }

    //查找终端
    public static function getAppById($id)
    {
        return App::find($id);
    }







}