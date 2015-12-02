<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
	protected $table = 'stores';
	//protected $fillable = [];

	public function storeType(){
		return $this->belongsTo('App\StoreType');
	}

	public function item(){
		return $this->hasMany('App\Item');
	}

	public function recentLists(){
		return $this->hasMany('App\RecentList');
	}

}
