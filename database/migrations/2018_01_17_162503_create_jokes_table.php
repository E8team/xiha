<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJokesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 笑话表
        Schema::create('jokes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index();
            $table->char('image_hash', 32)->nullable()->comment('对应 images 表 hash 字段');
            $table->unsignedInteger('comments_count')->default(0)->index()->comment('评论数');
            $table->unsignedInteger('up_votes_count')->default(0)->index()->comment('赞数量');
            $table->text('content')->commnet('内容');
            $table->timestampsTz();
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jokes');
    }
}
