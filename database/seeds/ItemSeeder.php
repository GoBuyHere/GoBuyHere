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


        $item1 = ItemInfo::create(['name' => 'lucky charms']);
        $item2 = ItemInfo::create(['name' => 'chicken']);
        $item3 = ItemInfo::create(['name' => 'coke']);
        $item4 = ItemInfo::create(['name' => 'frozen pizza']);
	    $item5 = ItemInfo::create(['name' => 'sprite']);
	    $item6 = ItemInfo::create(['name' => 'pepsi']);
	    $item7 = ItemInfo::create(['name' => 'mtn dew']);
	    $item8 = ItemInfo::create(['name' => 'crackers']);
	    $item9 = ItemInfo::create(['name' => 'breakfast bar']);
	    $item10 = ItemInfo::create(['name' => 'shrimp']);
	    $item11 = ItemInfo::create(['name' => 'hot dogs']);
	    $item12 = ItemInfo::create(['name' => 'hot dog buns']);
	    $item13 = ItemInfo::create(['name' => 'mustard']);
	    $item14 = ItemInfo::create(['name' => 'pickle']);
	    $item15 = ItemInfo::create(['name' => 'banana']);
	    $item16 = ItemInfo::create(['name' => 'apple']);
	    $item17 = ItemInfo::create(['name' => 'bacon']);
	    $item18 = ItemInfo::create(['name' => 'hot pocket']);
	    $item19 = ItemInfo::create(['name' => 'orange juice']);
	    $item20 = ItemInfo::create(['name' => 'candy']);


	    $items =[$item1,$item2,$item3,$item4,$item5,$item6,$item7,$item8,$item9,$item10,
		    $item11,$item12,$item13,$item14,$item15,$item16,$item17,$item18,$item19,$item20];

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
