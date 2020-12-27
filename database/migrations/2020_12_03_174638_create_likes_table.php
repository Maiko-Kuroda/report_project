<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); //外部キー
            $table->unsignedBigInteger('report_id');//外部キー
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');//外部キー
            $table->foreign('report_id')->references('id')->on('reports')->onDelete('cascade');//外部キー
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
        Schema::dropIfExists('likes');
    }
}
