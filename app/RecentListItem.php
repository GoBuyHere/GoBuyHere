<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecentListItem extends Model
{
	/* Has Fields:
	 * item_id (FK)
	 * recent_list_id (FK)
	 *
	 */

	protected $table = 'recent_list_items';


	protected $fillable = [];

	public function recentList(){
		return $this->belongsTo('App\RecentList');
	}

	public function item(){
		return $this->belongsTo('App\Item');
	}

}
