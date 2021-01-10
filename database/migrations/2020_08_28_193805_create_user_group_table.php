<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateUserGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //【中間テーブル】
    // userてーぶるとグループテーブルがあって、それを繋ぐのが中間テーブル
    // グループidとグループ名
    public function up()
    {
        Schema::create('user_group', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('group_id');
            $table->primary(['user_id', 'group_id']); //主キーを指定.複合キー追加
            //データベースレベルの整合性を強制するために、テーブルに対する外部キー束縛の追加
            //さらに束縛に対して「デリート時(on delete)」と「更新時(on update)」に対する処理をオプションとして指定
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
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
        Schema::dropIfExists('user_group');
    }
}