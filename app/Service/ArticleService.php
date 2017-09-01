<?php
/**
 * Created by PhpStorm.
 * User: cheney
 * Date: 2017/8/24
 * Time: 11:12
 */
namespace App\Service;

use App\ArcitleType;
use App\Article;
class ArticleService
{

    //文章列表
    public static function articleList()
    {
        return Article::paginate(Article::ARTICLE_PAGE_NUM);
    }

    //新增文章
    public static function create($data)
    {
        return Article::create($data);
    }

    //查找文章
    public static function getArticleById($id)
    {
        return Article::find($id);
    }

    //查找文章
    public static function getArticleByIds($ids)
    {
        return Article::whereIn('id',$ids)->paginate(Article::ARTICLE_PAGE_NUM);
    }

    //查找启用文章
    public static function getEnableArticleById($id)
    {
        return Article::whereRaw('id = ? and status = ?',[$id,Article::ARTICLE_STATUS_ENABLE])->get();
    }


    //编辑状态
    public static function editStatus($id)
    {
        $article = Article::find($id);
        if($article->status == Article::ARTICLE_STATUS_ENABLE)
        {
            $article->status = Article::ARTICLE_STATUS_DISABLE;
        }else{
            $article->status = Article::ARTICLE_STATUS_ENABLE;
        }
        return $article->save();
    }

    //删除文章
    public static function delete($id)
    {
        return Article::destroy($id);
    }

    //编辑文章
    public static function edit($id,$data)
    {
        return Article::where('id','=',$id)->update($data);
    }

    //筛选文章
    public static function typeSelect($type_id)
    {
        return Article::where('type','=',$type_id)->paginate(Article::ARTICLE_PAGE_NUM);
    }

    //搜索文章
    public static function search($content)
    {
        return Article::where('title','like','%'.$content.'%')->paginate(Article::ARTICLE_PAGE_NUM);
    }

    //新增文章分类
    public static function createType($data)
    {
        return ArcitleType::create($data);
    }

    //删除文章分类（如果分类下有文章，则不能删除，否则返回删除成功的条数）
    public static function deleteType($id)
    {
        $articleList=Article::where('type','=',$id)->select('id')->get()->toArray();
        return (count($articleList)!=0) ? $articleList : ArcitleType::destroy($id);
    }

    //编辑文章分类
    public static function editType($id,$data)
    {
        return ArcitleType::where('id','=',$id)->update($data);
    }

    //编辑分类状态
    public static function editTypeStatus($id)
    {
        $articleType = ArcitleType::find($id);
        if($articleType->status == ArcitleType::ARTICLE_TYPE_STATUS_ENABLE)
        {
            $articleType->status = ArcitleType::ARTICLE_TYPE_STATUS_DISABLE;
        }else{
            $articleType->status = ArcitleType::ARTICLE_TYPE_STATUS_ENABLE;
        }
        return $articleType->save();
    }

    //文章分类列表
    public static function articleTypeList()
    {
        return ArcitleType::paginate(Article::ARTICLE_PAGE_NUM);
    }

    //文章分类列表
    public static function articleEnableTypeList()
    {
        return ArcitleType::where('status','=',ArcitleType::ARTICLE_TYPE_STATUS_ENABLE)->get();
    }

    //查找文章分类
    public static function getArticleTypeById($id)
    {
        return ArcitleType::find($id);
    }

    //获取文章列表API
    public static function newsGetArticlesApi($ids)
    {
        $articles=Article::whereIn('id',$ids)->select('id','title','face','excerpt','created_at','hits','source')->get()->toArray();
        foreach ($articles as $key=>$article)
        {
            $filePath=$_SERVER['DOCUMENT_ROOT'].'/app/ArticleFace/'.$article['face'];
            if(file_exists($filePath) && !empty($article['face']))
            {
                $articles[$key]['thumb']['md5']=md5_file($filePath);
                $articles[$key]['thumb']['url']=$_SERVER['HTTP_HOST'].'/app/ArticleFace/'.$article['face'];
            }else{
                $articles[$key]['thumb']=null;
            }
        }
        return $articles;
    }

    //获取文章内容API
     public static function newsGetArticleContentApi($id)
     {
         $article=Article::find($id);
         if($article){
             $article->increment('hits');
             return $article->content;
         }else{
             return false;
         }
     }
}