<?php

use Illuminate\Database\Seeder;

class TableCleaner extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    DB::table('users')->truncate();
	    DB::table('store_types')->truncate();
	    DB::table('stores')->truncate();
	    DB::table('item_infos')->truncate();
        DB::table('items')->truncate();
	    DB::table('grocery_lists')->truncate();
	    DB::table('grocery_list_items')->truncate();
	    //DB::table('recent_lists')->truncate();
	    //DB::table('recent_list_items')->truncate();


    }
}
