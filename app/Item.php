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
	protected $fillable = [];

	public function itemInfo(){
		return $this->belongsTo('App\ItemInfo');
	}

	public function store(){
		return $this->belongsTo('App\Store');
	}

	public function recentListItems(){
		return $this->hasMany('App\RecentListItem');
	}
}
