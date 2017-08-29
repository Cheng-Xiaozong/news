<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePushArticleTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('push_article_types', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pid')->comment('父ID');
            $table->string('path')->comment('路径');
            $table->smallInteger('status')->default(0)->comment('状态（0启用1禁用）');
            $table->string('name')->comment('分类名称');
            $table->index('pid');
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
        Schema::drop('push_article_types');
    }
}
