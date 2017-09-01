<?php
/**
 * Created by PhpStorm.
 * User: cheney
 * Date: 2017/8/24
 * Time: 11:12
 */
namespace App\Service;
use App\App;
use App\PushArticle;
use App\PushArticleType;

class PushService
{
    //文章分类列表（搜索用）
    public static function pushArticleTypeList()
    {
        return PushArticleType::all()->toArray();
    }

    //文章分类列表（推送）
    public static function pushEnabledArticleTypeList()
    {
        return PushArticleType::where('status','=','0')->get()->toArray();
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

    //查询推送的文章是否分类
    public static function getPushArticleType($id)
    {
        return PushArticle::where('type_id','=',$id)->get();
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

    //终端列表不带分页
    public static function appLists()
    {
        return App::all();
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

    //查找启用的终端
    public static function getEnabledAppById($id)
    {
        return App::whereRaw('status = 0 and id = ?',[$id])->get();
    }

    //获取某分类的直接子分类
    public static function getSons($typeList,$id=0){
        $sons=array();
        foreach($typeList as $item){
            if($item['pid']==$id)
                $sons[]=$item;
        }
        return $sons;
    }

    //获取某个分类的所有子分类
    public static function getSubs($typeList,$id=0,$level=1){
        $subs=array();
        foreach($typeList as $item){
            if($item['pid']==$id){
                $item['level']=$level;
                $item['sonNum']=self::sonNum($typeList,$item['id']);
                $subs[]=$item;
                $subs=array_merge($subs,self::getSubs($typeList,$item['id'],$level+1));
            }

        }
        return $subs;
    }

    //获取某个分类的所有父分类
    public static function getParents($typeList,$id){
        $tree=array();
        foreach($typeList as $item){
            if($item['id']==$id){
                if($item['pid']>0)
                    $tree=array_merge($tree,self::getParents($typeList,$item['pid']));
                $tree[]=$item;
                break;
            }
        }
        return $tree;
    }

    //判断某个类下面子分类的数量
    public static function sonNum($array,$id=0)
    {
        return count(self::getSubs($array,$id));
    }

    //获取多维数组
    public static function getArrays($typeList, $name = 'child', $pid = 0){
        $arr = array();
        foreach ($typeList as $v) {
            if ($v['pid'] == $pid) {
                $v[$name] = self::getArrays($typeList, $name, $v['id']);
                $arr[] = $v;
            }
        }
        return $arr;
    }

    //数组转对象
    public static function arrayToObject($arr) {
        if (gettype($arr) != 'array') {
            return;
        }
        foreach ($arr as $k => $v) {
            if (gettype($v) == 'array' || getType($v) == 'object') {
                $arr[$k] = (object)self::arrayToObject($v);
            }
        }
        return (object)$arr;
    }

    //对象转数组
    public static function objectToArray($obj)
    {
        $obj = (array)$obj;
        foreach ($obj as $k => $v) {
            if (gettype($v) == 'resource') {
                return;
            }
            if (gettype($v) == 'object' || gettype($v) == 'array') {
                $obj[$k] = (array)self::objectToArray($v);
            }
        }
        return $obj;
    }

    //添加推送文章
    public static function addPushArticle($data)
    {
        return PushArticle::create($data);
    }

    //根据文章ID查询当前状态
    public static function getSelectedById($id)
    {
        return PushArticle::where('article_id','=',$id)->get();
    }

    //删除推送记录
    public static function deletePushArticle($data)
    {
        return PushArticle::destroy($data);
    }

    //根据推送ID查询文章
    public static function getArticlesByAppId($app_id)
    {
        return PushArticle::where('app_id','=',$app_id)->get();
    }

    //筛选推送文章
    public static function selectPushData($app_id,$type_id)
    {
        if(is_null($app_id) && is_null($type_id))
        {
            return PushArticle::paginate(PushArticle::PAGE_NUM);
        }

        if(!is_null($app_id) && !is_null($type_id))
        {
            return PushArticle::whereRaw('app_id = ? and type_id = ?',[$app_id,$type_id])->paginate(PushArticle::PAGE_NUM);
        }

        if(!is_null($app_id))
        {
            return PushArticle::where('app_id','=',$app_id)->paginate(PushArticle::PAGE_NUM);
        }

        if(!is_null($type_id))
        {
            return PushArticle::where('type_id','=',$type_id)->paginate(PushArticle::PAGE_NUM);
        }
    }

    //删除推送
    public static function delete($id)
    {
        return PushArticle::destroy($id);
    }


    //编辑推送状态
    public static function editStatus($id)
    {
        $push = PushArticle::find($id);
        if($push->status == PushArticle::STATUS_ENABLE)
        {
            $push->status = PushArticle::STATUS_DISABLE;
        }else{
            $push->status = PushArticle::STATUS_ENABLE;
        }
        return $push->save();
    }

    //编辑推送是否热门
    public static function editHotStatus($id)
    {
        $push = PushArticle::find($id);
        if($push->is_hot == PushArticle::STATUS_ENABLE)
        {
            $push->is_hot = PushArticle::STATUS_DISABLE;
        }else{
            $push->is_hot = PushArticle::STATUS_ENABLE;
        }
        return $push->save();
    }

    //编辑推送是否推荐
    public static function editRecommendStatus($id)
    {
        $push = PushArticle::find($id);
        if($push->is_recommend == PushArticle::STATUS_ENABLE)
        {
            $push->is_recommend = PushArticle::STATUS_DISABLE;
        }else{
            $push->is_recommend = PushArticle::STATUS_ENABLE;
        }
        return $push->save();
    }

    //获取文章列表的ID
    public static function getPushArticleIdList($app_id,$type_id)
    {
        $pushArticles=PushArticle::whereRaw('status = 0 and app_id = ? and type_id = ?',[$app_id,$type_id])->get()->toArray();
        $ids=[];
        foreach ($pushArticles as $pushArticle)
        {
            $ids[]=$pushArticle['article_id'];
        }
        return $ids;
    }

    //获取目录API
    public static function newsGetDirectoriesApi()
    {
        $typeList= PushArticleType::select('id','pid','name')->get()->toArray();
        return self::getArrays($typeList);
    }
}