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
	    $list = new GroceryList(['name' => "My Shopping List","current" => true]);
        //connect list with use
	    $list->user()->associate($user);

		//$user->save();
	    $list->save();
	    //$user->groceryLists()->save($list);

	    $itemInfos = App\ItemInfo::all();
	    //create grocery list items associated with $list
	    $pos = 0;
	    foreach($itemInfos as $itemInfo){
		    $pos++;
		    $g = new GroceryListItem(['active' => true, 'qty' => 1, 'position' => $pos]);
		    $g->groceryList()->associate($list);
		    $g->itemInfo()->associate($itemInfo);
		    $g->save();
	    }
    }
}
