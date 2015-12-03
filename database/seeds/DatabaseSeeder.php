<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        //$this->call(TableCleaner::class);
        $this->call(UserTableSeeder::class);
	    $this->call(StoreSeeder::class);
	    $this->call(ItemSeeder::class);
	    $this->call(GroceryListSeeder::class);

        Model::reguard();
    }
}
