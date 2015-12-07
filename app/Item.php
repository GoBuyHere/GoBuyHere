<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/** This Item has pricing for specific store */
class Item extends Model
{
	/* Has Fields:
	 * store_id (FK)
	 * item_info_id (FK)
	 * price
	 * index on item_info_id + store_id
	 *
	 */

	protected $table = 'items';
	protected $guarded=[];


	public function itemInfo(){
		return $this->belongsTo('App\ItemInfo');
	}

	public function store(){
		return $this->belongsTo('App\Store');
	}

	public function recentListItems(){
		return $this->hasMany('App\RecentListItem');
	}

	public function priceToReadable($qty = 1){
		return '$' . strVal(number_format($this->price * $qty / 100,2));
	}



	public function hasPrice(){
		if($this->price > 0 ){
			return true;
		}
		return false;
	}


}
