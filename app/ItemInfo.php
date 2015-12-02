<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/** This ItemInfo just has name and metric(coming soon?)** */
class ItemInfo extends Model
{
	/* Has Fields:
	 * name
	 *
	 */
	protected $table = 'item_infos';
	protected $fillable = [];

	public function items(){
		$this->hasMany('App\Item');
	}

	public function groceryListItems(){
		$this->hasMany('App\GroceryListItem');
	}
}
