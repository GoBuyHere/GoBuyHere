<?php

use Illuminate\Database\Seeder;
use App\GroceryList;
use App\GroceryListItem;


class GroceryListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   //find user
        $user = App\User::find(1);
        //make list
	    $list = new GroceryList(['name' => "My Shopping List"]);
        //connect list with use
	    $list->user()->associate($user);
	    $list->save();

	    $itemInfos = App\ItemInfo::all();
	    //create grocery list items associated with $list
	    foreach($itemInfos as $itemInfo){
		    $g = new GroceryListItem;
		    $g->groceryList()->associate($list);
		    $g->itemInfo()->associate($itemInfo);
		    $g->save();
	    }
    }
}
