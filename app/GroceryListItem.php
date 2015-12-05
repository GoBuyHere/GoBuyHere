<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroceryListItem extends Model
{
	/* Has Fields:
	 * grocery_list_id (FK)
	 * item_info_id (FK)
	 * qty
	 * active - boolean
	 *
	 */
	protected $table = 'grocery_list_items';
	protected $guarded = [];
	public function groceryList(){
		return $this->belongsTo('App\GroceryList');
	}

	public function itemInfo(){
		return $this->belongsTo('App\ItemInfo');
	}
}
