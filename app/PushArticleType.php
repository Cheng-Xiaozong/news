<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PushArticleType extends Model
{
    const ARTICLE_TYPE_STATUS_ENABLE = 0;    //文章状态(可用)
    const ARTICLE_TYPE_STATUS_DISABLE = 1;    //文章状态(禁用)
    const PAGE_NUM = 15;    //文章分页条数

    //容许批量赋值的字段
    protected $fillable = ['pid','path','status','name'];
}
