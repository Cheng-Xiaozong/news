<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePushArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('push_articles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type_id')->comment('分类ID');
            $table->integer('article_id')->comment('文章ID');
            $table->integer('app_id')->comment('终端ID');
            $table->smallInteger('status')->default(0)->comment('状态（0启用1禁用）');
            $table->smallInteger('is_hot')->default(1)->comment('状态（0启用1禁用）');
            $table->smallInteger('is_recommend')->default(1)->comment('状态（0启用1禁用）');
            $table->index('type_id');
            $table->index('app_id');
            $table->index('article_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('push_articles');
    }
}
