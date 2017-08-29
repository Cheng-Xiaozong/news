<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    const APP_STATUS_ENABLE = 0;    //状态(可用)
    const APP_STATUS_DISABLE = 1;    //状态(禁用)
    const APP_PAGE_NUM=15;

    //容许批量赋值的字段
    protected $fillable = ['name','status'];
}
