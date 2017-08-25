<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArcitleTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arcitle_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->smallInteger('status')->default(0)->comment('状态（0启用1禁用）');
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
        Schema::drop('arcitle_types');
    }
}
