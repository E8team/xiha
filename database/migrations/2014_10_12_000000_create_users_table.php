<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('用户昵称');
            $table->string('username')->unique()->comment('用户名');
            $table->string('email')->comment('邮箱');
            // $table->string('password');
            $table->string('introduce')->nullable()->comment('简介');
            $table->char('avatar_hash', 32)->nullable()->comment('头像');
            $table->string('github_url')->nullable()->comment('github 地址');
            $table->unsignedInteger('jokes_count')->default(0)->index()->commnet('发的笑话数量');
            $table->unsignedInteger('up_votes_count')->default(0)->index()->comment('通过 joke 和评论得到的所有赞');
            $table->unsignedInteger('views_count')->default(0)->index();
            $table->timestampTz('last_active_at')->nullable();
            // $table->rememberToken();
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
