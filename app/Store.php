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



}
