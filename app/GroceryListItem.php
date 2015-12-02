<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroceryListItem extends Model
{
	/* Has Fields:
	 * grocery_list_id (FK)
	 * item_info_id (FK)
	 *
	 */
	protected $table = 'grocery_list_items';
	protected $fillable = [];

	public function groceryList(){
		return $this->belongsTo('App\GroceryList');
	}

	public function itemInfo(){
		return $this->belongsTo('App\ItemInfo');
	}
}
