<?php
/**
 * Created by PhpStorm.
 * User: cheney
 * Date: 2017/9/1
 * Time: 12:00
 */
if(!function_exists('apiReturn'))
{
    function apiReturn($status,$message,$data=null)
    {
        return ['status'=>$status,'message'=>$message,'data'=>$data];
    }
}