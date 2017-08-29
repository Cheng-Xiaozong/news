<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PushTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $array=[
            ['id'=>'1','pid'=>'0','path'=>'1','name'=>'数码','status'=>1],
            ['id'=>'2','pid'=>'0','path'=>'2','name'=>'服装','status'=>1],
            ['id'=>'3','pid'=>'1','path'=>'1-3','name'=>'手机','status'=>1],
            ['id'=>'4','pid'=>'1','path'=>'1-4','name'=>'相机','status'=>1],
            ['id'=>'5','pid'=>'3','path'=>'1-3-5','name'=>'音乐手机','status'=>1],
            ['id'=>'6','pid'=>'3','path'=>'1-3-6','name'=>'拍照手机','status'=>1],
            ['id'=>'7','pid'=>'4','path'=>'1-4-7','name'=>'智能相机','status'=>1],
            ['id'=>'8','pid'=>'4','path'=>'1-4-8','name'=>'单反相机','status'=>1],
            ['id'=>'9','pid'=>'2','path'=>'2-9','name'=>'上衣','status'=>1],
            ['id'=>'10','pid'=>'2','path'=>'2-10','name'=>'裤子','status'=>1],
            ['id'=>'11','pid'=>'0','path'=>'11','name'=>'其他','status'=>1],
            ['id'=>'12','pid'=>'7','path'=>'1-4-7-12','name'=>'男士美颜相机','status'=>1],
            ['id'=>'13','pid'=>'7','path'=>'1-4-7-13','name'=>'女士美颜相机','status'=>1],
            ['id'=>'14','pid'=>'13','path'=>'1-4-7-13-14','name'=>'女士美颜自拍相机','status'=>1],
            ['id'=>'15','pid'=>'13','path'=>'1-4-7-13-14','name'=>'女士美颜照片相机','status'=>1],
        ];
        DB::table('push_article_types')->insert($array);
    }
}
