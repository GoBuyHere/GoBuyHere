<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
	/* Has Fields:
	 * address
	 * city
	 * state
	 * zipcode
	 * store_type_id (FK)
	 *
	 */
	protected $table = 'stores';
	//protected $fillable = [];

	public function storeType(){
		return $this->belongsTo('App\StoreType');
	}

	public function items(){
		return $this->hasMany('App\Item');
	}

	public function recentLists(){
		return $this->hasMany('App\RecentList');
	}

	public function getStoreType(){
		return $this->storeType->type;
	}

	public function formatCityStateZip(){
		return $this->city . ', ' . $this->state . $this->zipcode;
	}

	public function getPricedItems($groceryItems){ //groceryListItems
		$missAndPrice = array(0,0,array(),array());  //misses first, prices

		$total = 0;
		foreach($groceryItems as $gItem){
			$item = $this->items()->where('item_info_id','=',$gItem->item_info_id)->first();
			if($item != null){
				$price = $gItem->qty * $item->price;
				$price = number_format($price / 100,2);
				$missAndPrice[1] += $price;
				$missAndPrice[2][$gItem->item_info_id] = $price;
			}
			else{
				$missAndPrice[0] ++;
			}
		}
		$missAndPrice[3] = $this;

		return $missAndPrice; //format of [$miss, $totalprice, [$grocery_list_item_id => $price], $store]
	}





}
