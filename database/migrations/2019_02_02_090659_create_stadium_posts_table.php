<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStadiumPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stadium_posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('stadium');  //スタジアム名
            $table->double('latitude'); //緯度
            $table->double('longitude');//経度
            $table->string('league');   //何のスポーツのリーグか
            $table->string('address');  //住所
            $table->string('country');  //国
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
        Schema::dropIfExists('stadium_posts');
    }
}
