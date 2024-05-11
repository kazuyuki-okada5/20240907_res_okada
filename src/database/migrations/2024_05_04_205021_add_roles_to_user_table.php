<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRolesToUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('user'); // デフォルトは一般ユーザー

            // 管理者のID範囲を1〜5に設定
            $table->unsignedBigInteger('manager_id')->nullable()->unique();
            $table->foreign('manager_id')->references('id')->on('users')->onDelete('cascade');

            // 店舗代表者のID範囲を6〜30に設定
            $table->unsignedBigInteger('representative_id')->nullable()->unique();
            $table->foreign('representative_id')->references('id')->on('users')->onDelete('cascade');

            // ユーザー認証用のID範囲を31以上に設定
            $table->unsignedBigInteger('user_auth_id')->nullable()->unique();
            $table->foreign('user_auth_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // テーブルから外部キー制約を削除
            $table->dropForeign(['manager_id']);
            $table->dropForeign(['representative_id']);
            $table->dropForeign(['user_auth_id']);

            // カラムを削除
            $table->dropColumn(['role', 'manager_id', 'representative_id', 'user_auth_id']);
        });
    }
}