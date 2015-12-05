<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroceryListItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grocery_list_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('qty');
            $table->integer('position');
	        $table->boolean('active');
            $table->integer("grocery_list_id")->unsigned();
            $table->integer("item_info_id")->unsigned();
            $table->foreign('grocery_list_id')->references('id')->on('grocery_lists');
            $table->foreign('item_info_id')->references('id')->on('item_infos');

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
        Schema::drop('grocery_list_items');
    }
}
