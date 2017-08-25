<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArcitleType extends Model
{
    const ARTICLE_TYPE_STATUS_ENABLE = 0;    //文章状态(可用)
    const ARTICLE_TYPE_STATUS_DISABLE = 1;    //文章状态(禁用)

    //容许批量赋值的字段
    protected $fillable = ['name','status'];

}
