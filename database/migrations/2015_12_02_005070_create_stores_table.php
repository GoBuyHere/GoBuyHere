<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('store_type_id')->unsigned();
            $table->string('address');
	        $table->string('city');
	        $table->string('state');
	        $table->string('zipcode');
            $table->timestamps();
            $table->foreign('store_type_id')->references('id')->on('store_types');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('stores');
    }
}
