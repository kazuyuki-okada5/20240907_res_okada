<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepresentativeStoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('representative_store', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('representative_id');
            $table->unsignedBigInteger('store_id');
            $table->timestamps();

            // 外部キー制約の追加
            $table->foreign('representative_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');

            // 重複を防ぐために代表者IDと店舗IDの組み合わせを一意にする
            $table->unique(['representative_id', 'store_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('representative_store');
    }
}
