<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecentListItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recent_list_items', function (Blueprint $table) {
	        $table->increments('id');
            $table->timestamps();
            $table->integer('qty');

            $table->integer('item_id')->unsigned();
            $table->integer('recent_list_id')->unsigned();
            $table->foreign('recent_list_id')->references('id')->on('recent_lists');
            $table->foreign('item_id')->references('id')->on('items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('recent_list_items');
    }
}
