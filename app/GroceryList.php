<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Requests;
use Illuminate\Support\Collection;

class GroceryList extends Model
{
	/* Has Fields:
	 * user_id (FK)
	 * name
	 * current
	 *
	 */
	protected $table = 'grocery_lists';
	protected $guarded = [];

	public function user(){
		return $this->belongsTo('App\User');
	}

	public function groceryListItems(){
		return $this->hasMany('App\GroceryListItem');
	}

	public function storeChanges($request){
		$groceryListItems = $this->grocerylistItems;

		$newList = array();
		$names = $request->input('name');
		$qtys = $request->input('qty');
		$actives = $request->input('active');
		$newGroceryList = new Collection();
		$pos = 0;
		for($i=0;$i<count($names);$i++){
			if($names[$i] != "") {
				$pos++;
				$itemInfo = ItemInfo::firstOrCreate(['name' => ucwords($names[$i])]);
				$newGroceryItem = $this->groceryListItems()->where('item_info_id','=',$itemInfo->id)->first();

				if(isset($newGroceryItem) && (($key = $groceryListItems->search($newGroceryItem)) !==false )){

					$groceryListItems->forget($key);
					$newGroceryItem->qty = $qtys[$i];
					$newGroceryItem->active = $actives[$i];
					$newGroceryItem->position = $pos;
					$newGroceryList->push($newGroceryItem);
					//$newGroceryItem->save();
					//$newList[] = $newGroceryItem;

				}
				else{

					$newGroceryItem = new GroceryListItem(['qty' => $qtys[$i], 'active' => $actives[$i]]);
					$newGroceryItem->groceryList()->associate($this);
					$newGroceryItem->itemInfo()->associate($itemInfo);
					$newGroceryItem->position = $pos;
					$newGroceryList->push($newGroceryItem);
					//$newGroceryItem->save();
					//$newList[] = $newGroceryItem;

				}
			}
		}
		foreach($groceryListItems as $delItem){
			echo '<p>' . "DELETE" . '</p>' ;
			$delItem->delete();
		}
		foreach($newGroceryList as $item){
			$item->save();
			$newList[] = $item;
		}

		return $newList;
	}

	public function getActiveItems(){
		$items = $this->groceryListItems()->orderBy('position')->get();
		$filtered = $items->filter(function($item){
			return $item->active == 1;
		});
		return $filtered;
	}
	public function getOrderedStores($filtered){

//pass in filtered items
		//$filtered = $this->getActiveItems();

		$user = $this->user;
		$stores = $user->stores;
		//$stores = Store::with('storeType')->get();
		$storePrices = array();
		foreach($stores as $store){
			$storePrices[] = $store->getPricedItems($filtered);
		}
		$miss = array();
		$price = array();
		foreach($storePrices as $key => $row){
			$miss[$key] = $row[0];
			$price[$key] = $row[1];
		}//now sort

		array_multisort($miss, SORT_ASC, $price, SORT_ASC, $storePrices);
		//fully sorted in order and with store object attached at the end;
		return $storePrices;
	}


}
