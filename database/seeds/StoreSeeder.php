<?php

use Illuminate\Database\Seeder;
use App\Store;
use App\StoreType;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $walmart = StoreType::create(array('type' => 'Walmart'));

        $target = StoreType::create(array('type' => 'Target'));

        $w1 = new Store(array('address' => '1501 Skyland Blvd E',
            'city' => 'Tuscaloosa',
            'state' => 'AL',
            'zipcode' => '35405'));

        $w2 = new Store(array('address' => '5710 McFarland Blvd',
            'city' => 'Northport',
            'state' => 'AL',
            'zipcode' => '35476'));

        $t1 = new Store(array('address' => '1901 13th Ave E',
            'city' => 'Tuscaloosa',
            'state' => 'AL',
            'zipcode' => '35404'));


        $walmart->stores()->saveMany([$w1,$w2]);
        $target->stores()->save($t1);

    }
}
