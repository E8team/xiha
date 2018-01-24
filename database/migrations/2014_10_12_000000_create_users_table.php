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
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email');
            // $table->string('password');
            $table->string('introduce')->nullable();
            $table->char('avatar_hash', 32)->nullable()->comment('头像');
            $table->string('github_url')->nullable();
            $table->unsignedInteger('jokes_count')->default(0)->index()->commnet('发的笑话数量');
            $table->unsignedInteger('votes_count')->default(0)->index();
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
