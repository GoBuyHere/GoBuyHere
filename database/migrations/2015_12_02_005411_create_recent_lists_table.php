<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecentListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recent_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
	        $table->integer('store_id')->unsigned();
	        $table->integer('user_id')->unsigned();

	        $table->foreign('store_id')->references('id')->on('stores');
	        $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('recent_lists');
    }
}
