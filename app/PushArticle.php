<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PushArticle extends Model
{
    const STATUS_ENABLE = 0;    //状态(可用)
    const STATUS_DISABLE = 1;    //状态(禁用)
    const PAGE_NUM=15;

    //容许批量赋值的字段
    protected $fillable = ['type_id','article_id','app_id','is_hot','is_recommend','status'];
    //文章分类处理
    public function type($value)
    {
        $list = PushArticleType::lists('name','id');
        return $list[$value];

    }

    //分类名处理
    public function appName($value)
    {
        $list = App::lists('name','id');
        return $list[$value];

    }
}
