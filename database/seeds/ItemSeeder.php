<?php

use Illuminate\Database\Seeder;
use App\Item;
use App\ItemInfo;
use App\Store;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $item1 = ItemInfo::create(['name' => 'Lucky Charms']);
        $item2 = ItemInfo::create(['name' => 'Chicken']);
        $item3 = ItemInfo::create(['name' => 'Coke']);
        $item4 = ItemInfo::create(['name' => 'Frozen Pizza']);

	    $items=[$item1,$item2,$item3,$item4];

	    $stores = Store::all();
		/* Generate these 4 items for each store with random prices between
	       $1.00 and $6.00 (100 - 600 in DB)
		*/
        foreach($stores as $store){
	        foreach($items as $item) {
		        $i = new Item;
		        $i->price = rand(100, 600);
		        $i->store()->associate($store);
		        $i->itemInfo()->associate($item);
		        $i->save();
	        }
        }
    }
}
