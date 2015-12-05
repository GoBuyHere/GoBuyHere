<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroceryList extends Model
{
	/* Has Fields:
	 * user_id (FK)
	 * name
	 *
	 */
	protected $table = 'grocery_lists';


	public function user(){
		return $this->belongsTo('App\User');
	}

	public function groceryListItems(){
		return $this->hasMany('App\GroceryListItem');
	}
}
