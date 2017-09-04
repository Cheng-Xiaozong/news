<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

    const ARTICLE_STATUS_ENABLE = 0;    //文章状态(可用)
    const ARTICLE_STATUS_DISABLE = 1;    //文章状态(禁用)
    const ARTICLE_PAGE_NUM = 15;    //文章分页条数

    //容许批量赋值的字段
    protected $fillable = ['user_id','author','title','excerpt','source','content','status','tag','face','type','hits'];

    //文章分类处理
    public function type($value)
    {
        $list = ArcitleType::lists('name','id');
        return $list[$value];
    }

    //文章封面处理
    public function face($value)
    {
       return empty($value) ? 'http://'.$_SERVER['HTTP_HOST'].'/app/public/noImg.png' : 'http://'.$_SERVER['HTTP_HOST'].'/app/ArticleFace/'.$value;
    }
}
