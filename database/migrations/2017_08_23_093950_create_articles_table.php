<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id')->comment('文章ID');
            $table->integer('user_id')->comment('用户ID');
            $table->string('author')->comment('作者');
            $table->string('title')->comment('标题');
            $table->string('excerpt')->comment('摘要');
            $table->string('source')->comment('来源');
            $table->text('content')->comment('内容');
            $table->smallInteger('status')->default(0)->comment('状态（0启用1禁用）');
            $table->string('tag')->comment('标签');
            $table->string('face')->comment('封面');
            $table->integer('type')->comment('分类');
            $table->bigInteger('hits')->comment('点击量');
            $table->index('title');
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
        Schema::drop('articles');
    }
}
