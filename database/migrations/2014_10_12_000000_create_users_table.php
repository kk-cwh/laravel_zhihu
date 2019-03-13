<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('avatar');
            $table->string('confirmation_token');
            $table->smallInteger('is_active')->default(0);
            $table->integer('questions_count')->default(0)->comment('提问数量');
            $table->integer('answers_count')->default(0)->comment('回答数量');
            $table->integer('comments_count')->default(0)->comment('评论数量');
            $table->integer('favorites_count')->default(0)->comment('收藏数量');
            $table->integer('likes_count')->default(0)->comment('点赞数量');
            $table->integer('followers_count')->default(0)->comment('关注数量');
            $table->integer('followings_count')->default(0)->comment('被关注数量');
            $table->json('settings')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
