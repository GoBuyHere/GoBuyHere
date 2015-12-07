<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecentList extends Model
{
	/* Has Fields:
	 * store_id (FK)
	 * user_id (FK)
	 *
	 */
	protected $table = 'recent_lists';
	protected $guarded = ['id'];

	public function store(){
		return $this->belongsTo('App\Store');
	}

	public function user(){
		return $this->belongsTo('App\User');
	}

	public function recentListItems(){
		return $this->hasMany('App\RecentListItem');
	}

	public function totalPrice(){
		$rItems = $this->recentListItems;
		$total = 0;
		foreach($rItems as $rItem){
			$total += $rItem->item->price * $rItem->qty;
		}

		return '$' . strVal(number_format($total  / 100,2));

	}

}
