<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('themes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('theme_name')->comment('主题名称');
            $table->integer('start_time')->comment('活动开始时间');
            $table->integer('end_time')->comment('活动结束时间');
            $table->text('theme_desc')->comment('活动简介');
            $table->integer('theme_vote')->comment('活动总票数');
            $table->tinyInteger('theme_status')->default('0')->comment('状态 0未发布 1已发布');
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
        Schema::dropIfExists('themes');
    }
}
