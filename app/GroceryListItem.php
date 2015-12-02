<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroceryListItem extends Model
{
	protected $table = 'grocery_list_items';
	protected $fillable = [];

	public function groceryList(){
		return $this->belongsTo('App\GroceryList');
	}

	public function itemInfo(){
		return $this->belongsTo('App\ItemInfo');
	}
}
