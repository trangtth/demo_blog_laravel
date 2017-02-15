<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('blogs', function (Blueprint $table) {
//            $table->increments('id');
//            $table->integer('author_id');
//            $table->string('title');
//            $table->string('content');
//            $table->string('image');
//            $table->timestamps();
//        });
//
//        Schema::table('blogs', function ($table) {
//            $table->softDeletes();
//        });
//
//        Schema::table('blogs', function (Blueprint $table) {
//            $table->foreign('author_id')
//                ->references('id')
//                ->on('users');
//        });

        Schema::table('users', function ($table) {
            $table->integer('role');
        });

        Schema::table('users', function ($table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('blogs');
    }
}
