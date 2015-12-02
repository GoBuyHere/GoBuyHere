<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/** This Item has pricing for specific store */
class Item extends Model
{

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
