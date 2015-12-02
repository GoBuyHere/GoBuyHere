<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments("id");
            $table->integer('store_id')->unsigned();
            $table->integer('item_info_id')->unsigned();
            $table->integer('price')->unsigned();
            $table->timestamps();

            $table->foreign('item_info_id')->references('id')->on('item_infos');
            $table->foreign('store_id')->references('id')->on('stores');
            $table->unique(['item_info_id','store_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('items');
    }
}
