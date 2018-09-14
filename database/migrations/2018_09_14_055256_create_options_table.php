<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('theme_id');
            $table->string('option_name')->comment('选手名称');
            $table->string('option_desc')->comment('选手简介');
            $table->string('option_company')->comment('选手公司');
            $table->string('option_mobile')->comment('选手手机号');
            $table->string('option_img')->comment('选手图片');
            $table->integer('option_vote')->comment('选手票数');
            $table->tinyInteger('option_status')->default('1')->comment('状态 0未发布 1已发布');
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
        Schema::dropIfExists('options');
    }
}
